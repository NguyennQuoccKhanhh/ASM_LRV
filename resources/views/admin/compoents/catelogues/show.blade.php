@extends('admin.layouts.master')

@section('title')
    Xem chi tiết danh mục: {{ $model->name }}
@endsection

@section('content')
    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
        <tr>
            <th>Trường</th>
            <th>Giá trị</th>
        </tr>
        @foreach ($model->toArray() as $key => $item)
            @if ($key !== 'deleted_at')
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $item }}</td>
                </tr>
            @endif
        @endforeach
    </table>
@endsection
