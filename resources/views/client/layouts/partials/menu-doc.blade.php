<div class="col-lg-12">
    <div class="mb-3">
        <h4>Số bài viết</h4>
        <ul class="list-unstyled fruite-categorie">
            <li>
                <div class="d-flex justify-content-between fruite-name">
                    <a href="#"><i class="fas fa-apple-alt me-2"></i>Danh mục 1</a>
                    <span>(3)</span>
                </div>
            </li>
            <li>
                <div class="d-flex justify-content-between fruite-name">
                    <a href="#"><i class="fas fa-apple-alt me-2"></i>Danh mục 2</a>
                    <span>(5)</span>
                </div>
            </li>
            <li>
                <div class="d-flex justify-content-between fruite-name">
                    <a href="#"><i class="fas fa-apple-alt me-2"></i>Danh mục 3</a>
                    <span>(2)</span>
                </div>
            </li>
            <li>
                <div class="d-flex justify-content-between fruite-name">
                    <a href="#"><i class="fas fa-apple-alt me-2"></i>Danh mục 4</a>
                    <span>(8)</span>
                </div>
            </li>
            <li>
                <div class="d-flex justify-content-between fruite-name">
                    <a href="#"><i class="fas fa-apple-alt me-2"></i>Danh mục 5</a>
                    <span>(5)</span>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="col-lg-12">
    <div class="mb-3">
        <h4 class="mb-2">Lượt xem</h4>
        <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500"
            value="0" oninput="amount.value=rangeInput.value">
        <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
    </div>
</div>
<div class="col-lg-12">
    <h4 class="mb-3">Top 5 bài vết được xem nhiều nhất</h4>
    <div class="d-flex align-items-center justify-content-start">
        <div class="rounded me-4" style="width: 100px; height: 100px;">
            <img src="{{ asset('themes/client/img/featur-1.jpg') }}" class="img-fluid rounded" alt="">
        </div>
        <div>
            <h6 class="mb-2">Tiêu đề 1</h6>
            <div class="d-flex mb-2">
                <i class="fa fa-star text-secondary"></i>
                <i class="fa fa-star text-secondary"></i>
                <i class="fa fa-star text-secondary"></i>
                <i class="fa fa-star text-secondary"></i>
                <i class="fa fa-star"></i>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-start">
        <div class="rounded me-4" style="width: 100px; height: 100px;">
            <img src="{{ asset('themes/client/img/featur-2.jpg') }}" class="img-fluid rounded" alt="">
        </div>
        <div>
            <h6 class="mb-2">Tiêu đề 2</h6>
            <div class="d-flex mb-2">
                <i class="fa fa-star text-secondary"></i>
                <i class="fa fa-star text-secondary"></i>
                <i class="fa fa-star text-secondary"></i>
                <i class="fa fa-star text-secondary"></i>
                <i class="fa fa-star"></i>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-start">
        <div class="rounded me-4" style="width: 100px; height: 100px;">
            <img src="{{ asset('themes/client/img/featur-3.jpg') }}" class="img-fluid rounded" alt="">
        </div>
        <div>
            <h6 class="mb-2">Tiêu đề 3</h6>
            <div class="d-flex mb-2">
                <i class="fa fa-star text-secondary"></i>
                <i class="fa fa-star text-secondary"></i>
                <i class="fa fa-star text-secondary"></i>
                <i class="fa fa-star text-secondary"></i>
                <i class="fa fa-star"></i>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center my-4">
        <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Xem thêm</a>
    </div>
</div>
<div class="col-lg-12">
    <div class="position-relative">
        <img src="{{ asset('themes/client/img/banner-fruits.jpg') }}" class="img-fluid w-100 rounded" alt="">
        <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
            <h3 class="text-secondary fw-bold">Trái cây <br> Rau xanh</h3>
        </div>
    </div>
</div>
