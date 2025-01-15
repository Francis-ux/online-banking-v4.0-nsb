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
                        @include('partials.validation_message')
                        <div class="card shadow mb-4 border-left-danger ">
                            <div class="card-header d-flex justify-content-between">
                                <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>
                                @include('dashboard.admin.users.partials.account_option_and_status')
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8">
                                        <h3> {{ $user->first_name }} {{ $user->last_name }}</h3>
                                        <dl class="row">
                                            <dt class="col-sm-12">
                                                <h4 class="text-success">Account details</h4>
                                            </dt>
                                            <dt class="col-sm-4">Account name:</dt>
                                            <dd class="col-sm-8">{{ $user->first_name }} {{ $user->last_name }}</dd>
                                            <dt class="col-sm-4">Email:</dt>
                                            <dd class="col-sm-8">{{ $user->email }}</dd>
                                            <dt class="col-sm-4">Email Code:</dt>
                                            <dd class="col-sm-8">{{ $user->email_code ?? 'N/A' }}</dd>
                                            <dt class="col-sm-4">Member since:</dt>
                                            <dd class="col-sm-8">{{ date('dS M,Y', strtotime($user->created_at)) }}</dd>
                                            <dt class="col-sm-4">Phone:</dt>
                                            <dd class="col-sm-8"><strong
                                                    class="text-danger">{{ $user->dial_code }}</strong>{{ $user->phone }}
                                            </dd>
                                            <dt class="col-sm-4">Date of Birth:</dt>
                                            <dd class="col-sm-8">{{ date('Y-m-d', strtotime($user->dob)) }}</dd>
                                            <dt class="col-sm-4">Marital status:</dt>
                                            <dd class="col-sm-8 text-capitalize">{{ $user->marital_status }}</dd>
                                            <dt class="col-sm-4">Professional status:</dt>
                                            <dd class="col-sm-8 text-capitalize">{{ $user->professional_status }}</dd>
                                            <dt class="col-sm-4">Address:</dt>
                                            <dd class="col-sm-8">{{ $user->address }}</dd>
                                            <dt class="col-sm-4">Nationality:</dt>
                                            <dd class="col-sm-8">{{ $user->nationality }}</dd>
                                            <dt class="col-sm-4">Transfer pin:</dt>
                                            <dd class="col-sm-8">{{ $user->transfer_pin ?? 'N/A' }}</dd>
                                            <dt class="col-sm-4">Registration token:</dt>
                                            <dd class="col-sm-8">{{ $user->registration_token }}</dd>
                                            <dt class="col-sm-4">Should login require code:</dt>
                                            <dd class="col-sm-8">
                                                {{ $user->should_login_require_code == 0 ? 'No login code is not required' : 'Yes login code is require ' }}
                                            </dd>
                                            <dt class="col-sm-4">Login Code:</dt>
                                            <dd class="col-sm-8">{{ $user->login_code ?? 'N/A' }}</dd>
                                            <dt class="col-sm-4">Should transfer fail:</dt>
                                            <dd class="col-sm-8">
                                                {{ $user->should_transfer_fail == 0 ? 'No' : 'Yes' }}
                                            </dd>
                                            <hr>

                                            <dt class="col-sm-12">
                                                <h4 class="text-success">Account details</h4>
                                            </dt>
                                            <dt class="col-sm-4">Account state:</dt>
                                            <dd class="col-sm-8">
                                                <span class="text-capitalize">
                                                    @foreach ($accountStates as $key => $accountState)
                                                        @if ($accountState->value == $user->account_state)
                                                            {{ $accountState->name }}
                                                        @endif
                                                    @endforeach
                                                </span>
                                                @if ($user->account_state == 2)
                                                    <span class="text-danger">User will not be able login</span>
                                                @endif
                                            </dd>
                                            <dt class="col-sm-4">Account verification:</dt>
                                            <dd class="col-sm-8">
                                                <span class="text-capitalize">
                                                    <?= $user->is_account_verified == 1 ? 'VERIFIED' : 'NOT VERIFIED' ?></span>
                                                @if ($user->is_account_verified == 0)
                                                    User will not be able to perform any transaction, until account is
                                                    verified</span>
                                                @endif
                                            </dd>
                                            <dt class="col-sm-4">Account request validation:</dt>
                                            <dd class="col-sm-8"><?= $user->request_validation == 1 ? 'YES' : 'NO' ?></dd>
                                            <dt class="col-sm-4">Account number:</dt>
                                            <dd class="col-sm-8"><?= $user->account_number ?></dd>
                                            <dt class="col-sm-4">Account password:</dt>
                                            <dd class="col-sm-8"><?= $user->password_text ?></dd>
                                            <dt class="col-sm-4">Account type:</dt>
                                            <dd class="col-sm-8 text-capitalize"><?= $user->account_type ?></dd>
                                            <dt class="col-sm-4">Account currency:</dt>
                                            <dd class="col-sm-8"><?= currency($user->currency, 'name') ?></dd>
                                            <dt class="col-sm-4">Account balance:</dt>
                                            <dd class="col-sm-8">
                                                <?= currency($user->currency) . formatAmount($user->balance) ?>
                                            </dd>

                                            <dt class="col-sm-4">Member since:</dt>
                                            <dd class="col-sm-8"><?= date('dS M,Y', strtotime($user->created_at)) ?></dd>

                                        </dl>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <h5>Profile Image</h5>
                                        <img style="width: 100%; overflow:hidden;"
                                            src="/uploads/users/image/<?= $user->image ?>" alt="No profile image uploaded">
                                        <h5>ID front</h5>
                                        <img width="100%" src="/uploads/users/id/<?= $user->id_front ?>"
                                            alt="Not uploaded" srcset="">
                                        <h5>ID back</h5>
                                        <img width="100%" src="/uploads/users/id/<?= $user->id_back ?>" alt="Not uploaded"
                                            srcset="">

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modal-fill">
                                    EDIT PROFILE
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" data-backdrop="false" id="modal-fill" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Account Information</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.users.profile.update', $user->uuid) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <input type="text" name="first_name"
                                                                value="<?= $user->first_name ?>"
                                                                class="form-control bg-light border-0 small"
                                                                id="" placeholder="First Name">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="last_name"
                                                                value="<?= $user->last_name ?>"
                                                                class="form-control bg-light border-0 small"
                                                                id="" placeholder="Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <input type="email" name="email"
                                                                value="<?= $user->email ?>"
                                                                class="form-control bg-light border-0 small"
                                                                id="exampleInputEmail" placeholder="Email Address">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="password" value=""
                                                                class="form-control bg-light border-0 small"
                                                                id="exampleInputPassword"
                                                                placeholder="Enter new password">
                                                            <small>This enter new password field is optional</small>
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                                            <label for="">Date of Birth</label>
                                                            <input type="date" name="dob"
                                                                value="<?= date('Y-m-d', strtotime($user->dob)) ?>"
                                                                class="form-control bg-light border-0 small"
                                                                id="">
                                                        </div>
                                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                                            <label for="">Gender</label>
                                                            <select class="form-control bg-light border-0 small"
                                                                name="gender" id="">
                                                                <option value="male"
                                                                    {{ $user->gender == 'male' ? 'selected' : '' }}>Male
                                                                </option>
                                                                <option value="female"
                                                                    {{ $user->gender == 'female' ? 'selected' : '' }}>
                                                                    Female
                                                                </option>
                                                                <option value="other"
                                                                    {{ $user->gender == 'other' ? 'selected' : '' }}>other
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label for="">Marital Status</label>
                                                            <select name="marital_status" id=""
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
                                                            <label for="">Dial code</label>
                                                            <select name="dial_code" required="" id=""
                                                                class="form-control bg-light border-0 small">
                                                                <option value="">Select</option>
                                                                @foreach (config('setting.dial_code') as $key => $dialCode)
                                                                    <option value="+{{ $key }}"
                                                                        {{ $user->dial_code == '+' . $key ? 'selected' : '' }}>
                                                                        {{ $dialCode }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="">Phone</label>
                                                            <input type="number" name="phone"
                                                                value="<?= $user->phone ?>"
                                                                class="form-control bg-light border-0 small"
                                                                id="" placeholder="Phone">
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                                            <label for="">Professional Status</label>
                                                            <input type="text"
                                                                value="<?= $user->professional_status ?>"
                                                                placeholder="Your professional status: e.g Student, Staff"
                                                                name="professional_status"
                                                                class="form-control bg-light border-0 small">
                                                        </div>
                                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                                            <label for="should_login_require_code">Should Login Require
                                                                Code?</label>
                                                            <select name="should_login_require_code"
                                                                id="should_login_require_code"
                                                                class="form-control bg-light border-0 small">
                                                                <option value="1"
                                                                    <?= $user->should_login_require_code == 1 ? 'selected' : '' ?>>
                                                                    Yes</option>
                                                                <option value="0"
                                                                    <?= $user->should_login_require_code == 0 ? 'selected' : '' ?>>
                                                                    No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                                            <label for="should_transfer_fail">Should Transfer Fail?</label>
                                                            <select name="should_transfer_fail" id="should_transfer_fail"
                                                                class="form-control bg-light border-0 small">
                                                                <option value="1"
                                                                    <?= $user->should_transfer_fail == 1 ? 'selected' : '' ?>>
                                                                    Yes</option>
                                                                <option value="0"
                                                                    <?= $user->should_transfer_fail == 0 ? 'selected' : '' ?>>
                                                                    No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12 mb-3 mb-sm-0 mt-3">
                                                            <label for="">Member since</label>
                                                            <input type="date"
                                                                value="<?= date('Y-m-d', strtotime($user->created_at)) ?>"
                                                                name="created_at"
                                                                class="form-control bg-light border-0 small">
                                                        </div>
                                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                                            <label for="">Address</label>
                                                            <input type="text" placeholder="Your contact address"
                                                                value="<?= $user->address ?>" name="address"
                                                                class="form-control bg-light border-0 small">
                                                        </div>
                                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                                            <label for="">Nationality</label>
                                                            <select name="nationality" required="" id=""
                                                                class="form-control bg-light border-0 small">
                                                                <option value="">Select</option>
                                                                @foreach (config('setting.nationality') as $key => $nationality)
                                                                    <option value="{{ $nationality }}"
                                                                        {{ $user->nationality == $nationality ? 'selected' : '' }}>
                                                                        {{ $nationality }}
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                                            <label for="">Currency</label>
                                                            <select name="currency" required="" id=""
                                                                class="form-control bg-light border-0 small">
                                                                <option value="">Select</option>
                                                                @foreach (config('setting.currency') as $key => $currency)
                                                                    <option
                                                                        value="{{ $currency['name'] }}-{{ $currency['code'] }}-{{ $currency['symbol'] }}"
                                                                        {{ $user->currency == $currency['name'] . '-' . $currency['code'] . '-' . $currency['symbol'] ? 'selected' : '' }}>
                                                                        {{ $currency['name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label for="">Account</label>
                                                            <select name="account_type" id=""
                                                                class="form-control bg-light border-0 small">
                                                                <option value="savings"
                                                                    {{ $user->account_type == 'savings' }}>
                                                                    Savings account</option>
                                                                <option value="current"
                                                                    {{ $user->account_type == 'current' }}>
                                                                    Current Account</option>
                                                                <option value="corporate"
                                                                    {{ $user->account_type == 'corporate' }}>Corporate
                                                                    account
                                                                </option>
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                                        Update account
                                                    </button>

                                                </form>
                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->

                                <!-- Modal -->
                                <div class="modal fade " id="modelId" tabindex="-1" role="dialog"
                                    aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">

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
