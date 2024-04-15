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

    public function edit($id)
    {
        $course = Course::find($id);
        $categories = Category::latest()->get();
        $subcategories = Subcategory::where('category_id', $course->category_id)->latest()->get();
        $goals = CourseGoal::where('course_id', $course->id)->get();
        return view('instructor.course.edit', compact('course', 'categories', 'subcategories', 'goals'));
    }

    public function update(Request $request)
    {
        $course = Course::find($request->id);

        $course->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'title' => $request->title,
            //'image' => 'upload/courses/images/'.$image_name,
            'slug' => \Str::slug($request->name),
            'description' => $request->description,
            //'video' => 'upload/courses/videos/'.$video_name,
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

        $notification = array(
            'message' => 'Course Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('courses.index')->with($notification);

    }

    public function delete($id)
    {
        $course = Course::find($id);

        //delete course goals
        CourseGoal::where('course_id', $course->id)->delete();

        $course->delete();

        $notification = array(
            'message' => 'Course Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('courses.index')->with($notification);
    }

    public function updateImage(Request $request)
    {
        $course = Course::find($request->id);

        if($request->file('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->delete($course->image);
            Storage::disk('public')->putFileAs('upload/courses/images', $image, $image_name);
        } else {
            $image_name = $course->image;
        }

        $course->update([
            'image' => ($request->file('image')) ? 'upload/courses/images/'.$image_name : $image_name

        ]);

        $notification = array(
            'message' => 'Course Image Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('courses.index')->with($notification);
    }

    public function updateVideo(Request $request)
    {
        $course = Course::find($request->id);

        if($request->file('video')) {
            $video = $request->file('video');
            $video_name = time() . '.' . $video->getClientOriginalExtension();
            Storage::disk('public')->delete($course->video);
            Storage::disk('public')->putFileAs('upload/courses/videos', $video, $video_name);
        } else {
            $video_name = $course->video;
        }

        $course->update([
            'video' => ($request->file('video')) ? 'upload/courses/videos/'.$video_name : $video_name

        ]);

        $notification = array(
            'message' => 'Course Video Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('courses.index')->with($notification);
    }

    public function updateGoals(Request $request)
    {

        if($request->goals == null) {
            return redirect()->back();
        }

        //delete all goals
        CourseGoal::where('course_id', $request->id)->delete();

        //add new goals
        if(count($request->goals)) {
            foreach($request->goals as $goal) {
                if(!empty($goal)) {
                    CourseGoal::create([
                        'course_id' => $request->id,
                        'name' => $goal,
                    ]);
                }
            }
        }

        $notification = array(
            'message' => 'Course Goals Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('courses.index')->with($notification);
    }

}
