@extends('menu.app')

@section('content')
<div class="container-md padding-0" style="scroll-padding-top: 200px;">
    <!-- Hero Image Section -->
    <div class="restaurant-banner" id="banner" style="background-image: url({{ asset('assets/images/banner.png') }});">
    </div>

    <div class="menu-bg mx-custom px-3 py-5">
        <!-- Restaurant Details -->
        <div class="d-flex justify-content-center">
            <div class="d-flex card restaurant-details text-center mb-4 box-shadow">
                <div class="row">
                    <div class="col-md-4 my-auto">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Pam's Scoop, Juice & Crepe Logo"
                            class="img-fluid">
                    </div>
                    <div class="col-md-8 my-auto">
                        <h1 class="fw-bold">Pam's Scoop, Juice & Crepe</h1>
                        <hr class="w-100 divider">
                        <p class="mb-1">81 230 801</p>
                        <p class="mb-1">
                            <a href="https://maps.app.goo.gl/5rSUQvWFTduPdDCU7?g_st=ac" class="text-yellow"
                                target="blank">
                                <i class="fa-solid fa-location-dot"></i>
                                visit us
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Categories -->
        <div
            class="d-flex flex-nowrap gap-3 py-3 justify-content-start overflow-x-auto w-100 menu-categories custom-rounded">
            <div class="card category-div box-shadow mb-2">
                <a href="{{ route('home') }}#all" class="d-flex flex-column align-items-center">
                    <button class="btn btn-custom rounded-pill fw-bold pb-0">All</button>
                </a>
            </div>
            @foreach ($categories as $category)
            <div class="card category-div box-shadow mb-2">
                <a href="{{ route('home') }}#{{ $category->name }}" class="d-flex flex-column align-items-center">
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="category-image"
                        loading="lazy" decoding="async" fetchpriority="high">
                    <button class="btn btn-custom rounded-pill fw-bold pb-0">{{ ucwords($category->name) }}</button>
                </a>
            </div>
            @endforeach
        </div>

        <!-- Menu Items -->
        <div id="menuItems" class="px-md-5 px-2">
            <h2 class="text-yellow text-center fw-bold ms-md-5 fs-1 mt-5">MENU</h2>
            <div id="all"></div>

            @foreach ($products as $index => $productGroup)
            <h3 class="fw-bold fs-2 mt-4" id="{{ $productGroup[0]->category->name ?? '' }}">
                {{ ucwords($productGroup[0]->category->name ?? '') }}
            </h3>

            <div class="row">
                @foreach ($productGroup as $product)
                <a data-bs-toggle="modal" data-bs-target="#productModal"
                    class="col-md-6 dim-on-hover rounded product-item" data-product-id="{{ $product->id }}"
                    data-name="{{ ucwords($product->name) }}"
                    data-price="{{ number_format($product->price, 2, '.', '') }}"
                    data-description="{{ $product->description }}" data-image="{{ asset($product->image) }}"
                    data-secondary-images="{{ $product->secondary_images->pluck('path') }}"
                    data-has-variants="{{ $product->variants->count() > 0 ? 'true' : 'false' }}">
                    <div class="row me-md-3 mb-4 justify-content-center justify-content-md-between">
                        <div class="col-4 col-md-2 justify-content-center justify-content-md-end">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="menu-img"
                                loading="lazy" decoding="async" fetchpriority="low">
                        </div>
                        <div class="col-6 col-md-9 mt-3">
                            <div class="d-flex flex-column">
                                <p class="mb-1 ms-md-2 fs-5">{{ ucwords($product->name) }}</p>
                                <p class="mb-1 ms-md-2 text-muted fs-6 d-block">
                                    {{ $product->description }}
                                </p>
                                <div class="d-flex align-items-end justify-content-between my-1 ms-md-2 fw-bold fs-5">
                                    <span class="text-muted ms-2 fs-5">${{ number_format($product->price, 2) }}</span>
                                    <span class="text-muted-custom ms-2 fs-7">
                                        {{ number_format($product->price * $rate, 2) }}LBP
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 my-auto p-0">
                            <button type="button" class="btn px-3 py-2 fs-7 btn-atb-quick">
                                <i class="fa-solid fa-bag-shopping p-0"></i>
                            </button>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endforeach
        </div>

        <div class="row mb-4" id="business">
            <!-- Business Hours -->
            <div class="offset-md-3 col-md-6 mt-4 mb-5 px-md-5">
                <h4 class="fw-bold mb-3">Business Hours</h4>
                <div class="business-hours p-3 custom-rounded text-center">
                    @foreach ($operating_hours as $oh)
                    <p class="my-1">{{ $oh->day }}:
                        @if($oh->open)
                        {{ $oh->opening_hour }} - {{ $oh->closing_hour }}
                        @else
                        Closed
                        @endif
                    </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Variant Templates -->
<div id="variantTemplates" class="d-none">
    @foreach ($products as $productGroup)
    @foreach ($productGroup as $product)
    @if ($product->variants->count() != 0)
    <div id="variant-template-{{ $product->id }}">
        @foreach ($product->variants as $variant)
        <div class="form-group d-flex flex-column align-items-center align-items-md-start my-3">
            <label class="form-label">{{ ucwords($variant->title) }}</label>
            @if ($variant->type == 'single')
            <select class="form-select variant-select" name="variant[{{$variant->id}}]" id="variant_{{$variant->id}}"
                data-variant-id="{{ $variant->id }}" required>
                <option value=""></option>
                @foreach ($variant->options as $option)
                <option value="{{ $option->value }}" data-price="{{ $option->price }}"
                    data-quantity="{{ $option->quantity }}" data-max="{{ $option->max_quantity }}">
                    {{ $option->value }}
                    @if($option->price > 0)
                    + ${{ number_format($option->price, 2) }}
                    @endif
                    @if($option->quantity !== null)
                    ({{ $option->quantity }} available)
                    @endif
                </option>
                @endforeach
            </select>
            @else
            <div class="variant-options-container" id="variant_{{$variant->id}}">
                @foreach ($variant->options as $option)
                <div class="form-check mb-2">
                    <input class="form-check-input variant-option-checkbox" type="checkbox"
                        name="variant[{{$variant->id}}][]" value="{{ $option->value }}"
                        id="option-{{$variant->id}}-{{$option->id}}" data-price="{{ $option->price }}"
                        data-quantity="{{ $option->quantity }}" data-option-id="{{ $option->id }}"
                        data-max="{{ $option->max_quantity }}">
                    <label class="form-check-label" for="option-{{$variant->id}}-{{$option->id}}">
                        {{ $option->value }} + ${{ $option->price }}
                        @if($option->quantity !== null)
                        ({{ $option->quantity }} available)
                        @endif
                    </label>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif
    @endforeach
    @endforeach
</div>

@include('menu._nav')
@include('menu._product')
@include('menu._bag')
@include('menu._scripts')
@endsection