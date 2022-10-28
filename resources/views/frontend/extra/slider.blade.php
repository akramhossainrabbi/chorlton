{{-- <div class="tp-banner-container">
    <div class="tp-banner">
        <ul>
            @if(isset($SliderData))
                @foreach($SliderData as $sld)
                <li data-transition="fade" data-slotamount="7">
                    <img alt="{{$sld->name}}" src="{{url('front-theme/images/slider/dummy.png')}}" data-lazyload="{{url('upload/slider/'.$sld->sliderimage)}}" data-duration="1000" data-ease="Linear.easeNone">
                </li>
                @endforeach
            @endif            
        </ul>
    </div>
</div> --}}

<div class="hero-wrap js-fullheight" style="background-image: url({{ asset('upload/slider/banner-cho.jpg')}});" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
        <div class="col-md-11 ftco-animate text-center">
          <h1 class="mb-4">Welcome to Coriander Restaurants - CHORLTON</h1>
          <!--<p><a href="menu" class="btn btn-primary mr-md-4 py-3 px-4">Order Online Now<span class="ion-ios-arrow-forward"></span></a></p>-->
        </div>
      </div>
    </div>
</div>

<section class="ftco-section ftco-no-pt ftco-intro">
    <div class="container">
      <div class="row">
        <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
          <div class="d-block services active text-center">
           
            <div class="media-body">
              <h3 class="heading">Order Online</h3>
              
              <a href="#" class="btn-custom d-flex align-items-center justify-content-center"><span class="fa fa-chevron-right"></span><i class="sr-only">Read more</i></a>
            </div>
          </div>      
        </div>
        <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
          <div class="d-block services text-center">
            
            <div class="media-body">
              <h3 class="heading">Make Online Payment</h3>
              
              <a href="#" class="btn-custom d-flex align-items-center justify-content-center"><span class="fa fa-chevron-right"></span><i class="sr-only">Read more</i></a>
            </div>
          </div>    
        </div>
        <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
          <div class="d-block services text-center">
           
            <div class="media-body">
              <h3 class="heading">Get Food Delivered</h3>
              
              <a href="#" class="btn-custom d-flex align-items-center justify-content-center"><span class="fa fa-chevron-right"></span><i class="sr-only">Read more</i></a>
            </div>
          </div>      
        </div>
      </div>
    </div>
</section>