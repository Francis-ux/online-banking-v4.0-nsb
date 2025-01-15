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
                        <div class="shadow mb-4 border-bottom-success">
                            <div class="card-header py-3 d-flex justify-content-between">
                                @include('dashboard.user.partials.balance_and_currency')

                                @include('dashboard.user.partials.menu')
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-7">
                                    @forelse ($notifications as $notification)
                                        <div class="card-body scroll-card-body">
                                            <div class="list-group">
                                                <a href="#"
                                                    class="list-group-item list-group-item-action list-group-item-info">
                                                    <p class="m-0 p-0">{{ $notification->type }}</p>
                                                    <small>{{ $notification->notification }}</small>
                                                    <small class="float-right">
                                                        Date: {{ date('dS M,Y', strtotime($notification->created_at)) }}
                                                    </small>
                                                    <br>
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="card-body scroll-card-body">
                                            <div class="alert alert-warning" role="alert">
                                                <strong>No notifications yet</strong>
                                            </div>
                                        </div>
                                    @endforelse
                                    <div class="card-footer">
                                        <h5>Total: {{ $notifications->count() }}</h5>
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
