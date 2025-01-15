@extends('layouts.master')
@section('content')
    <section class="error-section pt_120 pb_120">
        <div class="auto-container">
            <div class="error-content">
                <h1>419</h1>
                <h2>Page Expired</h2>
                <p>The page has expired due to inactivity. Please refresh and try again.</p>
                <div class="btn-box mt_20">
                    <a href="{{ url()->previous() }}" class="theme-btn btn-one">Go Back</a>
                    <a href="/" class="theme-btn btn-two">Go Home</a>
                </div>
            </div>
        </div>
    </section>
@endsection
