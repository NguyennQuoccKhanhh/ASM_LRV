
@extends('client.layouts.master')

@section('title')
    Đăng Nhập
@endsection

@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Đăng nhập</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Đăng nhập</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Đăng nhập tài khoản</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Email<sup>*</sup></label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Password<sup>*</sup></label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter Password">
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('forgotPassword') }}">Quên mật khẩu</a>
                    <div class="row mt-3">
                        <button type="submit" class="btn btn-primary">Đăng nhập</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->
@endsection
