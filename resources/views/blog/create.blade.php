@extends('layouts.app')
@section('title')
    Create Blog
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="col-md-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Create Blog</h4>
            </div>
            <form id="frm_crt_blog">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <b>Title</b>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <b>Category</b>
                                <select name="category_id" class="form-control select2" required>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <b>Content</b>
                        <textarea name="content" class="form-control" id="summernote" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <b>Tags</b>
                        <select name="tag_id[]" class="form-control select2" data-placeholder="Choose Tag" multiple required>
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <b>Cover Image</b>
                        <input type="file" class="form-control" name="cover_image" accept="image/*" required>
                    </div>
                </div>
                <div class="card-footer btn-wrapper text-center d-flex justify-content-between">
                    <a href="{{url('/blog')}}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary btn_crt_blog">Save <i class="fa-solid fa-spinner fa-spin btn_crt_spin_blog" style="display: none;"></i></button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{asset('management/blog.js')}}"></script>
@endpush
