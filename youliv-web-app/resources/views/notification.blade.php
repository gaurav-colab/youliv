@extends('layouts.appcommon')
@section('content')

<!--  notification-sec starts      -->
<section class="notification-sec wow fadeInUp" data-wow-delay="0.2s">
    <div class="container">
        <h1>Notification <span>Clear all</span></h1>
        <div onclick="location.href='javascript:void(0);';" class="notify-div unread">
            <h2>Payment Cycle</h2>
            <span>29 February 2020</span>
            <p>Your Next Month Payment Deo Amount Rs 14000.</p>
        </div>

        <div onclick="location.href='javascript:void(0);';" class="notify-div unread">
            <h2>Payment Cycle</h2>
            <span>29 February 2020</span>
            <p>Your Next Month Payment Deo Amount Rs 14000.</p>
        </div>

        <div onclick="location.href='javascript:void(0);';" class="notify-div">
            <h2>Payment Cycle</h2>
            <span>29 February 2020</span>
            <p>Your Next Month Payment Deo Amount Rs 14000.</p>
        </div>

        <div onclick="location.href='javascript:void(0);';" class="notify-div">
            <h2>Payment Cycle</h2>
            <span>29 February 2020</span>
            <p>Your Next Month Payment Deo Amount Rs 14000.</p>
        </div>

        <div onclick="location.href='javascript:void(0);';" class="notify-div">
            <h2>Payment Cycle</h2>
            <span>29 February 2020</span>
            <p>Your Next Month Payment Deo Amount Rs 14000.</p>
        </div>

        <div onclick="location.href='javascript:void(0);';" class="notify-div">
            <h2>Payment Cycle</h2>
            <span>29 February 2020</span>
            <p>Your Next Month Payment Deo Amount Rs 14000.</p>
        </div>

        <div onclick="location.href='javascript:void(0);';" class="notify-div">
            <h2>Payment Cycle</h2>
            <span>29 February 2020</span>
            <p>Your Next Month Payment Deo Amount Rs 14000.</p>
        </div>
    </div>
</section>
<!--  notification-sec ends      -->


@include('footer')
<!-- Modal -->
<div class="modal fade" id="req-call-modal" role="dialog">
    <div class="modal-dialog pd-modal">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="visit-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h2>Request for a call</h2>
            </div>
            <div class="visit-body">
                <h3>Our promise We will get back to you within 24-48 hrs. Don't worry we will never spam you</h3>
                <form>
                    <div class="form-group">
                        <input type="text" placeholder="Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Phone Number" class="form-control">
                    </div>
                </form>
                <button type="submit" class="btn logform-btn"><span>submit</span></button>
            </div>
        </div>

    </div>
</div>
<!--        request-modal ends-->
@endsection