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
                        <div class="card shadow mb-4 border-bottom-success">
                            <div class="card-header py-3 d-flex justify-content-between">
                                @include('dashboard.user.partials.balance_and_currency')

                                @include('dashboard.user.partials.menu')
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-7">
                                    @include('partials.validation_message')
                                    @include('partials.email_message')

                                    <div class="">
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($transferCodes as $transferCode)
                                                    @if ($transferCode->reference_id == $referenceId && $transferCode->order_no == request()->segment(5))
                                                        <div class="col-sm-12 col-md-12">
                                                            <h4>Transfer in progress.....</h4>
                                                            <div class="d-flex justify-content-center">
                                                                <div class="progress" role="progressbar"
                                                                    aria-label="Success example" aria-valuenow="25"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    style="height: 20px; width: 100%;">
                                                                    <div class="progress-bar bg-success" id="myProgressBar">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div id="code_area" class="d-none text-center">
                                                                <form
                                                                    action="{{ route('user.transfer.code.validate', [$transfer->reference_id, $orderNo]) }}"
                                                                    class="code_form" method="POST">
                                                                    @csrf
                                                                    <div id="message-area">
                                                                        <h5 class="text-center mt-3 mb-3">Transfer State:
                                                                            {{ config('app.name') }}
                                                                            {{ $transferCode->name }} CODE</h5>
                                                                        <h4 class="text-center mt-3 mb-5">Kindly insert your
                                                                            {{ $transferCode->name }} Code to facilitate the
                                                                            transfer
                                                                            of
                                                                            your
                                                                            funds to <span
                                                                                class="text-uppercase text-success">{{ $transfer->account_name ?? $transfer->beneficiary }}</span>
                                                                            or contact {{ config('app.email') }}</h4>
                                                                    </div>

                                                                    <div
                                                                        class="form-group mt-5 col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                                                                        <input type="hidden" name="verification_code_id"
                                                                            value="{{ $transferCode->verification_code_id }}">
                                                                        <input type="hidden" name="code_name"
                                                                            value="{{ $transferCode->name }}">
                                                                        <label for="{{ $transferCode->name }}"
                                                                            class="d-none">{{ $transferCode->name }}({{ $transferCode->description }})</label>
                                                                        <input type="text" required name="code"
                                                                            class="form-control"
                                                                            placeholder="Enter {{ ucwords($transferCode->name) }} Code"
                                                                            id="{{ $transferCode->name }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button class="btn btn-success"
                                                                            type="submit">VALIDATE</button>
                                                                    </div>

                                                                </form>

                                                            </div>
                                                            <h6 class="mt-4 mb-4">Reference ID:
                                                                <code>{{ $transferCode->reference_id }}</code>
                                                            </h6>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
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
                <script>
                    let transferCodeCount = {{ count($transferCodes) }};
                    let transferSegment = {{ (int) request()->segment(5) }};
                    console.log(transferSegment)
                    var i = 0;

                    function move(width, widthLimit) {
                        if (i == 0) {
                            i = 1;
                            var elem = document.getElementById("myProgressBar");
                            elem.style.width = width + "%";
                            elem.innerText = width + "%";

                            var id = setInterval(frame, 500);

                            function frame() {
                                if (width >= widthLimit) {
                                    clearInterval(id);
                                    i = 0;
                                    $("#code_area").removeClass('d-none')
                                } else {
                                    width++;
                                    elem.style.width = width + "%";
                                    elem.innerHTML = width + "%";
                                }
                            }
                        }
                    }
                    if (transferCodeCount == 1) {
                        if (transferSegment == 1) {
                            move(1, 99);
                        }
                    }
                    if (transferCodeCount == 2) {
                        if (transferSegment == 1) {
                            move(1, 40);
                        }

                        if (transferSegment == 2) {
                            move(40, 75);
                        }
                    }
                    if (transferCodeCount == 3) {
                        if (transferSegment == 1) {
                            move(1, 50);
                        }

                        if (transferSegment == 2) {
                            move(50, 75);
                        }
                        if (transferSegment == 3) {
                            move(75, 99);
                        }
                    }
                    if (transferCodeCount == 4) {
                        if (transferSegment == 1) {
                            move(1, 25);
                        }

                        if (transferSegment == 2) {
                            move(25, 50);
                        }
                        if (transferSegment == 3) {
                            move(50, 75);
                        }
                        if (transferSegment == 4) {
                            move(75, 99);
                        }
                    }
                    if (transferCodeCount == 5) {
                        if (transferSegment == 1) {
                            move(1, 25);
                        }

                        if (transferSegment == 2) {
                            move(25, 50);
                        }
                        if (transferSegment == 3) {
                            move(50, 75);
                        }
                        if (transferSegment == 4) {
                            move(75, 85);
                        }
                        if (transferSegment == 5) {
                            move(85, 99);
                        }
                    }
                    if (transferCodeCount == 6) {
                        if (transferSegment == 1) {
                            move(1, 25);
                        }

                        if (transferSegment == 2) {
                            move(25, 45);
                        }
                        if (transferSegment == 3) {
                            move(45, 65);
                        }
                        if (transferSegment == 4) {
                            move(65, 75);
                        }
                        if (transferSegment == 5) {
                            move(75, 85);
                        }
                        if (transferSegment == 6) {
                            move(85, 99);
                        }
                    }

                    setTimeout(() => {
                        $("#myProgressBar").css('opacity', '1');
                        move();
                    }, 3000);
                </script>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
