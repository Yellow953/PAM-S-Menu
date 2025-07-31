<!-- Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-box">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-4 text-center">
                            <img id="productModalImage" src="" alt="Product Image"
                                class="img-fluid mb-3 custom-rounded">

                            <div class="row d-none" id="secondaryImagesContainer">
                                <div id="multi-item-example"
                                    class="col-12 carousel slide carousel-multi-item pointer-event"
                                    data-bs-ride="carousel">
                                    <div class="carousel-inner product-links-wap" role="listbox">
                                        <div class="carousel-item active">
                                            <div class="row" id="secondaryImagesRow">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <h4 id="productModalLabel" class="text-center text-md-start">Product Name</h4>
                            <p id="productModalDescription" class="text-muted text-center text-md-start"></p>
                            <div class="fw-bold fs-4 text-center text-md-start" id="productModalPrice"></div>
                            <div class="text-muted fs-5 text-center text-md-start" id="productModalPriceLBP"></div>
                            <div id="variantSelectors"></div>
                            <div id="variantWarning" class="text-danger my-2" style="display:none;">
                                Please select all options to continue.
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mt-3">
                        <input type="number" id="productModalQuantity" value="1" min="1"
                            class="form-control input w-200px">
                        <button type="button" class="btn btn-yellow mt-3 mt-md-0 px-4 py-2 fs-5" id="addToBagBtn">
                            Add to Bag <span class="mx-1"><i class="fa-solid fa-bag-shopping"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>