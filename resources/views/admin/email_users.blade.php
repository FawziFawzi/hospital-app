<!DOCTYPE html>
<html lang="en">
<head>

    <base href="/public">
    @include('admin.css')
</head>
<body>
<div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">

        </div>
    </div>
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
                    <h1 class="text-center">Send Email</h1>
                    <form action="{{ route('admin.sendEmailUsers', $appointment->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Greeting</label>
                            <input type="text" name="greeting" class="form-control" id="greeting"   placeholder="greeting" value="{{old('greeting')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Body</label>
                            <input type="text" name="body" class="form-control" id="body"  placeholder="body" value="{{old('body')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="room">Action Text</label>
                            <input type="text" name="actiontext" class="form-control" id="actiontext"  placeholder="actiontext" value="{{old('actiontext')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="room">Action Url</label>
                            <input type="text" name="actionurl" class="form-control" id="actionurl"  placeholder="actionurl" value="{{old('actionurl')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="room">End Part</label>
                            <input type="text" name="endpart" class="form-control" id="endpart"  placeholder="endpart" value="{{old('endpart')}}" required>
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
