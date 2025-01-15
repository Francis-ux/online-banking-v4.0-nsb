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
                            <div class="card-header py-3 d-flex justify-content-between">
                                <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>
                                @include('dashboard.admin.users.partials.account_option_and_status')
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-7">
                                    <div class="card-body scroll-card-body">
                                        <?php if (empty($deposits)) : ?>
                                        <div class="alert alert-warning">No deposit record yet</div>
                                        <?php else : ?>
                                        <div class="list-group">
                                            <?php foreach ($deposits as $deposit) : ?>
                                            <a href="{{ route('admin.users.deposit.show', [$user->uuid, $deposit->uuid]) }}"
                                                class="list-group-item list-group-item-action list-group-item-<?= $deposit->status == 1 ? 'success' : 'danger' ?>">
                                                <dl class="row">
                                                    <dt class="col-sm-4 m-0">Date:</dt>
                                                    <dd class="col-sm-8 m-0"><i class="fa fa-calendar"
                                                            aria-hidden="true"></i>
                                                        <?= date('dS M Y', strtotime($deposit->date)) ?>
                                                    </dd>
                                                    <dt class="col-sm-4 m-0">Amount:</dt>
                                                    <dd class="col-sm-8 m-0">
                                                        <?= currency($user->currency) . formatAmount($deposit->amount) ?>
                                                        <?= $deposit->currency ?></dd>
                                                    <dt class="col-sm-4 m-0">Status:
                                                    </dt>
                                                    <dd class="col-sm-8 m-0">
                                                        <?= $deposit->status == 1 ? 'CONFIRMED' : 'PENDING' ?>
                                                    </dd>
                                                    <dt class="col-sm-4 m-0">Transaction ID:
                                                    </dt>
                                                    <dd class="col-sm-8 m-0"><?= $deposit->reference_id ?></dd>
                                                </dl>
                                            </a>
                                            <div class="btn-group mb-1">
                                                <?php if ($deposit->status != 1) : ?>
                                                <a href="{{ route('admin.users.deposit.confirm', [$user->uuid, $deposit->uuid]) }}"
                                                    class="btn text-white btn-info btn-sm"
                                                    title="Click to confirm transaction">CONFIRM
                                                    <i class="fa fa-envelope" aria-hidden="true"></i> </a>
                                                <?php endif; ?>
                                                <a onclick="return confirm('Are you sure?')" href="{{ route('admin.users.deposit.delete', [$user->uuid, $deposit->uuid]) }}"
                                                    title="Click to delete transaction"
                                                    class="btn text-white btn-danger btn-sm">DELETE
                                                    <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer">

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5">
                                    @include('dashboard.admin.users.partials.personal_account_details')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        @endsection
