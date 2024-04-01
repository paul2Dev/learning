<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Models\Subcategory;

class CategoryController extends Controller
{
    //category methods

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

    //subcategory methods

    public function subcategoryIndex()
    {
        $subcategories = Subcategory::latest()->get();
        return view('admin.subcategory.index', compact('subcategories'));
    }

    public function subcategoryCreate()
    {
        $categories = Category::latest()->get();
        return view('admin.subcategory.create', compact('categories'));
    }

    public function subcategoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:subcategories,name',
            'category_id' => 'required',
        ]);

        Subcategory::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'category_id' => $request->category_id,
        ]);

        $notification = array(
            'message' => 'Subcategory Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subcategory.index')->with($notification);
    }

    public function subcategoryEdit($id)
    {
        $subcategory = Subcategory::find($id);
        $categories = Category::latest()->get();
        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function subcategoryUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:subcategories,name,'.$request->id,
            'category_id' => 'required',
        ]);

        $subcategory = Subcategory::find($request->id);

        $subcategory->update([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'category_id' => $request->category_id,
        ]);

        $notification = array(
            'message' => 'Subcategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subcategory.index')->with($notification);
    }

    public function subcategoryDelete($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();

        $notification = array(
            'message' => 'Subcategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subcategory.index')->with($notification);
    }
}
