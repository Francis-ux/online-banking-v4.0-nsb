@extends('dashboard.user.layouts.master')
@section('content')
    <style>
        .statement-table th,
        .statement-table td {
            text-align: left;
        }

        .statement-table thead th {
            background-color: #d3d3d3;
        }

        .statement-table tfoot {
            font-weight: bold;
            background-color: #d3d3d3;
        }
    </style>
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
                                    <div class="card-header">
                                        <a href="{{ route('user.account.statement.download', [$fromDate, $toDate]) }}"
                                            class="btn btn-success btn-sm">Download PDF</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-8 table-responsive">
                                                <table id="statementTable"
                                                    class="table table-bordered table-striped statement-table">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Description</th>
                                                            <th>Reference ID</th>
                                                            <th>Amount</th>
                                                            <th>Type</th>
                                                            <th>Balance</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($transactions as $transaction)
                                                            <tr>
                                                                <td>{{ $transaction->date }}</td>
                                                                <td>{{ $transaction->description }}</td>
                                                                <td>{{ $transaction->reference_id }}</td>
                                                                <td>{{ currency($user->currency) }}{{ formatAmount($transaction->amount) }}
                                                                </td>
                                                                <td>{{ $transaction->type }}</td>
                                                                <td>{{ currency($user->currency) }}{{ formatAmount($transaction->current_balance) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                    <tfoot class="thead-dark">
                                                        <tr>
                                                            <td colspan="3"><strong>*** Totals ***</strong></td>
                                                            <td>{{ currency($user->currency) }}{{ formatAmount($totalAmount) }}
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <div class="mt-5 d-flex justify-content-center">
                                                    @if ($transactions->hasPages())
                                                        {{ $transactions->withQueryString()->links() }}
                                                    @endif
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
            <!-- /.content -->
        </div>
    </div>
@endsection
