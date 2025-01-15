<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>

    <nav class="menu-box">
        <div class="nav-logo"><a href="/"><img width="200" src="/dashboard/resources/images/logo1.png"
                    alt="" title=""></a></div>
        <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
        <div class="contact-info">
            <h4>Contact Info</h4>
            <ul>
                @if (config('app.address'))
                    <li>{{ config('app.address') }}</li>
                @endif
                @if (config('app.phone'))
                    <li><a href="tel{{ config('app.phone') }}">{{ config('app.phone') }}</a></li>
                @endif
                <li><a href="mailto{{ config('app.email') }}">{{ config('app.email') }}</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li><a href="/"><span class="fab fa-twitter"></span></a></li>
                <li><a href="/"><span class="fab fa-facebook-square"></span></a></li>
                <li><a href="/"><span class="fab fa-pinterest-p"></span></a></li>
                <li><a href="/"><span class="fab fa-instagram"></span></a></li>
                <li><a href="/"><span class="fab fa-youtube"></span></a></li>
            </ul>
        </div>
    </nav>
</div>
