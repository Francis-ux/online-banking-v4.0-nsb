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
                    <div class="col-sm-12 col-md-4 offset-md-3">

                        <div class="card">
                            <div class="card-body">
                                @include('partials.validation_message')
                                <form action="{{ route('user.deposit.card.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <label for="">Amount:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <?= currency($user->currency) ?></div>
                                                <input type="number" value="<?= old('amount') ?>" class="form-control"
                                                    name="amount" placeholder="Amount">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="my-input">Card number</label>
                                                <input id="my-input" value="<?= old('card_number') ?>" name="card_number"
                                                    class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="my-input">CVV</label>
                                                <input id="my-input" value="<?= old('card_cvv') ?>" name="card_cvv"
                                                    class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="my-input">Expiry date</label>
                                                <input id="my-input" value="<?= old('card_date') ?>" name="card_date"
                                                    class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <button class="btn btn-success btn-sm" type="submit">
                                                    Continue
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
