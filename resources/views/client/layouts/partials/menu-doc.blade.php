<div class="col-lg-12">
    <div class="mb-3">
        <h4>Số bài viết</h4>
        <ul class="list-unstyled fruite-categorie">
            @foreach ($catelogueWithCount as $cateWithCount)
                <li>
                    <div class="d-flex justify-content-between fruite-name">
                        <a href="#"><i class="fas fa-apple-alt me-2"></i>{{ $cateWithCount->name }}</a>
                        <span>({{ $cateWithCount->posts_count }})</span>
                    </div>
                </li>
            @endforeach
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
    <h4 class="mb-3">Top 5 bài viết được xem nhiều nhất</h4>
    @foreach ($topViewedPosts->take(3) as $topPost)
        <div class="d-flex align-items-center justify-content-start">
            <div class="rounded me-4" style="width: 100px; height: 100px;">
                <img src="{{ Storage::url($topPost->image_post) }}" class="img-fluid rounded" alt="">
            </div>
            <div>
                <h6 class="mb-2">{{ $topPost->title }}</h6>
                <div class="d-flex mb-2">
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star"></i>
                </div>
            </div>
        </div>
    @endforeach
    <div id="hidden-posts" style="display: none;">
        @foreach ($topViewedPosts->slice(3) as $topPost)
            <div class="d-flex align-items-center justify-content-start mt-2">
                <div class="rounded me-4" style="width: 100px; height: 100px;">
                    <img src="{{ Storage::url($topPost->image_post) }}" class="img-fluid rounded" alt="">
                </div>
                <div>
                    <h6 class="mb-2">{{ $topPost->title }}</h6>
                    <div class="d-flex mb-2">
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center my-4">
        <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100"
            onclick="showMorePosts(event)">Xem thêm</a>
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
<script>
    function showMorePosts(event) {
        event.preventDefault();
        document.getElementById('hidden-posts').style.display = 'block';
        event.target.style.display = 'none';
    }
</script>
