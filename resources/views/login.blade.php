@extends('layouts.userapp')
@section('content')
    <div class="row">
        <div class="col-md-7 p-0 mx-auto">
            <div class="card tab2-card card-login">
                <div class="card-body">


                    @if (!empty(Auth::user()->name))
                        Hello {{ Auth::user()->name }}, You are successfully logged in!
                        <button class="btn btn-primary">Advisory form</button>
                        <a href="{{ route('user.logout') }}" class="btn btn-primary">Logout</a>
                    @else
                        <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="top-profile-tab" data-bs-toggle="tab" href="#top-profile"
                                    role="tab" aria-controls="top-profile" aria-selected="true"><span
                                        class="icon-user me-2"></span>Login</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-profile" role="tabpanel"
                                aria-labelledby="top-profile-tab">

                                <form action="{{ route('user.auth') }}" method="POST" class="form-horizontal auth-form"
                                    novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <input name="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" placeholder="Username"
                                            id="exampleInputEmail1" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-button">
                                        <button class="btn btn-primary" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection
