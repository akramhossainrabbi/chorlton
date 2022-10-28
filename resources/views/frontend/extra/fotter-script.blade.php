<!-- Load JS siles -->	
        <script type="text/javascript" src="{{url('front-theme/js/jquery.min.js')}}"></script>
        <script type="text/javascript">
                $(document).ready(function(){
                    var SHoppingCartJsonURL="{{url('shoppingCart')}}";
                    //------------------------Ajax POS Start-------------------------//
                    $.ajax({
                        'async': false,
                        'type': "GET",
                        'global': false,
                        'dataType': 'json',
                        'url': SHoppingCartJsonURL,
                        'data': 
                        {
                            '_token':"{{csrf_token()}}"
                        },
                        'success': function (data) {
                            //tmp = data;
                            //console.log('return url',data);
                            loadMinTopCart(data);
                        }
                    });
                    //------------------------Ajax POS End---------------------------//
                });


        function loadMinTopCart(data)
        {
                var obj=data;


                var specialItemPrice=0;
                if(obj.items)
                {
                    var specialItemID="{{env('SPECIALSETMENUID')}}";
                    $.each(obj.items,function(key,row){
                            //console.log(row);
                            var line=row.item;
                            var cid=line.cid;
                           // console.log(cid);
                            if(cid==specialItemID){
                                specialItemPrice+=(line.price * row.qty);
                            }
                            
                    });
                }

                console.log('Special Item Price =',specialItemPrice);



                console.log(obj.rec);
                var tax_rate=$(".top-shopping-cart-short").attr('data-tax-amount');
                var tax=0;
                if(tax_rate)
                {

                        var tax_type = tax_rate.match(/%/g);
                        if(tax_type=='%')
                        {
                                var actual_rate = parseFloat(tax_rate.replace("%", "")).toFixed(2);
                                tax             = parseFloat((obj.totalPrice*actual_rate)/100).toFixed(2);
                        }
                        else
                        {
                                tax             = parseFloat(tax_rate).toFixed(2);
                        }
                }

                var discount=0;
                var discount_rate=0;
                var limit_check=0;
                //alert(obj.rec);
                var limit_check=$(".top-shopping-cart-short").attr("data-disamount-limit");
                var discount_rate=$(".top-shopping-cart-short").attr("data-discount");
                if(obj.rec=="Collect")
                {
                    var limit_check=$(".top-shopping-cart-short").attr("data-disamount-limit");
                    var discount_rate=$(".top-shopping-cart-short").attr("data-discount");
                }
                else if(obj.rec=="Delivery")
                {
                    var limit_check=$(".top-shopping-cart-short").attr("data-delivery-disamount-limit");
                    var discount_rate=$(".top-shopping-cart-short").attr("data-delivery-discount");
                }

                //alert($(".top-shopping-cart-short").html());

                console.log(limit_check,discount_rate);
                
                if(discount_rate)
                {
                        var discount_type = tax_rate.match(/%/g);
                        if(discount_type=='%')
                        {
                                

                                if(limit_check>0 && (obj.totalPrice-specialItemPrice)<limit_check)
                                {
                                        var amount_to_get_discount=limit_check-(obj.totalPrice-specialItemPrice);
                                        discount='0.00';
                                }
                                else 
                                {
                        var actual_discount_rate = parseFloat(discount_rate.replace("%", "")).toFixed(2);
                        discount        = parseFloat(((obj.totalPrice-specialItemPrice)*actual_discount_rate)/100).toFixed(2);
                                }
                        }
                        else
                        {
                                if(limit_check>0 && (obj.totalPrice-specialItemPrice)<limit_check)
                                {
                                        var amount_to_get_discount=limit_check-(obj.totalPrice-specialItemPrice);
                                        discount='0.00';
                                }
                                else
                                {
                                        discount        = parseFloat(discount_rate).toFixed(2);
                                }
                        }

                }
            
                var extraDeliveryCharge=0.00;
                if(obj.rec=="Delivery")
                {
                    if(parseFloat(obj.totalPrice)>14.99)
                    {
                        extraDeliveryCharge=0.00;
                        console.log('extraDeliveryCharge=',extraDeliveryCharge);
                    }
                    else
                    {
                        if(parseFloat(obj.totalPrice)>0)
                        {
                            extraDeliveryCharge=0.00;
                            console.log('extraDeliveryCharge=',extraDeliveryCharge);
                        }
                        else
                        {
                            extraDeliveryCharge=0.00;
                            console.log('extraDeliveryCharge=',extraDeliveryCharge);
                        }
                        
                    }
                }
            
                var totalSubPrice=((obj.totalPrice-0)+(extraDeliveryCharge-0)-tax)-discount;
                if(parseFloat(totalSubPrice)<0)
                {
                    totalSubPrice=0;
                }

                var totalQty=obj.totalQty;

                if(parseFloat(totalQty)<0)
                {
                    totalQty=0;
                }

                console.log(totalQty,totalSubPrice);




                $(".top-shopping-cart-short").children("a").html(totalQty+" item(s) - £"+parseFloat(totalSubPrice).toFixed(2));

                if($(".mobileCartMenuShortCartData"))
                {
                    $(".mobileCartMenuShortCartData").html(totalQty+" item(s) - £"+parseFloat(totalSubPrice).toFixed(2));
                }
        }

        </script>

         <script src="{{ asset('new_design/assets/frontend/js/jquery.min.js') }}"></script>
         <script src="{{ asset('new_design/assets/frontend/js/jquery-migrate-3.0.1.min.js') }}"></script>
       <!--   <script src="assets/frontend/js/popper.min.js"></script> -->
         <script src="{{ asset('new_design/assets/frontend/js/bootstrap.min.js') }}"></script>
         <!-- <script src="assets/frontend/js/jquery.easing.1.3.js"></script> -->
         <script src="{{ asset('new_design/assets/frontend/js/jquery.waypoints.min.js') }}"></script>
         <script src="{{ asset('new_design/assets/frontend/js/jquery.stellar.min.js') }}"></script>
         {{-- <script src="assets/frontend/js/bootstrap-datepicker.js"></script> --}}
         {{-- <script src="assets/frontend/js/jquery.timepicker.min.js"></script> --}}
         <script src="{{ asset('new_design/assets/frontend/js/owl.carousel.min.js') }}"></script>
         <script src="{{ asset('new_design/assets/frontend/js/jquery.magnific-popup.min.js') }}"></script>
         <script src="{{ asset('new_design/assets/frontend/js/main.js') }}"></script>
       
       
        <script>
       //     $(document).ready(function(){
       //   let $button =$(".btn-primary");
       //   $button.click(function(){
       //         $(".panel-collapse").toggle()
       
       //         var $this = $(this);
       //         $this.toggleClass('.btn-primary');
       //         if(!$this.hasClass('.btn-primary')){
       //          $this.text('Hide all');
       //         } else {
       //          $this.text('Show all');
       //          }
       //     });
       // });
        </script>
       
       
       <script>
       $(document).ready(function()
       {
           $("a[href^='#']").bind("click",function(){
           var target = $(this).attr("href");
           var elmnt = document.getElementById(target);
           elmnt.scrollIntoView();
         });
       });
       </script>
       
       <script src="{{ asset('new_design/assets/frontend/js/common.js') }}"></script> 
       
        <!-- Waypoints script -->
        <script type="text/javascript" src="{{url('front-theme/js/waypoints.min.js')}}"></script>
        @yield('slider-js')
        <!-- Input placeholder plugin -->
        <script type="text/javascript" src="{{url('front-theme/js/jquery.placeholder.js')}}"></script>


        <!-- Tweeter API plugin -->
        <script type="text/javascript" src="{{url('front-theme/js/jflickrfeed.min.js')}}"></script>

        <!-- general script file -->
        <script type="text/javascript" src="{{url('front-theme/js/script.js')}}"></script>