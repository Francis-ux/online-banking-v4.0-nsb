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
                    <div class="col-sm-12 col-md-5">
                        @include('partials.validation_message')
                        <form action="{{ route('user.deposit.bitcoin.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    @if ($admin->btc_qr_code)
                                        <h3>Scan the QR code to make deposit</h3>
                                        <div class="col-12">
                                            <img src="/uploads/admin/bitcoin_qr_code/<?= $admin->btc_qr_code ?>"
                                                alt="Not available" srcset="" width="300">
                                        </div>
                                        <h1>OR</h1>
                                    @endif
                                    <h5>Copy bitcoin address to deposit: </h5>
                                    <div class="input-group">
                                        <div class="input-group-addon">BTC:</div>
                                        <input required type="text" id="btc_address" value="<?= $admin->btc_address ?>"
                                            class="form-control" name="btc_address" placeholder="BTC Address">
                                        <button type="button" class="input-group-addons btn btn-success"
                                            onclick="copyText()">COPY</button>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-sm-12 col-md-5">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-7">
                                    <label for="">Amount Deposited
                                        (<?= currency($user->currency) ?>):</label>
                                    <div class="input-group">
                                        <input <?= old('amount') ?> type="number" class="form-control"
                                            name="amount" placeholder="Amount">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Continue</button>
                        </form>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
    <script>
        function copyText() {
            // Get the input field
            var input = document.getElementById("btc_address");

            // Select the text in the input field
            input.select();
            input.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text to the clipboard
            document.execCommand("copy");

            // Optionally, you can display a message or perform other actions
            alert("Copied the text: " + input.value);
        }
    </script>
@endsection
