@extends('layouts.appcommon')
@section('content')

<div class="content clearfix">
    <!--		destop account manu-bar-->
    <aside>
        <div id="box" class="sticky-pp">
            <div class="profile-sidebar">
                <div class="sidesticky">
                    <div class="profile-photo">
                        <figure>
                            <img src="{{ url('app_asset/images/profile-pic.png') }}" alt="profile picture">
                        </figure>
                        <figcaption>
                            <h1>John Deo</h1>
                        </figcaption>
                    </div>
                    <ul>
                        <li class="profile-active"><a href="javascript:void(0);"><span class="icon-account"></span>My
                                Subscription</a></li>
                        <li><a href="javascript:void(0);"><span class="icon-account1"></span>My Profile</a></li>
                        <li><a href="javascript:void(0);"><span class="icon-request"></span>My Requests</a></li>
                        <li><a href="javascript:void(0);"><span class="icon-logout"></span>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!--			destop account manu-bar ends-->
    <main>
        <!--		  mobile display account-menubar-->
        <div class="profile-sidebar visible-xs">
            <div class="sidesticky profile-mob-display ">
                <div class="profile-photo">
                    <figure>
                        <img src="{{ url('app_asset/images/profile-pic.png') }}" alt="profile picture">
                    </figure>
                    <figcaption>
                        <h1>John Deo</h1>
                    </figcaption>
                </div>
                <ul>
                    <li class="profile-active"><a href="javascript:void(0);"><span class="icon-account"></span>My
                            Subscription</a></li>
                    <li><a href="javascript:void(0);"><span class="icon-account1"></span>My Profile</a></li>
                    <li><a href="javascript:void(0);"><span class="icon-request"></span>My Requests</a></li>
                    <li><a href="javascript:void(0);"><span class="icon-logout"></span>Logout</a></li>
                </ul>
            </div>
        </div>
        <!--		  mobile display account-menubar ends-->



        <section class="subscription-plan profile-block-sec">
            <div class="switch-plan">
                <div class="my-subs">
                    <h2>Current Subscription</h2>
                    <div class="monthly-pay-price">
                        <h2>Your Monthly Plan</h2>
                        <div class="monthly-main">
                            <h1>₹14,000</h1>
                            <p>/ bed</p>
                        </div>
                        <p>Next Payment deo on 28 March 2020</p>

                    </div>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#switch-plan-modal"><img src="{{ url('app_asset/images/swap.png') }}">Switch to Other Plan</a>
                </div>
            </div>
            <div class="upcoming-visit">
                <h2>Upcoming Visits <a href="javascript:void)(0);">See all Visit</a></h2>
                <div class="scrollbar" id="style-15">
                    <div class="up-visit-wrap force-overflow">
                        <div class="booking-house pd-hs-detail">
                            <figure>
                                <img src="{{ url('app_asset/images/booking-house-1.png') }}" alt="house for booking">
                            </figure>
                            <figcaption>
                                <h2>YOULIV Tokyo House</h2>
                                <h4><span class="icon-gps"></span>Plot No. 89, 2nd Floor, JLPL, Sector 82, Mohali, Punjab 140306 </h4>
                                <ul>
                                    <li>
                                        <h2>Date of your Visit<span>March 20 2020</span></h2>
                                        <br>
                                        <h2>Time slot Scheduled<span>07:00 PM - 08:00 PM</span></h2>
                                    </li>
                                </ul>

                                <div class="co-slider-btn">
                                    <a href="javascript:void(0);" class="now-book">Cancel Visit</a>
                                    <a href="javascript:void(0);" class="visit-book re-s-btn">Re-Schedule visit</a>
                                    <a href="javascript:void(0);" class="feed-btn g-btn">Google map</a>
                                </div>
                            </figcaption>
                        </div>

                        <div class="booking-house pd-hs-detail">
                            <figure>
                                <img src="{{ url('app_asset/images/booking-house-1.png') }}" alt="house for booking">
                            </figure>
                            <figcaption>
                                <h2>YOULIV Tokyo House</h2>
                                <h4><span class="icon-gps"></span>Plot No. 89, 2nd Floor, JLPL, Sector 82, Mohali, Punjab 140306 </h4>
                                <ul>
                                    <li>
                                        <h2>Date of your Visit<span>March 20 2020</span></h2>
                                        <br>
                                        <h2>Time slot Scheduled<span>07:00 PM - 08:00 PM</span></h2>
                                    </li>
                                </ul>

                                <div class="co-slider-btn">
                                    <a href="javascript:void(0);" class="now-book">Cancel Visit</a>
                                    <a href="javascript:void(0);" class="visit-book re-s-btn">Re-Schedule visit</a>
                                    <a href="javascript:void(0);" class="feed-btn g-btn">Google map</a>
                                </div>
                            </figcaption>
                        </div>
                        <div class="booking-house pd-hs-detail">
                            <figure>
                                <img src="{{ url('app_asset/images/booking-house-1.png') }}" alt="house for booking">
                            </figure>
                            <figcaption>
                                <h2>YOULIV Tokyo House</h2>
                                <h4><span class="icon-gps"></span>Plot No. 89, 2nd Floor, JLPL, Sector 82, Mohali, Punjab 140306 </h4>
                                <ul>
                                    <li>
                                        <h2>Date of your Visit<span>March 20 2020</span></h2>
                                        <br>
                                        <h2>Time slot Scheduled<span>07:00 PM - 08:00 PM</span></h2>
                                    </li>
                                </ul>

                                <div class="co-slider-btn">
                                    <a href="javascript:void(0);" class="now-book">Cancel Visit</a>
                                    <a href="javascript:void(0);" class="visit-book re-s-btn">Re-Schedule visit</a>
                                    <a href="javascript:void(0);" class="feed-btn g-btn">Google map</a>
                                </div>
                            </figcaption>
                        </div>
                    </div>
                </div>
            </div>


            <div class="my-account-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#Edit-Profile" aria-controls="Edit-Profile" role="tab" data-toggle="tab">Booking History</a></li>
                    <li role="presentation"><a href="#Food-preference" aria-controls="Food-preference" role="tab" data-toggle="tab">Payments</a></li>
                    <li role="presentation"><a href="#Favourite-Properties" aria-controls="Favourite-Properties" role="tab" data-toggle="tab">Visit History</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="Edit-Profile">
                        <div class="acc-booking-div">
                            <div class="booking-house pd-hs-detail">
                                <figure>
                                    <img src="{{ url('app_asset/images/booking-house-1.png') }}" alt="house for booking">
                                </figure>
                                <figcaption>
                                    <h2>YOULIV Tokyo House</h2>
                                    <span class="book-id">Booking ID 000234</span>
                                    <h4><span class="icon-gps"></span>Plot No. 89, 2nd Floor, JLPL, Sector 82, Mohali, Punjab 140306
                                    </h4>

                                    <div class="pd-price">
                                        <ul>
                                            <li>
                                                <figure>
                                                    <img src="{{ url('app_asset/images/single-bed.png') }}" alt="single">
                                                </figure>
                                                <figcaption>
                                                    <div class="book-occup">
                                                        <h2>Single Occupancy</h2>
                                                        <p><span>₹14,000</span> bed / month</p>
                                                    </div>
                                                    <div class="book-month-sub">
                                                        <h2>Date of Joining <span>March 20 2020</span></h2>
                                                        <p><span>Monthly Subscription</span></p>
                                                    </div>
                                                </figcaption>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="co-slider-btn">
                                        <a href="javascript:void(0);" class="now-book">Book Again</a>
                                        <a href="javascript:void(0);" class="visit-book re-s-btn">Payment History</a>
                                        <a href="javascript:void(0);" class="feed-btn" data-toggle="modal" data-target="#feedback-modal">Give Feedback</a>
                                    </div>
                                </figcaption>
                            </div>
                            <div class="booking-house pd-hs-detail">
                                <figure>
                                    <img src="{{ url('app_asset/images/booking-house-1.png') }}" alt="house for booking">
                                </figure>
                                <figcaption>
                                    <h2>YOULIV Tokyo House</h2>
                                    <span class="book-id">Booking ID 000234</span>
                                    <h4><span class="icon-gps"></span>Plot No. 89, 2nd Floor, JLPL, Sector 82, Mohali, Punjab 140306
                                        <span class="book-cancle-btn acc-cancle-btn">Cancelled</span> </h4>

                                    <div class="pd-price">
                                        <ul>
                                            <li>
                                                <figure>
                                                    <img src="{{ url('app_asset/images/single-bed.png') }}" alt="single">
                                                </figure>
                                                <figcaption>
                                                    <div class="book-occup">
                                                        <h2>Single Occupancy</h2>
                                                        <p><span>₹14,000</span> bed / month</p>
                                                    </div>
                                                    <div class="book-month-sub">
                                                        <h2>Date of Joining <span>March 20 2020</span></h2>
                                                        <p><span>Monthly Subscription</span></p>
                                                    </div>
                                                </figcaption>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="co-slider-btn">
                                        <a href="javascript:void(0);" class="now-book">Book Again</a>
                                        <a href="javascript:void(0);" class="visit-book re-s-btn">Payment History</a>
                                        <a href="javascript:void(0);" class="feed-btn" data-toggle="modal" data-target="#feedback-modal">Give Feedback</a>
                                    </div>
                                </figcaption>
                            </div>
                            <div class="booking-house pd-hs-detail">
                                <figure>
                                    <img src="{{ url('app_asset/images/booking-house-1.png') }}" alt="house for booking">
                                </figure>
                                <figcaption>
                                    <h2>YOULIV Tokyo House</h2>
                                    <span class="book-id">Booking ID 000234</span>
                                    <h4><span class="icon-gps"></span>Plot No. 89, 2nd Floor, JLPL, Sector 82, Mohali, Punjab 140306
                                    </h4>

                                    <div class="pd-price">
                                        <ul>
                                            <li>
                                                <figure>
                                                    <img src="{{ url('app_asset/images/single-bed.png') }}" alt="single">
                                                </figure>
                                                <figcaption>
                                                    <div class="book-occup">
                                                        <h2>Single Occupancy</h2>
                                                        <p><span>₹14,000</span> bed / month</p>
                                                    </div>
                                                    <div class="book-month-sub">
                                                        <h2>Date of Joining <span>March 20 2020</span></h2>
                                                        <p><span>Monthly Subscription</span></p>
                                                    </div>
                                                </figcaption>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="co-slider-btn">
                                        <a href="javascript:void(0);" class="now-book">Book Again</a>
                                        <a href="javascript:void(0);" class="visit-book re-s-btn">Payment History</a>
                                        <a href="javascript:void(0);" class="feed-btn" data-toggle="modal" data-target="#feedback-modal">Give Feedback</a>
                                    </div>
                                </figcaption>
                            </div>
                            <div class="booking-house pd-hs-detail">
                                <figure>
                                    <img src="{{ url('app_asset/images/booking-house-1.png') }}" alt="house for booking">
                                </figure>
                                <figcaption>
                                    <h2>YOULIV Tokyo House</h2>
                                    <span class="book-id">Booking ID 000234</span>
                                    <h4><span class="icon-gps"></span>Plot No. 89, 2nd Floor, JLPL, Sector 82, Mohali, Punjab 140306
                                    </h4>

                                    <div class="pd-price">
                                        <ul>
                                            <li>
                                                <figure>
                                                    <img src="{{ url('app_asset/images/single-bed.png') }}" alt="single">
                                                </figure>
                                                <figcaption>
                                                    <div class="book-occup">
                                                        <h2>Single Occupancy</h2>
                                                        <p><span>₹14,000</span> bed / month</p>
                                                    </div>
                                                    <div class="book-month-sub">
                                                        <h2>Date of Joining <span>March 20 2020</span></h2>
                                                        <p><span>Monthly Subscription</span></p>
                                                    </div>
                                                </figcaption>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="co-slider-btn">
                                        <a href="javascript:void(0);" class="now-book">Book Again</a>
                                        <a href="javascript:void(0);" class="visit-book re-s-btn">Payment History</a>
                                        <a href="javascript:void(0);" class="feed-btn" data-toggle="modal" data-target="#feedback-modal">Give Feedback</a>
                                    </div>
                                </figcaption>
                            </div>
                        </div>
                    </div>



                    <div role="tabpanel" class="tab-pane" id="Food-preference">
                        <div class="acc-payment-wrap">
                            <div class="pay-card-det">
                                <ul>
                                    <li>
                                        <h2>Payment Cycle</h2>
                                        <p>29 February 2020 - 28 March 2020</p>
                                    </li>
                                    <li>
                                        <div class="card-number">
                                            <figure><img src="{{ url('app_asset/images/visa.png') }}" alt="card number"></figure>
                                            <p>4321</p>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>29 March 2020<span>₹14,000</span></h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="pay-card-det">
                                <ul>
                                    <li>
                                        <h2>Payment Cycle</h2>
                                        <p>29 February 2020 - 28 March 2020</p>
                                    </li>
                                    <li>
                                        <div class="card-number">
                                            <figure><img src="{{ url('app_asset/images/visa.png') }}" alt="card number"></figure>
                                            <p>4321</p>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>29 March 2020<span>₹14,000</span></h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="pay-card-det">
                                <ul>
                                    <li>
                                        <h2>Payment Cycle</h2>
                                        <p>29 February 2020 - 28 March 2020</p>
                                    </li>
                                    <li>
                                        <div class="card-number">
                                            <figure><img src="{{ url('app_asset/images/visa.png') }}" alt="card number"></figure>
                                            <p>4321</p>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>29 March 2020<span>₹14,000</span></h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="pay-card-det">
                                <ul>
                                    <li>
                                        <h2>Payment Cycle</h2>
                                        <p>29 February 2020 - 28 March 2020</p>
                                    </li>
                                    <li>
                                        <div class="card-number">
                                            <figure><img src="{{ url('app_asset/images/visa.png') }}" alt="card number"></figure>
                                            <p>4321</p>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>29 March 2020<span>₹14,000</span></h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="pay-card-det">
                                <ul>
                                    <li>
                                        <h2>Payment Cycle</h2>
                                        <p>29 February 2020 - 28 March 2020</p>
                                    </li>
                                    <li>
                                        <div class="card-number">
                                            <figure><img src="{{ url('app_asset/images/visa.png') }}" alt="card number"></figure>
                                            <p>4321</p>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>29 March 2020<span>₹14,000</span></h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="pay-card-det">
                                <ul>
                                    <li>
                                        <h2>Payment Cycle</h2>
                                        <p>29 February 2020 - 28 March 2020</p>
                                    </li>
                                    <li>
                                        <div class="card-number">
                                            <figure><img src="{{ url('app_asset/images/visa.png') }}" alt="card number"></figure>
                                            <p>4321</p>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>29 March 2020<span>₹14,000</span></h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="pay-card-det">
                                <ul>
                                    <li>
                                        <h2>Payment Cycle</h2>
                                        <p>29 February 2020 - 28 March 2020</p>
                                    </li>
                                    <li>
                                        <div class="card-number">
                                            <figure><img src="{{ url('app_asset/images/visa.png') }}" alt="card number"></figure>
                                            <p>4321</p>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>29 March 2020<span>₹14,000</span></h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="pay-card-det">
                                <ul>
                                    <li>
                                        <h2>Payment Cycle</h2>
                                        <p>29 February 2020 - 28 March 2020</p>
                                    </li>
                                    <li>
                                        <div class="card-number">
                                            <figure><img src="{{ url('app_asset/images/visa.png') }}" alt="card number"></figure>
                                            <p>4321</p>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>29 March 2020<span>₹14,000</span></h4>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="Favourite-Properties">
                        <div class="book-historyy">
                            <div class="booking-house pd-hs-detail">
                                <figure>
                                    <img src="{{ url('app_asset/images/booking-house-1.png') }}" alt="house for booking">
                                </figure>
                                <figcaption>
                                    <h2>YOULIV Tokyo House</h2>
                                    <span class=" book-cancle-btn visted-bttn">Visted</span>
                                    <h4><span class="icon-gps"></span>Plot No. 89, 2nd Floor, JLPL, Sector 82, Mohali, Punjab 140306
                                    </h4>

                                    <div class="pd-price">
                                        <ul>
                                            <li>
                                                <div class="his-b1">
                                                    <h2>Date of your Visit<span>March 20 2020</span></h2>
                                                </div>
                                                <div class="his-b2">
                                                    <h2>Time slot Scheduled<span>07:00 PM - 08:00 PM</span></h2>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                    <div class="co-slider-btn">
                                        <a href="javascript:void(0);" class="now-book re-sche">Re-Schedule visit</a>
                                    </div>
                                </figcaption>
                            </div>
                            <div class="booking-house pd-hs-detail">
                                <figure>
                                    <img src="{{ url('app_asset/images/booking-house-1.png') }}" alt="house for booking">
                                </figure>
                                <figcaption>
                                    <h2>YOULIV Tokyo House</h2>
                                    <span class="book-cancle-btn req-cancle">Cancelled</span>
                                    <h4><span class="icon-gps"></span>Plot No. 89, 2nd Floor, JLPL, Sector 82, Mohali, Punjab 140306
                                    </h4>

                                    <div class="pd-price">
                                        <ul>
                                            <li>
                                                <div class="his-b1">
                                                    <h2>Date of your Visit<span>March 20 2020</span></h2>
                                                </div>
                                                <div class="his-b2">
                                                    <h2>Time slot Scheduled<span>07:00 PM - 08:00 PM</span></h2>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                    <div class="co-slider-btn">
                                        <a href="javascript:void(0);" class="now-book re-sche">Re-Schedule visit</a>
                                    </div>
                                </figcaption>
                            </div>
                            <div class="booking-house pd-hs-detail">
                                <figure>
                                    <img src="{{ url('app_asset/images/booking-house-1.png') }}" alt="house for booking">
                                </figure>
                                <figcaption>
                                    <h2>YOULIV Tokyo House</h2>
                                    <span class=" book-cancle-btn visted-bttn">Visted</span>
                                    <h4><span class="icon-gps"></span>Plot No. 89, 2nd Floor, JLPL, Sector 82, Mohali, Punjab 140306
                                    </h4>

                                    <div class="pd-price">
                                        <ul>
                                            <li>
                                                <div class="his-b1">
                                                    <h2>Date of your Visit<span>March 20 2020</span></h2>
                                                </div>
                                                <div class="his-b2">
                                                    <h2>Time slot Scheduled<span>07:00 PM - 08:00 PM</span></h2>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                    <div class="co-slider-btn">
                                        <a href="javascript:void(0);" class="now-book re-sche">Re-Schedule visit</a>
                                    </div>
                                </figcaption>
                            </div>
                            <div class="booking-house pd-hs-detail">
                                <figure>
                                    <img src="{{ url('app_asset/images/booking-house-1.png') }}" alt="house for booking">
                                </figure>
                                <figcaption>
                                    <h2>YOULIV Tokyo House</h2>
                                    <span class="book-cancle-btn req-cancle">Cancelled</span>
                                    <h4><span class="icon-gps"></span>Plot No. 89, 2nd Floor, JLPL, Sector 82, Mohali, Punjab 140306
                                    </h4>

                                    <div class="pd-price">
                                        <ul>
                                            <li>
                                                <div class="his-b1">
                                                    <h2>Date of your Visit<span>March 20 2020</span></h2>
                                                </div>
                                                <div class="his-b2">
                                                    <h2>Time slot Scheduled<span>07:00 PM - 08:00 PM</span></h2>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                    <div class="co-slider-btn">
                                        <a href="javascript:void(0);" class="now-book re-sche">Re-Schedule visit</a>
                                    </div>
                                </figcaption>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>


    </main>
</div>


<!-- feedback-Modal -->
<div class="modal fade" id="feedback-modal" role="dialog">
    <div class="modal-dialog pd-modal">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="visit-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h2>Your Feedback Matters!</h2>
            </div>
            <div class="visit-body">
                <h2>YOULIV Tokyo House</h2>
                <p><span class="icon-gps"></span> Plot No. 89, 2nd Floor, JLPL Industrial Area, Sector 82, Mohali, Punjab
                    140306 </p>
                <h3>Your rating for this property</h3>
                <img src="{{ url('app_asset/images/rating.png') }}">
                <h3>Tell us about your experience</h3>
                <form>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Message" rows="6"></textarea>
                    </div>
                </form>
                <button type="submit" class="btn logform-btn"><span>Book a Visit</span></button>
            </div>
        </div>

    </div>
</div>
<!--        feedback-modal ends-->
<!-- feedback-Modal -->
<div class="modal fade" id="feedback-modal" role="dialog">
    <div class="modal-dialog pd-modal">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="visit-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h2>Your Feedback Matters!</h2>
            </div>
            <div class="visit-body">
                <h2>YOULIV Tokyo House</h2>
                <p><span class="icon-gps"></span> Plot No. 89, 2nd Floor, JLPL Industrial Area, Sector 82, Mohali, Punjab
                    140306 </p>
                <h3>Your rating for this property</h3>
                <img src="{{ url('app_asset/images/rating.png') }}">
                <h3>Tell us about your experience</h3>
                <form>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Message" rows="6"></textarea>
                    </div>
                </form>
                <button type="submit" class="btn logform-btn"><span>Book a Visit</span></button>
            </div>
        </div>

    </div>
</div>
<!--        feedback-modal ends-->


<!-- switch-plan-modal-->
<div class="modal fade" id="switch-plan-modal" role="dialog">
    <div class="modal-dialog pd-modal">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="visit-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h2>Switch Subscription Plan</h2>
            </div>
            <div class="swt-body">
                <ul>
                    <li>
                        <div class="monthly-pay-price">
                            <h2>6 Month</h2>
                            <div class="monthly-main">
                                <h1>₹84,000</h1>
                                <p>/ bed</p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do magna aliqua.</p>
                            <div class="co-slider-btn">
                                <a href="javascript:void(0);" class="now-book">Select</a>
                            </div>
                        </div>

                    </li>
                    <li>
                        <div class="monthly-pay-price month-popular-price">
                            <h2>Yearly</h2>
                            <div class="monthly-main">
                                <h1>₹1,55,000</h1>
                                <p><span>1,68,000</span>/ bed</p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do magna aliqua.</p>
                            <div class="co-slider-btn">
                                <a href="javascript:void(0);" class="now-book">Select</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
<!-- switch-plan-modal-->


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

@include('footer')




<!--        script-->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="{{ url('app_asset/js/script.js') }}"></script>

<script src="{{ url('app_asset/js/jquery.floatit.js') }}"></script>
<script src="{{ url('app_asset/js/script.js') }}"></script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>
<!--        script End -->

@endsection
