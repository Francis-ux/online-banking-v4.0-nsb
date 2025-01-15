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
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="card shadow mb-4 border-bottom-success">
                            <h4 class="card-header">Deposit information</h4>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-7">
                                                        <?php if ($deposit->method == "Card") : ?>
                                                        <h4>Card transaction</h4>
                                                        <dl class="row">
                                                            <dt class="col-sm-3">Card number:</dt>
                                                            <dd class="col-sm-9"><?= $deposit->card_number ?></dd>
                                                            <dt class="col-sm-3">Card CVV</dt>
                                                            <dd class="col-sm-9"><?= $deposit->cvv ?></dd>
                                                            <dt class="col-sm-3">Expiry date</dt>
                                                            <dd class="col-sm-9"><?= $deposit->card_expiry_date ?></dd>
                                                        </dl>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-sm-12 col-md-5">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12">
                                                <img src="/uploads/users/deposit/<?= $deposit->proof ?>" alt=""
                                                    srcset="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer" style="overflow: hidden;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        @endsection
