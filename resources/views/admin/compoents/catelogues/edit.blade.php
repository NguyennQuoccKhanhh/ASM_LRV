@extends('admin.layouts.master')

@section('title')
    Cập nhật danh mục bài vết: {{ $model->name }}
@endsection

@section('content')
    <form action="{{ route('admin.compoents.catelogues.update', $model->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mt-3 mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
                value="{{ $model->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </form>
@endsection
