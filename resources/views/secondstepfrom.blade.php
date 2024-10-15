@extends('layouts.userapp')
@section('content')
    <div class="row">
        <div class="col-md-12 p-0 mx-auto">
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
                                    <h4>Select Options:</h4>
                                    @foreach ($options as $option)
                                        <input type="checkbox" id="{{ $option['value'] }}" name="insurance_options[]"
                                            value="{{ $option['value'] }}">
                                        <label for="{{ $option['value'] }}"
                                            class="text-capitalize">{{ $option['label'] }}</label> &ensp;
                                    @endforeach
                                </div>

                                <h4>Select Provinces:</h4>
                                <div class="form-group">
                                    <input type="checkbox" id="Ontario" name="Provinces[]" value="Ontario">
                                    <label for="Ontario">Ontario</label> &ensp;

                                    <input type="checkbox" id="New Brunswick" name="Provinces[]" value="New Brunswick">
                                    <label for="Ontario">New Brunswick</label> &ensp;

                                    <input type="checkbox" id="Quebec" name="Provinces[]" value="Quebec">
                                    <label for="Ontario">Quebec</label> &ensp;

                                    <input type="checkbox" id="British Columbia" name="Provinces[]"
                                        value="British Columbia">
                                    <label for="Ontario">British Columbia</label> &ensp;

                                    <input type="checkbox" id="Manitoba" name="Provinces[]" value="Manitoba">
                                    <label for="Ontario">Manitoba</label> &ensp;

                                    <input type="checkbox" id="Yukon" name="Provinces[]" value="Yukon">
                                    <label for="Ontario">Yukon</label> &ensp;

                                    <input type="checkbox" id="Alberta" name="Provinces[]" value="Alberta">
                                    <label for="Ontario">Alberta</label> &ensp;

                                    <input type="checkbox" id="Saskatchewan" name="Provinces[]" value="Saskatchewan">
                                    <label for="Ontario">Saskatchewan</label> &ensp;

                                    <input type="checkbox" id="Prince Edward Island" name="Provinces[]"
                                        value="Prince Edward Island">
                                    <label for="Ontario">Prince Edward Island</label> &ensp;

                                    <input type="checkbox" id="Nova Scotia" name="Provinces[]" value="Nova Scotia">
                                    <label for="Ontario">Nova Scotia</label> &ensp;

                                    <input type="checkbox" id="Newfoundland & Labrador" name="Provinces[]"
                                        value="Newfoundland & Labrador">
                                    <label for="Ontario">Newfoundland & Labrador</label> &ensp;

                                    <input type="checkbox" id="Northwest Territories" name="Provinces[]"
                                        value="Northwest Territories">
                                    <label for="Ontario">Northwest Territories</label> &ensp;

                                    <input type="checkbox" id="Nunavut" name="Provinces[]" value="Nunavut">
                                    <label for="Ontario">Nunavut</label> &ensp;
                                </div>

                                <h4>Product Services</h4>
                                <label for="">Life:</label> &ensp;
                                <div class="form-group">

                                    <input type="checkbox" id="intrested" name="product_services[]"
                                        value="I am Interested">
                                    <label for="intrested">I am Interested</label> &ensp;

                                    <input type="checkbox" id="I_Decline" name="product_services[]" value="I Decline">
                                    <label for="I_Decline">I Decline</label> &ensp;
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <h4>Critical Illness:</h4>
                                        <div class="form-group">

                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <h4>Disability:</h4>
                                    </div>
                                    <div class="col-4">
                                        <h4>Long Term Care:</h4>
                                    </div>
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
