<?php
$objSTD=new MenuPageController;
$SliderData=$objSTD->SliderData();
$Seo=$objSTD->Seo();
?>
@extends('frontend.layout.master')
@section('title','')
@section('seo')
    <meta name="description" content="{{$Seo->description}}">
    <meta name="keywords" content="{{$Seo->meta}}">
@endsection
@section('css')
<link rel="stylesheet" href="{{url('front-theme/css/style.css')}}">
<link rel="stylesheet" href="{{url('front-theme/css/responsive.css')}}">
@endsection
@section('content')	

 
	<!-- Revolution slider start -->
                @include('frontend.extra.slider')
                <!-- Revolution slider end -->
                <?php 
                    $objSTD=new MenuPageController;
                    $WelcomeContent = $objSTD->WelcomeContent();
                ?>
                <!-- Welcome Box start -->
                <div class="welcome">
                    <div class="container">
                        <div class="row">
                            <div class="cell-9">
                                <h3 class="center block-head"><span class="main-color">{{$WelcomeContent->title}}</span></h3>
                                <div class="cell-12">
                                    <p class="margin-bottom-0">
                                        <?php
                                            echo html_entity_decode($WelcomeContent->description)
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="cell-3">
                                <div class="material-card-content" style="border-top-color: rgb(246, 187, 66);">

                                    <?php 
                                        echo html_entity_decode($WelcomeContent->free_home_delivery)
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Welcome Box end -->


                <!-- Services boxes style 1 start -->
                <!-- FUN Staff start -->
                <div class="block-bg-1 sectionWrapper">
                    <div class="container">
                        <div class="row">                            
                            <div class="cell-4 fx animated fadeInUp" data-animate="fadeInUp" data-animation-delay="200" style="animation-delay: 200ms;">
                                <div class="grid3column uppercase cus_image">
                                    <h3>Reserve Your Table</h3>
                                    <img alt="" src="{{url('front-theme/images/table_booking.jpg')}}">
                                    <a class="btn btn-md btn-3d btn-white fx animated fadeInUp" href="{{url('table-booking')}}" data-animate="fadeInUp" data-animation-delay="1700" style="animation-delay: 1700ms;">
                                <!--<a class="btn btn-md btn-3d btn-white fx animated fadeInUp" href="{{url('xyz.pdf')}}" data-animate="fadeInUp" data-animation-delay="1700" style="animation-delay: 1700ms;"> -->
                                        <span><i class="fa fa-chain selectedI"></i>Click for Booking...</span>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="cell-4 fx animated fadeInUp" data-animate="fadeInUp" data-animation-delay="200" style="animation-delay: 200ms;">
                                <div class="grid3column uppercase cus_image">
                                    <h3>Christmas Menu</h3>
                                    <img alt="" src="{{url('front-theme/images/xmas.jpg')}}">
                                    <a class="btn btn-md btn-3d btn-white fx animated fadeInUp" href="/pages/4/CHRISTMAS%20MENU" data-animate="fadeInUp" data-animation-delay="1700" style="animation-delay: 1700ms;">
                                        <span><i class="fa fa-chain selectedI"></i>read more...</span>
                                    </a>
                                </div>
                            </div>
                            
                            
                            <div class="cell-4 fx animated fadeInUp" data-animate="fadeInUp" data-animation-delay="200" style="animation-delay: 200ms;">
                                <div class="grid3column uppercase cus_image">
                                    <h3>Our Offers</h3>
                                    <img alt="" src="{{url('front-theme/images/offers.jpg')}}">
                                    <a class="btn btn-md btn-3d btn-white fx animated fadeInUp" href="{{url('our-offer')}}" data-animate="fadeInUp" data-animation-delay="1700" style="animation-delay: 1700ms;">
                                        <span><i class="fa fa-chain selectedI"></i>read more...</span>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="cell-4 fx animated fadeInUp" data-animate="fadeInUp" data-animation-delay="200" style="animation-delay: 200ms;">
                                <div class="grid3column uppercase cus_image">
                                    <h3>Kids Menu</h3>
                                    <img alt="" src="{{url('front-theme/images/Kids.jpg')}}">
                                    <a class="btn btn-md btn-3d btn-white fx animated fadeInUp" href="/pages/2/CHILDREN MENU" data-animate="fadeInUp" data-animation-delay="1700" style="animation-delay: 1700ms;">
                                        <span><i class="fa fa-chain selectedI"></i>read more...</span>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="cell-4 fx animated fadeInUp" data-animate="fadeInUp" data-animation-delay="200" style="animation-delay: 200ms;">
                                <div class="grid3column uppercase cus_image">
                                    <h3>What We Offering</h3>
                                    <img alt="" src="{{url('front-theme/images/offering.jpg')}}">
                                    <a class="btn btn-md btn-3d btn-white fx animated fadeInUp" href="pages/6/What we offering" data-animate="fadeInUp" data-animation-delay="1700" style="animation-delay: 1700ms;">
                                        <span><i class="fa fa-chain selectedI"></i>read more...</span>
                                    </a>
                                </div>
                            </div>
                        </div>    

                    </div><!-- .container end -->
                </div><!-- .funn-staff end -->
                <!-- FUN Staff end -->


@endsection	

@section('css')
    <!-- Skin style (** you can change the link below with the one you need from skins folder in the css folder **) -->
    <link rel="stylesheet" href="{{url('front-theme/css/custom.css')}}">
@endsection 


