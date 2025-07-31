<header class="checkout-header shadow-sm py-3 bg-white border-bottom">
    <div class="container position-relative text-center">
        <!-- Back Button (Left) -->
        <div class="position-absolute start-0 top-50 translate-middle-y">
            <a href="{{ route(Helper::menu_or_shop($business) == 'menu' ? 'menu' : 'shop.home', $business->name) }}"
                class="btn btn-link text-decoration-none btn-back ms-3">
                <i class="fas fa-chevron-left me-1"></i>
                {{ Helper::menu_or_shop($business) == 'menu' ? 'Menu' : 'Shop' }}
            </a>
        </div>

        <!-- Centered Logo + Brand Name (Inline) -->
        <a href="{{ route(Helper::menu_or_shop($business) == 'menu' ? 'menu' : 'shop.home', $business->name) }}"
            class="d-inline-flex align-items-center justify-content-center gap-2 text-decoration-none">
            <img src="{{ asset($business->logo == 'assets/images/no_img.png'
    ? 'assets/images/yellowpos_black_transparent_bg.png'
    : $business->logo) }}" alt="Logo" class="logo-img">
            <span class="logo-text fw-semibold mb-0">{{ ucwords($business->name) }}</span>
        </a>
    </div>
</header>