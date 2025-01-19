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
                        <div class="card shadow mb-4 border-bottom-success">
                            <div class="card-header py-3 d-flex justify-content-between">
                                <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>
                                @include('dashboard.admin.users.partials.account_option_and_status')
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-7">
                                    <div class="card-body">
                                        <dl class="row">
                                            <h5 class="col-sm-12 text-primary">Withdrawal Details</h5>
                                            <dt class="col-sm-4">Withdrawal Method:</dt>
                                            <dd class="col-sm-8">{{ $transfer->type }}</dd>
                                            <dt class="col-sm-4">Withdrawal Amount:</dt>
                                            <dd class="col-sm-8">
                                                <strong>{{ currency($user->currency) . formatAmount($transfer->amount) }}</strong>
                                                {{ $transfer->currency }}
                                            </dd>
                                            <dt class="col-sm-4"> Completed Process:</dt>
                                            <dd class="col-sm-8">
                                                @if ($transfer->status == 0)
                                                    <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                                @elseif($transfer->status == 2)
                                                    <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                                @endif
                                            </dd>
                                            <dt class="col-sm-4">Withdrawal Method:</dt>
                                            <dd class="col-sm-8">{{ $transfer->type }}</dd>
                                            <dt class="col-sm-4">Date:</dt>
                                            <dd class="col-sm-8">{{ date('dS M,Y', strtotime($transfer->created_at)) }}
                                            </dd>

                                            <h5 class="col-sm-12 text-primary">Beneficiary Details</h5>

                                            <dt class="col-sm-4">Bank Name:</dt>
                                            <dd class="col-sm-8">{{ $transfer->bank_name }}</dd>
                                            <dt class="col-sm-4">Account Name:</dt>
                                            <dd class="col-sm-8">{{ $transfer->account_name }}</dd>
                                            <dt class="col-sm-4">Account Number:</dt>
                                            <dd class="col-sm-8">{{ $transfer->account_number }}</dd>
                                            <dt class="col-sm-4">Routing Number:</dt>
                                            <dd class="col-sm-8">{{ $transfer->routing_number }}</dd>

                                            <h5 class="col-sm-12 text-primary">Verification codes</h5>
                                            @forelse ($transferCodes as $code)
                                                <dt class="col-sm-4">{{ $code->name }}</dt>
                                                <dd class="col-sm-8">{{ $code->code }}</dd>
                                            @empty
                                                <dd class="col-12">No verification codes</dd>
                                            @endforelse
                                        </dl>

                                        <form
                                            action="{{ route('admin.users.withdrawal.update', [$user->uuid, $transfer->reference_id]) }}"
                                            method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="other_status" id="other_status" @class(['form-control'])>
                                                    @foreach ($transferStatus as $key => $status)
                                                        <option value="{{ $status->value }}"
                                                            {{ $transfer->status == $status->value ? 'selected' : '' }}>
                                                            {{ $status->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="message">Message</label>
                                                <textarea required name="message" id="message" cols="30" rows="10" class="form-control">{{ $transfer->message }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5">
                                    @include('dashboard.admin.users.partials.personal_account_details')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        @endsection
