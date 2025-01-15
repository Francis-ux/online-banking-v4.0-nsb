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
                                    <div class="card-header mb-3">
                                        <h4>User transactions</h4>
                                        <p>Transaction history</p>
                                    </div>
                                    <div class="list-group">
                                        @forelse ($transactions as $transaction)
                                            <a href="{{ route('user.transaction.show',$transaction->uuid) }}"
                                                class="list-group-item list-group-item-action list-group-item-default">
                                                <span
                                                    class="badge {{ $transaction->type == 'CREDIT' ? 'badge-success' : 'badge-danger' }} float-right">{{ $transaction->type }}</span>
                                                <h5 class="m-0 p-0"><span
                                                        class="{{ $transaction->type == 'CREDIT' ? 'text-success' : 'text-danger' }}">{{ currency($user->currency) . formatAmount($transaction->amount) }}</span>
                                                    <small>{{ currency($user->currency, 'name') }}</small>
                                                </h5>
                                                <p class="m-0 p-0">{{ $transaction->description }}</p>
                                                <p class="text-primary">Balance:
                                                    {{ currency($user->currency) . formatAmount($transaction->current_balance) }}
                                                </p>
                                                <small class="float-right">
                                                    Date: {{ date('dS M, Y', strtotime($transaction->date)) }}
                                                </small>
                                            </a>
                                        @empty
                                            <div class="card-body scroll-card-body">
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>No transactions yet</strong>
                                                </div>
                                            </div>
                                        @endforelse

                                    </div>

                                    <div class="card-footer">
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
