<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        $image = $request->file('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('upload/categories', $image, $image_name);

        Category::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'image' => 'upload/categories/'.$image_name,
        ]);

        $notification = array(
            'message' => 'Category Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.index')->with($notification);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$request->id,
        ]);

        $category = Category::find($request->id);

        if($request->file('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->delete($category->image);
            Storage::disk('public')->putFileAs('upload/categories', $image, $image_name);
        } else {
            $image_name = $category->image;
        }

        $category->update([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'image' => ($request->file('image')) ? 'upload/categories/'.$image_name : $image_name,
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.index')->with($notification);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        Storage::disk('public')->delete($category->image);
        $category->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.index')->with($notification);
    }
}
