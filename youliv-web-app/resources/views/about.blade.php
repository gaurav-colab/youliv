@extends('layouts.app')

@section('content')

<!--   about-in-sec section starts     -->
<section class="about-in-sec">
    <div class="container-fluid inner-container">
        <div class="about-in-outer">
            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-md-offset-0 col-md-6 col-sm-6 col-xs-12">
                    <div class="abt-content wow slideInLeft" data-wow-delay="0.1s">
                        <div class="sec-heading">
                            <h2>About <span>YouLiv..</span> <span class="icon-heart"></span></h2>
                        </div>
<p>The YouLiv Team is committed to creating experiences and turning them into a story reel. A delightful experience of finding your new home away from home online without hunting manually, an affordable experience of imaging your new home with our professional on-site clicked photographs to maintain the uttermost transparency in our offering and recommendations, and most important- an experience of professionally managed free site visits to figure out every minute details of day-to-day living to match your personal preferences.
</p><p>Create your college story reel, or story reel of your very first job while we design your hassle free comfort living at verified properties with various online payment options.
</p>                    </div>
                </div>
                <div class="col-lg-5 col-lg-offset-1 col-md-offset-0 col-md-6 col-sm-6 col-xs-12">
                    <figure class="wow fadeInUp" data-wow-delay="0.1s">
                        <img src="{{ url ($server_path.'app_asset/images/about-in-1.png') }}" alt="about us">
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   about-in-sec section ends     -->


<!--work-in-sec starts-->
<section class="co-liv-sec work-in-sec">
    <div class="container-fluid inner-container">
        <div class="sec-heading wow fadeIn" data-wow-delay="0.3s">
            <h2>How it <span>Works..</span></h2>
            <p>We use human intelligence rather than artificial intelligence along with feedback to recommend you the best new home- home away from home. YouLiv assists you find and rent verified, rooms, flats, PG, houses, apartments, and private hostels for working professionals, students in Chandigarh, Panchkula, Mohali. Book now! </p>
        </div>
        <div class="epic-advantage-outer">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div onclick="location.href='javascript:void(0);';" class="work-in-content">
                        <figure>
                            <img src="{{ url ($server_path.'app_asset/images/work-in1.png') }}" alt="Search Co-Living Spaces">
                        </figure>
                        <figcaption>
                            <h1>Search Property</h1>
                            <p> </p>
                        </figcaption>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div onclick="location.href='javascript:void(0);';" class="work-in-content">
                        <figure>
                            <img src="{{ url ($server_path.'app_asset/images/work-in2.png') }}" alt="Book your Co-Living">
                        </figure>
                        <figcaption>
                            <h1>View and Shortlist</h1>
                            <p> </p>
                        </figcaption>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div onclick="location.href='javascript:void(0);';" class="work-in-content">
                        <figure>
                            <img src="{{ url ($server_path.'app_asset/images/welcome-img-1.png') }}" alt="Free Visit">
                        </figure>
                        <figcaption>
                            <h1>Free Visit &nbsp;&nbsp;&nbsp;</h1>
                            <p></p>
                        </figcaption>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div onclick="location.href='javascript:void(0);';" class="work-in-content">
                        <figure>
                            <img src="{{ url ($server_path.'app_asset/images/welcome-img-4.png') }}" alt="Book">
                        </figure>
                        <figcaption>
                            <h1>Book Online</h1>
                            <p> </p>
                        </figcaption>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--work-in-sec ends-->

<!--        get-yoliv section starts-->
<section class="get-youliv get-in about-sec">
         <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="our_team_heading">Our Team</div>
                </div>
            </div>
            <div class="row three-img">
                  
                    <div class="col-md-4">
                        <div class="about-us-caption">
                            <div class="about-us-img">
                                <img src="{{ url ($server_path.'app_asset/images/alkesh.jpg') }}" class="img-responsive">
                            </div>
                            <h4>Alkesh Mahajan</h4>
                            <p>Co-Founder</p>
                        </div>
                    </div>
					  <div class="col-md-4">
                        <div class="about-us-caption">
                            <div class="about-us-img">
                               <img src="{{ url ($server_path.'app_asset/images/akul.jpg') }}" class="img-responsive">
                            </div>
                            <h4>Akul Mahajan</h4>
                            <p>Co-Founder</p>
                        </div>
                    </div>
					 <div class="col-md-4">
                    <div class="about-us-caption">
                        <div class="about-us-img">
                            <img src="{{ url ($server_path.'app_asset/images/mohit.jpg') }}" class="img-responsive">
                        </div>
                        <h4>Mohit Mahajan</h4>
                        <p>Co-Founder</p>
                    </div>
                </div>
            </div>
            <div class="row three-img">
               
                <div class="col-md-4">
                    <div class="about-us-caption">
                        <div class="about-us-img">
                            <img src="{{ url ($server_path.'app_asset/images/kritika.jpg') }}" class="img-responsive">
                        </div>
                        <h4>Kritika Vohra</h4>
                        <p>Operations Manager</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="about-us-caption">
                        <div class="about-us-img">
                            <img src="{{ url ($server_path.'app_asset/images/shagun.jpg') }}" class="img-responsive">
                        </div>
                        <h4>Shagun Rana</h4>
                        <p>Operations Executive</p>
                    </div>
                </div>
            </div>
            <div class="row three-img">
                    <div class="col-lg-4">
                        <div class="about-us-caption">
                            <div class="about-us-img">
                                <img src="{{ url ($server_path.'app_asset/images/rajinderpal.jpg') }}" class="img-responsive">
                            </div>
                            <h4>Rajinderpal Singh</h4>
                            <p>Area Manager</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="about-us-caption">
                            <div class="about-us-img">
                                <img src="{{ url ($server_path.'app_asset/images/jatinder.jpg') }}" class="img-responsive">
                            </div>
                            <h4>Jatinder Singh</h4>
                            <p>Area Manager</p>
                        </div>
                    </div>
            </div>
        </div>
</section>

<!--        get-yoliv section ends-->




@include('footer')

@endsection
