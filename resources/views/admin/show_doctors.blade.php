<!DOCTYPE html>
<html lang="en">
<head>


    @include('admin.css')
</head>
<body>
<div class="container-scroller">

    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    <!-- partial:partials/navbar.html -->
    @include('admin.navbar')

    <div class="container-fluid page-body-wrapper">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <span class="ml-2"> {{session('success')}} </span>
                </div>
            @endif


            <h1 class="mt-5">Doctors Data</h1>

            <table class="table table-sm  mt-5 text-white">
                <thead>
                <tr>

                    <th scope="col">Doctor Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Room</th>
                    <th scope="col">Speciality</th>
                    <th scope="col">Image</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>

                </tr>
                </thead>
                <tbody>
                @foreach($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->phone }}</td>
                        <td>{{ $doctor->room }}</td>
                        <td>{{ $doctor->speciality }}</td>
                        <td><img src="{{ asset('/doctor_image/' . $doctor->image) }}" alt="" srcset=""></td>
                        <td><a href="{{ route('admin.editDoctors', $doctor->id) }}" class="btn btn-warning">Edit</a></td>


                        <td>
                            <form action="{{ route('admin.editDoctors', $doctor->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this item?');"
                                >Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <!-- main-panel ends -->
        </div>
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->

@include('admin.script')
<!-- End custom js for this page -->
</body>
</html>
