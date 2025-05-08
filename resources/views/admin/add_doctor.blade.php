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
                <div class="ps-lg-1">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                        <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
                    </div>
                </div>
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

    <div class="container-fluid page-body-wrapper">
        <div class="container">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                   <span class="ml-2"> {{session()->get('message')}} </span>
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
                    <h1 class="text-center">Add Doctor</h1>
                    <form action="{{route('admin.store-doctor')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Doctor Name</label>
                            <input type="text" name="name" class="form-control" id="name"   placeholder="Enter Doctor Name" value="{{old('name')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" class="form-control" id="phone"  placeholder="Enter Doctor Phone Number" value="{{old('phone')}}" required>
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
                            <input type="text" name="room" class="form-control" id="room"  placeholder="Enter The Room Number" value="{{old('room')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-label">Doctor Image</label>
                            <input type="file" name="image" class="form-control" id="image" value="{{old('image')}}" required>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-lg btn-success" type="submit">Submit form</button>
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
