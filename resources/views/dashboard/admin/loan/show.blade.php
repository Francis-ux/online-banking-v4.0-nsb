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
                <div class="row">
                    <div class="col-sm-12 col-md-12 pb-3">
                        <dl class="row text-black">
                            <dt class="col-sm-3">Name:</dt>
                            <dd class="col-sm-9"><?= $loan->name ?></dd>
                            <dt class="col-sm-3">Phone</dt>
                            <dd class="col-sm-9"><?= $loan->phone ?></dd>
                            <dt class="col-sm-3">Email</dt>
                            <dd class="col-sm-9"><?= $loan->email ?></dd>
                            <dt class="col-sm-3">Address</dt>
                            <dd class="col-sm-9"><?= $loan->address ?></dd>
                            <dt class="col-sm-3">Loan type</dt>
                            <dd class="col-sm-9"><?= $loan->type ?> </dd>
                            <dt class="col-sm-3">Occupation</dt>
                            <dd class="col-sm-9"><?= $loan->occupation ?></dd>
                            <dt class="col-sm-3">Annual income</dt>
                            <dd class="col-sm-9"><?= $loan->income ?></dd>
                            <dt class="col-sm-3">Reason</dt>
                            <dd class="col-sm-9"><?= $loan->reason ?></dd>
                            <dt class="col-sm-3">Status</dt>
                            <dd class="col-sm-9"><?= $loan->status == 0 ? 'Pending' : 'Approved' ?></dd>
                            <dt class="col-sm-3">Submitted</dt>
                            <dd class="col-sm-9"><?= $loan->created_at ?></dd>
                        </dl>
                        <a href="{{ route('admin.loan.delete', $loan->uuid) }}"> <button class="btn btn-sm btn-primary" type="button">DELETE</button></a>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
