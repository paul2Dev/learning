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
                    <li class="breadcrumb-item active" aria-current="page">All Instructors</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
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
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instructors as $instructor)
                        <tr>
                            <td>{{ $instructor->id }}</td>
                            <td>{{ $instructor->name }}</td>
                            <td>{{ $instructor->username }}</td>
                            <td>{{ $instructor->email }}</td>
                            <td>{{ $instructor->phone }}</td>
                            <td>
                                @if ($instructor->status == 1)
                                    <span class="btn btn-success">Active</span>
                                @else
                                    <span class="btn btn-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="form-check form-switch">
									<input class="form-check-input status-toggle" type="checkbox" id="flexSwitchCheckChecked" data-user-id="{{ $instructor->id }}" {{ $instructor->status ? 'checked' : '' }}>
									<label class="form-check-label" for="flexSwitchCheckChecked"></label>
								</div>
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

@section('blade-scripts')
    <script>
        $(document).ready(function() {
            $('.status-toggle').on('change', function() {
                let userId = $(this).data('user-id');
                let isChecked = $(this).is(':checked');

                console.log(userId, isChecked);

                $.ajax({
                    url: "{{ route('instructor.update.status') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        userId: userId,
                        isChecked: isChecked ? 1 : 0,
                    },
                    success: function(response) {
                            toastr.success(response.message);
                    },
                    error: function(response) {
                        toastr.error(response.message);
                    }
                });
            });
        });
    </script>
@endsection
