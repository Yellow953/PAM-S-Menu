<script async>
    // Constants and Configurations
    const CONFIG = {
        cookieKey: "{{ Helper::menu_or_shop($business) == 'menu' ? 'bag_' . $business->id : 'cart_' . $business->id }}",
        rate: {{ $rate }},
        deliveryFee: {{ $business->delivery ?? 0 }},
        businessPhone: "{{ $business->phone }}".replace(/\D/g, ""),
        routes: {
            discountCheck: '{{ route("discounts.check", $business->name) }}',
            menu: '{{ route("menu", $business->name) }}',
            shop: '{{ route("shop.home", $business->name) }}',
            previous: "{{ route(Helper::menu_or_shop($business) == 'menu' ? 'menu' : 'shop.home', $business->name) }}"
        },
        csrfToken: '{{ csrf_token() }}'
    };

    // State Management
    const state = {
        bag: getBagFromCookies(),
        discount: { value: 0, type: null },
        map: {
            instance: null,
            marker: null,
            initialized: false,
            loaded: false
        },
        elements: {
            orderSummary: $("#orderSummary"),
            checkoutSubtotal: $("#checkoutSubtotal"),
            delivery: $("#delivery"),
            discountValue: $("#discountValue"),
            checkoutTotal: $("#checkoutTotal"),
            checkoutTotalLBP: $("#checkoutTotalLBP"),
            discountInput: $('#discount'),
            applyBtn: $('#apply'),
            mapSection: document.getElementById('map-section'),
            paymentInfo: document.getElementById('payment-info')
        }
    };

    // Core Functions
    function getBagFromCookies() {
        try {
            const match = document.cookie.match(new RegExp(`(?:^| )${CONFIG.cookieKey}=([^;]+)`));
            return match ? JSON.parse(decodeURIComponent(match[1])) : [];
        } catch (e) {
            console.error('Error parsing bag data:', e);
            return [];
        }
    }

    function formatVariantOptions(variants) {
        if (!variants?.length) return '';
        return variants.map(v =>
            `${v.value}${v.price_adjustment ? ` (+$${v.price_adjustment.toFixed(2)})` : ''}`
        ).join(', ');
    }

    function calculateOrderTotals() {
        const subtotal = state.bag.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const orderType = document.querySelector('input[name="order_type"]:checked')?.value;
        const deliveryAmount = orderType === 'delivery' ? CONFIG.deliveryFee : 0;

        let appliedDiscount = 0;
        if (state.discount.type === 'Percentage') {
            appliedDiscount = subtotal * (state.discount.value / 100);
        } else if (state.discount.type === 'Fixed') {
            appliedDiscount = state.discount.value;
        }

        const subtotalAfterDiscount = Math.max(0, subtotal - appliedDiscount);
        const total = subtotalAfterDiscount + deliveryAmount;

        return {
            subtotal,
            deliveryAmount,
            appliedDiscount,
            total,
            totalLBP: total * CONFIG.rate
        };
    }

    function renderOrderItems() {
        state.elements.orderSummary.empty();

        if (state.bag.length === 0) {
            window.location.href = document.referrer || CONFIG.routes.previous;
            state.elements.orderSummary.append('<p class="text-center text-muted">Your bag is empty.</p>');
            return false;
        }

        state.bag.forEach(item => {
            const itemTotal = item.price * item.quantity;
            const variantText = item.variants?.length
                ? `<small class="text-muted d-block">${formatVariantOptions(item.variants)}</small>`
                : '';

            state.elements.orderSummary.append(`
                <li class="list-group-item bg-transparent px-0 d-flex align-items-start gap-3">
                    <img src="${item.image}" alt="${item.name}" class="rounded border" style="width: 64px; height: 64px; object-fit: cover;">
                    <div class="flex-grow-1">
                        <div class="fw-semibold">${item.name}</div>
                        ${variantText}
                        <small class="text-muted d-block">Qty: ${item.quantity}</small>
                        <div class="fw-medium">$${itemTotal.toFixed(2)}</div>
                    </div>
                </li>
            `);
        });

        return true;
    }

    function updateCheckoutSummary() {
        if (!renderOrderItems()) return;

        const totals = calculateOrderTotals();

        state.elements.checkoutSubtotal.text(`$${totals.subtotal.toFixed(2)}`);
        state.elements.delivery.text(`$${totals.deliveryAmount.toFixed(2)}`);
        state.elements.discountValue.text(`$${totals.appliedDiscount.toFixed(2)}`);
        state.elements.checkoutTotal.text(`$${totals.total.toFixed(2)}`);
        state.elements.checkoutTotalLBP.text(`${totals.totalLBP.toLocaleString()} LBP`);
    }

    // UI Helpers
    function showToast(message, type = 'info', duration = 3000) {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} position-fixed bottom-0 end-0 m-3`;
        toast.innerHTML = `
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            ${message}
        `;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), duration);
    }

    function showErrorToast(message, duration = 5000) {
        const toast = document.createElement('div');
        toast.className = 'alert alert-danger d-flex position-fixed top-15 end-0 m-3';
        toast.style.maxWidth = '300px';
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <div>${message}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), duration);
    }

    // Event Handlers
    function handleApplyDiscount() {
        const discountCode = state.elements.discountInput.val().trim();
        if (!discountCode) return alert('Please enter a discount code.');

        $.ajax({
            method: 'POST',
            url: CONFIG.routes.discountCheck,
            data: { discount: discountCode, _token: CONFIG.csrfToken },
            success: (response) => {
                if (response.exists) {
                    state.discount = { value: response.value, type: response.type };
                    state.elements.discountInput.prop('disabled', true);
                    state.elements.applyBtn.hide();
                    updateCheckoutSummary();
                } else {
                    alert('Invalid discount code.');
                }
            },
            error: () => alert('Something went wrong. Please try again.')
        });
    }

    function handleOrderSubmit(event) {
        event.preventDefault();

        const name = document.querySelector("input[name='name']").value.trim();
        const phone = document.querySelector("input[name='phone']").value.trim();
        const orderType = document.querySelector('input[name="order_type"]:checked')?.value;
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
        const latitude = document.getElementById("latitude").value.trim();
        const longitude = document.getElementById("longitude").value.trim();

        // Validation
        if (!name) return showErrorToast("Please enter your name");
        if (!phone) return showErrorToast("Please enter your phone number");
        if (state.bag.length === 0) return showErrorToast("Your cart is empty");
        if (orderType === "delivery" && (!latitude || !longitude)) {
            return showErrorToast("Please select a delivery location on the map");
        }

        // Prepare order message
        const items = state.bag.map(item =>
            `- ${item.name} (x${item.quantity})` +
            (item.variants?.length ? ` [${formatVariantOptions(item.variants)}]` : '') +
            ` — $${(item.price * item.quantity).toFixed(2)}`
        ).join("\n");

        const deliverySection = orderType === "delivery"
            ? `\nDelivery Location:\nhttps://www.google.com/maps?q=${latitude},${longitude}\n`
            : '';

        const message = `*New Order*\n\n` +
            `*Client:*\n${name}\n${phone}\n\n` +
            `*Order Type:* ${orderType}\n` +
            `*Payment:* ${paymentMethod}\n\n` +
            `*Items:*\n${items}\n\n` +
            `${orderType === "delivery" ? `*Delivery Fee:* $${CONFIG.deliveryFee.toFixed(2)}\n` : ""}` +
            `*Discount:* ${state.elements.discountValue.text().trim()}\n` +
            `*Subtotal:* ${state.elements.checkoutSubtotal.text().trim()}\n` +
            `*Total:* ${state.elements.checkoutTotal.text().trim()}\n` +
            `*Total LBP:* ${state.elements.checkoutTotalLBP.text().trim()}` +
            deliverySection + `\nPlease confirm.`;

        window.open(`https://wa.me/${CONFIG.businessPhone}?text=${encodeURIComponent(message)}`, "_blank");
    }

    // Google Maps Functions
    function initMap() {
        if (document.querySelector('input[name="order_type"]:checked')?.value !== 'delivery' || state.map.initialized) return;

        state.map.instance = new google.maps.Map(document.getElementById('map'), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 13,
            mapTypeControl: false,
            streetViewControl: false,
            fullscreenControl: false,
            styles: [{ featureType: "poi", elementType: "labels", stylers: [{ visibility: "off" }] }]
        });

        const autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete'),
            { types: ['geocode'] }
        );

        state.map.marker = new google.maps.Marker({
            map: state.map.instance,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: true,
            icon: { url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png", scaledSize: new google.maps.Size(40, 40) }
        });

        autocomplete.addListener('place_changed', () => {
            const place = autocomplete.getPlace();
            if (place.geometry) updateLocation(place.geometry.location.lat(), place.geometry.location.lng(), place.formatted_address);
            else alert("Couldn't find that location - please try again");
        });

        state.map.marker.addListener('dragend', e => reverseGeocode(e.latLng.lat(), e.latLng.lng()));
        state.map.instance.addListener('click', e => reverseGeocode(e.latLng.lat(), e.latLng.lng()));

        document.getElementById('current-location').addEventListener('click', handleCurrentLocation);

        state.map.initialized = true;
    }

    function handleCurrentLocation() {
        if (!navigator.geolocation) return showErrorToast("Geolocation not supported", 5000);

        const btn = document.getElementById('current-location');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Locating...';
        btn.disabled = true;

        navigator.geolocation.getCurrentPosition(
            position => {
                btn.innerHTML = '<i class="fas fa-location-arrow me-2"></i>Use Current Location';
                btn.disabled = false;
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // Use state.map.instance instead of map
                state.map.instance.setCenter(pos);
                state.map.instance.setZoom(17);
                updateLocation(pos.lat, pos.lng, '');
                reverseGeocode(pos.lat, pos.lng);
            },
            error => {
                btn.innerHTML = '<i class="fas fa-location-arrow me-2"></i>Use Current Location';
                btn.disabled = false;
                showErrorToast(getGeolocationError(error), 10000);
            },
            { enableHighAccuracy: false, timeout: 10000, maximumAge: 0 }
        );
    }

    function getGeolocationError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                return "Location access denied. Please enable permissions.<br><a href='https://support.google.com/chrome/answer/142065' target='_blank'>How to enable permissions</a>";
            case error.POSITION_UNAVAILABLE:
                return "Location information unavailable. Check your connection.";
            case error.TIMEOUT:
                return "Location request timed out. Try again with better GPS signal.";
            default:
                return "Error getting location.";
        }
    }

    function loadGoogleMapsIfNeeded() {
        if (document.querySelector('input[name="order_type"]:checked')?.value === 'delivery' && !state.map.loaded) {
            const script = document.createElement('script');
            script.src = `https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap`;
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
            state.map.loaded = true;
        }
    }

    function updateLocation(lat, lng, address) {
        if (!state.map.instance || !state.map.marker) return;

        state.map.instance.panTo({ lat, lng });
        state.map.instance.setZoom(17);
        state.map.marker.setPosition({ lat, lng });
        state.map.marker.setVisible(true);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        if (address) {
            document.getElementById('formatted_address').value = address;
            document.getElementById('autocomplete').value = address;
        }
    }

    function reverseGeocode(lat, lng) {
        new google.maps.Geocoder().geocode({ location: { lat, lng } }, (results, status) => {
            if (status === "OK" && results[0]) updateLocation(lat, lng, results[0].formatted_address);
        });
    }

    // UI Toggles
    function toggleMapSection() {
        const showMap = document.querySelector('input[name="order_type"]:checked')?.value === 'delivery';
        state.elements.mapSection.style.display = showMap ? 'block' : 'none';
        if (showMap) {
            updateCheckoutSummary();
            loadGoogleMapsIfNeeded();
        }
    }

    function togglePaymentInfo() {
        state.elements.paymentInfo.style.display =
            document.querySelector('input[name="payment_method"]:checked')?.value === 'whish' ? 'block' : 'none';
    }

    // Initialization
    document.addEventListener('DOMContentLoaded', () => {
        // Event listeners
        state.elements.applyBtn.on('click', handleApplyDiscount);
        document.getElementById("submitBtn").addEventListener("click", handleOrderSubmit);
        document.getElementById('copy-whish').addEventListener('click', () => {
            navigator.clipboard.writeText(document.getElementById('whish-number').textContent.trim())
                .then(() => showToast('Number copied', 'success'))
                .catch(() => showToast('Failed to copy', 'danger'));
        });

        // Radio button listeners
        document.querySelectorAll('input[name="order_type"]').forEach(radio =>
            radio.addEventListener('change', toggleMapSection));
        document.querySelectorAll('input[name="payment_method"]').forEach(radio =>
            radio.addEventListener('change', togglePaymentInfo));

        // Initial setup
        toggleMapSection();
        togglePaymentInfo();
        updateCheckoutSummary();
    });

    window.gm_authFailure = () => alert('Google Maps authentication failed');
</script>