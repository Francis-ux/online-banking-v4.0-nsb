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
                @include('partials.validation_message')
                <!-- Basic Card Example -->
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="card shadow mb-4 border-bottom-success">
                            <div class="card-header py-3 d-flex justify-content-between">
                                @include('dashboard.user.partials.balance_and_currency')

                                @include('dashboard.user.partials.menu')
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-8">
                                                <form action="{{ route('user.account.statement.store') }}" method="post">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="from">Start</label>
                                                            <input type="date" name="from" id="from"
                                                                class="form-control">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="to">End</label>
                                                            <input type="date" name="to" id="to"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                @include('dashboard.user.partials.personal_account_details')
                                            </div>
                                        </div>
                                    </div>

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
