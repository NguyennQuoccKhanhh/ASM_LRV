@extends('admin.layouts.master')

@section('title')
    Cập nhật bài viết
@endsection

@section('content')
    <form action="{{ route('admin.compoents.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Cập nhật bài viết: {{ $post->title }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Bài viết</a></li>
                            <li class="breadcrumb-item active">Cập nhật</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        @if ($errors->any() || session('error'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            @if ($errors->any())
                                <div class="alert alert-danger" style="width: 100%;">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger" style="width: 100%;">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

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
                                                <option @selected($post->catelogue_id == $id) value="{{ $id }}">
                                                    {{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="sku" class="form-label">Mã bài viết</label>
                                        <input type="text" class="form-control" name="sku" id="sku" disabled
                                            value="{{ $post->sku }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="title" class="form-label">Tiêu đề bài viết</label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            value="{{ $post->title }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="image_post" class="form-label">Ảnh bìa</label>
                                        <input type="file" class="form-control" name="image_post" id="image_post">
                                        @if ($post->image_post)
                                            <img src="{{ \Storage::url($post->image_post) }}" width="100px" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="description" class="form-label">Miêu tả ngắn</label>
                                        <input type="text" class="form-control" name="description" id="description"
                                            value="{{ $post->description }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="content" class="form-label">Mô tả</label>
                                        {{-- <input  class="form-control" name="content" id="content"
                                            placeholder="Thêm mô tả"> --}}
                                        <textarea class="form-control" name="content" id="content" cols="30" rows="10" placeholder="Thêm mô tả">{!! $post->content !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck1"
                                            name="is_show_home" {{ $post->is_show_home ? 'checked' : '' }}>
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
                                @if ($post->medias && count($post->medias) > 0)
                                    @foreach ($post->medias as $item)
                                        <div class="col-md-6" id="storage_{{ $item->id }}_item">
                                            <label for="media_{{ $item->id }}" class="form-label">Ảnh</label>
                                            <div class="d-flex">
                                                <input type="file" class="form-control" name="image_media[]"
                                                    id="media_{{ $item->id }}">
                                                <img src="{{ \Storage::url($item->image_media) }}" width="100px"
                                                    alt="Media Image">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removeImageMedia('storage_{{ $item->id }}_item', '{{ $item->id }}', '{{ $item->image_media }}')">
                                                    <span class="bx bx-trash">Xóa</span>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-6" id="media_default_item">
                                        <label for="media_default" class="form-label">Ảnh</label>
                                        <div class="d-flex">
                                            <input type="file" class="form-control" name="image_media[]"
                                                id="media_default">
                                        </div>
                                    </div>
                                @endif

                            </div>
                            <!--end row-->
                        </div>
                        <div id="delete_galleries"></div>
                    </div>
                </div>
                <div class="">
                    <button class="col-md-12 btn btn-primary" type="submit">Cập nhật</button>
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

        function removeImageMedia(id, mediaID, imagePath) {
            if (confirm('Chắc chắn xóa không?')) {
                document.getElementById(id).remove();
                let html = `<input type="hidden" name="delete_medias[${mediaID}]" value="${imagePath}">`;
                document.getElementById('delete_galleries').insertAdjacentHTML('beforeend', html);
            }
        }
    </script>
@endsection
