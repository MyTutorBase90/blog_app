@extends('layouts.app')
@section('title')
    Category
@endsection
@section('content')
<div class="container">
    <div class="col-md-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Categories</h4>
                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#crt_category">New Category</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" id="category_table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('category.create')
@include('category.edit')
@include('category.delete')
@endsection
@push('js')
    <script src="{{asset('management/category.js')}}"></script>
@endpush
