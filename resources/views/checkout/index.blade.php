@extends('checkout.app')

@section('title', 'Checkout')

@section('content')
<main class="checkout-main py-5">
    <div class="container">
        <form action="#" enctype="multipart/form-data">
            @csrf
            <div class="row px-3">
                {{-- LEFT: Customer Details--}}
                <div class="col-lg-7">
                    <div class="card py-4 px-2 px-lg-4 mb-4">
                        <h4 class="mb-4 text-center text-md-start text-dark">Customer Details</h4>
                        <div class="mb-3">
                            <label class="form-label text-muted">Full Name *</label>
                            <input type="text" class="form-control input form-control-lg" name="name"
                                placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Phone Number *</label>
                            <input type="tel" class="form-control input form-control-lg" name="phone"
                                placeholder="+1234567890" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Order Type</label>
                            <div class="d-flex gap-2">
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="order_type" id="order_type_store"
                                        value="store" autocomplete="off" checked>
                                    <label class="card p-3 flex-fill text-center btn btn-radio" for="order_type_store"
                                        style="cursor:pointer;">
                                        <div class="mb-2">
                                            <i class="fas fa-store fa-2x"></i>
                                        </div>
                                        <div>In Store</div>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="order_type" id="order_type_delivery"
                                        value="delivery" autocomplete="off">
                                    <label class="card p-3 flex-fill text-center btn btn-radio"
                                        for="order_type_delivery" style="cursor:pointer;">
                                        <div class="mb-2">
                                            <i class="fas fa-truck fa-2x"></i>
                                        </div>
                                        <div>Delivery</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label class="form-label text-muted">Payment Method</label>
                        <div class="d-flex gap-2">
                            <div class="col-6">
                                {{-- Cash On Delivery --}}
                                <input type="radio" class="btn-check" name="payment_method" id="payment_method_cash"
                                    value="cash" autocomplete="off" checked>
                                <label class="card p-3 flex-fill text-center btn btn-radio" for="payment_method_cash"
                                    style="cursor:pointer;">
                                    <div class="mb-2">
                                        <i class="fas fa-money-bill-wave fa-2x"></i>
                                    </div>
                                    <div>Cash On Delivery</div>
                                </label>
                            </div>

                            <div class="col-6">
                                {{-- Whish Payment --}}
                                <input type="radio" class="btn-check" name="payment_method" id="payment_method_whish"
                                    value="whish" autocomplete="off">
                                <label class="card p-3 flex-fill text-center btn btn-radio" for="payment_method_whish"
                                    style="cursor:pointer;">
                                    <div class="mb-2">
                                        <i class="fas fa-credit-card fa-2x"></i>
                                    </div>
                                    <div>Whish</div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card py-4 px-2 px-md-4 rounded-4" id="map-section" style="display: none;">
                        <h4 class="text-center text-md-start mb-4">Delivery Details</h4>
                        <div class="map-card">
                            {{-- Address Input --}}
                            <div class="form-group mb-3 position-relative">
                                <label for="autocomplete" class="form-label text-muted">Your Address</label>
                                <input type="text" id="autocomplete" class="form-control form-control-lg"
                                    placeholder="Enter your address">
                                <small class="instruction-text text-muted">Start typing or use your current
                                    location.</small>
                            </div>
                            {{-- Map & Button --}}
                            <div class="map-container position-relative rounded border mt-3 overflow-hidden">
                                <button id="current-location"
                                    class="btn btn-outline-primary btn-sm position-absolute top-0 end-0 m-2 z-10"
                                    type="button">
                                    <i class="fas fa-location-arrow me-1"></i> Use My Location
                                </button>
                                <div id="map" style="width: 100%; height: 300px;"></div>
                            </div>
                            {{-- Hidden Fields --}}
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            <input type="hidden" name="formatted_address" id="formatted_address">
                        </div>
                    </div>
                </div>
                {{-- RIGHT: Cart Summary --}}
                <div class="col-lg-5">
                    <div class="card p-4">
                        <h4 class="mb-4 text-center text-md-start text-dark">Order Summary</h4>
                        <ul class="list-group list-group-flush mb-4" id="orderSummary">
                            {{-- Items will be added dynamically by JS --}}
                        </ul>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-medium" id="checkoutSubtotal">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Delivery</span>
                            <span class="fw-medium" id="delivery">${{ number_format($business->delivery, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Discount</span>
                            <span class="fw-medium" id="discountValue">$0.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total</span>
                            <span id="checkoutTotal">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total LBP</span>
                            <span id="checkoutTotalLBP">0.00 LBP</span>
                        </div>

                        <div class="d-flex mt-4">
                            <input type="text" class="form-control my-auto me-2" placeholder="Discount Code ..."
                                name="discount" id="discount" value="">
                            <a id="apply" class="btn btn-secondary my-auto ms-2">Redeem</a>
                        </div>

                        <button type="submit" id="submitBtn" class="btn btn-primary w-100 btn-lg mt-5">
                            Place Order
                        </button>
                    </div>
                    <div class="card p-4 bg-white rounded-4 mt-5" id="payment-info" style="display: none;">
                        <h5 class="mb-3 text-dark">Payment Info</h5>
                        <div class="p-3 bg-light border-0 rounded-3">
                            <h6 class="mb-2">WHISH MONEY</h6>
                            <p class="mb-3 text-muted">
                                Please transfer money from your Whish account to the following number:
                            </p>
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <span id="whish-number" class="fw-semibold">{{ $business->phone }}</span>
                                <button id="copy-whish" type="button" class="btn btn-sm btn-outline-success"
                                    title="Copy number">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@include('checkout._script')
@endsection