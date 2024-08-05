@extends('client.layouts.master')

@section('title')
    Chi tiết bài viết : {{ $post->slug }}
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Chi tiết sản phẩm</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Chi tiết sản phẩm</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ Storage::url($post->image_post) }}" class="img-fluid rounded"
                                        alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{ $post->title }}</h4>
                            <p class="mb-3">Category: {{ $post->catelogue->name }}</p>
                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p class="mb-4">{!! $post->content !!}</p>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Miêu tả đầy đủ</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Bình luận</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <p>{!! $post->content !!}</p>

                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                    @foreach ($post->comments as $comment)
                                        <div class="d-flex">
                                            <img src="{{ Storage::url(Auth::user()->avatar) }}"
                                                class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;"
                                                alt="">
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">
                                                    {{ $comment->created_at->format('d/m/Y H:i') }}</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>{{ $comment->user->name }}</h5>
                                                </div>
                                                <p>{{ $comment->content }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <h4 class="mb-5 fw-bold">Bình luận của tôi</h4>
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0 me-4" disabled
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="email" class="form-control border-0" disabled
                                            value="{{ Auth::user()->email }}">
                                    </div>
                                </div>

                                <form action="{{ route('comment.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div class="col-lg-12">
                                        <div class="border-bottom rounded my-4">
                                            <textarea name="content" class="form-control border-0" cols="30" rows="8" placeholder="Nội dung của bạn... *"
                                                spellcheck="false"></textarea>
                                        </div>
                                        <button type="submit"
                                            class="btn border border-secondarpy text-rimary rounded-pill px-4 py-3">Gửi</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <h1 class="mb-4">Tìm kiếm bài viết</h1>
                            <div class="input-group w-100 mx-auto d-flex mb-4">
                                <input type="search" class="form-control p-3" placeholder="Nhập danh mục..."
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        @include('client.layouts.partials.menu-doc')
                    </div>
                </div>
            </div>
            <h1 class="fw-bold mb-0">Bài viết tương tự</h1>
            <div class="vesitable">
                @if ($relatedPosts->isNotEmpty())
                    <div class="owl-carousel vegetable-carousel justify-content-center">
                        @foreach ($relatedPosts as $relatedPost)
                            <div class="border border-primary rounded position-relative vesitable-item">
                                <div class="vesitable-img">
                                    <img src="{{ Storage::url($relatedPost->image_post) }}"
                                        class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; right: 10px;">{{ $relatedPost->catelogue->name }}</div>
                                <div class="p-4 pb-0 rounded-bottom">
                                    <h4>{{ $relatedPost->title }}</h4>
                                    <p>{{ Str::limit($relatedPost->description, 100) }}</p>
                                    <div class="d-flex justify-content-center flex-lg-wrap">
                                        <a href="{{ route('chitiet', $relatedPost->slug) }}"
                                            class="btn border border-secondaryounded-pill px-3 py-1 mb-4 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i>Xem chi tiết bài viết</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Không có bài viết tương tự.</p>
                @endif
            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection
