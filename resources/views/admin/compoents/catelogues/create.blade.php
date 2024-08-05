@extends('admin.layouts.master')

@section('title')
    Them moi danh mục
@endsection

@section('content')
    <form action="{{ route('admin.compoents.catelogues.store') }}" method="POST">
        @csrf
        <div class="mt-3 mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
            {{-- @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif --}}
            @error('name')
{{$message}}
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
        </div>
    </form>
@endsection
