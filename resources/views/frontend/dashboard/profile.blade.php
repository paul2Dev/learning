@extends('frontend.dashboard.layout')
@section('content')
    @include('frontend.dashboard.partials.user_details')

    <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
        <div class="setting-body">
            <h3 class="fs-17 font-weight-semi-bold pb-4">Edit Profile</h3>
            <form method="post" action="{{ route('user.profile.store') }}" class="row pt-40px" enctype="multipart/form-data">
                @csrf
                <div class="media media-card align-items-center">
                    <div class="media-img media-img-lg mr-4 bg-gray">
                        <img class="mr-3" src="{{ (!empty($profile->photo)) ? url('upload/user_images/'.$profile->photo) : url('upload/no_image.jpg') }}" alt="avatar image">
                    </div>
                    <div class="media-body">
                        <div class="file-upload-wrap file-upload-wrap-2">
                            <input type="file" name="photo" class="multi file-upload-input with-preview" multiple>
                            <span class="file-upload-text"><i class="la la-photo mr-2"></i>Upload a Photo</span>
                        </div><!-- file-upload-wrap -->
                        <p class="fs-14">Max file size is 5MB, Minimum dimension: 200x200 And Suitable files are .jpg & .png</p>
                    </div>
                </div><!-- end media -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Name</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="name" value="{{ $profile->name }}">
                        <span class="la la-user input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Username</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="username" value="{{ $profile->username }}">
                        <span class="la la-user input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Email Address</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="email" name="email" value="{{ $profile->email }}">
                        <span class="la la-envelope input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Phone Number</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="phone" value="{{ $profile->phone }}">
                        <span class="la la-phone input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Address</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="address" value="{{ $profile->address }}">
                        <span class="la la-home input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-12 py-2">
                    <button type="submit" class="btn theme-btn">Save Changes</button>
                </div><!-- end input-box -->
            </form>
        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->
@endsection
