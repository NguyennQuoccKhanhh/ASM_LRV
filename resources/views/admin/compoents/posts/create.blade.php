@extends('admin.layouts.master')

@section('title')
    Thêm mới bài viết
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <div class="alert alert-danger" style="width: 100%;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <form action="{{ route('admin.compoents.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div>
                                        <label for="catelogue_id" class="form-label">Danh mục bài viết</label>
                                        <select class="form-control" name="catelogue_id" id="catelogue_id">
                                            @foreach ($catelogues as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="sku" class="form-label">Mã bài viết</label>
                                        <input type="text" class="form-control" name="sku" id="sku"
                                            value="{{ strtoupper(\Str::random(8)) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="title" class="form-label">Tiêu đề bài viết</label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="Thêm tiêu đề bài viết">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="image_post" class="form-label">Ảnh bìa</label>
                                        <input type="file" class="form-control" name="image_post" id="image_post">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="description" class="form-label">Miêu tả ngắn</label>
                                        <input type="text" class="form-control" name="description" id="description"
                                            placeholder="Thêm miêu tả ngắn">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="content" class="form-label">Mô tả</label>
                                        {{-- <input  class="form-control" name="content" id="content"
                                            placeholder="Thêm mô tả"> --}}
                                        <textarea class="form-control" name="content" id="content" cols="30" rows="10" placeholder="Thêm mô tả"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck1" name="is_show_home" value="1"
                                            checked>
                                        <label class="form-check-label" for="SwitchCheck1">Hiển thị</label>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Ảnh mô tả</h4>
                        <button type="button" class="btn btn-primary" onclick="addImageMedia()">Thêm ảnh</button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="media_list">
                                <div class="col-md-6" id="media_default_item">
                                    <label for="media_default" class="form-label">Ảnh</label>
                                    <div class="d-flex">
                                        <input type="file" class="form-control" name="image_media[]" id="media_default">
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
                <div class="">
                    <button class="col-md-12 btn btn-primary" type="submit">Thêm mới</button>
                </div>
            </div>
            <!--end col-->
        </div>
    </form>
@endsection


@section('scripts-list')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection
@section('scripts')
    <script>
        $('form').submit(function() {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        });
        // CKEDITOR.replace('content');

        function addImageMedia() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" name="image_media[]" id="${id}">
                        <button type="button" class="btn btn-danger" onclick="removeImageMedia('${id}_item')">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>
            `;

            // $('#media_list').append(html);
            document.getElementById('media_list').insertAdjacentHTML('beforeend', html);
        }

        function removeImageMedia(id) {
            if (confirm('Chắc chắn xóa không?')) {
                // $('#' + id).remove();
                document.getElementById(id).remove();
            }
        }
    </script>
@endsection
