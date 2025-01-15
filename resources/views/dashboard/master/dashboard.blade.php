@extends('dashboard.master.layouts.master')
@section('content')
    <div class="content-wrapper" style="min-height: 697px;">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header d-none d-md-block d-lg-block">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h4 class="page-title">Master Dashboard</h4>
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
                <div class="row">
                    <div class="col-xl-12 col-md-10 mb-4 mt-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="list-group d-lg-none">
                                    @foreach ($admins as $admin)
                                        <a href="{{ route('master.admin.edit', $admin->uuid) }}"
                                            class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{ $admin->email }}</h5>
                                                <small>
                                                    @if ($admin->status == 1)
                                                        <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                                    @endif
                                                </small>
                                            </div>
                                            <p class="mb-1">Email: {{ $admin->email }}</p>
                                            <small>{{ date('dS M Y', strtotime($admin->created_at)) }}</small>
                                        </a>
                                    @endforeach

                                </div>
                                <div class="d-none d-lg-block">
                                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="30%">Name</th>
                                                <th width="30%">Email</th>
                                                <th width="5%">Status</th>
                                                <th width="30%">Registered</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($admins as $admin)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('master.admin.edit', $admin->uuid) }}"
                                                            class="list-group-item-action text-primary">
                                                            {{ $admin->email }} </a>
                                                    </td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>
                                                        @if ((int) $admin->status == 1)
                                                            <i class="fa fa-check-circle text-success"
                                                                aria-hidden="true"></i>
                                                        @else
                                                            <i class="fa fa-times-circle text-danger"
                                                                aria-hidden="true"></i>
                                                        @endif
                                                    </td>

                                                    <td>{{ date('dS M Y', strtotime($admin->created_at)) }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Registered</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
