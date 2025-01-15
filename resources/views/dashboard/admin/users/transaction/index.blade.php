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
                                        @forelse ($transactions as $transaction)
                                            <div class="list-group">
                                                <a href="#"
                                                    class="list-group-item list-group-item-action list-group-item-default">
                                                    <h5 class="m-0 p-0 d-flex justify-content-between">
                                                        @if ($transaction->type == 'CREDIT')
                                                            <span
                                                                class="text-success">{{ currency($user->currency) . formatAmount($transaction->amount) }}</span>
                                                        @elseif ($transaction->type == 'DEBIT')
                                                            <span
                                                                class="text-danger">{{ currency($user->currency) . formatAmount($transaction->amount) }}</span>
                                                        @endif
                                                        <small>{{ $transaction->currency }}</small>

                                                        @if ($transaction->type == 'CREDIT')
                                                            <span class="badge badge-success float-right">CREDIT</span>
                                                        @elseif($transaction->type == 'DEBIT')
                                                            <span class="badge badge-danger float-right">DEBIT</span>
                                                        @endif
                                                    </h5>
                                                    <p class="m-0 p-0">{{ $transaction->description }}</p>
                                                    <small>Balance:
                                                        {{ currency($user->currency) . formatAmount($transaction->current_balance) }}</small>
                                                    <small class="float-right">
                                                        Date:
                                                        {{ date('dS M, Y', strtotime($transaction->date)) }}
                                                    </small>
                                                </a>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.users.transaction.print', [$user->uuid, $transaction->uuid]) }}"
                                                        class="btn text-white btn-primary btn-sm" target="_blank">PRINT
                                                        <i class="fa fa-print" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('admin.users.transaction.delete', $transaction->uuid) }}"
                                                        onclick="return confirm('Are you sure?')"
                                                        class="btn text-white btn-danger btn-sm">DELETE <i
                                                            class="fa fa-trash" aria-hidden="true"></i> </a>
                                                </div>
                                                <hr>
                                            </div>
                                        @empty
                                            <div class="alert alert-warning" role="alert">
                                                <strong>No transactions yet</strong>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5">
                                    @include('partials.validation_message')
                                    @include('partials.email_message')
                                    <div class="card">

                                        <div class="card-header">
                                            <h5>Send Transaction</h5>
                                        </div>
                                        <div class="card-body">
                                            <dl class="row">
                                                <dt class="mt-0 mb-0 col-sm-4">Account name:</dt>
                                                <dd class="mt-0 mb-0 col-sm-8">
                                                    <?= $user->first_name . ' ' . $user->last_name ?></dd>
                                                <dt class="mt-0 mb-0 col-sm-4">Account balance:</dt>
                                                <dd class="mt-0 mb-0 col-sm-8">
                                                    <strong>{{ currency($user->currency) . formatAmount($user->balance) }}</strong>
                                                    -
                                                    {{ currency($user->currency, 'name') }}
                                                </dd>
                                            </dl>
                                            <small id="helpId" class="text-danger">Do not use: spaces or comma, use only
                                                numbers
                                                when
                                                entering amount</small>
                                            <form action="{{ route('admin.users.transaction.store', $user->uuid) }}"
                                                method="POST" class="row">
                                                @csrf
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Amount </label>
                                                        <input type="text" name="amount" id="" required=""
                                                            value="" class="form-control" placeholder=""
                                                            aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Type </label>
                                                        <select name="type" id="" class="form-control"
                                                            required="">
                                                            <option value=""></option>
                                                            <option value="DEBIT">DEBIT</option>
                                                            <option value="CREDIT">CREDIT</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Date</label>
                                                        <input type="date" name="date" id="" required=""
                                                            class="form-control" placeholder="" aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Notification </label>
                                                        <select name="notification" id="" class="form-control"
                                                            required="">
                                                            <option value=""></option>
                                                            <option value="NONE">NONE</option>
                                                            <option value="EMAIL">EMAIL</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Description</label>
                                                        <input type="text" name="description" required=""
                                                            id="" class="form-control" placeholder=""
                                                            aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        @endsection
