@extends('dashboard.master.layouts.master')
@section('content')
    <div class="content-wrapper" style="min-height: 697px;">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header d-none d-md-block d-lg-block">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h4 class="page-title">Master Dashboard</h4>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"
                                                aria-hidden="true"></i></a></li>
                                    <li class="breadcrumb-item" aria-current="page"><?= $title ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div> <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-2">
                        @include('partials.validation_message')
                        <div class="card">
                            <div class="card-body" style="padding: 50px;">

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Register Admin Account</h1>
                                </div>
                                <form action="{{ route('master.admin.store') }}" class="user" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="name" class="form-control" id="name" name="name"
                                            placeholder="Enter name">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email Address">
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="registration_token">Registration Token</label>
                                            <input type="text" class="form-control" id="registration_token"
                                                name="registration_token"
                                                placeholder="Enter a registration code for this admin">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="text" class="form-control" id="password" name="password"
                                            placeholder="Password">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="dial_code">Dial code</label>
                                            <select name="dial_code" id=""
                                                class="form-control bg-light border-1 small">
                                                <option value="">Select</option>
                                                @foreach (config('setting.dial_code') as $key => $dialCode)
                                                    <option value="+{{ $key }}"
                                                        {{ old('dial_code') == '+' . $key ? 'selected' : '' }}>
                                                        {{ $dialCode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Phone</label>
                                            <input type="number" name="phone" value="{{ old('phone') }}"
                                                class="form-control bg-light border-0 small" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" value="{{ old('address') }}"
                                            class="form-control bg-light border-0 small" placeholder="Address">
                                    </div>
                                    <input type="submit" class="btn btn-success btn-user btn-block"
                                        value="Register Account" id="admin_register">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
