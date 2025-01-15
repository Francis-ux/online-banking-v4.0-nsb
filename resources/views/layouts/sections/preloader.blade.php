<div class="loader-wrap">
    <div class="preloader">
        <div class="preloader-close">close</div>
        <div id="handle-preloader" class="handle-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
                <div class="txt-loading">
                    @php
                        $siteName = explode(' ', config('app.loader_name'));
                    @endphp
                    @foreach ($siteName as $key => $item)
                        <span data-text-preloader="{{ $item }}" class="letters-loading">
                            {{ $item }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
