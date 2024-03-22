<div class="card">
    <div class="card-body">
        <div class="d-flex flex-column align-items-center text-center">
            <img src="{{ (!empty($profile->photo)) ? url('upload/admin_images/'.$profile->photo) : url('upload/no_image.jpg') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
            <div class="mt-3">
                <h4>{{ $profile->name }}</h4>
                <p class="text-secondary mb-1">{{ $profile->username }}</p>
                <p class="text-muted font-size-sm">{{ $profile->email }}</p>
                <button class="btn btn-primary">Follow</button>
                <button class="btn btn-outline-primary">Message</button>
            </div>
        </div>
        <hr class="my-4" />
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                <span class="text-secondary">https://codervent.com</span>
            </li>
        </ul>
    </div>
</div>
