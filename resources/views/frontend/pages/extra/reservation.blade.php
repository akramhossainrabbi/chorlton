<?php
$objSTD=new MenuPageController();
$Seo=$objSTD->Seo();
?>
@extends('frontend.layout.master')
@section('title','Table Reservation | ')
@section('seo')
    <meta name="description" content="{{$Seo->booking_description}}">
    <meta name="keywords" content="{{$Seo->meta}}">
@endsection
@section('css')
<link rel="stylesheet" href="{{url('front-theme/css/style.css')}}">
<link rel="stylesheet" href="{{url('front-theme/css/responsive.css')}}">
<link rel="stylesheet" href="{{url('front-theme/css/skins/default.css')}}">
<link rel="stylesheet" href="{{ url('front-theme/calendar/css/pikaday.css') }}">
<link rel="stylesheet" href="{{ url('front-theme/calendar/timepicker.min.css') }}">
@endsection
@section('content')	
    <div class="page-title title-1">
        <div class="container">
            <div class="row">
                <div class="cell-12">
                    <h1 class="fx" data-animate="fadeInLeft">Table <span>Booking</span></h1>


                <!-- <div class="breadcrumbs main-bg fx" data-animate="fadeInUp">
                        <span class="bold">You Are In:</span><a href="#">Home</a><span class="line-separate">/</span><span> Online Table Reservation</span>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sectionWrapper">
        @include('frontend.extra.msg')
        <div class="container">
            <div class="row">
                <div class="cell-3"></div>
                <div class="cell-7">
                    <div class="panel panel-default contactus">
                        <div class="panel-heading clearfix">
                            <h3 class="panel-title uppercase" >Table Reservation (Please Select Booking Slot: 5.15pm to 7.00pm & 7.15pm to 9.00pm)</h3>
                            <h4 class="panel-title uppercase" >Please mention your food order here. It helps to maintain the safe distance.</h4>
                        </div>
                        @if(Session::has('error'))  
                            <div class="alert allDanger alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ Session::get('error') }}
                                <h4><i class="fa fa-times-circle"></i>  
                                    @php
                                        Session::forget('error');
                                    @endphp
                                </h4>   
                            </div>
                        @endif
                        <form method="post" action="{{url('reservation-request')}}" class="contact-form">
                            {!! csrf_field() !!}
                                <div class="form-input">
                                    <label>Full Name <span class="required">*</span></label>
                                    <input type="text" name="fullname" class="field-long" required placeholder="Name" />
                                </div>
                                <div class="form-input">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" name="email" required class="field-long" />
                                </div>
                                <div class="form-input">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="text" name="phone" required class="field-long" />
                                </div>
                                <div class="form-input">
                                    <label>Number Of Person <span class="required">*</span></label>
                                    <input type="text" name="number_of_person" required class="field-long" />
                                </div>
                                <div class="form-input">
                                    <label>Reservation Date <span class="required">*</span></label>
                                    <input type="text" id="datepicker" required name="reservation_date" >
                                </div>
                                <div class="form-input">
                                    <label>Reservation Time <span class="required">*</span></label>
                                    <!--<input type="text" name="phone" id="dateapicker" class="field-long" />-->
                                    <input type="text" name="reservation_time" required data-toggle="timepicker">
                                </div>
                                <div class="form-input">
                                    <label>Your Message</label>
                                    <textarea name="description" id="field5" class="field-long field-textarea"></textarea>
                                </div>
                                <div class="form-input">
                                    {{-- <div class="g-recaptcha" data-sitekey="6LdXY98ZAAAAAMpmXuC5XVQWVVHRPaYaSA_TedkG"></div> --}}
                                <!-- <div class="g-recaptcha" 
                                        data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                    </div>-->
                                </div>
      
                                <button class="btn btn-success" name="submit" type="submit" > Submit </button>
                                {{-- &nbsp;&nbsp;<input type="reset" value="Reset" id="reset"> --}}
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection	





@section('css')
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('slider-js')
    <script src="{{url('front-theme/calendar/pikaday.js')}}"></script>

    <script>

        var picker = new Pikaday(
                {
                    field: document.getElementById('datepicker'),
                    firstDay: 1,
                    minDate: new Date(),
                    maxDate: new Date(2020, 12, 31),
                    yearRange: [2000, 2020]
                });

    </script>
    <script src="{{url('front-theme/calendar/timepicker.min.js')}}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function (event)
        {
            timepicker.load({
                interval: 15,
                defaultHour: 8
            });
        });
    </script>
    <script>
        $('form').on('submit', function(e) {
          if(grecaptcha.getResponse() == "") {
            e.preventDefault();
            alert("Please ensure that you are a human!");
            return false;
          }

        });
    </script>
    
    <script type="text/javascript" src="{{url('front-theme/js/jquery.animateNumber.min.js')}}"></script>
    <script type="text/javascript" src="{{url('front-theme/js/jquery.easypiechart.min.js')}}"></script>

    <script src="{{url('front-theme/js/sweetalert.min.js')}}"></script>
    
    
    
    
    @include('frontend.extra.cart-js')
    <!-- NiceScroll plugin -->
	<script type="text/javascript" src="{{url('front-theme/js/jquery.nicescroll.min.js')}}"></script>
@endsection

