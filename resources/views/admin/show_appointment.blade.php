<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>
<div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
            <div class="card-body card-body-padding d-flex align-items-center justify-content-between">

                <div class="d-flex align-items-center justify-content-between">
                    <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
                    <button id="bannerClose" class="btn border-0 p-0">
                        <i class="mdi mdi-close text-white me-0"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    <!-- partial:partials/navbar.html -->
    @include('admin.navbar')

    <div class="container mt-10 d-flex justify-content-start">
        <div class="w-100 mt-70">
            @if(session('success'))
                <div class="alert alert-success mt-7">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <span class="ml-2">{{ session('success') }}</span>
                </div>
            @endif

            <table class="table table-sm mt-5 text-white">
                <thead>
                <tr>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Message</th>
                    <th scope="col">Status</th>
                    <th scope="col">Approved</th>
                    <th scope="col">Canceled</th>
                    <th scope="col">Send Email</th>
                </tr>
                </thead>
                <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->name }}</td>
                        <td>{{ $appointment->email }}</td>
                        <td>{{ $appointment->phone }}</td>
                        <td>{{ $appointment->doctor }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->message }}</td>
                        <td>{{ $appointment->status }}</td>
                        <td>
                            <form action="{{ route('admin.approveAppointment', $appointment->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.cancelAppointment', $appointment->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger">Cancel</button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.emailUsers', $appointment->id) }}" class="btn btn-primary">Send Email</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
<!-- page-body-wrapper ends -->
</div>
@include('admin.script')
<!-- End custom js for this page -->
</body>
</html>
