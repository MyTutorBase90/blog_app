<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Tag;

class TagController extends Controller
{
    public function json_index()
    {
        return datatables()
                    ->of(Tag::orderBy('title', 'ASC')->get())
                    ->addColumn('title', function($get){
                        return $get->title;
                    })
                    ->addColumn('action', 'tag.action')
                    ->addIndexColumn()
                    ->rawColumns(['title', 'action'])
                    ->toJson();
    }

    public function index()
    {
        return view('tag.index');
    }

    public function store(Request $request)
    {
        Tag::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-')
        ]);

        return response()->json([
            'success' => 'Data Successfully Created',
        ]);
    }

    public function edit($slug)
    {
        $data = Tag::where('slug', $slug)->first();
        return response()->json($data);
    }

    public function update(Request $request, $slug)
    {
        Tag::where('slug', $slug)->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-')
        ]);

        return response()->json([
            'success' => 'Data Successfully Updated',
        ]);
    }

    public function delete($slug)
    {
        Tag::where('slug', $slug)->delete();
        return response()->json([
            'success' => 'Data Successfully Deleted',
        ]);
    }
}
