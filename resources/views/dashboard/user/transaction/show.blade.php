@extends('dashboard.user.layouts.master')
@section('content')
    <div class="content-wrapper" style="min-height: 697px;">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header d-none d-md-block d-lg-block">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h4 class="page-title">My account</h4>
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
                <!-- Basic Card Example -->
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="shadow mb-4 border-bottom-success">
                            <div class="card-header py-3 d-flex justify-content-between">
                                @include('dashboard.user.partials.balance_and_currency')

                                @include('dashboard.user.partials.menu')
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-7">
                                    <div class="card-header">
                                        <h4>Transaction details</h4>
                                        <p>Transaction information</p>
                                    </div>
                                    <div class="card-body">
                                        <span class="badge badge-info float-right"><?= $transaction->type ?></span>
                                        <h5 class="m-0 p-0"><span
                                                class="text-primary"><?= currency($user->currency) . formatAmount($transaction->amount) ?></span>
                                            <small><?= currency($user->currency, 'name') ?></small>
                                        </h5>
                                        <p class="m-0 p-0"><?= $transaction->description ?></p>
                                        <small class="float-right">
                                            Date: <?= date('dS M,Y', strtotime($transaction->date)) ?> </small>
                                        <h5>Beneficiary information's</h5>
                                        @if (!empty($transfer))
                                            @if ($transfer->type == 'Electronic Transfer')
                                                <dl class="row">
                                                    <dt class="col-sm-3">{{ $transfer->withdrawal_method }}:</dt>
                                                    <dd class="col-sm-9">{{ $transfer->beneficiary }}</dd>
                                                </dl>
                                            @else
                                                <dl class="row">
                                                    <dt class="col-sm-3">Bank name:</dt>
                                                    <dd class="col-sm-9">{{ $transfer->bank_name }}</dd>
                                                    <dt class="col-sm-3">Account name:</dt>
                                                    <dd class="col-sm-9">{{ $transfer->account_name }}</dd>
                                                    <dt class="col-sm-3">Account number:</dt>
                                                    <dd class="col-sm-9">{{ $transfer->account_number }}</dd>
                                                </dl>
                                            @endif
                                        @else
                                            <dl class="row">
                                                <dt class="col-sm-3">Bank name:</dt>
                                                <dd class="col-sm-9">{{ config('app.name') }}</dd>
                                                <dt class="col-sm-3">Account name:</dt>
                                                <dd class="col-sm-9">{{ $user->first_name }} {{ $user->last_name }} </dd>
                                                <dt class="col-sm-3">Account number: </dt>
                                                <dd class="col-sm-9">{{ $user->account_number }}</dd>
                                                <dt class="col-sm-3"></dt>
                                                <dd class="col-sm-9"></dd>
                                            </dl>
                                        @endif
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('user.transaction.print', $transaction->uuid) }}"
                                                class="btn btn-sm btn-success" target="_blank">Print <i
                                                    class="fa fa-print"></i></a>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5">
                                    @include('dashboard.user.partials.personal_account_details')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
