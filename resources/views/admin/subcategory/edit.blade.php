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
                    <li class="breadcrumb-item active" aria-current="page">Edit Subcategory</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <form class="row g-3" id="createSubCategory" action="{{ route('subcategory.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $subcategory->id }}">
                <div class="form-group col-md-6">
                    <label for="name" class="form-label">Select Category</label>
                    <select class="form-select mb-3" name="category_id" aria-label="Default select example">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ ($category->id == $subcategory->category_id ? 'selected' : '') }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6"></div>
                <div class="form-group col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $subcategory->name }}" placeholder="Subcategory Name">
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
            $('#createSubCategory').validate({
                rules: {
                    name: {
                        required: true
                    },
                    category_id: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: "Please enter subcategory name"
                    },
                    category_id: {
                        required: "Please enter category"
                    },
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
        });
    </script>
@endsection
