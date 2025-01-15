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
                    <div class="col-sm-12 col-md-8">
                        @include('partials.validation_message')
                        <div class="card shadow mb-4 border-left-danger ">
                            <div class="card-header d-flex justify-content-between">
                                <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>
                                @include('dashboard.admin.users.partials.account_option_and_status')
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.users.account.state.setting.update', $user->uuid) }}"
                                    class="user" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Set state</label>
                                        <select class="form-control" required name="account_state">
                                            <option value="">Select</option>
                                            @foreach ($accountStates as $accountState)
                                                <option value="{{ $accountState->value }}"
                                                    {{ $user->account_state == $accountState->value ? 'selected' : '' }}>
                                                    {{ $accountState->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted d-block">Frozen account users cannot make
                                            transfers</small>
                                        <small class="text-muted d-block">Disabled users cannot login</small>
                                        <small class="text-muted d-block">KYC users will be unable to make
                                            withdrawals</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Set message</label>
                                        <textarea name="account_state_reason" class="form-control">{{ $user->account_state_reason }}</textarea>
                                        <small class="text-muted">This message will appear when user
                                            login</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
