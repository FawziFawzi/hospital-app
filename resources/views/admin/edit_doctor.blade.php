<!DOCTYPE html>
<html lang="en">
<head>

    <base href="/public">

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
            @if(session()->has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                   <span class="ml-2"> {{session()->get('success')}} </span>
                </div>
            @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


            <div class="row mt-5 justify-content-center">
                <div class="col-md-8">
                    <h1 class="text-center">Edit Doctor</h1>
                    <form action="{{route('admin.updateDoctors', $doctor->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Doctor Name</label>
                            <input type="text" name="name" class="form-control" id="name"   placeholder="Enter Doctor Name" value="{{ $doctor->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" class="form-control" id="phone"  placeholder="Enter Doctor Phone Number" value="{{ $doctor->phone }}" required>
                        </div>
                        <div class="form-group">
                            <label for="speciality">Speciality</label>
                            <select name="speciality" id="speciality" class="form-select" style="width: 100%; height:36px;">
                                <option selected>--Select--</option>
                                <option value="skin">Skin</option>
                                <option value="eye">Eye</option>
                                <option value="heart">Heart</option>
                                <option value="nose">Nose</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="room">Room Number</label>
                            <input type="text" name="room" class="form-control" id="room"  placeholder="Enter The Room Number" value="{{ $doctor->room }}" required>
                        </div>
                    <div class="col-2" style="margin-top: 20px" >
                        <h1>Old Image</h1>
                        <img src="{{ asset('/doctor_image/' . $doctor->image) }}" alt="" srcset="">
                    </div>
                        <div class="form-group">
                            <label for="image" class="form-label">Change Image</label>
                            <input type="file" name="image" class="form-control" id="image" value="{{old('image')}}" >
                        </div>
                        <div class="col-12">
                            <button class="btn btn-lg btn-success" type="submit">Update Doctor Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
@include('admin.script')
<!-- End custom js for this page -->
</body>
</html>
