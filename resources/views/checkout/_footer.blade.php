<footer class="checkout-footer text-center py-4 bg-white border-top mt-auto">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3 small text-muted">
            <div class="d-flex align-items-center gap-1">
                <i class="fas fa-lock"></i>
                <span>Secure Checkout</span>
            </div>

            <span class="d-none d-md-inline">|</span>

            <span>&copy; {{ date('Y') }} {{ ucwords($business->name) }}</span>

            {{-- Optional links --}}
            {{--
            <span class="d-none d-md-inline">|</span>
            <a href="#" class="text-muted text-decoration-none">Privacy</a>
            <a href="#" class="text-muted text-decoration-none">Terms</a>
            --}}
        </div>
    </div>
</footer>