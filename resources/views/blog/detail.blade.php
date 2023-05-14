@extends('layouts.app')
@section('title')
    {{$blog->title}}
@endsection
@section('content')
<div class="container">
    <div class="col-md-8 offset-2 mt-5 mb-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{$blog->title}}</h4>
            </div>
            <div class="card-body">
                <img src="{{asset('document/blogs/'.$blog->cover_image)}}" alt="{{$blog->title}}" style="max-width: 100%; max-height: 50%;">
                <hr>
                <span class="badge bg-primary">{{$blog->category->title}}</span>
                <br>
                {!! $blog->content !!}
                <hr>
                @foreach ($blog->tags as $tag)
                    <span class="badge bg-info">#{{$tag->title}}</span>
                @endforeach
            </div>
            <div class="card-footer btn-wrapper text-center d-flex justify-content-between">
                <a href="{{url('/blog')}}" class="btn btn-danger">Back</a>
                <a href="{{url('/blog/'.$blog->slug.'/edit')}}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
</div>
@include('blog.delete')
@endsection
@push('js')
    <script src="{{asset('management/blog.js')}}"></script>
@endpush
