@extends('dashboard.admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header d-none d-md-block d-lg-block">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h4 class="page-title">{{ $admin->email }}</h4>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"
                                                aria-hidden="true"></i></a></li>
                                    <li class="breadcrumb-item" aria-current="page">{{ $title }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div> <!-- Main content -->
            <section class="content">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Registered codes</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-8">
                                <h4>Edit verification code information</h4>
                                <dl class="row">
                                    <dt class="col-sm-3">Name of code:</dt>
                                    <dd class="col-sm-9"><?= $verificationCode->name ?></dd>
                                    <dt class="col-sm-3">Description:</dt>
                                    <dd class="col-sm-9"><?= $verificationCode->description ?></dd>
                                    <dt class="col-sm-3">Length of code:</dt>
                                    <dd class="col-sm-9"><?= $verificationCode->length ?></dd>
                                    <dt class="col-sm-3">Nature:</dt>
                                    <dd class="col-sm-9 text-capitalize">
                                        <?= $verificationCode->nature_of_code ?> characters</dd>
                                    <dt class="col-sm-3">Date added:</dt>
                                    <dd class="col-sm-9">
                                        <?= date('dS M,Y H:i:s', strtotime($verificationCode->created_at)) ?></dd>
                                    <dt class="col-sm-3">Last updated:</dt>
                                    <dd class="col-sm-9">
                                        <?= date('dS M,Y H:i:s', strtotime($verificationCode->updated_at)) ?></dd>
                                </dl>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <form action="{{ route('admin.verification.code.update', $verificationCode->uuid) }}"
                                    class="row" method="POST">
                                    @csrf
                                    <div class="col-xs-12 col-md-12">
                                        @include('partials.validation_message')
                                        <h4>Edit verification code</h4>
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ $verificationCode->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <input type="text" name="description" class="form-control"
                                                value="{{ $verificationCode->description }}">
                                            <small>What this code is all about</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Length</label>
                                            <input type="number" name="length" value="{{ $verificationCode->length }}"
                                                class="form-control">
                                            <small>How long do you want this code to be when generated?</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nature of code</label>
                                            <select name="nature_of_code" class="form-control">
                                                <option value="alnum"
                                                    {{ $verificationCode->nature_of_code == 'alnum' ? 'selected' : '' }}>
                                                    Alphanumeric</option>
                                                <option value="numeric"
                                                    {{ $verificationCode->nature_of_code == 'numeric' ? 'selected' : '' }}>
                                                    Numeric</option>
                                            </select>
                                            <small>Do you want this code to be a mixture of letters and
                                                numbers(alpha-numeric)?
                                                or
                                                just
                                                numbers(numeric)</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Applicable to user</label>
                                            <select name="applicable_to" class="form-control">
                                                <option {{ $verificationCode->applicable_to == 'All' ? 'selected' : '' }}
                                                    value="All">
                                                    ALL USERS</option>
                                                @foreach ($users as $user)
                                                    <option
                                                        {{ $verificationCode->applicable_to == $user->id ? 'selected' : '' }}
                                                        value="{{ $user->id }}">
                                                        {{ $user->first_name . ' ' . $user->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm" type="submit">
                                                UPDATE
                                            </button>
                                            <button class="btn btn-warning btn-sm" type="reset">
                                                RESET
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        @endsection
