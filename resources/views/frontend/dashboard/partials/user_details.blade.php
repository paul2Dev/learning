<div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
    <div class="media media-card align-items-center">
        <div class="media-img media--img media-img-md rounded-full">
            <img class="rounded-full" src="{{ (!empty(Auth::user()->photo)) ? url('upload/user_images/'.Auth::user()->photo) : url('upload/no_image.jpg') }}" alt="Student thumbnail image">
        </div>
        <div class="media-body">
            <h2 class="section__title fs-30">Howdy, {{ Auth::user()->name }}</h2>
        </div><!-- end media-body -->
    </div><!-- end media -->
</div><!-- end breadcrumb-content -->
