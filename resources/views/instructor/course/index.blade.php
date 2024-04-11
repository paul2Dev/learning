@extends('instructor.dashboard')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Courses</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('course.create') }}" class="btn btn-primary px-5">Add Course</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td><img src="{{ Croppa::url($course->image, 50) }}" alt=""></td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->category_id }}</td>
                            <td>{{ $course->price }}</td>
                            <td>{{ $course->discount_price }}</td>
                            <td>
                                <a href="{{ route('category.edit', $course->id) }}" class="btn btn-outline-info"><i class="bx bx-pencil me-0"></i></a>
                                <a href="{{ route('category.delete', $course->id) }}" class="btn btn-outline-danger" id="delete"><i class="bx bx-x me-0"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
