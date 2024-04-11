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
                    <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <form class="row g-3" id="createCategory" action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Course Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Course Title">
                </div>
                <div class="form-group col-md-6">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" name="image" type="file" id="image">
                </div>
                <div class="col-md-6">
                    <img id="showImage" src="{{ (!empty($course->image)) ? url($course->image) : url('upload/no_image.jpg') }}" alt="Admin" class="rounded-squre p-1 bg-primary" width="150">
                </div>
                <div class="form-group col-md-6">
                    <label for="video" class="form-label">Video</label>
                    <input type="file" name="video" class="form-control" accept="video/mp4, video/webm">
                </div>
                <div class="col-md-6"></div>
                <div class="form-group col-md-6">
                    <label for="category_id" class="form-label">Select Category</label>
                    <select class="form-select mb-3" name="category_id" aria-label="Default select example">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="subcategory_id" class="form-label">Select Subcategory</label>
                    <select class="form-select mb-3" name="subcategory_id" aria-label="Default select example">
                        <option value="">Select</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="certificate" class="form-label">Certificate Available</label>
                    <select class="form-select mb-3" name="certificate" aria-label="Default select example">
                        <option value="">Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="certificate" class="form-label">Course Level</label>
                    <select class="form-select mb-3" name="level" aria-label="Default select example">
                        <option value="">Select</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Middle">Middle</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="price" class="form-control" id="price">
                </div>
                <div class="form-group col-md-3">
                    <label for="discount_price" class="form-label">Discount Price</label>
                    <input type="text" name="discount_price" class="form-control" id="discount_price">
                </div>
                <div class="form-group col-md-3">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="text" name="duration" class="form-control" id="duration">
                </div>
                <div class="form-group col-md-3">
                    <label for="resources" class="form-label">Resources</label>
                    <input type="text" name="resources" class="form-control" id="resources">
                </div>
                <div class="form-group col-md-12">
                    <label for="prerequisites" class="form-label">Prerequisites</label>
                    <textarea class="form-control" name="prerequisites" id="prerequisites" ></textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="tinyEditor" ></textarea>
                </div>

                <p>Course Goals</p>
                <div class="row add_item">
                    <div class="col-md-6">
                        <div class="mb-3">
                                <label for="goals" class="form-label"> Goals </label>
                                <input type="text" name="goals[]" id="goals" class="form-control" placeholder="Goals ">
                        </div>
                    </div>
                    <div class="form-group col-md-6" style="padding-top: 30px;">
                        <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                    </div>
                </div>
                <div style="visibility: hidden">
                    <div class="whole_extra_item_add" id="whole_extra_item_add">
                       <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                          <div class="container mt-2">
                             <div class="row">


                                <div class="form-group col-md-6">
                                   <label for="goals">Goals</label>
                                   <input type="text" name="goals[]" id="goals" class="form-control" placeholder="Goals  ">
                                </div>
                                <div class="form-group col-md-6" style="padding-top: 20px">
                                   <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                                   <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="best_seller" value="1" id="flexCheckDefault">
                            <label for="flexCheckDefault" class="form-check-label">Best Seller</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="featured" value="1" id="flexCheckDefault">
                            <label for="flexCheckDefault" class="form-check-label">Featured</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="highest_rated" value="1" id="flexCheckDefault">
                            <label for="flexCheckDefault" class="form-check-label">Highest Rated</label>
                        </div>
                    </div>
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

@section('blade-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#createCategory').validate({
                rules: {
                    name: {
                        required: true
                    },
                    title: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter course name"
                    },
                    title: {
                        required: "Please enter course title"
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });

            $('select[name="category_id"]').on('change', function(){
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/"+category_id,
                        type: "GET",
                        dataType:"json",
                        success:function(data){
                            $('select[name="subcategory_id"]').html('');
                            var d =$('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
                            });
                        },

                    });
                } else {
                    //alert('danger');
                }
            });

            var counter = 0;
            $(document).on("click",".addeventmore",function(){
                    var whole_extra_item_add = $("#whole_extra_item_add").html();
                    $(this).closest(".add_item").append(whole_extra_item_add);
                    counter++;
            });
            $(document).on("click",".removeeventmore",function(event){
                    $(this).closest("#whole_extra_item_delete").remove();
                    counter -= 1
            });
        });
    </script>
@endsection
