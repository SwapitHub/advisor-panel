@extends('layouts.userapp')
@section('content')
    <div class="row">
        <div class="col-md-10 p-0 mx-auto">
            <div class="card tab2-card card-login">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="top-profile-tab" data-bs-toggle="tab" href="#top-profile"
                                role="tab" aria-controls="top-profile" aria-selected="true"><span
                                    class="icon-user me-2"></span>Advisory form</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-profile" role="tabpanel"
                            aria-labelledby="top-profile-tab">

                            <form action="{{ route('from.add') }}" method="POST" class="form-horizontal auth-form"
                                novalidate>
                                @csrf
                                <div class="form-group">
                                    <label for="email">Advisor Full Name</label>
                                    <input name="advisor_name" type="text"
                                        class="form-control @error('advisor_name') is-invalid @enderror" placeholder="Advisor Name"
                                        id="exampleInputEmail1" value="{{ old('advisor_name') }}">
                                    @error('advisor_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Designation">Designation</label>
                                    <input name="advoisor_designation" type="text" class="form-control" placeholder="Designation">
                                    @error('advoisor_designation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input name="date" type="date" class="form-control" placeholder="Date">
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Advisor Phone</label>
                                    <input name="advoisor_phone" type="number" class="form-control" placeholder="Phone no.">
                                    @error('advoisor_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="client_name">Client Full Name</label>
                                    <input name="client_name" type="text" class="form-control" placeholder="Client Name">
                                    @error('client_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="client_city">Client City/Town</label>
                                    <input name="client_city" type="text" class="form-control" placeholder="Client City/Town">
                                    @error('client_city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="client_email">Client Email</label>
                                    <input name="client_email" type="email" class="form-control" placeholder="Client Email">
                                    @error('client_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-button">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
