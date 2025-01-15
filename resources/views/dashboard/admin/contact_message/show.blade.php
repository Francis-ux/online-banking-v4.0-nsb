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
                @if (empty($contactMessage))
                    <div class="alert alert-warning" role="alert">
                        <strong>No messages have been sent</strong>
                    </div>
                @else
                    <div class="row">
                        <div class="col-sm-12 col-md-12 pb-3">
                            <dl class="row text-black">
                                <dt class="col-sm-3">Name:</dt>
                                <dd class="col-sm-9">{{ $contactMessage->name }}</dd>
                                <dt class="col-sm-3">Email:</dt>
                                <dd class="col-sm-9">{{ $contactMessage->email }}</dd>
                                <dt class="col-sm-3">Subject</dt>
                                <dd class="col-sm-9">{{ $contactMessage->subject }}</dd>
                                <dt class="col-sm-3">Message</dt>
                                <dd class="col-sm-9">{{ $contactMessage->message }}</dd>
                                <dt class="col-sm-3">Submitted</dt>
                                <dd class="col-sm-9">{{ $contactMessage->created_at }}</dd>
                            </dl>
                            <a href="{{ route('admin.contact.message.delete', $contactMessage->uuid) }}"> <button
                                    class="btn btn-sm btn-primary" type="button">DELETE</button></a>
                        </div>
                    </div>
                @endif
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
