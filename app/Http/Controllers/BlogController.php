<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Blog;

use Validator;

class BlogController extends Controller
{
    public function json_index()
    {
        return datatables()
                    ->of(Blog::orderBy('title', 'ASC')->get())
                    ->addColumn('title', function($get){
                        return $get->title;
                    })
                    ->addColumn('category', function($get){
                        return $get->category ? $get->category->title : '';
                    })
                    ->addColumn('action', 'blog.action')
                    ->addIndexColumn()
                    ->rawColumns(['title', 'category', 'action'])
                    ->toJson();
    }

    public function index()
    {
        return view('blog.index');
    }

    public function create()
    {
        $data['categories'] = Category::orderBy('title', 'ASC')->get();
        $data['tags'] = Tag::orderBy('title', 'ASC')->get();
        return view('blog.create', $data);
    }

    public function store(Request $request)
    {
        $rules = array(
            'cover_image' => 'sometimes|max:5024',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if ($request->hasFile('cover_image')) {
            $allowedfileExtension_cover_image=['jpg', 'png', 'jpeg', 'PNG', 'JPG', 'JPEG'];
            $file_cover_image = $request->file('cover_image');
            $filename_cover_image = Str::slug($request->title, '_') . time() . '.' . $file_cover_image->getClientOriginalExtension();
            $extension_cover_image = $file_cover_image->getClientOriginalExtension();
            $check_cover_image = in_array($extension_cover_image,$allowedfileExtension_cover_image);
            if ($check_cover_image) {
                $location_cover_image = public_path('document/blogs');
                $file_cover_image->move($location_cover_image, $filename_cover_image);
                $document_cover_image = $filename_cover_image;
            }else{
                return response()->json(['error_extension' => 'The File Must Be jpg, jpeg, png, PNG, JPG, JPEG']);
            }
            $cover_image = $document_cover_image;
        }

        $blog = new Blog;
        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title, '-');
        $blog->content = $request->content;
        $blog->cover_image = $cover_image;
        $blog->save();

        $blog->tags()->sync($request->tag_id, false);

        return response()->json([
            'success' => 'Data Successfully Created',
            'slug' => $blog->slug
        ]);
    }

    public function detail($slug)
    {
        $data['blog'] = Blog::where('slug', $slug)->with(['category', 'tags'])->first();
        return view('blog.detail', $data);
    }

    public function edit($slug)
    {
        $data['blog'] = Blog::where('slug', $slug)->first();
        $data['categories'] = Category::orderBy('title', 'ASC')->get();
        $data['tags'] = Tag::orderBy('title', 'ASC')->get();
        return view('blog.edit', $data);
    }

    public function update(Request $request, $slug)
    {
        $rules = array(
            'cover_image' => 'sometimes|max:5024',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $blog = Blog::where('slug', $slug)->first();
        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title, '-');
        $blog->content = $request->content;
        if ($request->hasFile('cover_image')) {
            $allowedfileExtension_cover_image=['jpg', 'png', 'jpeg', 'PNG', 'JPG', 'JPEG'];
            $file = $request->file('cover_image');
            $filename = Str::slug($request->title, '_') . time() . '.' . $file->getClientOriginalExtension();
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension,$allowedfileExtension_cover_image);
            if (isset($blog->cover_image) && file_exists(public_path('document/blogs/'.$blog->cover_image))) {
                unlink(public_path('document/blogs/'.$blog->cover_image));
            }
            if ($check) {
                $location = public_path('document/blogs');
                $file->move($location, $filename);
                $document = $filename;
            }else{
                return response()->json(['error_extension' => 'The File Must Be jpg, jpeg, png, PNG, JPG, JPEG']);
            }
            $blog->cover_image = $document;
        }
        $blog->save();

        if (isset($request->tag_id)) {
            $blog->tags()->sync($request->tag_id);
        } else {
            $blog->tags()->sync(array());
        }

        return response()->json([
            'success' => 'Data Successfully Updated',
            'slug' => $blog->slug
        ]);
    }

    public function delete($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        if (isset($blog->cover_image) && file_exists(public_path('document/blogs/'.$blog->cover_image))) {
            unlink(public_path('document/blogs/'.$blog->cover_image));
        }
        $blog->delete();
        return response()->json([
            'success' => 'Data Successfully Deleted'
        ]);
    }
}
