<div class="container px-0">
    <nav class="navbar navbar-light bg-white navbar-expand-xl">
        <a href="index.html" class="navbar-brand">
            <h1 class="text-primary display-6"><a href="{{ route('index') }}">Fruitables</a> </h1>
        </a>
        <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars text-primary"></span>
        </button>
        <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
            <div class="navbar-nav mx-auto">
                <a href="{{ route('index') }}" class="nav-item nav-link active">Trang chủ</a>
                @if (Auth::user())
                    <a href="{{ route('listdanhsach') }}" class="nav-item nav-link"> Tổng hợp bài viết</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Chuyên mục bài viết
                        </a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            @foreach ($catelogue as $cate)
                                <a href="{{ route('listPostCate', ['id' => $cate->id]) }}"
                                    class="dropdown-item">{{ $cate->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif


                <a href="{{ route('lienhe') }}" class="nav-item nav-link">Liên hệ </a>
            </div>
            <div class="d-flex m-3 me-0">
                <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                    data-bs-toggle="modal" data-bs-target="#searchModal"><i
                        class="fas fa-search text-primary"></i></button>
                <a href="#" class="position-relative me-4 my-auto">
                </a>
                <a href="#" class="my-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fas fa-user fa-2x"></i>
                        </a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            @if (Auth::user())
                                {{-- <a href="" class="dropdown-item">Cập nhật tài khoản</a> --}}
                                <a href="{{ route('forgotPassword') }}" class="dropdown-item">Quên mật khẩu</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item"
                                        onclick="confirmLogout(event)">Thoát</button>
                                </form>
                                <script>
                                    function confirmLogout(event) {
                                        event.preventDefault();
                                        if (confirm('Bạn có chắc chắn muốn đăng xuất?')) {
                                            document.getElementById('logout-form').submit();
                                        }
                                    }
                                </script>
                            @else
                                <a href="{{ route('register') }}" class="dropdown-item">Đăng ký</a>
                                <a href="{{ route('login') }}" class="dropdown-item">Đăng nhập</a>
                            @endif
                        </div>
                    </div>

                </a>
            </div>
        </div>
    </nav>
</div>
