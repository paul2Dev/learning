<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Course;
use App\Models\CourseGoal;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('instructor_id', Auth::user()->id)->latest()->get();

        return view('instructor.course.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::latest()->get();
        return view('instructor.course.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'video' => 'required|mimes:mp4|max:10000',
        ]);

        $image = $request->file('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('upload/courses/images', $image, $image_name);

        $video = $request->file('video');
        $video_name = time() . '.' . $video->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('upload/courses/videos', $video, $video_name);

        $course = Course::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => Auth::user()->id,
            'name' => $request->name,
            'title' => $request->title,
            'image' => 'upload/courses/images/'.$image_name,
            'slug' => \Str::slug($request->name),
            'description' => $request->description,
            'video' => 'upload/courses/videos/'.$video_name,
            'level' => $request->level,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'certificate' => $request->certificate,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'prerequisites' => $request->prerequisites,
            'best_seller' => $request->best_seller,
            'featured' => $request->featured,
            'highest_rated' => $request->highest_rated,
            'status' => 0,
        ]);

        //check for goals and add them
        if(count($request->goals)) {
            foreach($request->goals as $goal) {
                if(!empty($goal)) {
                    CourseGoal::create([
                        'course_id' => $course->id,
                        'name' => $goal,
                    ]);
                }
            }
        }

        $notification = array(
            'message' => 'Course Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('courses.index')->with($notification);
    }

    public function subcategoryAjax($category_id)
    {
        $subcategories = Subcategory::where('category_id', $category_id)->latest()->get();
        return response()->json($subcategories);
    }

}
