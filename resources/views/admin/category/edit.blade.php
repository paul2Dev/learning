@extends('admin.dashboard')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <form class="row g-3" id="editCategory" action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $category->id }}">
                <div class="form-group col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}" placeholder="Category Name">
                </div>
                <div class="col-md-6"></div>
                <div class="form-group col-md-6">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" name="image" type="file" id="image">
                </div>
                <div class="col-md-6">
                    <img id="showImage" src="{{ (!empty($category->image)) ? Croppa::url($category->image, 150) : url('upload/no_image.jpg') }}" alt="Admin" class="rounded-squre p-1 bg-primary" width="150">
                </div>
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
