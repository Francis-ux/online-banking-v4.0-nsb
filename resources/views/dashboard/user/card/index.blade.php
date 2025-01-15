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
            </div>

            <!-- Main content -->
            <section class="content">
                <!-- Basic Card Example -->
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="mb-4 border-bottom-success">
                            <div class="card-header py-3 d-flex justify-content-between">
                                @include('dashboard.user.partials.balance_and_currency')

                                @include('dashboard.user.partials.menu')
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-7">
                                    @include('partials.validation_message')
                                    <div class="box-body">
                                        <form action="{{ route('user.card.store') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', $user->first_name . ' ' . $user->last_name) }}"
                                                    readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="type">Type of Card</label>
                                                <select class="form-control" id="type" name="type" required>
                                                    <option value="">Select</option>
                                                    @foreach ($cardTypes as $key => $cardType)
                                                        <option value="{{ $cardType->value }}">{{ $cardType->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="residential_address">Residential Address</label>
                                                <input type="text" class="form-control" id="residential_address"
                                                    name="residential_address"
                                                    value="{{ old('residential_address', $user->address) }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="registration_token">Registration Token</label>
                                                <input type="text" class="form-control" id="registration_token"
                                                    name="registration_token"
                                                    value="{{ old('registration_token', $user->registration_token) }}"
                                                    readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    value="{{ old('phone', $user->phone) }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email', $user->email) }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-4">Submit Request</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5 mt-5">
                                    <div class="card mt-5">
                                        <div class="card-header">Card Request Details</div>
                                        <div class="card-body">
                                            @forelse($cards as $key => $card)
                                                <p>Submitted Application Date: {{ $card->date }}</p>
                                                <p>Application Status: {{ $card->status == 0 ? 'Pending' : 'Approved' }}
                                                </p>
                                                <p>Card Type:

                                                    @foreach ($cardTypes as $key => $cardType)
                                                        @if ($card->type == $cardType->value)
                                                            {{ $cardType->name }}
                                                        @endif
                                                    @endforeach
                                                </p>
                                                <hr>
                                            @empty
                                                <p>No card request found.</p>
                                            @endforelse
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
