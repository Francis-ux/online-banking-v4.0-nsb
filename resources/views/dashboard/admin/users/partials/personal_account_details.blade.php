<div class="">
    <div class="card-header d-flex justify-content-between">
        <h4>Personal Account details </h4>
        <i class="fa fa-database" aria-hidden="true"></i>
    </div>
    <div class="card-body ">
        <dl class="row">
            <dt class="mt-0 mb-0 col-12">Name:</dt>
            <dd class="mt-0 mb-0 col-12">{{ $user->first_name . ' ' . $user->last_name }} </dd>
            <dt class="col-12">Account type:</dt>
            <dd class="col-12 text-capitalize">{{ $user->account_type }}</dd>

            <dt class="mt-0 mb-0 col-12">Account number:</dt>
            <dd class="mt-0 mb-0 col-12">{{ $user->account_number }}</dd>
            <dt class="mt-0 mb-0 col-12">Balance:</dt>
            <dd class="mt-0 mb-0 col-12">
                <strong>{{ currency($user->currency) . formatAmount($user->balance) }} -
                    {{ currency($user->currency, 'code') }}
            </dd>
        </dl>
    </div>
    <div class="card-footer">
        Registered: {{ date('dS M,Y', strtotime($user->created_at)) }} </div>
</div>
