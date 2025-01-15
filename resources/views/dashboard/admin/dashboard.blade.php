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
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Registered Users</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group d-lg-none">
                            @foreach ($users as $user)
                                <a href="{{ route('admin.users.profile.index', $user->uuid) }}"
                                    class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $user->first_name . ' ' . $user->last_name }}</h5>
                                        <small>
                                            @if ($user->is_account_verified == 0)
                                                <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                            @endif
                                        </small>
                                    </div>
                                    <p class="mb-1">Email: {{ $user->email }}</p>
                                    <small>Registered: {{ date('dS M Y', strtotime($user->created_at)) }}</small>
                                </a>
                            @endforeach

                        </div>
                        <div class="d-none d-lg-block">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="30%">Name</th>
                                        <th width="30%">Email</th>
                                        <th width="5%">Verified</th>
                                        <th width="5%">Disabled</th>
                                        <th width="30%">Registered</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.users.profile.index', $user->uuid) }}"
                                                    class="list-group-item-action text-primary">
                                                    {{ $user->first_name . ' ' . $user->last_name }}</a>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->is_account_verified == 0)
                                                    <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->account_state == 1)
                                                    <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                                @elseif($user->account_state == 0)
                                                    <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                                @endif
                                            </td>
                                            <td> {{ date('dS M Y', strtotime($user->created_at)) }}<br>
                                                <span class="text-danger">Last
                                                    login:</span>{{ date('dS M Y  g:i:s A', strtotime($user->last_login_time)) }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Verified</th>
                                        <th>Disabled</th>
                                        <th>Registered</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
