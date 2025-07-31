<!-- Bag Modal -->
<div class="modal fade" id="bagModal" tabindex="-1" aria-labelledby="bagModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-box">
            <div class="modal-body">
                <div class="container-fluid">
                    <h3 class="mb-4 text-center text-md-start">Your Bag</h3>

                    <div id="bagItems" class="list-group">
                        <!-- Items will be dynamically added here -->
                    </div>

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                        <h5 class="mb-2 mb-md-0">Total:</h5>
                        <h5 id="bagTotalLBP" class="text-muted fs-5">0.00LBP</h5>
                        <h5 id="bagTotal" class="fw-bold fs-4">$0.00</h5>
                    </div>

                    <div class="d-flex flex-column flex-md-row align-content-center justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary btn-dismiss w-100 w-md-auto"
                            data-bs-dismiss="modal">
                            Continue Shopping
                        </button>
                        @if ($business->ordering_activated)
                        <a href="{{ route('checkout.index', $business->name) }}" class="btn btn-yellow w-100 w-md-auto">
                            Checkout
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>