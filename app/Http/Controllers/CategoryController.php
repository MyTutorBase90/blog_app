<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Category;

class CategoryController extends Controller
{
    public function json_index()
    {
        return datatables()
                    ->of(Category::orderBy('title', 'ASC')->get())
                    ->addColumn('title', function($get){
                        return $get->title;
                    })
                    ->addColumn('action', 'category.action')
                    ->addIndexColumn()
                    ->rawColumns(['title', 'action'])
                    ->toJson();
    }

    public function index()
    {
        return view('category.index');
    }

    public function store(Request $request)
    {
        Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-')
        ]);

        return response()->json([
            'success' => 'Data Successfully Created',
        ]);
    }

    public function edit($slug)
    {
        $data = Category::where('slug', $slug)->first();
        return response()->json($data);
    }

    public function update(Request $request, $slug)
    {
        Category::where('slug', $slug)->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-')
        ]);

        return response()->json([
            'success' => 'Data Successfully Updated',
        ]);
    }

    public function delete($slug)
    {
        Category::where('slug', $slug)->delete();
        return response()->json([
            'success' => 'Data Successfully Deleted',
        ]);
    }
}
