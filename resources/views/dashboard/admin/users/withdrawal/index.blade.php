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
                                    <div class="card-body">
                                        <div class="list-group">
                                            @forelse ($transfers as $transfer)
                                                <a href="{{ route('admin.users.withdrawal.show', [$user->uuid, $transfer->reference_id]) }}"
                                                    class="list-group-item list-group-item-action list-group-item-secondary">
                                                    <p class="m-0 p-0"><?= $transfer->type ?></p>
                                                    <small>Amount:
                                                        <?= currency($user->currency) . formatAmount($transfer->amount) ?></small>
                                                    <small class="float-right">
                                                        Date: <?= date('dS M,Y', strtotime($transfer->created_at)) ?>
                                                    </small>
                                                </a>
                                                <div
                                                    class="mb-3 bg-primary d-flex justify-content-between p-1 text-white hide-sm">
                                                    <span>
                                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                        <?= $transfer->reference_id ?> </span>
                                                    <a href="{{ route('admin.users.withdrawal.delete', $transfer->id) }}"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">DELETE</a>
                                                </div>
                                            @empty
                                                <div class="alert alert-warning">No withdrawal yet</div>
                                            @endforelse
                                        </div>
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
