<footer class="main-footer">
    <div class="pull-right d-none d-sm-inline-block">
        <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">Contact US: Email: {{ config('app.email') }} Phone:
                    {{ config('app.phone') }} </a>
            </li>
        </ul>
    </div>
    &copy; {{ config('app.name') }} {{ date('Y') }}. All Rights Reserved.
</footer>
