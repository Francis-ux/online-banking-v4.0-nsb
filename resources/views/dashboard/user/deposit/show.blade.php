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
                                <div class="col-sm-12 col-md-12">
                                    @include('partials.validation_message')
                                    <div class="card-body">
                                        @if ($deposit->status == 1)
                                            <div class="col-sm-12 col-md-12">
                                                <div class="alert alert-success">
                                                    <h4>Deposit confirmed</h4>
                                                </div>
                                            </div>
                                        @elseif($deposit->status == 0)
                                            <div class="col-sm-12 col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="alert alert-primary" role="alert">
                                                            <h4 class="alert-heading">Processing...</h4>
                                                            Your deposit is processing, please wait...
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        @if ($deposit->proof == null)
                                                            <h4>Please confirm your deposit</h4>
                                                            <p>Upload a proof of deposit:</p>
                                                            <form
                                                                action="{{ route('user.deposit.upload.proof', $deposit->uuid) }}"
                                                                enctype="multipart/form-data" method="POST">
                                                                @csrf
                                                                <input required type="file" class="mb-2" name="proof"
                                                                    id="">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm">Submit</button>
                                                                <h6>Supported: <code>jpg, png, jpeg</code></h6>
                                                            </form>
                                                        @else
                                                            <img src="/uploads/users/deposit/<?= $deposit->proof ?>"
                                                                alt="" srcset="" width="auto">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
        </div>
    </div>
@endsection
