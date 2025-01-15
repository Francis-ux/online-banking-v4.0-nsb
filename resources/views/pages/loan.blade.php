@extends('layouts.master')
@section('content')
    <!-- page-title -->
    <section class="page-title centred">
        <div class="bg-layer" style="background-image: url(/assets/images/background/page-title.jpg);"></div>
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url(/assets/images/shape/shape-18.png);"></div>
            <div class="pattern-2" style="background-image: url(/assets/images/shape/shape-17.png);"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <h1>{{ $title }}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="/">Home</a></li>
                    <li>{{ $title }}</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="pt_120 pb_120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('partials.validation_message')
                    @include('partials.sweet_alert')
                    <form action="{{ route('loan.store') }}" class="row" method="POST">
                        @csrf
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Full name</label>
                                <input type="text" required name="name" value="{{ old('name') }}"
                                    class="form-control" aria-describedby="emailHelp" placeholder="Enter Full name..."
                                    required />
                            </div>
                            <div class="form-group">
                                <label>Residential Address</label>
                                <input type="text" required name="address" value="{{ old('address') }}"
                                    class="form-control" aria-describedby="emailHelp"
                                    placeholder="Enter Residential Address..." required />
                            </div>
                            <div class="form-group">
                                <label>Phone number</label>
                                <input type="text" required name="phone" value="{{ old('phone') }}"
                                    class="form-control" aria-describedby="emailHelp" placeholder="Enter Phone number..." />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" required name="email" value="{{ old('email') }}"
                                    class="form-control" aria-describedby="emailHelp" placeholder="Enter Email..."
                                    required />
                            </div>
                            <div class="form-group">
                                <label>Occupation</label>
                                <input type="text" required name="occupation" value="{{ old('occupation') }}"
                                    class="form-control" aria-describedby="emailHelp" placeholder="Enter Occupation..."
                                    required />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Type of Loan</label> <br />
                                <select name="type" class="form-control w-100">
                                    <option value="Student loan">Student loan</option>
                                    <option value="Car loan">Car loan</option>
                                    <option value="Small Business Loan ">
                                        Small Business Loan
                                    </option>
                                    <option value="Micro Business loan">
                                        Micro Business loan
                                    </option>
                                    <option value="Large Business Loan">
                                        Large Business Loan
                                    </option>
                                    <option value="Housing loan">Housing loan</option>
                                    <option value="Insurance">Insurance</option>
                                </select>
                            </div>

                            <br /><br />
                            <div class="form-group">
                                <label>Reference ID</label> <br />
                                <input type="text" required name="reference_id" value="{{ old('reference_id') }}"
                                    class="form-control" aria-describedby="referenceIDHelp"
                                    placeholder="Enter reference id..." />
                                <small></small>
                            </div>

                            <div class="form-group">
                                <label>Annual Income Rate</label> <br />
                                <select name="income" class="form-control w-100" required>
                                    <option>0$ – $1000</option>
                                    <option>$1,000 – $9,000</option>
                                    <option>$10,000 – $49,000</option>
                                    <option>$50,000 – $99,000</option>
                                    <option>$100,000 – Above</option>
                                </select>
                            </div>

                            <br /><br />
                            <div class="form-group">
                                <label>Short Note of Loan Reason:
                                </label>
                                <textarea class="form-control" name="reason" rows="4" required>{{ old('reason') }}</textarea>
                            </div>

                        </div>
                        <div class="col-12 mt-5">
                            <button type="submit" class="btn btn-success btn-user btn-xs">
                                Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- page-title end -->
@endsection
