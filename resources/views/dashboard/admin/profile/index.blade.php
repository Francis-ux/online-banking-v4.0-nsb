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
                                            <dd class="col-sm-8">{{ $admin->name }}</dd>
                                            <dt class="col-sm-4">Email:</dt>
                                            <dd class="col-sm-8">{{ $admin->email }}</dd>
                                            <dt class="col-sm-4">Registration Token:</dt>
                                            <dd class="col-sm-8">{{ $admin->registration_token }}</dd>
                                            <dt class="col-sm-4">Phone:</dt>
                                            <dd class="col-sm-8"><span
                                                    class="text-danger">{{ $admin->dial_code }}</span>{{ $admin->phone }}
                                            </dd>
                                            <dt class="col-sm-4">Address:</dt>
                                            <dd class="col-sm-8">{{ $admin->address }}</dd>
                                            <dt class="col-sm-4">BTC Address:</dt>
                                            <dd class="col-sm-8">{{ $admin->btc_address }}</dd>
                                            <dt class="col-sm-4">Live Chat Id:</dt>
                                            <dd class="col-sm-8">{{ $admin->live_chat_id }}</dd>
                                            <dt class="col-sm-4">BTC QR Code:</dt>

                                            <dd class="col-sm-8">
                                                <img src="{{ asset('uploads/admin/bitcoin_qr_code/' . $admin->btc_qr_code) }}"
                                                    alt="BTC QR Code" style="width: 100px; height: 100px;">
                                            </dd>
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
                                                <form action="{{ route('admin.profile.update', $admin->uuid) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <div class="mb-3 mb-sm-0">
                                                            <label for="btc_address">BTC Address</label>
                                                            <input type="text" name="btc_address"
                                                                value="{{ $admin->btc_address }}"
                                                                class="form-control bg-light border-0 small"
                                                                placeholder="BTC Address">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="mb-3 mb-sm-0">
                                                            <label for="btc_qr_code">BTC QR Code</label>
                                                            <input type="file" name="btc_qr_code"
                                                                class="form-control bg-light border-0 small"
                                                                placeholder="Upload BTC QR Code">
                                                        </div>
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
