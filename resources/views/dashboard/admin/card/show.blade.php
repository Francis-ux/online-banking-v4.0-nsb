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
                <div class="row">
                    <div class="col-sm-12 col-md-12 pb-3">
                        <dl class="row text-black">
                            <dt class="col-sm-3">Name:</dt>
                            <dd class="col-sm-9">{{ $card->name }}</dd>
                            <dt class="col-sm-3">Phone</dt>
                            <dd class="col-sm-9">{{ $card->phone }}</dd>
                            <dt class="col-sm-3">Email</dt>
                            <dd class="col-sm-9">{{ $card->email }}</dd>
                            <dt class="col-sm-3">Address</dt>
                            <dd class="col-sm-9">{{ $card->residential_address }}</dd>
                            <dt class="col-sm-3">Card type</dt>
                            <dd class="col-sm-9">
                                @foreach ($cardTypes as $key => $cardType)
                                    @if ($card->type == $cardType->value)
                                        {{ $cardType->name }}
                                    @endif
                                @endforeach
                            </dd>
                            <dt class="col-sm-3">Submitted</dt>
                            <dd class="col-sm-9">{{ $card->created_at }}</dd>
                            <dt class="col-sm-3">Status</dt>
                            <dd class="col-sm-9">{{ $card->status == 0 ? 'Pending' : 'Approved' }}</dd>
                        </dl>
                        <a href="{{ route('admin.card.delete', $card->uuid) }}"> <button class="btn btn-sm btn-primary"
                                type="button">DELETE</button></a>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
