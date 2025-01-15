<div>
    <h6 class="text-bold text-primary mt-2">
        <div class="number-diy">
            <div class="data" data-number="0"
                style="display: flex; align-items: center; font-size: 25px; color: rgb(0, 0, 0); font-family: Roboto;">
                {{ currency($user->currency) . formatAmount($user->balance) }}
            </div>
            {{ currency($user->currency, 'code') }}
        </div>
    </h6>
</div>
