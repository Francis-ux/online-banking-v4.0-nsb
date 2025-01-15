@extends('dashboard.user.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Card Example -->
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="card shadow border-bottom-success">
                            <div class="card-header d-flex justify-content-between">
                                @include('dashboard.user.partials.balance_and_currency')

                                @include('dashboard.user.partials.menu')
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 ">
                                    @include('partials.email_message')
                                    <div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                                                <form action="{{ route('user.email.verification.store') }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="d-none d-lg-block col-lg-2 mt-5">
                                                            <i class="fa fa-4x fa-passport text-primary"
                                                                aria-hidden="true"></i>
                                                        </div>
                                                        <div class="col-sm-12 col-md-10">
                                                            <div class="card-body">
                                                                @include('partials.validation_message')
                                                                <h4 class="card-title">User email verification</h4>
                                                                <p class="card-text">Please enter the confirmation code sent
                                                                    via
                                                                    email, to
                                                                    complete your registration process</p>
                                                                <div class="form-group">
                                                                    <input type="text" name="code" value=""
                                                                        class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary"
                                                                        type="submit">Submit</button>
                                                                    <a href="{{ route('user.email.verification.resend') }}"><button
                                                                            type="button" class="btn btn-secondary"
                                                                            type="submit">Resend</button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
