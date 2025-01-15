@extends('dashboard.admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header d-none d-md-block d-lg-block">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h4 class="page-title">{{ config('app.email') }}</h4>
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
            </div>
            <!-- Main content -->
            <section class="content">
                <!-- Basic Card Example -->
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        @include('partials.validation_message')
                        <div class="card shadow mb-4 border-left-danger">
                            <div class="card-header d-flex justify-content-between">
                                <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <dl class="row">
                                            <dt class="col-sm-4">Name:</dt>
                                            <dd class="col-sm-8">{{ $master->name }}</dd>
                                            <dt class="col-sm-4">Email:</dt>
                                            <dd class="col-sm-8">{{ $master->email }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modal-fill">
                                    EDIT PROFILE
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" data-backdrop="false" id="modal-fill" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Account Information</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('master.profile.update', $master->uuid) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" id="name"
                                                            class="form-control" value="{{ $master->name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="text" name="email" id="email"
                                                            class="form-control" value="{{ $master->email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="text" name="password" id="password"
                                                            class="form-control">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                                        Update Account
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
