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
                                <ul class="list-group">
                                    @forelse ($verificationCodes as $verificationCode)
                                        <div class="list-group-item mb-2">
                                            <h5 class="d-flex justify-content-between"> {{ $verificationCode->name }} <div
                                                    class="dropdown open">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown">
                                                        <i class="fa fa-cog" aria-hidden="true"></i> Actions
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.verification.code.edit', $verificationCode->uuid) }}">Edit
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.verification.code.delete', $verificationCode->uuid) }}"
                                                            onclick="return confirm('Are you sure?')">Delete
                                                            code</a>
                                                    </div>
                                                </div>
                                            </h5>
                                            <p>Applicable for:
                                                @if ($verificationCode->applicable_to == 'All')
                                                    {{ $verificationCode->applicable_to }} users
                                                @else
                                                    {{ @$verificationCode->user->first_name . ' ' . @$verificationCode->user->last_name }}
                                                @endif
                                            </p>
                                            <small>Nature : {{ $verificationCode->length }} <span
                                                    class="text-capitalize">{{ $verificationCode->nature_of_code }}</span>
                                                code</small>
                                            <span
                                                class="badge badge-primary float-right">{{ $verificationCode->created_at }}</span>

                                        </div>
                                    @empty
                                        <div class="alert alert-warning">No verification code registered</div>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <form action="{{ route('admin.verification.code.store') }}" class="row" method="POST">
                                    @csrf
                                    <div class="col-xs-12 col-md-12">
                                        @include('partials.validation_message')
                                        <h4>New verification code</h4>
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <input type="text" name="description" class="form-control" value="">
                                            <small>What this code is all about</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Length</label>
                                            <input type="number" name="length" value="7" class="form-control">
                                            <small>How long do you want this code to be when generated?</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nature of code</label>
                                            <select name="nature_of_code" class="form-control">
                                                <option value="alnum">Alphanumeric</option>
                                                <option value="numeric">Numeric</option>
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
                                                <option value="All">ALL USERS</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->first_name . ' ' . $user->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm" type="submit">
                                                SAVE
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
        </div>
    </div>
@endsection
