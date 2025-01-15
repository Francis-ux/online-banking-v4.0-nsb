@extends('layouts.master')
@section('content')
    <section class="error-section pt_120 pb_120">
        <div class="auto-container">
            <div class="error-content">
                <h1>500</h1>
                <h2>Internal Server Error</h2>
                <p>
                    Oops, something went wrong. We're not sure what happened,
                    but our team is on it. We're working as fast as we can to
                    fix the issue and get things back up and running. In the
                    meantime, you can try refreshing the page or coming back
                    later. If you're still having trouble, please don't hesitate
                    to reach out to us.
                </p>
                <div class="btn-box mt_20">
                    <a href="{{ url()->previous() }}" class="theme-btn btn-one">Go Back</a>
                    <a href="/" class="theme-btn btn-two">Go Home</a>
                </div>
            </div>
        </div>
    </section>
@endsection
