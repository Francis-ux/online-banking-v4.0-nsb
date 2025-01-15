@extends('dashboard.user.layouts.master')
@section('content')
    <div class="content-wrapper">
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
                                                aria-hidden="true"></i></a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">{{ $title }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div> <!-- Main content -->
            <section class="content">
                <!-- Basic Card Example -->
                <h2>{{ $title }}</h2>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="row">
                            <div class="col-sm-12 col-md-10">
                                <!-- menu, date & IP -->
                                <div class="d-flex align-items-center">
                                    <div class="rounded-3 p-2 green mr-2">
                                        <i class="fas fa-box text-white"></i>
                                    </div>

                                    <!-- ip & date -->
                                    <div class="ms-2 fw-bold text-success">
                                        <span> LOGIN IP: {{ request()->ip() }} </span>
                                        <span> COUNTRY: {{ $userCountry }}</span>
                                        {{-- <span> Country Test: {{ $userCountryTest }}</span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2 d-none d-md-block d-lg-block">
                                <!-- user details at top right -->
                                @if ($user->image == null)
                                    <div class="d-flex justify-content-center">
                                        <img style="width: 15%; height:auto; border-radius:5px; border:2px solid gray; overflow:hidden;"
                                            src="{{ asset('default.png') }}" alt="No image uploaded">

                                        <div class="ml-2">
                                            <span class=" fw-bold cap">
                                                {{ $user->first_name . ' ' . $user->last_name }}
                                            </span> <br>
                                            <span class="cap"> Account holder </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-center">
                                        <img style="width: 15%; height:auto; border-radius:5px; border:2px solid gray; overflow:hidden;"
                                            src="{{ asset('uploads/users/image/' . $user->image) }}"
                                            alt="No image uploaded">
                                        <div class="ml-2">
                                            <span class=" fw-bold cap">
                                                {{ $user->first_name . ' ' . $user->last_name }}
                                            </span> <br>
                                            <span class="cap"> Account holder </span>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="row my-4">
                            <!-- contains balance and history -->
                            <!-- balance card -->
                            <div class="col-12 col-md-7 green p-3">
                                <div class="d-flex justify-content-between">
                                    <div class="text-white"> <span>Available Balance</span> </div>
                                </div>

                                <!-- account balance -->
                                <div>
                                    {{-- <i class="text-white fa fa-wallet fa-2x"></i> --}}
                                    <span class="text-white balance fw-bold" style="font-size:20px;">
                                        {{ currency($user->currency) . formatAmount($user->balance) }} </span>
                                </div>

                                <!-- progress bar below account balance -->
                                <div>
                                    <progress max="100" value="100" class="w-100 progress"></progress>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12 col-md-3">
                                        <div class="d-flex justify-content-between align-items-center align-contents-center"
                                            style="width:80px; height:80px; border:2px solid transparent; overflow:hidden; object-fit: cover; ">

                                            @if ($user->image != null)
                                                <img style="width: 100%;"
                                                    src="{{ asset('uploads/users/image/' . $user->image) }}"
                                                    alt="No image uploaded">
                                            @else
                                                <img style="width: 100%;" src="{{ asset('default.png') }}"
                                                    alt="No image uploaded">
                                            @endif
                                        </div>
                                        <a class="btn btn-primary btn-sm" href="{{ route('user.profile.index') }}"
                                            role="button">Account
                                            Profile</a>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <!-- account details -->
                                        <div class="d-flex justify-content-between mt-4">
                                            <div class="">
                                                <div class="upper text-white opacity-50">Account holder</div>
                                                <div class="cap text-white ">
                                                    {{ $user->first_name . ' ' . $user->last_name }}
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="upper text-white opacity-50">Account Type</div>
                                                <div class="cap text-white ">{{ $user->account_type }}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <div>
                                                <div class="upper text-white opacity-50">Account Number</div>
                                                <div class="cap text-white">{{ $user->account_number }}</div>
                                            </div>
                                            <div>
                                                <div class="upper text-white opacity-50">Account State</div>
                                                <div class="cap text-white">
                                                    @foreach ($accountStates as $accountState)
                                                        @if ($user->account_state == $accountState->value)
                                                            {{ $accountState->name }}
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- send & deposit money buttons -->
                                <div class="d-flex mt-5">
                                    <a href="{{ route('user.transfer.fund') }}"
                                        class="send-button text-cen cap d-flex rounded-pill p-3">
                                        <div class="icon-holder rounded-circle bg-white">
                                            <i class="text-danger fa fa-hand-holding-usd"></i>

                                        </div>
                                        <span class="text-white align-self-center p-2 ">
                                            send money
                                        </span>
                                    </a>
                                    <a href="{{ route('user.deposit.index') }}"
                                        class=" ms-1 deposit-button text-cen cap d-flex rounded-pill p-3">
                                        <div class="icon-holder rounded-circle bg-white">
                                            <i class="cap text-danger fa fa-piggy-bank"></i>
                                        </div>
                                        <span class="cap text-white align-self-center p-2 ">
                                            make deposit
                                        </span>
                                    </a>
                                </div>

                            </div>
                            <div class="col-12 col-md-5  bg-white">
                                <!-- transaction history -->
                                <div class="rounded-5 mt-4 ">

                                    <div class="d-block d-md-flex justify-content-between">
                                        <div class="mb-2">
                                            <div>
                                                <i class="text-success fa fa-warehouse fa-2x"></i>
                                                <span class="text-center fs-4 cap text-success fw-bold">
                                                    latest transactions </span>
                                            </div>
                                            <div>
                                                <small> below is the recent transaction occurred on your
                                                    account
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body scroll-card-body">
                                        <div class="list-group">
                                            @forelse ($transactions as $transaction)
                                                <a href="{{ route('user.transaction.show', $transaction->uuid) }}"
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
                                                        Date:
                                                        {{ date('dS M, Y', strtotime($transaction->date)) }}
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
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="fs-3 fw-bold text-center">Transactions</div>
                                        <div class="d-flex justify-content-between mt-4">
                                            <a class="text-center" href="{{ route('user.transaction.index') }}">
                                                <div><i class="fa fa-money-bill fa-4x"></i></div>
                                                <div> History</div>
                                            </a>
                                            <a href="{{ route('user.transfer.fund') }}" class="text-center">
                                                <div><i class="fa fa-exchange-alt fa-4x"></i></div>
                                                <div> Send Money</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="fs-2 text-center fw-bold">Transfers</div>
                                        <div class="d-flex justify-content-between mt-5">
                                            <a class="text-center" href="{{ route('user.transfer.index') }}">
                                                <div><i class="fa fa-history fa-3x"></i></div>
                                                <div class="mt-3">Transfer History</div>
                                            </a>
                                            <div class="text-center">
                                                <div class="fw-bold"><i class="fa fa-circle-notch fa-3x"></i></div>
                                                <div>{{ $transfers }} Total Transfers</div>
                                                <div class="mt-3 text-primary">Last updated: {{ date('M dS Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="">
                                            <div class="fw-bold text-center fs-1">Deposit Method</div>
                                            <!-- <div class="">dd</div> -->
                                        </div>
                                        <div class="d-flex justify-content-between mt-5">
                                            <a href="{{ route('user.deposit.card') }}">
                                                <div><i class="fa fa-credit-card fa-5x"></i></div>
                                                <div class="text-center">Card</div>
                                            </a>
                                            <a href="{{ route('user.deposit.bitcoin') }}">
                                                <div><i class="fa fa-coins fa-5x"></i></div>
                                                <div class="text-center">Bitcoin</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center fw-bold fs-1">Applications</div>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('loan') }}" class="p-5 text-center">
                                                <div><i class="fa fa-money-check fa-5x"></i></div>
                                                <div class="text-center">Request Loan</div>
                                            </a>
                                            <a href="{{ route('user.card.index') }}" class="p-5 text-center">
                                                <div><i class="fa fa-credit-card  fa-5x"></i></div>
                                                <div class="text-center">Request Card</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center fw-bold fs-1">Profile </div>
                                        <div class="d-flex justify-content-between mt-5">
                                            <a href="{{ route('user.notification.index') }}" class="text-center">
                                                <div>
                                                    <div><i class="fa fa-coins fa-5x"></i></div>
                                                    <div class="text-center">Notifications</div>
                                                </div>
                                            </a>
                                            <a href="{{ route('user.profile.index') }}">
                                                <div><i class="fa fa-cog fa-5x"></i></div>
                                                <div class="text-center">Settings</div>
                                            </a>
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
