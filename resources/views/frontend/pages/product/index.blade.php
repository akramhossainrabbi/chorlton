<?php
$objSTD=new MenuPageController();
$Seo=$objSTD->Seo();
?>
@extends('frontend.layout.master')
@section('title','Order Your Menu | ')
@section('seo')
    <meta name="description" content="{{$Seo->online_order_description}}">
    <meta name="keywords" content="{{$Seo->meta}}">
@endsection
@section('content')
    <div class="sectionWrapper">
        <div class="container">
            <div class="row">
                <!-- cell6  class="proButton modal-trigger" data-modal="modal-name" -->
                <div class="cell-6">
                    <div class="root">
                        <div>
                            <div class="ant-collapse ant-collapse-icon-position-left">
                            
                            </div>
                            <div class="clearfix"></div>
                            <div class="container mt-3 px-0 px-lg-2 ">
                                <section id="detail_view_menu">
                                    <div class="row">
                                        @include('frontend.extra.ros_menu')

                                        @include('frontend.extra.cart',compact($orderINfoText))
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>

    @if(isset($orderINfoText))
    <div class="modal" id="alergy_alert" style="z-index: 9999;">
        <div class="modal-sandbox"></div>
        <div class="modal-box">
            <div class="modal-header">
                <div class="close-modal">✖</div> 
                <h4><i class="fa fa-info-circle"></i> Allergy & dietary information</h4>
            </div>
            <div class="modal-body" style="padding:20px 10px 10px 10px;">       
                <div class="cell-12">
                   {!!html_entity_decode($orderINfoText->allergy_alert)!!} 
                </div>               
            </div>
        </div>
    </div>
    @endif

    <div id="orderModal" class="modal fade" style="z-index: 9999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <h5>How you want the order?</h5>
                    @if($tab->collection_only==1)
                        <input style="display: none;"  type="radio" value="Delivery" name="record" id="record_1">
                        <label class="cell-5 btn btn-success" style=" text-transform: capitalize; padding-left: 25px;">
                            <input style="position: absolute; margin-top:8px; margin-left: -48px;" type="radio" value="Collect" name="record" id="record_0"> 
                            <span>Only Collection</span>
                        </label>
                    @else
                        <div class="text-center">
                            <label class="cell-5 btn btn-success">
                                <input checked="checked" style="position: absolute; margin-top:8px; margin-left: -17px; " type="radio" value="Delivery" name="record" id="record_1"> 
                                Delivery
                            </label>
                            <label class="cell-5 btn btn-success" style=" text-transform: capitalize; padding-left: 25px;">
                                <input style="position: absolute; margin-top:8px; margin-left: -48px;" type="radio" value="Collect" name="record" id="record_0"> 
                                <span>Collection</span>
                            </label>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="pickUp" class="modal fade" style="z-index: 9999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h5> Choose Your Time Between</h5>
                    {{-- <input type="text" class="form-control" id="pickUpTime"> --}}

                    <label>Minimum time for collection is 35-45 mins. 
                        It might takes more time on Friday & Saturday Nights</label>
                        <label>
                            <i class="fa fa-calendar" aria-hidden="true"></i> 
                            <input type="text" class="form-control" id="pickUpDate" value="{{date('D d M Y')}}" name="booking_date" size="12" style="display: inline; width: auto; float: none;"> 
                            <i class="fa fa-clock-o" aria-hidden="true" style="margin-left: 20px;"></i> 
                            <select id="pickUpTime" class="form-control" name="booking_time" style="display: inline; width: auto; float: none;">
                                <option value="00:00">Select Time</option>
                                <?php
                                $start=strtotime('00:00');
                                $end=strtotime('23:30');

                                for ($i=$start;$i<=$end;$i = $i + 15*60)
                                {
                                     echo date('g:i A',$i).'<br>';
                                     ?>
                                     <option value="{{date('g:i A',$i)}}">{{date('g:i A',$i)}}</option>
                                     <?php
                                }
                                ?>
                            </select>
                        </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveTime">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="searchPost" class="modal fade" style="z-index: 9999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h5> Search PostCode</h5>
                    <input type="text" class="form-control" placeholder="Search PostCode">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Search</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <button data-toggle="modal" data-target="#itemModalCenter">ashdfsdf</button>
    <div class="modal fade" id="itemModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-modal="true" style="z-index: 9999;">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">MIXED GRILL PLATTER(ONE)(meat)</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body bg-white container">
                <form name="add_to_cart_form" id="add_to_cart_form">
                    <input type="hidden" name="item_id" id="item_id" value="27">
                    <input type="hidden" name="discount" id="discount" value="0">
                    <input type="hidden" name="has_meal_deal" id="has_meal_deal" value="0">
                    <div class="row">
                        <h4 class="col-md-12">Karahi</h4><br>
                        <p class="col-md-12">Karahi</p>
                    </div>
                       
                    <div class="row price">
                        <h4 class="col-md-12 heading">Price</h4>
                        <hr>
                        
                        <div class="col-md-12 row">
                        <input type="hidden" name="variation_id" id="variation_id" value="0">
                            <div class="col-md-3">
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" data-id="0" class="custom-control-input popupPriceClass btnClass" value="8.9" price="8.9" name="item_price" id="customCheckDefault" checked="">
                                    <label class="custom-control-label text-sm" for="customCheckDefault">
                                        CHICKEN £8.90 
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" class="custom-control-input popupPriceClass btnClass" value="9.9" data-id="2" name="item_price" price="9.9" id="customCheck1">
                                    <label class="custom-control-label text-sm" for="customCheck1">LAMB 
                                    £ 9.90 
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" class="custom-control-input popupPriceClass btnClass" value="8.9" data-id="3" name="item_price" price="8.9" id="customCheck2">
                                    <label class="custom-control-label text-sm" for="customCheck2">VEGETABLE 
                                    £ 8.90 
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                       
                                               
                                               
                    <div class="row quantity">
                        <h4 class="col-md-12 heading">Quantity</h4>
                        <hr>
                        <div class="col-md-12 row">
                            <div class="product__details__quantity col-md-3">
                                <div class="quantity">
                                    <div class="pro-qty product_qty_hgt">
                                        <span class="product_count_item number-qty-decr  qtybtn popqnty-dec" type="main_item" id="number_qty_decr">-</span>
                                            <input class="product_count_item number-qty main_item_qty popqnty-num" id="main_item_qty" type="text" value="1" min="1" max="10" name="main_item_qty">
                                        <span class="product_count_item number-qty-incrs  qtybtn popqnty-inc" type="main_item" id="number_qty_incrs">+</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                       
                       
                       
                    <div class="row special_inst">
                        <h4 class="col-md-12 heading">Special Instructions</h4>
                        <hr>
                        <div class="col-md-12 row">
                            <textarea class="form-control special_inst" name="special_inst" id="special_inst" placeholder="Special Instructions"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <span class="priceOfItem">£6.90</span>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary add_cart" data-item-id="4">Add To Cart</button>
            </div>
          </div>
        </div>
      </div> --}}
@endsection	





@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{url('front-theme/css/custom.css')}}">
    <link rel="stylesheet" href="{{url('front-theme/css/radio-button/style.css')}}">
    {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css"> --}}
    <link rel="stylesheet" href="{{url('front-theme/calendar/css/pikaday.css')}}">
    <style type="text/css">
        .display-none-sec
        {
            display: none !important;
        }

        .discount-space
        {
            display: none;
        }

        .cart-item-highlight
        {
            font-weight: 600;
        }

        .cart-data-mini-box
        {
            width: 100%;
            display: block; 
        }

        .cart-price-mini-box
        {
            display:inline-grid;
            font-weight: 600;
        }
        .cart-price-mini-box > span::before 
        {
            content:"$";
            display:inline-grid;
            font-weight: 600;
        }
        .cart-extra-mini-box
        {
            width: 150px;
            display:inline-grid;
            overflow: hidden;
            font-weight: bold;
        }
        /* this will set the toastr style */
        .toast-success {
            background-color: purple;
        }

        .ui-timepicker-container{ 
            z-index:10000 !important; 
        }
    </style>
@endsection

@section('slider-js')
    <script type="text/javascript" src="{{url('front-theme/js/jquery.animateNumber.min.js')}}"></script>
    <script type="text/javascript" src="{{url('front-theme/js/jquery.easypiechart.min.js')}}"></script>

    <script src="{{url('front-theme/js/sweetalert.min.js')}}"></script>
	@include('frontend.extra.cart-js')
    <script type="text/javascript">

        
        $(document).ready(function(){
            $("#mobileCartMenuShort").click(function(){
                $('html, body').animate({
                    scrollTop: $("#mobileCartWeb").offset().top - ($('#mobileCartWeb')[0].scrollHeight-250)
                }, 1000);

                console.log('Position Get : ',$("#mobileCartWeb").offset().top);

            });
        });

        
    </script>
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script> --}}
    <script src="{{url('front-theme/calendar/pikaday.js')}}"></script>
    <script>

        var picker = new Pikaday(
                {
                    field: document.getElementById('pickUpDate'),
                    firstDay: 1,
                    minDate: new Date(),
                    maxDate: new Date(2040, 12, 31),
                    yearRange: [2020, 2040]
                });

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            // $('#pickUpTime').timepicker();
            var addtoCartURL="{{url('order-item/add-to-cart/json')}}";
            $.ajax({
                'async': false,
                'type': "GET",
                'global': false,
                'dataType': 'json',
                'url': addtoCartURL,
                'data': 
                {
                    '_token':"{{csrf_token()}}"
                },
                'success': function (data) {
                    var obj=data;
                    if(obj.rec==null) 
                    {
                        $("#orderModal").modal('show'); 
                        $("input[name=record]").click(function(){
                            var selecVal='';
                            var pickup_time='';
                            if(document.getElementById('record_0').checked==true)
                            {
                                $("#pickUp").modal('show');
                                $("#orderModal").modal('hide');
                                $( "#saveTime" ).click(function() {
                                    pickup_date = document.getElementById("pickUpDate").value;
                                    pickup_time = document.getElementById("pickUpTime").value;
                                    $("#pickUp").modal('hide');
                                    selecVal='Collect';
                                    var item_id=selecVal;
                                    var addtoCartURL="{{url('order-item/add-to-cart')}}";
                                    //------------------------Ajax POS Start-------------------------//
                                    $.ajax({
                                        'async': false,
                                        'type': "POST",
                                        'global': false,
                                        'dataType': 'json',
                                        'url': addtoCartURL,
                                        'data': {'rec':item_id, 'pickup_time':pickup_time, 'pickup_date':pickup_date, '_token':"{{csrf_token()}}"},
                                        'success': function (data) {
                                            loadCart(data);
                                            $("#orderModal").modal('hide');
                                        }
                                    });
                                });
                            }
                            else if(document.getElementById('record_1').checked==true)
                            {
                                // $("#searchPost").modal('show');
                                $("#orderModal").modal('hide');
                                selecVal='Delivery';
                            }
                            if(selecVal!='')
                            {
                                var item_id=selecVal;
                                var addtoCartURL="{{url('order-item/add-to-cart')}}";
                                //------------------------Ajax POS Start-------------------------//
                                $.ajax({
                                    'async': false,
                                    'type': "POST",
                                    'global': false,
                                    'dataType': 'json',
                                    'url': addtoCartURL,
                                    'data': {'rec':item_id, '_token':"{{csrf_token()}}"},
                                    'success': function (data) {
                                        loadCart(data);
                                        $("#orderModal").modal('hide');
                                    }
                                });
                            }
                        });
                    }

                }

            });
        });
    </script>

    <script>
        function incr(id) {
            var quantity = $(`#main_item_qty_${id}`);

            var price = $(`#product_price_${id}:checked`).val();

            var a = quantity.val();
            
            a++;
            quantity.val(a);
            $(`.priceOfItem_${id}`).html((price*a).toFixed(2));
            $(`#add_cart_btn_${id}`).attr("data-quantity", a);
        }
        function decr(id) {
            var quantity = $(`#main_item_qty_${id}`);

            var price = $(`#product_price_${id}:checked`).val();
            
            var b = quantity.val();
            if (b >= 1) {
                b--;
                quantity.val(b);
            }
            else {
                $(`#number_qty_decr_${id}`).prop("disabled", true);
            }
            $(`.priceOfItem_${id}`).html((price*b).toFixed(2));
            $(`#add_cart_btn_${id}`).attr("data-quantity", b);
        }
        function subcat(id, sub_id, price){
            $(`#main_item_qty_${id}`).val(1);
            $(`.priceOfItem_${id}`).html((price).toFixed(2));
            $(`.priceOfItem_${id}`).attr("data-price", (price).toFixed(2));
            $(`#add_cart_btn_${id}`).attr("data-extra-id", sub_id);
        }
    </script>
@endsection
