@extends('client.layouts.master')

@section('title')
    Danh sách bài viết
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Danh sách bài viết theo danh mục: {{ $currentCatelogue->name }}</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Danh sách bài viết theo danh mục </li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Tìm kiếm bài viết</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="Nhập danh mục..."
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-6"></div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                @include('client.layouts.partials.menu-doc')
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center">
                                @foreach ($posts as $post)
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ Storage::url($post->image_post) }}"
                                                    class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">{{ $currentCatelogue->name }}</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{ $post->title }}</h4>
                                                <p>{{ Str::limit($post->description, 100) }} </p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <a href="{{ route('chitiet', $post->slug) }}"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i>Xem chi tiết
                                                        bài
                                                        viết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        @if ($posts->onFirstPage())
                                            <span class="rounded">&laquo;</span>
                                        @else
                                            <a href="{{ $posts->previousPageUrl() }}" class="rounded">&laquo;</a>
                                        @endif

                                        @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                            <a href="{{ $url }}"
                                                class="rounded {{ $page == $posts->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                                        @endforeach

                                        @if ($posts->hasMorePages())
                                            <a href="{{ $posts->nextPageUrl() }}" class="rounded">&raquo;</a>
                                        @else
                                            <span class="rounded">&raquo;</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
@endsection
