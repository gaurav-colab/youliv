@extends('layouts.appcommon')
@section('content')

<!--occupant-detail-sec starts-->
<section class="occupant-detail-sec">
    <div class="container-fluid inner-container">
        <div class="occup-det-one wow fadeInLeft" data-wow-delay="0.2s">
            <div class="occup-det-block1">
                <div class="co-liv-content">

                    <figure>
                        <img src="{{ url('public/app_asset/images/occupant-det-img1.png') }}" alt="occupant-detail">
                    </figure>

                    <!--
               <div class="liv-rating">
               <h4>4.5</h4>
               </div>
-->
                    <div class="fm-occp woman-room">
                        <h2><span class="icon-woman"></span>Women</h2>
                    </div>

                </div>
                <div class="booking-house pd-hs-detail">


                    <h2>YOULIV Tokyo House</h2>
                    <h4><span class="icon-gps"></span>Plot No. 89, 2nd Floor, JLPL, Sector 82, Mohali, Punjab 140306 </h4>

                    <h3 class="pd-heading">Room Details <span><a href="javascript:void(0);">Change</a></span></h3>
                    <div class="pd-price">
                        <ul>
                            <li>
                                <figure>
                                    <img src="{{ url('public/app_asset/images/single-bed.png') }}" alt="single">
                                </figure>
                                <figcaption>
                                    <div class="book-occup">
                                        <h2>Single Occupancy</h2>
                                        <p><span>₹14,000</span> bed / month</p>
                                    </div>
                                    <div class="book-month-sub">
                                        <h2>Move-in <span>March 20 2020</span></h2>
                                        <p><span>Yearly Subscription</span></p>
                                    </div>
                                </figcaption>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="occup-det-block2">
                <div class="occ-form-1">
                    <h2>Occupant's Details</h2>
                    <p>All fields mendatory*</p>
                    <div class="content-outer">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Occupant's Name">
                            </div>
                            <div class="form-group ftype left-group-oc">
                                <div class="input-group">
                                    <div class="input-group-addon first-type">+91</div>
                                    <input type="text" class="form-control" placeholder="9876543210">
                                </div>

                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Aadhar Number">
                            </div>
                            <div class="form-group left-group-oc">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="DOB">
                                    <div class="input-group-addon"><span class="icon-calendar"></span></div>
                                </div>
                            </div>
                            <div class="form-group select-grop-occ">
                                <select class="form-control">
                                    <option>Occupation</option>
                                    <option>Student</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Institution/ Office Address"></textarea>
                            </div>
                            <div class="form-group left-group-oc">
                                <textarea class="form-control" placeholder="Permanent Address"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Pin Code">
                            </div>
                            <div class="form-group left-group-oc">
                                <input type="text" class="form-control" placeholder="Pin Code">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="occ-form-2">
                    <h2>Parent Details</h2>
                    <div class="content-outer">

                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Father/Mother Name">
                            </div>
                            <div class="form-group left-group-oc">
                                <input type="text" class="form-control" placeholder="Father/Mother Contact Number">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Emergency Contact Number">
                            </div>
                            <div class="form-group check-forget">

                                <div class="cstm-checkbox">
                                    <label class="cstm--check">I hereby declare that the information provided by me above is true and correct to the best of my knowledge and belief.
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
        <div class="occup-payment-detail wow fadeInRight" data-wow-delay="0.2s">
            <div class="occup-payment-detail-sub">
                <h3 class="pd-heading">Payment Details </h3>
                <div class="content-outer detail-counter">
                    <form>
                        <div class="log-cstm-radio">
                            <p>
                                <input type="radio" id="Pre-Booking" name="radio-group" checked="">
                                <label for="Pre-Booking">Pre-Booking</label>
                            </p>
                            <h2>(You need to pay full amount within 48 hr to confirm booking)</h2>
                            <p>
                                <input type="radio" id="Pay Full" name="radio-group">
                                <label for="Pay Full">Pay Full Booking Amount</label>
                            </p>

                        </div>
                    </form>
                </div>
                <div class="content-outer detail-counter">
                    <form class="rp-code">
                        <div class="log-cstm-radio">
                            <p>
                                <input type="radio" id="Referral Code" name="radio-group" checked="">
                                <label for="Referral Code">I have a Referral Code</label>
                            </p>

                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Enter Promo Code">
                            <a href="javascript:void(0);">Apply</a>
                        </div>

                    </form>
                </div>
                <div class="detail-counter">
                    <h3 class="pd-heading">Invoice </h3>
                    <h2>Token Amount <span>₹4,000</span></h2>
                    <h2>Convenience Fee<span>₹20</span></h2>
                </div>
                <div class="detail-counter">
                    <h2>Payable Amount<span>₹4,020</span></h2>
                </div>
                <div class="form-group check-forget">
                    <label class="cstm--check">I accept the <a href="javascript:void(0);">Terms &amp; Conditions</a> and <a href="javascript:void(0);">Privacy Policy</a>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>

                </div>
            </div>
            <a href="javascript:void(0);">Pay Now</a>
        </div>
    </div>
</section>

<!--occupant-detail-sec ends-->


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
