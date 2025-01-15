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
                    <div class="col">
                        @include('partials.validation_message')
                        <div class="card">
                            <div class="card-header">
                                Update admin information
                            </div>
                            <div class="card-body">
                                <form action="{{ route('master.admin.update', $admin->uuid) }}" method="POST"
                                    class="user">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <input type="name" required name="name" value="<?= $admin->name ?>"
                                                class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <input type="email" required name="email" value="<?= $admin->email ?>"
                                                class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" name="registration_token"
                                                value="<?= $admin->registration_token ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <input type="text" name="password" class="form-control"
                                                placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label>Dial code</label>
                                            <select name="dial_code" required id="dial_code" class="form-control">
                                                <option value="">Select</option>
                                                @foreach (config('setting.dial_code') as $key => $dialCode)
                                                    <option value="+{{ $key }}"
                                                        {{ $admin->dial_code == '+' . $key ? 'selected' : '' }}>
                                                        {{ $dialCode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Phone</label>
                                            <input type="number" name="phone" value="<?= $admin->phone ?>"
                                                class="form-control" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" placeholder="Your contact address"
                                            value="<?= $admin->address ?>" name="address" class="form-control">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label>SMTP User</label>
                                            <input type="text" placeholder="SMTP User" value="<?= $admin->smtp_user ?>"
                                                name="smtp_user" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label>SMTP Password</label>
                                            <input type="text" placeholder="SMTP Password"
                                                value="<?= $admin->smtp_password ?>" name="smtp_password"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label>SMTP Host</label>
                                            <input type="text" placeholder="SMTP Host" value="<?= $admin->smtp_host ?>"
                                                name="smtp_host" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label>SMTP Port</label>
                                            <input type="text" placeholder="SMTP Port" value="<?= $admin->smtp_port ?>"
                                                name="smtp_port" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>SMTP Encryption</label>
                                        <select name="smtp_encryption" id="smtp_encryption" class="form-control">
                                            <option value="">Select</option>
                                            <option value="tls" {{ $admin->smtp_encryption == 'tls' ? 'selected' : '' }}>
                                                TLS</option>
                                            <option value="ssl" {{ $admin->smtp_encryption == 'ssl' ? 'selected' : '' }}>
                                                SSL</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">Select</option>
                                            <option value="1" {{ $admin->status == 1 ? 'selected' : '' }}>ACTIVE
                                            </option>
                                            <option value="0" {{ $admin->status == 0 ? 'selected' : '' }}>INACTIVE
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Live Chat</label>
                                        <textarea name="live_chat" class="form-control" id="live_chat" cols="50" rows="30"
                                            placeholder="Paste live chat script here">
                                      <?= $admin->live_chat ?>
                                      </textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Update account
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
