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
            </div> <!-- Main content -->
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
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">

                                            <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab"
                                                    href="#profile8" role="tab" aria-selected="true"><span><i
                                                            class="ion-person me-15"></i>Direct Bank
                                                        Transfer</span></a> </li>
                                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#home8"
                                                    role="tab" aria-selected="false"><span><i
                                                            class="ion-home me-15"></i>Electronic
                                                        Transfers</span></a> </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content tabcontent-border">
                                            <div class="tab-pane active" id="profile8" role="tabpanel">
                                                <form action="{{ route('user.direct.bank.transfer') }}" class="p-15"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="method" value="BANK">
                                                    <div class="form-group">
                                                        <label for="bank">BANK</label>
                                                        <select required class="form-control" name="bank" id="bank">
                                                            <option value="">Please select...</option>
                                                            <option value="<?= config('app.name') ?>">
                                                                <?= config('app.name') ?></option>
                                                            <option value="BANK">Other Banks</option>
                                                            <option value="JPMorgan Chase &amp; Co.">JPMorgan Chase &amp;
                                                                Co.
                                                            </option>
                                                            <option value="Bank of America Corp.">Bank of America Corp.
                                                            </option>
                                                            <option value="Wells Fargo &amp; Co.">Wells Fargo &amp; Co.
                                                            </option>
                                                            <option value="Citigroup Inc.">Citigroup Inc. </option>
                                                            <option value="U.S. Bancorp">U.S. Bancorp </option>
                                                            <option value="Truist Bank.">Truist Bank. </option>
                                                            <option value="PNC Financial Services Group Inc.">
                                                                PNC Financial Services Group Inc. </option>
                                                            <option value="TD Group US Holdings LLC. ">TD Group US Holdings
                                                                LLC.
                                                            </option>
                                                            <option value="Bank of New York Mellon Corp.">Bank of New York
                                                                Mellon Corp.
                                                            </option>
                                                            <option value="Capital One Financial Corp. ">Capital One
                                                                Financial
                                                                Corp.
                                                            </option>
                                                            <option value="State Street Corp.">State Street Corp. </option>
                                                            <option value="Goldman Sachs Group Inc.">Goldman Sachs Group
                                                                Inc.
                                                            </option>
                                                            <option value="Fifth Third Bank.">Fifth Third Bank. </option>
                                                            <option value="HSBC.">HSBC. </option>
                                                            <option value="Citizens Financial Group.">Citizens Financial
                                                                Group.
                                                            </option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bank_name">BANK NAME</label>
                                                        <input required type="text" name="bank_name" id="bank_name"
                                                            class="form-control" value="{{ old('bank') }}"
                                                            aria-describedby="helpId">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="account_number">Account Number</label>
                                                        <input type="text" name="account_number" id="account_number"
                                                            class="form-control" value="{{ old('account_number') }}"
                                                            aria-describedby="helpId">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="account_name">Account Name</label>
                                                        <input required type="text" name="account_name" id="account_name"
                                                            class="form-control" value="{{ old('account_name') }}"
                                                            aria-describedby="helpId">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="description">Description/Purpose</label>
                                                        <input required type="text" name="description" id="description"
                                                            class="form-control" value="{{ old('description') }}"
                                                            aria-describedby="helpId">
                                                    </div>

                                                    <label for="">Amount</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mr-2" id="basic-addon1">
                                                                <?= currency($user->currency) ?>
                                                            </span>
                                                        </div>
                                                        <input required type="number" name="amount"
                                                            class="form-control" placeholder=""
                                                            value="{{ old('amount') }}">
                                                    </div>
                                                    <nav>
                                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                            <a class="nav-item nav-link" id="nav-home-tab"
                                                                data-bs-toggle="tab" href="#nav-swift" role="tab"
                                                                aria-controls="nav-swift" aria-selected="false">SWIFT</a>
                                                            <a class="nav-item nav-link" id="nav-iban-tab"
                                                                data-bs-toggle="tab" href="#nav-iban" role="tab"
                                                                aria-controls="nav-iban" aria-selected="false">IBAN</a>
                                                            <a class="nav-item nav-link active" id="nav-routing-tab"
                                                                data-bs-toggle="tab" href="#nav-routing" role="tab"
                                                                aria-controls="nav-routing" aria-selected="true">ROUTING
                                                                NUMBER</a>
                                                        </div>
                                                    </nav>
                                                    <div class="tab-content" id="nav-tabContent">
                                                        <div class="tab-pane fade" id="nav-swift" role="tabpanel"
                                                            aria-labelledby="nav-swift-tab">
                                                            <label for="">SWIFT CODE</label>
                                                            <input type="text" name="swift_code" class="form-control"
                                                                placeholder="You’ll need one if you’re sending or receiving money internationally.">
                                                        </div>
                                                        <div class="tab-pane fade" id="nav-iban" role="tabpanel"
                                                            aria-labelledby="nav-iban-tab">
                                                            <label for="">iBAN CODE</label>
                                                            <input type="text" name="iban_code" class="form-control"
                                                                placeholder="Money from Europe you need an IBAN.">
                                                        </div>
                                                        <div class="tab-pane fade active show" id="nav-routing"
                                                            role="tabpanel" aria-labelledby="nav-routing-tab">
                                                            <label for="">Routing Number</label>
                                                            <input type="text" name="routing_number"
                                                                class="form-control"
                                                                placeholder="Money from the US you’ll need a routing number.">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="transfer_pin">Transfer Pin</label>
                                                        <input required type="number" name="transfer_pin"
                                                            class="form-control" placeholder="Enter transfer pin">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <input type="submit" class="btn btn-primary" value="Submit">
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="tab-pane" id="home8" role="tabpanel">
                                                <form action="{{ route('user.electronic.transfer') }}" class="p-15" method="POST">
                                                    @csrf
                                                    <h5 class="card-title"><i class="fa fa-credit-card"></i> Withdrawal
                                                        information</h5>
                                                    <input type="hidden" name="bank" value="OTHERS">
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="">Select Withdrawal Method</label>
                                                        <select required name="withdrawal_method" id=""
                                                            class="form-control">
                                                            <option value="Western Union">Western Union</option>
                                                            <option value="Skrill">Skrill</option>
                                                            <option value="Money Gram">Money Gram</option>
                                                            <option value="Bitcoin Wallet">Bitcoin Wallet</option>
                                                        </select>
                                                    </div>
                                                    <label for="">Amount</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mr-2" id="basic-addon1">
                                                                <?= currency($user->currency) ?>
                                                            </span>
                                                        </div>
                                                        <input required type="number" name="amount"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Beneficiary</label>
                                                        <input required type="text" name="beneficiary"
                                                            class="form-control" placeholder="">
                                                        <small>Bitcoin address, E-wallet ID, etc</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="transfer_pin">Transfer Pin</label>
                                                        <input required type="number" name="transfer_pin"
                                                            class="form-control" placeholder="Enter transfer pin">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <button type="submit" name="electronic_transfer"
                                                            class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="card-footer ">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5">
                                    @include('dashboard.user.partials.personal_account_details')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('bank').onchange = function(e) {
                        if (e.target.value != 'BANK') {
                            document.getElementById('bank_name').value = e.target.value;
                            document.getElementById('bank_name').setAttribute('readonly', true);
                        } else {
                            document.getElementById('bank_name').value = '';
                            document.getElementById('bank_name').focus();
                            document.getElementById('bank_name').removeAttribute('readonly');
                        }
                    }
                </script>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
