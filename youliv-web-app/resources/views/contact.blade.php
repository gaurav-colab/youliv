@extends('layouts.app')

@section('content')

<!--        contact-in-sec starts-->
<section class="contact-in-sec">
    <div class="container-fluid inner-container">
        <div class="row">
            <div class="col-lg-5 col-md-4 col-sm-5 col-xs-12 wow fadeInUp" data-wow-delay="0.3s">
                <div class="con-in-content">
                    <h1>Visit us at</h1>
                    <p>Youliv Spaces C/o Magnet Cowork,<br>Plot 129/1 (opp. Hyatt),<br>Industrial Area,<br>Phase 1,Chandigarh </p>
                    <h2>Contact Us</h2>
                    <ul>
                        <li><a href="callto:+91 9876543212"><span class="icon-phone-call"></span>+91 78145 45433</a></li>
                        <li><a href="mailto:info@youliv.com"><span class="icon-arroba"></span>info@youliv.com</a></li>
                    </ul>
                    <div class="con-in-icon">
                        <h2>Follow Us</h2>
                        <ul>
                            <li><a href="javascript:void(0);"><span class="icon-facebook"></span></a></li>
                            <li><a href="javascript:void(0);"><span class="icon-instagram"></span></a></li>
                            <li><a href="javascript:void(0);"><span class="icon-youtube"></span></a></li>

                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-7 col-md-8 col-sm-7 col-xs-12">
                <div class="content-outer contact-in-outer wow fadeInRight" data-wow-delay="0.3s">
                    <div class="empty"></div>
                    <h2>Get In Touch</h2>
                    <p>Want to get in touch? We'd love to hear from you. Here's how can you reach us...</p>
					@if (session('success'))
					  <div class="alert alert-success">
						{{ session('success') }}
					  </div>
					@endif
					@if (session('error'))
					  <div class="alert alert-warning">
						{{ session('error') }}
					  </div>
					@endif
                    <form action="{{url('/')}}/contact_mail_send" method="post" id="contact_us">
					@csrf
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Name" id="name" name="name" required>
								<input type="hidden" class="form-control"  id="pcode" name="pcode" value="{{$pcode}}">
                                <div class="input-group-addon"><span class="icon-user"></span></div>
								@error('name')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Email ID" id="email" name="email" required>
                                <div class="input-group-addon"><span class="icon-mail"></span></div>
								@error('email')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
                            </div>
                        </div>
                        <div class="form-group ftype">
                            <div class="input-group">
                                <div class="input-group-addon first-type">+91</div>
                                <input type="phone" class="form-control" placeholder="Phone Number" id="phone" name="phone">
                                <div class="input-group-addon"><span class="icon-phone"></span></div>
								@error('phone')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea type="text" placeholder="Subject" rows="6" id="message" name="message" required></textarea>
							@error('message')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
                        </div>

                        <button type="submit" class="btn logform-btn"><span>Send message</span></button>
						
                    </form>


                </div>
            </div>
        </div>
    </div>
</section>
<!--        contact-in-sec ends-->







@include('footer')

@endsection