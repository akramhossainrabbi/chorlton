                <style type="text/css">
                    .cart-data-logo
                    {
                        height: 25px !important;
                    }
                    .item-display{ margin: 5px 10px;  }
                    .tab_right_header .cart_item{  margin: 4px 10px !important; }
                    .tab_right_header{ height: 46px !important;  }  
                    .mini-cart-total{ padding: 0 10px 6px 10px !important;  }
                    .mini-cart .checkout{ padding-top: 6px !important; }
                    .tab_right_sidebar{ padding-bottom: 6px !important;  }

                    .mini-cart-list li {
                        position: relative;
                        overflow: hidden;
                        border-bottom: 1px solid #E7E7E7;
                        padding-bottom: 5px;
                        margin-bottom: 5px;
                        padding-left: 5px;
                    }

                    .mini-cart-list a.remove {
                        position: absolute;
                        right: 5px;
                        top: 0;
                    }
                    .mini-cart-list a.remove i {
                        font-size: 130%;
                        color: #bababa;
                    }
                    .mini-cart-list a.remove:hover i {
                        color: #000;
                    }
                    /* .mini-cart-list a.remove {
                        left: 5px;
                        right: auto;
                    } */
                    /* width */
                    .mini-cart-list::-webkit-scrollbar {
                        width: 5px;
                    }

                    /* Track */
                    .mini-cart-list::-webkit-scrollbar-track {
                        background: #f1f1f1; 
                    }
                     
                    /* Handle */
                    .mini-cart-list::-webkit-scrollbar-thumb {
                        background: #888; 
                    }

                    /* Handle on hover */
                    .mini-cart-list::-webkit-scrollbar-thumb:hover {
                        background: #e7512f; 
                    }

                    .mini-cart .checkout a
                    {
                        padding: 0 10px;
                    }
                    .btn-proceed {
                        font-size: 14px;
                        color: #fff;
                        text-align: center;
                        border-radius: 6px;
                        text-transform: uppercase;
                        font-weight: 300;
                    }
                    .btn-proceed {
                        background: #0082ea;
                        border: none;
                        border-radius: 0px !important;
                        padding: 16px;
                        font-size: 16px !important;
                        font-weight: bold !important;
                        background: #fe2919;
                        background: #207dff;
                        background: -moz-linear-gradient(45deg, #207dff 0%, #00bd55 100%);
                        background: -webkit-gradient(left bottom, right top, color-stop(0%, #207dff), color-stop(100%, #00bd55));
                        background: -webkit-linear-gradient( 45deg , #9c27b0 0%, #4caf50 100%);
                        background: -o-linear-gradient(45deg, #207dff 0%, #00bd55 100%);
                        background: -ms-linear-gradient(45deg, #207dff 0%, #00bd55 100%);
                        background: linear-gradient( 45deg , #9c27b0 0%, #4caf50 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#207dff', endColorstr='#00bd55', GradientType=1 );
                    }

                    .wrapper{
                    display: inline-flex;
                    align-items: center;
                    justify-content: space-evenly;
                    border-radius: 5px;
                    }
                    .wrapper .option{
                    background: #fff;
                    height: 100%;
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: space-evenly;
                    margin: 0 10px;
                    border-radius: 5px;
                    cursor: pointer;
                    padding: 0 10px;
                    border: 2px solid lightgrey;
                    transition: all 0.3s ease;
                    }
                    .wrapper .option .dot{
                    height: 20px;
                    width: 20px;
                    background: #d9d9d9;
                    border-radius: 50%;
                    position: relative;
                    }
                    .wrapper .option .dot::before{
                    position: absolute;
                    content: "";
                    top: 4px;
                    left: 4px;
                    width: 12px;
                    height: 12px;
                    background: #0069d9;
                    border-radius: 50%;
                    opacity: 0;
                    transform: scale(1.5);
                    transition: all 0.3s ease;
                    }
                    input[type="radio"]{
                    display: none;
                    }
                    #rec_1:checked:checked ~ .rec_1,
                    #rec_0:checked:checked ~ .rec_0{
                    border-color: #0069d9;
                    background: #0069d9;
                    }
                    #rec_1:checked:checked ~ .rec_1 .dot,
                    #rec_0:checked:checked ~ .rec_0 .dot{
                    background: #fff;
                    }
                    #rec_1:checked:checked ~ .rec_1 .dot::before,
                    #rec_0:checked:checked ~ .rec_0 .dot::before{
                    opacity: 1;
                    transform: scale(1);
                    }
                    .wrapper .option span{
                    color: #808080;
                    }
                    #rec_1:checked:checked ~ .rec_1 span,
                    #rec_0:checked:checked ~ .rec_0 span{
                    color: #fff;
                    }

                    .coupon {
                    border-radius: 1px
                    }

                    .btn-apply {
                    font-size: 11px
                    } 
                </style>

                <div class="col col-12 col-lg-4 px-3 p-lg-0 mb-3">
                    <div style="position: sticky; top: 10px;">
                        <div name="cart-basket-navigate">
                            <section id="cart-Basket" class="basket-order-view my-3 p-2 p-lg-3 link-background">
                                <div class="row">
                                    <div class="inner center col-md-12 text-center mb-15 border-bottom">
                                        {{-- <a href="javascript:;" class="top10 green-color change-address block text-center" data-toggle="modal" data-target="#searchPost">
                                            <i class="fa fa-location-arrow" aria-hidden="true"></i> Search Postcode</a>
                                         --}}
                                        <p class="deliverd has-success" style="color: green;font-weight: bold;"></p>
                                        <p class="not-deliverd has-danger"></p>
                                    </div>
                                </div>
                                @if($tab->collection_only==1)
                                    <input style="display: none;"  type="radio" value="Delivery" name="rec" id="rec_1"> 
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="Collect" name="rec" id="rec_0" class="custom-control-input">
                                        <label class="custom-control-label" for="rec_0">Only Collection</label>
                                    </div>
                                @else
                                    <div class="text-center">
                                        {{-- <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" value="Delivery" name="rec" id="rec_1" class="custom-control-input">
                                            <label class="custom-control-label" for="rec_1">Delivery</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" value="Collect" name="rec" id="rec_0" class="custom-control-input">
                                            <label class="custom-control-label" for="rec_0">Collection</label>
                                        </div> --}}
                                        {{-- <label class="cell-5 btn btn-success">
                                            <input checked="checked" style="position: absolute; margin-top:8px; margin-left: -17px; " type="radio" value="Delivery" name="rec" id="rec_1"> 
                                            Delivery
                                        </label>
                                        <label class="cell-5 btn btn-success" style=" text-transform: capitalize; padding-left: 25px;">
                                            <input style="position: absolute; margin-top:8px; margin-left: -48px;" type="radio" value="Collect" name="rec" id="rec_0" checked="checked"> 
                                            <span>Collection</span>
                                        </label> --}}
                                        <div class="wrapper">
                                            <input type="radio" value="Delivery" name="rec" id="rec_1">
                                            <input type="radio" value="Collect" name="rec" id="rec_0">
                                              <label for="rec_1" class="option rec_1">
                                                <div class="dot"></div>
                                                 <span>Delivery</span>
                                                 </label>
                                              <label for="rec_0" class="option rec_0">
                                                <div class="dot"></div>
                                                 <span>Collection</span>
                                              </label>
                                        </div>
                                    </div>

                                @endif
                                
                                @if(isset($common))
                                    <div  data-disamount-type="{{$common->discount_option}}"  class="clearfix spend-discount" data-disamount-limit="{{$common->minimum_amount}}" data-discount="{{$common->discount_amount}}">
                                        @if(!empty($common->message))
                                            <div class="restaurantOffers">
                                                <p>{{$common->message}}</p>
                                            </div>
                                        @endif
                                    </div>
                                @elseif(isset($colndel))
                                    @foreach($colndel as $cnd)

                                        <div data-disamount-type="{{$cnd->discount_option}}" class="clearfix spend-discount-colndel spx-{{$cnd->discount_option}}" data-disamount-limit="{{$cnd->minimum_amount}}" data-discount="{{$cnd->discount_amount}}">
                                            @if(!empty($cnd->message))
                                            <div class="restaurantOffers">
                                                <p>{{$cnd->message}}</p>
                                            </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif

                                <div class="cart-cont" id="style-4">
                                    <span class="append_cart_item">		
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h3>
                                                            <span>Your Basket</span>
                                                            {{-- <span class="cart_item mini_shopping-cart-quantity text-center" style="display: inline; border-radius: 5px; margin-left: 3px;">0</span> --}}
                                                        </h3>
                                                    </div>
                                                    <h3 class="empty-cart" style="display: inline; color:red; cursor: pointer;">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <ul class="mini-cart-list">
                                                           
                                                </ul>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                                <div class="container-fluid">
                                    <div class="form-group"> <label>Have coupon?</label>
                                        <div class="input-group"> 
                                            <input type="text" class="form-control coupon" id="promo_code" placeholder="Coupon code"> 
                                            <span class="input-group-append"> 
                                                <button class="btn btn-primary btn-apply coupon" id="coupon_submit">Apply</button> 
                                            </span> 
                                        </div>
                                    </div>
                                </div>
                                <div class="mini-cart-total">
                                    <div class="clearfix d-flex">
                                        <div class="left">Sub-Total:</div>
                                        <div class="right">£<span id="mini_cart_subtotal">0.00</span></div>
                                    </div>
                                    @if(isset($tax))
                                        <div class="clearfix tax-space d-flex">
                                            <div class="left">Tax (<span data-type="1">{{$tax->tax_amount}}</span>):</div>
                                            <div class="right">£<span>0.00</span></div>
                                        </div>
                                    @endif
    
                                    {{-- <div class="clearfix extradeliverycharge-space d-flex">
                                        <div class="left">Extra Charge <span></span>:</div>
                                        <div class="right">£<span>0.00</span></div>
                                    </div> --}}
    
                                    <div class="clearfix discount-space d-flex">
                                        <div class="left">Discount <span></span>:</div>
                                        <div class="right discount">£<span>0.00</span></div>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                    <div class="clearfix d-flex">
                                        <div class="left">Total:</div>
                                        <div class="right total-cart-check-price">£<span>0.20</span></div>
                                    </div>
                                </div>
                                
                                <!-- Button trigger modal -->
                                @if ($orderINfoText->isoffline==0)
                                <div class="checkout text-center">
                                    {{-- <a class="btn btn-success empty-cart" href="javascript:void(0);">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        Empty Cart</a>
                                    <a class="btn btn-success checkout-page" href="javascript:void(0);">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        Checkout 
                                    </a> --}}
                                    <button type="button" class="btn btn-proceed btn-lg btn-block checkout-page"><span>Checkout</span></button>
                                </div>
                                @endif
                                <a class="allergy modal-trigger online-smart-way fx animated fadeInUp" data-animate="fadeInUp" data-modal="alergy_alert" data-animation-delay="600" style="animation-delay: 600ms;">
                                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Do you have an allergy or other dietary requirement?
                                </a>
                            </section>
                        </div>
                    </div>
                </div>
                