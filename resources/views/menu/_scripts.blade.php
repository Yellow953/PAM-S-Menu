<script>
    $(document).ready(function () {
        const businessId = {{ $business->id }};
        const rate = {{ $rate }};
        const cookieKey = `bag_${businessId}`;
        let bag = [];
        let $modal, modalInstance;
        let basePrice;
        let currentMaxQuantity = null;

        init();

        function init() {
            bag = getBagFromCookies();
            updateBagUI();
            cacheDOMElements();
            setupEventListeners();
        }

        function cacheDOMElements() {
            $modal = $('#productModal');
            modalInstance = new bootstrap.Modal($modal[0]);
        }

        function setupEventListeners() {
            $(document).on('click', '.product-item', handleProductClick);
            $(document).on('change', '.variant-select', handleVariantChange);
            $(document).on('change', '.variant-option-checkbox', handleCheckboxChange);
            $('#addToBagBtn').on('click', handleAddToBag);
            $(document).on('click', '.secondary-image', handleSecondaryImageClick);
            $(document).on('click', '.increase-qty', handleQuantityChange);
            $(document).on('click', '.decrease-qty', handleQuantityChange);
            $(document).on('click', '.remove-item', handleRemoveItem);
            $(document).on('input', '#productModalQuantity', handleQuantityInput);
        }

        function getBagFromCookies() {
            try {
                const cookieValue = document.cookie
                    .split('; ')
                    .find(row => row.startsWith(`${cookieKey}=`))
                    ?.split('=')[1];

                return cookieValue ? JSON.parse(decodeURIComponent(cookieValue)) : [];
            } catch (e) {
                console.error('Error parsing bag data:', e);
                return [];
            }
        }

        function saveBagToCookies() {
            const expires = new Date(Date.now() + 7 * 864e5).toUTCString();
            document.cookie = `${cookieKey}=${encodeURIComponent(JSON.stringify(bag))}; path=/; expires=${expires}; samesite=lax`;
        }

        function updateModalPrice() {
            let extraPrice = 0;
            let maxQuantity = currentMaxQuantity;

            // Handle select variants
            $modal.find(".variant-select option:selected").each(function() {
                const price = parseFloat($(this).data("price")) || 0;
                extraPrice += price;

                // Check for max quantity from variants
                const variantMax = parseInt($(this).data("max"));
                if (variantMax && (maxQuantity === null || variantMax < maxQuantity)) {
                    maxQuantity = variantMax;
                }
            });

            // Handle checkbox variants
            $modal.find(".variant-option-checkbox:checked").each(function() {
                const price = parseFloat($(this).data("price")) || 0;
                extraPrice += price;

                // Check for max quantity from variants
                const variantMax = parseInt($(this).data("max"));
                if (variantMax && (maxQuantity === null || variantMax < maxQuantity)) {
                    maxQuantity = variantMax;
                }
            });

            const totalPrice = basePrice + extraPrice;
            $modal.find("#productModalPrice").text(`$${totalPrice.toFixed(2)}`);
            $modal.find("#productModalPriceLBP").text(`${(totalPrice * rate).toLocaleString()}LBP`);

            // Update quantity input max attribute if we have a max quantity
            const $quantityInput = $modal.find("#productModalQuantity");
            if (maxQuantity !== null) {
                $quantityInput.attr('max', maxQuantity);
                const currentVal = parseInt($quantityInput.val());
                if (currentVal > maxQuantity) {
                    $quantityInput.val(maxQuantity);
                }
            } else {
                $quantityInput.removeAttr('max');
            }
        }

        function checkAllVariantsSelected() {
            let allSelected = true;
            $modal.find(".variant-select").each(function () {
                if (!$(this).val()) {
                    allSelected = false;
                    return false;
                }
            });

            $modal.find("#addToBagBtn").prop("disabled", !allSelected);
            $modal.find("#variantWarning").toggle(!allSelected);
        }

        function animateBagIcon() {
            const $icon = $("#bagBtn i");
            $icon.addClass("animate-bag");
            setTimeout(() => $icon.removeClass("animate-bag"), 500);
        }

        function updateBagUI() {
            const $bagContainer = $("#bagItems").empty();
            let total = 0, count = 0;

            if (!bag.length) {
                $bagContainer.append('<p class="text-center text-muted">Your bag is empty.</p>');
            } else {
                bag.forEach((item, i) => {
                    total += item.price * item.quantity;
                    count += item.quantity;

                    const variantsHtml = (item.variants || []).map(v =>
                        `<small class="d-block text-muted">${v.value}${v.price_adjustment ? ` (+$${v.price_adjustment.toFixed(2)})` : ''}</small>`
                    ).join('');

                    $bagContainer.append(`
                        <div class="bag-item d-flex align-items-center justify-content-between p-2 border-bottom">
                            <img src="${item.image}" alt="${item.name}" class="rounded" width="50" loading="lazy" decoding="async" fetchpriority="low">
                            <div class="item-info">
                                <h6 class="mb-0">${item.name}</h6>
                                ${variantsHtml}
                                <small>$${item.price.toFixed(2)}</small>
                            </div>
                            <div class="item-controls d-flex align-items-center">
                                <button class="btn btn-sm btn-outline-primary decrease-qty" data-index="${i}">-</button>
                                <span class="mx-2">${item.quantity}</span>
                                <button class="btn btn-sm btn-outline-primary increase-qty" data-index="${i}">+</button>
                                <button class="btn btn-sm btn-outline-danger remove-item ms-2" data-index="${i}">&times;</button>
                            </div>
                        </div>
                    `);
                });
            }

            $("#bagTotal").text(`$${total.toFixed(2)}`);
            $("#bagTotalLBP").text(`${(total * rate).toLocaleString()}LBP`);
            $("#bagCount").text(count).toggle(count > 0);
        }

        function handleProductClick() {
            const $this = $(this);
            const productId = $this.data("product-id");
            const name = $this.data("name");
            const price = parseFloat($this.data("price"));
            const description = $this.data("description");
            const image = $this.data("image");
            const secondaryImages = $this.data("secondary-images") || [];
            const hasVariants = $this.data("has-variants") == true;
            currentMaxQuantity = $this.data("max-quantity") || null;
            basePrice = price;

            $modal.find("#productModalLabel").text(name);
            $modal.find("#productModalPrice").text(`$${price.toFixed(2)}`);
            $modal.find("#productModalPriceLBP").text(`${(price * rate).toLocaleString()}LBP`);
            $modal.find("#productModalDescription").text(description);
            $modal.find("#productModalImage").attr("src", image);
            $modal.find("#productModalQuantity").val(1);

            // Set max quantity if exists
            if (currentMaxQuantity) {
                $modal.find("#productModalQuantity").attr('max', currentMaxQuantity);
            } else {
                $modal.find("#productModalQuantity").removeAttr('max');
            }

            $modal.find("#variantSelectors").empty().off("change", ".variant-select");

            if (hasVariants) {
                const $template = $(`#variant-template-${productId}`);
                if ($template.length) {
                    $modal.find("#variantSelectors").html($template.html());

                    $modal.on("change", ".variant-select", function() {
                        updateModalPrice();
                        checkAllVariantsSelected();
                    });

                    $modal.on("change", ".variant-option-checkbox", function() {
                        updateModalPrice();
                    });
                }
            }

            const $secondaryImagesRow = $modal.find("#secondaryImagesRow").empty();
            const $container = $modal.find("#secondaryImagesContainer").toggleClass("d-none", secondaryImages.length === 0);

            if (secondaryImages.length) {
                const primaryBlock = `
                    <div class="col-4 p-2">
                        <a href="#" class="secondary-image" data-image="${image}">
                            <img class="card-img secondary-img border img-fluid" src="${image}" loading="lazy" decoding="async" fetchpriority="low">
                        </a>
                    </div>
                `;
                $secondaryImagesRow.append(primaryBlock);

                secondaryImages.forEach(img => {
                    const fullPath = "{{ asset('') }}" + img.replace(/^\//, '');
                    $secondaryImagesRow.append(`
                        <div class="col-4 p-2">
                            <a href="#" class="secondary-image" data-image="${fullPath}">
                                <img class="card-img secondary-img border img-fluid" src="${fullPath}" loading="lazy" decoding="async" fetchpriority="low">
                            </a>
                        </div>
                    `);
                });
            }

            modalInstance.show();
        }

        function handleVariantChange() {
            updateModalPrice();
            checkAllVariantsSelected();
        }

        function handleCheckboxChange() {
            updateModalPrice();
        }

        function handleSecondaryImageClick(e) {
            e.preventDefault();
            $modal.find("#productModalImage").attr("src", $(this).data("image"));
        }

        function handleQuantityInput(e) {
            const $input = $(this);
            const max = parseInt($input.attr('max'));
            const value = parseInt($input.val());

            if (max && value > max) {
                $input.val(max);
            } else if (value < 1) {
                $input.val(1);
            }
        }

        function handleAddToBag() {
            const name = $modal.find("#productModalLabel").text();
            const price = parseFloat($modal.find("#productModalPrice").text().replace('$', ''));
            const quantity = parseInt($modal.find("#productModalQuantity").val());
            const image = $modal.find("#productModalImage").attr("src");
            const maxQuantity = currentMaxQuantity;

            // Check if quantity exceeds max quantity
            if (maxQuantity && quantity > maxQuantity) {
                alert(`You can only add up to ${maxQuantity} of this item.`);
                return;
            }

            let selectedVariants = [];
            let allSelected = true;

            // Handle select variants
            $modal.find(".variant-select").each(function () {
                const variantId = $(this).attr("name").match(/\d+/)[0];
                const option = $(this).find("option:selected");
                const value = option.val();
                const priceAdjustment = parseFloat(option.data("price")) || 0;

                if (!value) {
                    allSelected = false;
                    return false;
                }

                selectedVariants.push({
                    variant_id: variantId,
                    value,
                    price_adjustment: priceAdjustment
                });
            });

            // Handle checkbox variants
            $modal.find(".variant-option-checkbox:checked").each(function () {
                const variantId = $(this).attr("name").match(/\d+/)[0];
                const value = $(this).val();
                const priceAdjustment = parseFloat($(this).data("price")) || 0;

                selectedVariants.push({
                    variant_id: variantId,
                    value,
                    price_adjustment: priceAdjustment
                });
            });

            if (!allSelected && $modal.find(".variant-select").length > 0) {
                alert("Please select all required variant options before adding to cart.");
                return;
            }

            const variantKey = `${name}-${selectedVariants.map(v => `${v.variant_id}:${v.value}`).join('-')}`;
            const existingItem = bag.find(item => item.variantKey === variantKey);

            // Check if adding this would exceed max quantity
            if (existingItem && maxQuantity && (existingItem.quantity + quantity) > maxQuantity) {
                const remaining = maxQuantity - existingItem.quantity;
                if (remaining > 0) {
                    alert(`You can only add ${remaining} more of this item (max ${maxQuantity}).`);
                } else {
                    alert(`You've already reached the maximum quantity (${maxQuantity}) for this item.`);
                }
                return;
            }

            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                bag.push({
                    name,
                    price,
                    quantity,
                    image,
                    variantKey,
                    variants: selectedVariants,
                    maxQuantity: maxQuantity
                });
            }

            saveBagToCookies();
            updateBagUI();
            animateBagIcon();
            modalInstance.hide();
        }

        function handleQuantityChange(e) {
            e.preventDefault();
            const i = $(this).data("index");
            const item = bag[i];

            if ($(this).hasClass("increase-qty")) {
                if (item.maxQuantity && item.quantity >= item.maxQuantity) {
                    alert(`You can only add up to ${item.maxQuantity} of this item.`);
                    return;
                }
                item.quantity += 1;
            } else if ($(this).hasClass("decrease-qty")) {
                if (item.quantity > 1) {
                    item.quantity -= 1;
                } else {
                    bag.splice(i, 1);
                }
            }

            saveBagToCookies();
            updateBagUI();
        }

        function handleRemoveItem(e) {
            e.preventDefault();
            bag.splice($(this).data("index"), 1);
            saveBagToCookies();
            updateBagUI();
        }
    });
</script>