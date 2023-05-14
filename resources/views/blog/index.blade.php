@extends('layouts.app')
@section('title')
    Blog
@endsection
@section('content')
<div class="container">
    <div class="col-md-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Blogs</h4>
                <a href="{{url('/blog/create')}}" class="btn btn-sm btn-primary">New Blog</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" id="blog_table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
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
@include('blog.delete')
@endsection
@push('js')
    <script src="{{asset('management/blog.js')}}"></script>
@endpush
