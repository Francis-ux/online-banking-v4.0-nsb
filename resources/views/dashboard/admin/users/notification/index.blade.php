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
                                    <div class="card-body scroll-card-body">
                                        <?php if (empty($notifications)) : ?>
                                        <div class="alert alert-warning">No notification yet</div>
                                        <?php else : ?>
                                        <div class="list-group">
                                            <?php foreach ($notifications as $notification) : ?>
                                            <a href="#"
                                                class="list-group-item list-group-item-action list-group-item-info">
                                                <p class="m-0 p-0"><?= $notification->type ?></p>
                                                <small><?= $notification->notification ?></small>
                                                <small class="float-right">
                                                    Date: <?= date('dS M,Y', strtotime($notification->created_at)) ?>
                                                </small>
                                                <br>
                                            </a>
                                            <small class="bg-gradient-light p-1 text-primary m-0"> <i class="fa fa-bell"
                                                    aria-hidden="true"></i> Email sent successfully
                                                to:<?= $user->email ?></small>
                                            <div class="btn-group mb-2 mt-0">
                                                <a onclick="return confirm('Are you sure?')" href="{{ route('admin.users.notification.delete', $notification->uuid) }}"
                                                    class="btn text-white btn-danger btn-sm">DELETE <i class="fa fa-trash"
                                                        aria-hidden="true"></i> </a>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn-primary btn btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modelId">Send
                                            notification <i class="fa fa-bell" aria-hidden="true"></i> </button>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5">
                                    @include('dashboard.admin.users.partials.personal_account_details')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modelId" tabindex="-1" aria-labelledby="modelTitleId" style="display: none;"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.users.notification.send', $user->uuid) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Send notification</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" name="title" id="" class="form-control"
                                            placeholder="Enter notification title" aria-describedby="helpId">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Message</label>
                                        <input type="text" name="message" id="" class="form-control"
                                            placeholder="Enter notification message" aria-describedby="helpId">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Notification</label>
                                        <select name="notifiable" class="form-control" id="">
                                            <option value="NONE">NONE</option>
                                            <option value="EMAIL">EMAIL</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        @endsection
