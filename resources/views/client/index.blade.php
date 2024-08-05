@extends('client.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('content')
    @if ($catelogue->isNotEmpty())
        <!-- Hero Start -->
        <div class="container-fluid py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12 col-lg-7">
                        <h4 class="mb-3 text-secondary">100% Thực phẩm sạch</h4>
                        <h1 class="mb-5 display-3 text-primary">Thực phẩm sạch và trái cây hữu cơ</h1>
                        <form action="{{ route('search') }}" method="get">
                            <div class="position-relative mx-auto">
                                <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill"
                                    type="text" placeholder="Nhập từ tìm kiếm tại đây ...">
                                <button type="submit"
                                    class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100"
                                    style="top: 0; right: 25%;">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 col-lg-5">
                        <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active rounded">
                                    <img src="{{ asset('themes/client/img/hero-img-1.png') }}"
                                        class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Trái cây</a>
                                </div>
                                <div class="carousel-item rounded">
                                    <img src="{{ asset('themes/client/img/hero-img-2.jpg') }}"
                                        class="img-fluid w-100 h-100 rounded" alt="Second slide">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Rau xanh</a>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Trước</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Tiếp</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- Featurs Section Start -->
        <div class="container-fluid featurs py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-car-side fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Bài viết đa dạng</h5>
                                <p class="mb-0">Trang web tổng hợp rất nhiều bài viết ở mọi lĩnh vực</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-user-shield fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Thông tin bảo mật</h5>
                                <p class="mb-0">100% thông tin của người dùng được bảo mật</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-exchange-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Thông tin mới mẻ</h5>
                                <p class="mb-0">Bài viết được cập nhật theo từng ngày</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fa fa-phone-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Tư vấn 24/7</h5>
                                <p class="mb-0">Hỗ trợ nhanh chóng mọi lúc mọi nơi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featurs Section End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="row g-4">
                        <div class="col-lg-4 text-start">
                            <h1>Bài viết mới nhất trong ngày</h1>
                        </div>
                        <div class="col-lg-8 text-end">
                            <ul class="nav nav-pills d-inline-flex text-center mb-5">
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                        href="#tab-1">
                                        <span class="text-dark" style="width: 130px;">Tổng hợp</span>
                                    </a>
                                </li>
                                @foreach ($catelogue as $index => $cate)
                                    <li class="nav-item">
                                        <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill"
                                            href="#tab-{{ $index + 2 }}">
                                            <span class="text-dark" style="width: 130px;">{{ $cate->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        @foreach ($latestPosts as $post)
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="fruite-img">
                                                        <img src="{{ Storage::url($post->image_post) }}"
                                                            class="img-fluid w-100 rounded-top" alt="{{ $post->title }}">
                                                    </div>
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                        style="top: 10px; left: 10px;">
                                                        {{ $post->catelogue->name }}</div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4>{{ $post->title }}</h4>
                                                        <p>{{ Str::limit($post->description, 100) }}</p>
                                                        <div class="d-flex justify-content-center flex-lg-wrap">
                                                            <a href="{{ route('chitiet', $post->slug) }}"
                                                                class="btn border border-secondary rounded-pill px-3 text-primary">
                                                                <i class="fa fa-shopping-bag me-2 text-primary"></i>Xem chi
                                                                tiết bài viết
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($latestPostsCate as $index => $category)
                            <div id="tab-{{ $index + 2 }}" class="tab-pane fade show p-0">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="row g-4">
                                            @if ($category->posts->isNotEmpty())
                                                @foreach ($category->posts as $post)
                                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                                        <div class="rounded position-relative fruite-item">
                                                            <div class="fruite-img">
                                                                <img src="{{ Storage::url($post->image_post) }}"
                                                                    class="img-fluid w-100 rounded-top"
                                                                    alt="{{ $post->title }}">
                                                            </div>
                                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                                style="top: 10px; left: 10px;">{{ $category->name }}</div>
                                                            <div
                                                                class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                                <h4>{{ $post->title }}</h4>
                                                                <p>{{ Str::limit($post->description, 100) }}</p>
                                                                <div class="d-flex justify-content-center flex-lg-wrap">
                                                                    <a href="{{ route('chitiet', $post->id) }}"
                                                                        class="btn border border-secondary rounded-pill px-3 text-primary">
                                                                        <i
                                                                            class="fa fa-shopping-bag me-2 text-primary"></i>
                                                                        Xem chi tiết bài viết
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-12">
                                                    <p>Không có bài viết mới trong danh mục này hôm nay.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->


        <!-- Featurs Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-secondary rounded border border-secondary">
                                <img src="{{ asset('themes/client/img/featur-1.jpg') }}"
                                    class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-primary text-center p-4 rounded">
                                        <h5 class="text-white">Fresh Apples</h5>
                                        <h3 class="mb-0">20% OFF</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-dark rounded border border-dark">
                                <img src="{{ asset('themes/client/img/featur-2.jpg') }}"
                                    class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-light text-center p-4 rounded">
                                        <h5 class="text-primary">Tasty Fruits</h5>
                                        <h3 class="mb-0">Free delivery</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-primary rounded border border-primary">
                                <img src="{{ asset('themes/client/img/featur-3.jpg') }}"
                                    class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-secondary text-center p-4 rounded">
                                        <h5 class="text-white">Exotic Vegitable</h5>
                                        <h3 class="mb-0">Discount 30$</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featurs End -->


        <!-- Vesitable Shop Start-->
        <div class="container-fluid vesitable py-5">
            <div class="container py-5">
                <h1 class="mb-0">Bài viết truy cập nhiều nhất</h1>
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    @foreach ($topView as $top)
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <img src="{{ Storage::url($top->image_post) }}" class="img-fluid w-100 rounded-top"
                                    alt="">
                            </div>
                            @if ($top->catelogue)
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; right: 10px;">
                                    {{ $top->catelogue->name }}
                                </div>
                            @endif
                            <h4>{{ $top->title }}</h4>
                            <p>{{ $top->description }}</p>
                            <div class="d-flex justify-content-center flex-lg-wrap">
                                <a href="{{ route('chitiet', $top->slug) }}"
                                    class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i>Xem chi tiết bài viết</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
        <!-- Vesitable Shop End -->


        <!-- Banner Section Start-->
        <div class="container-fluid banner bg-secondary my-5">
            <div class="container py-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="py-4">
                            <h1 class="display-3 text-white">Bài viết lớn</h1>
                            <p class="fw-normal display-3 text-dark mb-4">{{ $topOne->title }}</p>
                            <p class="mb-4 text-dark">{{ Str::limit($topOne->description, 100) }}</p>
                            <a href="{{ route('chitiet', $topOne->slug) }}"
                                class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">Truy cập</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative">
                            <img src="{{ asset('themes/client/img/baner-1.png') }}" class="img-fluid w-100 rounded"
                                alt="">
                            <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute"
                                style="width: 140px; height: 140px; top: 0; left: 0;">
                                <div class="d-flex flex-column">
                                    {{-- <span class="h2 mb-0">50$</span> --}}
                                    <span class="h4 text-muted mb-0">{{ $topOne->view }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Section End -->


        <!-- Bestsaler Product Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                    <h1 class="display-4">Bài viết nổi bật</h1>
                    {{-- <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which
                    looks reasonable.</p> --}}
                </div>
                <div class="row g-4">
                    @foreach ($topFeaturedPosts as $post)
                        <div class="col-lg-6 col-xl-3">
                            <div class="p-4 rounded bg-light">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <img src="{{ Storage::url($post->image_post) }}"
                                            class="img-fluid rounded-circle w-100" alt="">
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="h5">{{ $post->title }}</a>
                                        <div class="d-flex my-3">
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <a href="{{ route('chitiet', $post->slug) }}"
                                            class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i>Xem chi tiết bài viết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($bottomFeaturedPosts as $post)
                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <div class="text-center">
                                <img src="{{ Storage::url($post->image_post) }}" class="img-fluid rounded"
                                    alt="">
                                <div class="py-4">
                                    <a href="#" class="h5">{{ $post->title }}</a>
                                    <div class="d-flex my-3 justify-content-center">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <a href="{{ route('chitiet', $post->slug) }}"
                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                            class="fa fa-shopping-bag me-2 text-primary"></i>Xem chi tiết bài viết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Bestsaler Product End -->


        <!-- Fact Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="bg-light p-5 rounded">
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>Tổng số bài viết</h4>
                                <h1>{{ $totalPosts }}</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>Tổng số bài viết được đọc</h4>
                                <h1>{{ $postsWithViews }}</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>Số thành viên truy cập</h4>
                                <h1>{{ $totalUsers }}</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>Tổng số lượt xem</h4>
                                <h1>{{ $totalViews }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fact Start -->


        <!-- Tastimonial Start -->
        <div class="container-fluid testimonial py-5">
            <div class="container py-5">
                <div class="testimonial-header text-center">
                    <h4 class="text-primary">Lượt đánh giá</h4>
                    <h1 class="display-5 mb-5 text-dark">Lượt đánh giá mới nhất</h1>
                </div>
                <div class="owl-carousel testimonial-carousel">
                    @foreach ($latestComments as $latestComment)
                        <div class="testimonial-item img-border-radius bg-light rounded p-4">
                            <div class="position-relative">
                                <i class="fa fa-quote-right fa-2x text-secondary position-absolute"
                                    style="bottom: 30px; right: 0;"></i>
                                <div class="mb-4 pb-4 border-bottom border-secondary">
                                    <p class="mb-0">{{ $latestComment->content }}</p>
                                </div>
                                <div class="d-flex align-items-center flex-nowrap">
                                    <div class="bg-secondary rounded">
                                        <img src="{{ Storage::url($latestComment->user ? $latestComment->user->avatar : 'Không có ảnh đại diện') }}"
                                            class="img-fluid rounded" style="width: 100px; height: 100px;"
                                            alt="">
                                    </div>
                                    <div class="ms-4 d-block">
                                        <h4 class="text-dark">
                                            {{ $latestComment->user ? $latestComment->user->name : 'Không có người dùng' }}
                                        </h4>
                                        <p class="m-0 pb-3">
                                            {{ $latestComment->post ? $latestComment->post->title : 'Không có bài viết' }}
                                        </p>
                                        <div class="d-flex pe-5">
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Tastimonial End -->
    @else
        <div class="alert alert-info">
            Không có bài viết nào để hiển thị.
        </div>
    @endif
@endsection
