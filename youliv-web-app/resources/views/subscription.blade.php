@extends('layouts.appcommon')
@section('content')

<!--        subscription-sec starts-->
<section class="subscription-sec wow fadeInUp" data-wow-delay="0.2s">
    <div class="container">
        <div class="sec-heading">
            <h2><span>YouLiv..</span> Subscription </h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
        <div class="choose-occupy">
            <h1>Choose the right plan for <span>Single Occupancy</span> bed</h1>
            <ul>
                <li>
                    <div class="monthly-pay-price">
                        <h2>Monthly</h2>
                        <div class="monthly-main">
                            <h1>₹14,000</h1>
                            <p>/ bed</p>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do magna aliqua.</p>
                        <div class="co-slider-btn">
                            <a href="javascript:void(0);" class="now-book">Get Started</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="monthly-pay-price">
                        <h2>6 Month</h2>
                        <div class="monthly-main">
                            <h1>₹84,000</h1>
                            <p>/ bed</p>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do magna aliqua.</p>
                        <div class="co-slider-btn">
                            <a href="javascript:void(0);" class="now-book">Get Started</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="monthly-pay-price month-popular-price">
                        <h2>6 Month</h2>
                        <div class="monthly-main">
                            <h1>₹84,000</h1>
                            <p>/ bed</p>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do magna aliqua.</p>
                        <div class="co-slider-btn">
                            <a href="javascript:void(0);" class="now-book">Get Started</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<!--        subscription-sec ends-->



@include('footer')

@endsection