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
            @if ($user->is_account_verified == 0)
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
                                    <div class="col-sm-12 col-md-12">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="text-danger">Please upload ID</h5>
                                                    <p>Please upload a valid ID in the fields provided, valid identity cards
                                                        includes
                                                        driver's licence, visas and national identities</p>
                                                    @include('partials.validation_message')
                                                    <div class="row mb-3">
                                                        <div class="col-sm-12 col-md-6">
                                                            <img width="500"
                                                                src="/uploads/users/id/<?= $user->id_front ?>"
                                                                alt="No ID found">
                                                            <form action="{{ route('user.profile.upload.front.id') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="custom-file">
                                                                    <input id="my-input" class="" type="file"
                                                                        name="id_front">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary btn-sm">UPLOAD
                                                                    FRONT</button>
                                                            </form>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6">
                                                            <img width="500"
                                                                src="/uploads/users/id/<?= $user->id_back ?>"
                                                                alt="No ID found">
                                                            <form action="{{ route('user.profile.upload.back.id') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="custom-file">
                                                                    <input id="my-input" class="" type="file"
                                                                        name="id_back">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary btn-sm">UPLOAD
                                                                    BACK</button>
                                                            </form>
                                                        </div>
                                                        <a href="{{ route('user.profile.request.validation') }}"
                                                            class="btn btn-primary btn-sm btn-block mt-3">REQUEST FOR
                                                            VALIDATION</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @else
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
                                                <div class="col-sm-12 col-md-4">
                                                    <div
                                                        style="width: 100%; height: 500px; overflow: hidden; object-fit: scale-down;">
                                                        @if ($user->image != null)
                                                            <img style="width: 100%; height:auto; overflow:hidden;"
                                                                src="/uploads/users/image/<?= $user->image ?>"
                                                                alt="No image uploaded">
                                                        @else
                                                            <img style="width: 100%; height:auto; overflow:hidden;"
                                                                src="{{ asset('default.png') }}" alt="No image uploaded">
                                                        @endif
                                                    </div>
                                                    <form action="{{ route('user.profile.update.image') }}" method="post"
                                                        class="form-row mt-3" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input id="my-input" class="btn-sm" type="file"
                                                                name="image">
                                                            <button type="submit" class="btn btn-primary btn-sm">UPLOAD <i
                                                                    class="fa fa-upload" aria-hidden="true"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <dl class="row">
                                                        <dt class="col-sm-12">Account Name:</dt>
                                                        <dd class="col-sm-12">
                                                            {{ $user->first_name . ' ' . $user->last_name }}</dd>
                                                        <dt class="col-sm-12">Email:</dt>
                                                        <dd class="col-sm-12"><?= $user->email ?></dd>
                                                        <dt class="col-sm-12">Address</dt>
                                                        <dd class="col-sm-12"><?= $user->address ?></dd>
                                                        <dt class="col-sm-12">Nationality</dt>
                                                        <dd class="col-sm-12"><?= $user->nationality ?></dd>
                                                        <dt class="col-sm-12">Gender</dt>
                                                        <dd class="col-sm-12 text-capitalize"><?= $user->gender ?></dd>
                                                        <dt class="col-sm-12">Date of Birth</dt>
                                                        <dd class="col-sm-12"><?= date('Y-m-d', strtotime($user->dob)) ?>
                                                        </dd>
                                                        <dt class="col-sm-12">Professional Status</dt>
                                                        <dd class="col-sm-12"><?= $user->professional_status ?></dd>
                                                        <dt class="col-sm-12">Marital Status</dt>
                                                        <dd class="col-sm-12 text-capitalize"><?= $user->marital_status ?>
                                                        </dd>
                                                        <dt class="col-sm-12">Account state:
                                                            @foreach ($accountStates as $accountState)
                                                                @if ($user->account_state == $accountState->value)
                                                                    {{ $accountState->name }}
                                                                @endif
                                                            @endforeach
                                                        </dt>
                                                    </dl>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-sm my-3"
                                                        data-bs-toggle="modal" data-bs-target="#modelId">
                                                        UPDATE PROFILE
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade " id="modelId" tabindex="-1"
                                                        role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Update Account Information</h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('user.profile.update') }}" class="user" method="post">
                                                                        @csrf
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                                <input type="text" disabled
                                                                                    name="first_name"
                                                                                    value="<?= $user->first_name ?>"
                                                                                    class="form-control bg-light border-0 small"
                                                                                    placeholder="First Name">
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <input type="text" disabled
                                                                                    name="last_name"
                                                                                    value="<?= $user->last_name ?>"
                                                                                    class="form-control bg-light border-0 small"
                                                                                    placeholder="Last Name">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="email" disabled name="email"
                                                                                value="<?= $user->email ?>"
                                                                                class="form-control bg-light border-0 small"
                                                                                id="exampleInputEmail"
                                                                                placeholder="Email Address">
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4 mb-3 mb-sm-0">
                                                                                <label for="dob">Date of Birth</label>
                                                                                <input type="date" required=""
                                                                                    disabled name="dob"
                                                                                    value="<?= date('Y-m-d', strtotime($user->dob)) ?>"
                                                                                    class="form-control bg-light border-0 small"
                                                                                    id="dob">
                                                                            </div>
                                                                            <div class="col-sm-4 mb-3 mb-sm-0">
                                                                                <label for="gender">Gender</label>
                                                                                <select
                                                                                    class="form-control bg-light border-0 small"
                                                                                    name="gender" id="gender">
                                                                                    <option value="male"
                                                                                        {{ $user->gender == 'male' ? 'selected' : '' }}>
                                                                                        Male
                                                                                    </option>
                                                                                    <option value="female"
                                                                                        {{ $user->gender == 'female' ? 'selected' : '' }}>
                                                                                        Female
                                                                                    </option>
                                                                                    <option value="other"
                                                                                        {{ $user->gender == 'other' ? 'selected' : '' }}>
                                                                                        other
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <label for="marital_status">Marital
                                                                                    Status</label>
                                                                                <select name="marital_status" required
                                                                                    id="marital_status"
                                                                                    class="form-control bg-light border-0 small">
                                                                                    <option value="single"
                                                                                        {{ $user->marital_status == 'single' ? 'selected' : '' }}>
                                                                                        Single</option>
                                                                                    <option value="married"
                                                                                        {{ $user->marital_status == 'married' ? 'selected' : '' }}>
                                                                                        Married</option>
                                                                                    <option value="separated"
                                                                                        {{ $user->marital_status == 'separated' ? 'selected' : '' }}>
                                                                                        Separated</option>
                                                                                    <option value="divorced"
                                                                                        {{ $user->marital_status == 'divorced' ? 'selected' : '' }}>
                                                                                        Divorced</option>
                                                                                    <option value="widowed"
                                                                                        {{ $user->marital_status == 'widowed' ? 'selected' : '' }}>
                                                                                        Widowed</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                                <label for="dial_code">Dial code</label>
                                                                                <select name="dial_code" required
                                                                                    id="dial_code"
                                                                                    class="form-control bg-light border-0 small">
                                                                                    <option value="">Select</option>
                                                                                    @foreach (config('setting.dial_code') as $key => $dialCode)
                                                                                        <option
                                                                                            value="+{{ $key }}"
                                                                                            {{ $user->dial_code == '+' . $key ? 'selected' : '' }}>
                                                                                            {{ $dialCode }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <label for="phone">Phone</label>
                                                                                <input type="number" required
                                                                                    name="phone"
                                                                                    value="<?= $user->phone ?>"
                                                                                    class="form-control bg-light border-0 small"
                                                                                    id="phone" placeholder="Phone">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                                                <label
                                                                                    for="professional_status">Professional
                                                                                    Status</label>
                                                                                <input type="text" required
                                                                                    value="<?= $user->professional_status ?>"
                                                                                    placeholder="Your professional status: e.g Student, Staff"
                                                                                    name="professional_status"
                                                                                    class="form-control bg-light border-0 small">
                                                                            </div>
                                                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                                                <label for="transfer_pin">Transfer
                                                                                    Pin</label>
                                                                                <input type="number" id="transfer_pin"
                                                                                    placeholder="Your pin for transfer"
                                                                                    name="transfer_pin"
                                                                                    class="form-control bg-light border-0 small">
                                                                            </div>
                                                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                                                <label for="address">Address</label>
                                                                                <input type="text" required
                                                                                    placeholder="Your contact address"
                                                                                    value="<?= $user->address ?>"
                                                                                    name="address"
                                                                                    class="form-control bg-light border-0 small">
                                                                            </div>
                                                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                                                <label
                                                                                    for="nationality">Nationality</label>
                                                                                <select name="nationality" required
                                                                                    id="nationality"
                                                                                    class="form-control bg-light border-0 small">
                                                                                    <option value="">Select</option>
                                                                                    @foreach (config('setting.nationality') as $key => $nationality)
                                                                                        <option
                                                                                            value="{{ $nationality }}"
                                                                                            {{ $user->nationality == $nationality ? 'selected' : '' }}>
                                                                                            {{ $nationality }}
                                                                                        </option>
                                                                                    @endforeach

                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                                                <label for="currency">Currency</label>
                                                                                <select name="currency" disabled
                                                                                    id="currency"
                                                                                    class="form-control bg-light border-0 small">
                                                                                    <option value="">Select</option>
                                                                                    @foreach (config('setting.currency') as $key => $currency)
                                                                                        <option
                                                                                            value="{{ $currency['name'] }}-{{ $currency['code'] }}-{{ $currency['symbol'] }}"
                                                                                            {{ $user->currency == $currency['name'] . '-' . $currency['code'] . '-' . $currency['symbol'] ? 'selected' : '' }}>
                                                                                            {{ $currency['name'] }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-12">
                                                                                <label for="account_type">Account</label>
                                                                                <select name="account_type" id="account_type"
                                                                                    disabled
                                                                                    class="form-control bg-light border-0 small">
                                                                                    <option value="savings"
                                                                                        {{ $user->account_type == 'savings' }}>
                                                                                        Savings account</option>
                                                                                    <option value="current"
                                                                                        {{ $user->account_type == 'current' }}>
                                                                                        Current Account</option>
                                                                                    <option value="corporate"
                                                                                        {{ $user->account_type == 'corporate' }}>
                                                                                        Corporate
                                                                                        account
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <button type="submit"
                                                                            class="btn btn-primary btn-user btn-block">
                                                                            Update account
                                                                        </button>

                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
            @endif
            <!-- /.content -->
        </div>
    </div>
@endsection
