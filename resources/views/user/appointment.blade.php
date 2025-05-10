<div class="page-section">
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="text-center wow fadeInUp">Make an Appointment</h1>

        <form class="main-form" method="POST" action="{{ route('user.appointment') }}">
            @csrf
            <div class="row mt-5 ">
                <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                    <input name="name" type="text" class="form-control" placeholder="Full name" value="{{ old('name') }}" required>
                </div>
                <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                    <input name="email" type="text" class="form-control" placeholder="Email address.." value="{{ old('email') }}" required>
                </div>
                <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
                    <input name="date" type="date" class="form-control" value="{{ old('date') }}" required>
                </div>
                <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
                    <select name="doctor" id="doctor" class="custom-select">
                        <option selected disabled>Choose Your Doctor</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->name }}">
                            {{ $doctor->name }}--> ({{ $doctor->speciality }})</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                    <input name="phone" type="text" class="form-control" placeholder="Number.." value="{{ old('phone') }}" required>
                </div>
                <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                    <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.."  required></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Submit Request</button>
        </form>
    </div>

</div> <!-- .page-section -->
