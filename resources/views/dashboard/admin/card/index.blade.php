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
                    <div class="col-sm-12 col-md-12">
                        <ul class="list-group">
                            @forelse ($cards as $card)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-start"
                                        href="{{ route('admin.card.show', $card->uuid) }}">
                                        <div>
                                            <strong>Name:{{ $card->name }}</strong>
                                            <span class="d-block text-primary">Type:
                                                @foreach ($cardTypes as $key => $cardType)
                                                    @if ($card->type == $cardType->value)
                                                        {{ $cardType->name }}
                                                    @endif
                                                @endforeach
                                                <br>
                                            </span>
                                        </div>
                                        <span class="badge badge-primary">
                                            {{ $card->created_at }} </span>
                                    </a>
                                </li>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-warning" role="alert">
                                        <strong>card applications not found</strong>
                                    </div>
                                </div>
                            @endforelse

                        </ul>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
