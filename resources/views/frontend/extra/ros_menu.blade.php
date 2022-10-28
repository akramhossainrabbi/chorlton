
<div class="col col-lg-3 col-6 d-none d-lg-block mb-3 ftco-faqs img">
    <div style="position: sticky; top: 10px;">
    <section id="menu-category" class=" p-lg-3 my-3 link-background" data-spy="affix">
        {{-- <h3>ITEMS</h3> --}}
        <ul class="nav flex-column" id="ul-scroll-category" style="max-height: 568px;">
        @if(count($category)>0)
        @foreach($category as $cat)
        <li class="nav-item d-block">
            <a class="nav-link" href="#cat_{{$cat['id']}}">{{$cat['name']}}</a>
        </li>
        @endforeach
        @endif              
        </ul>
    </section>
    </div>
</div>
<div class="col col-12 col-lg-5 search-takeaways pl-lg-0 mb-3">
    <div class="accordion">
        <div class="card">
            <?php 
            $modal='';
            //dd($category);
            ?>
            @if(count($category)>0)
                @foreach($category as $cat)
                    
                    <div class="clearfix"></div>
                    <div class="padd-top-20"></div>
                    <div class="card">
                        <div class="card-header">
                            <a href="#cat_{{$cat['id']}}" id="#cat_{{$cat['id']}}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link">
                                        <div name="TO START">
                                        <div class="card-header border-0 collapsed">
                                        <span class="card-title">{{$cat['name']}}</span>
                                        </div>
                                        </div>
                                    </button>
                            </h5>
                            </a>
                        </div>
                    <?php
                    if($cat['layout']==1 || $cat['layout']==4){
                        if(isset($cat['product_row']))
                        {

                            ?>
                            <div class="card-body">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody id="place_pro_{{$cat['id']}}">
                                        @if(!empty($cat['description']))
                                            <tr>
                                                <td colspan="3">
                                                    <p class="proDes" style="text-transform: capitalize;  font-style: italic !important;">
                                                        <?php echo strip_tags(html_entity_decode($cat['description']));?>
                                                    </p>
                                                </td>
                                            </tr>
                                        @endif
                                        <?php 
                                        foreach ($cat['product_row'] as $key => $row) 
                                        {
                                            $interface=$row['interface'];
                                        ?>
                                            <tr>
                                                <td width="80%">
                                                    <span class="proName">{{$row['name']}}</span>
                                                    <p class="proDes" style=" font-style: italic !important;">
                                                        <?php echo strip_tags(html_entity_decode($row['description'])); ?>
                                                    </p>
                                                </td>
                                                <td><span style="font-weight: 900;">
                                                @if($interface==3)
                                                <?php 
                                                $min_prince_row=0; 
                                                foreach($row['modal'] as $key=>$mod):
                                                    if($min_prince_row>0)
                                                    {
                                                        if($min_prince_row>$mod['price'])
                                                        {
                                                            $min_prince_row=$mod['price'];
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $min_prince_row=$mod['price'];
                                                    }
                                                endforeach;
                                                echo "£".$min_prince_row;
                                                ?>
                                                @else
                                                    £{{$row['price']}}
                                                @endif
                                                </span></td>
                                                <td align="right">
                                                    <div class="prosec">
                                                        @if($interface==5)
                                                            <a href="javascript:void(0);" class="button-cart_wop button proButton modal-trigger" data-modal="pizza_modal_name_{{$row['id']}}"><i class="fa fa-plus"></i></a>
                                                        @elseif($interface==4)
                                                            <a href="javascript:void(0);" class="button-cart_wop button proButton modal-trigger" data-modal="ex_modal-name_{{$row['id']}}"><i class="fa fa-plus"></i></a>
                                                        @elseif($interface==3)
                                                            <a href="javascript:void(0);" class="button-cart_wop button proButton modal-trigger" data-modal="other_modal_name_{{$row['id']}}"><i class="fa fa-plus"></i></a>
                                                        @elseif($interface==2)
                                                            &nbsp;
                                                        @else
                                                        <p class="proPrice">
                                                            
                                                            <div style="height: 0px; width: 0px; overflow: hidden;">
                                                                <img src="{{url('front-theme/images/cart-icon.png')}}">
                                                            </div>
                                                            <a href="javascript:void(0);" data-id="{{$row['id']}}" class="proButton" data-toggle="modal" data-target="#itemModalCenter{{ $row['id'] }}"><i class="fa fa-plus"></i></a>
                                                        </p>
                                                        @endif



                                                        @php
                                                        $modal.= '<div class="modal fade" id="itemModalCenter'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-modal="true" style="z-index: 9999;">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title">'.$row['name'].'</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body bg-white container">
                                                                        <form name="add_to_cart_form" id="add_to_cart_form">
                                                                            <div class="row">
                                                                                <h4 class="col-md-12">'.$row['name'].'</h4><br>
                                                                                <p class="col-md-12">'.strip_tags(html_entity_decode($row['description'])).'</p>
                                                                            </div>
                                                                            
                                                                            <div class="row price">
                                                                                <h4 class="col-md-12 heading">Price</h4>
                                                                                <hr>';
                                                                                $price = 0;
                                                                                if($interface==3){
                                                                                        $min_prince_row=0; 
                                                                                        foreach($row['modal'] as $key=>$mod){
                                                                                            if($min_prince_row>0)
                                                                                            {
                                                                                                if($min_prince_row>$mod['price'])
                                                                                                {
                                                                                                    $min_prince_row=$mod['price'];
                                                                                                }
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                $min_prince_row=$mod['price'];
                                                                                            }
                                                                                        };
                                                                                        $price = $min_prince_row;                            
                                                                                    }else{
                                                                                        if(!empty($row['price'])){
                                                                                            $price = $row['price'];
                                                                                        }
                                                                                    }
                                                                                    $modal.='<div class="custom-control custom-radio mb-3 ml-3">';
                                                                                        $modal.='<input class="custom-control-input" type="radio" name="exampleRadios'.$row['id'].'" id="product_price_'.$row['id'].'" value="'.$price.'" checked>
                                                                                                <label class="custom-control-label" for="product_price_'.$row['id'].'">
                                                                                                    '.$price.'
                                                                                                </label>';
                                                                                    $modal.='</div>';
                                                                                $modal.='</div>
                                                                                                   
                                                                            <div class="row quantity">
                                                                                <h4 class="col-md-12 heading">Quantity</h4>
                                                                                <hr>
                                                                                <div class="col-md-12 row">
                                                                                    <div class="product__details__quantity col-md-3">
                                                                                        <div class="quantity">
                                                                                            <div class="pro-qty product_qty_hgt">
                                                                                                <span class="product_count_item number-qty-decr  qtybtn popqnty-dec" id="number_qty_decr'.$row['id'].'" onclick="return decr('.$row['id'].')">-</span>
                                                                                                    <input class="product_count_item number-qty main_item_qty popqnty-num" id="main_item_qty_'.$row['id'].'" type="text" value="1" min="1" max="10">
                                                                                                <span class="product_count_item number-qty-incrs  qtybtn popqnty-inc" onclick="return incr('.$row['id'].')">+</span>
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
                                                                    <span class="priceOfItem_'.$row['id'].'">'.$price.'</span>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-primary add-cart" id="add_cart_btn_'.$row['id'].'" data-id="'.$row['id'].'" data-quantity="1">Add To Cart</button>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>';
                                                        @endphp
                                                    </div>
                                                </td>
                                            </tr>
                                            @if($interface==2)

                                                @foreach($row['ProductOneSubLevel'] as $dt)
                                                <tr>
                                                    <td>
                                                        <span class="proName">{{$dt['name']}}</span>
                                                    </td>
                                                    <td><span>£{{$dt['price']}}</span></td>
                                                    <td align="right">
                                                        <div class="prosec">
                                                            <p class="proPrice">
                                                                
                                                                <div style="height: 0px; width: 0px; overflow: hidden;">
                                                                    <img src="{{url('front-theme/images/cart-icon.png')}}">
                                                                </div>
                                                                <a  href="javascript:void(0);" data-name-snd="{{$dt['name']}}"  data-id="{{$row['id']}}" snd-data-id="{{$dt['id']}}" snd-data-price="{{$dt['price']}}" ex-class="add-snd-subcat-cart" name="dddd"  class="add-snd-cart proButton">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            @endif
                                        <?php
                                            
                                            if($interface==5)
                                            {
                                                $modal_name_pizza="pizza_modal_name_".$row['id'];
                                                $modal.='<div class="modal" data-array="" id="'.$modal_name_pizza.'">
                                                            <div class="modal-sandbox"></div>
                                                            <div class="modal-box">
                                                                <div class="modal-header">
                                                                    <div class="close-modal">&#10006;</div> 
                                                                    <h4><i class="fa fa-info-circle"></i> '.$row['name'].' </h4>
                                                                </div>
                                                                <div class="modal-body modal_fixer">';

                                                            $modal.='<div class="col-md-12">';

                                                            

                                                            $modal.='<section class="custom-radio-section-two data-select-place" id="data-select-place"></section>

                                                                    <div class="menu_options-header"><h2 style="margin-bottom: 0px !important;">Select option:</h2></div>';


                                                            if(isset($row['PizzaSize']))
                                                            {
                                                                $modal.='<section class="custom-radio-section custom-border-style-bottom" id="dta-category">';
                                                            
                                                                foreach ($row['PizzaSize'] as $pzkey => $pz) {

                                                                    $modal.='<div class="custom-radio-input-group selection-category-part">
                                                                            <input data-modal-id="'.$modal_name_pizza.'"  class="pizza-check-category" type="radio" id="control_'.str_replace(' ','_',strtolower($row['id'])).'_'.$pzkey.'" name="'.str_replace(' ','_',strtolower($row['id'])).'" value="'.$pz['id'].'">
                                                                            <label for="control_'.str_replace(' ','_',strtolower($row['id'])).'_'.$pzkey.'" class="custom-radio-input-group-border-bottom">
                                                                                <p style="margin: 0px !important;">'.$pz['name'].'</p>
                                                                            </label>
                                                                            </div>';

                                                                }

                                                            


                                                            $modal.='
                                                                    </section>';
                                                            }



                                                        if(isset($row['PizzaFlabour']))
                                                        {

                                                        $modal.='<section class="custom-radio-section custom-border-style-bottom sub-category" id="sub-category_'.$row['id'].'" style="display: none !important;">';


                                                                foreach ($row['PizzaFlabour'] as $pzskey => $psz) {
                                                                $modal.='<div class="custom-radio-input-group selection-subcat-part">
                                                                        <input class="pizza-check-subcat" data-modal-id="'.$modal_name_pizza.'"  type="radio" id="control_'.str_replace(' ','_',strtolower($row['name'])).'_'.$pzskey.'" name="'.str_replace(' ','_',strtolower($row['name'])).'_subcat" value="'.$psz['id'].'">
                                                                        <label for="control_'.str_replace(' ','_',strtolower($row['name'])).'_'.$pzskey.'" class="custom-radio-input-group-border-bottom">
                                                                            <p style="margin: 0px !important;">'.$psz['name'].'</p>
                                                                        </label>
                                                                        </div>';
                                                                }

                                                            }

                                                            $modal.='</section>';


                                                            if(isset($row['pizzaExtra']))
                                                            {
                                                            $modal.='<style type="text/css">
                                                                        .table-under-quantity{ padding-right: 5px; }
                                                                        .table-under-quantity tbody tr td .proDesc a{ font-size:25px; }
                                                                        .table-under-quantity tbody tr td .proDesc{ line-height: 25px; font-size:15px; }
                                                                        .table-under-quantity tbody tr td{ border-bottom:2px #fff solid; }
                                                                        .table-under-quantity tbody tr td{ font-size: 20px !important;  padding-left: 5px; }
                                                                    </style>';


                                                            $modal.='<table class="table-under-quantity cat-extra-table" cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>';
                                                                            
                                                                        foreach($row['pizzaExtra'] as $indK=>$kr){
                                                                                
                                                                            $modal.='<tr style="">
                                                                                        <td width="60%" style="">
                                                                                            <span class="proName">'.$kr['name'].'</span>
                                                                                            <p class="proDesc classExtraCalculate" style="display: none;" data-extra-name="'.$kr['name'].'">
                                                                                                <a href="javascript:void(0)" class="deductQTYPizza" style="margin-right: 30px;">
                                                                                                    <i class="fa fa-minus-circle" aria-hidden="true"></i> 
                                                                                                </a>
                                                                                                <span>0</span> 
                                                                                                <i class="fa fa-times" aria-hidden="true"></i> 
                                                                                                <span>'.$kr['price'].'</span>
                                                                                                =
                                                                                                <span>1</span>
                                                                                            </p>
                                                                                        </td>
                                                                                        <td width="20%"></td>
                                                                                        <td width="20%" align="right">

                                                                                            <div class="prosec">
                                                                                                <p class="proPrice" style="margin-bottom: 5px;"><span>£'.$kr['price'].'</span>
                                                                                                    <a href="javascript:void(0);" data-price="'.$kr['price'].'" data-id="'.$kr['id'].'"  data-modal-id="'.$modal_name_pizza.'"  class="proButton add-to-extras"><i class="fa fa-plus"></i></a>
                                                                                                </p>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>';
                                                                                
                                                                            }
                                                                                
                                                                $modal.='</tbody>
                                                                    </table>';


                                                                    }





                                                        $modal.='</div>';     
                                                                
                                                        $modal.=' <div class="modal-footer" style="padding: 15px;">
                                                                        <button data-id="'.$row['id'].'" data-take="'.$modal_name_pizza.'" type="button" class="btn btn-primary left add-total-pizza-basket"  style="color: white; margin-bottom: 15px !important;">
                                                                            <i class="fa fa-shopping-cart"></i> <b>Skip Extras</b>
                                                                        </button>
                                                                        <span class="right" style="font-weight: 600; font-size: 16px; color: #000;">£<span class="totlabsk">'.$row['price'].'</span></span>
                                                                </div>';                
                                                            

                                                        $modal.='</div>
                                                            </div>
                                                    </div>';
                                            }
                                            elseif($interface==4)
                                            {
                                                $modal.='<div class="modal" id="ex_modal-name_'.$row['id'].'">
                                                            <div class="modal-sandbox"></div>
                                                            <div class="modal-box">
                                                                <div class="modal-header">
                                                                    <div class="close-modal">&#10006;</div> 
                                                                    <h4><i class="fa fa-info-circle"></i> '.$row['name'].'</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                        
                                                                    <form action="#" id="reg_form" style="padding-top:7px;">';

                                                            $im=0;
                                                            foreach($row['ProductOneSubLevel'] as $index=>$itm):
                                                            
                                                            $ikm='';
                                                            if(isset($row['ProductOneSubLevel'][$index+1]))
                                                            {
                                                                    $ikm=$row['ProductOneSubLevel'][$index+1]['is_parent'];
                                                            }

                                                            if((!empty($ikm) && $ikm!=0 && $ikm!='No Parent') && $im==0)
                                                            {
                                                                    $im=1;
                                                                    $modal.='<div class="form_popup bgbor" data-m="'.$ikm.'" data-id="'.$itm['is_parent'].'">
                                                                            <div class="back_popup">';
                                                            }
                                                            

                                                            if($im==0)
                                                            {
                                                                    $modal.='<div class="form_popup bgbor" data-m="'.$ikm.'" data-id="'.$itm['is_parent'].'">
                                                                            <div class="back_popup">';
                                                            }
                                                            

                                                            
                                                        
                                                            
                                                                    
                                                            
                                                            
                                                            
                                                                        $modal.='<div class="cell-4" style="padding-top:12px;">
                                                                                    <label>'.$itm['name'].'</label>
                                                                                </div>
                                                                                <div class="cell-8" style="padding-top:7px;">
                                                                                    <select required="" title="'.$itm['name'].'">';     
                                                                            foreach($itm['dropdown'] as $drp):
                                                                                    $modal.='<option value="'.trim($drp).'">'.trim($drp).'</option>';  
                                                                            endforeach;          
                                                                        $modal.='</select>
                                                                                </div><div class="clearfix"></div>';

                                                                
                                                                if((!empty($ikm) && $ikm!=0 && $ikm!='No Parent') && $im==1)
                                                                {
                                                                        $im=1;
                                                                }
                                                                else
                                                                {
                                                                        $modal.='</div>
                                                                            </div>';
                                                                        $im=0;
                                                                }


                                                                
                                                                
                                                                

                                                                    
                                                                        
                                                                    

                                                                

                                                                endforeach;        
                                                                        
                                                            $modal.='<div class="form_popup">
                                                                            <a data-id="'.$row['id'].'" href="javascript:void(0);" class="btn executive-set-menu btn-mid main-bg"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                                                                        </div>                
                                                                    </form>

                                                                </div>
                                                            </div>
                                                    </div>';
                                            }
                                            elseif($interface==3)
                                            {
                                                $modal.='<div class="modal" id="other_modal_name_'.$row['id'].'">
                                                            <div class="modal-sandbox"></div>
                                                            <div class="modal-box">
                                                                <div class="modal-header">
                                                                <div class="close-modal">&#10006;</div> 
                                                                <h4><i class="fa fa-info-circle"></i> '.$row['name'].'</h4>

                                                            </div>
                                                            <div class="modal-header-details">
                                                                <p align="center">
                                                                <br>
                                                                <b>Please select a option.</b><br>
                                                                </p>   
                                                            </div>
                                                            <div class="modal-body" style="padding-bottom:10px;">';

                                                foreach($row['modal'] as $key=>$mod):
                                                    $modal.='       <div class="cell-6">
                                                                    <a data-id="'.$row['id'].'" snd-data-id="'.$mod['id'].'" name="options" id="option_0" class="btn add-snd-cart btn-optionlist"><span class="pull-left">
                                                                                '.$mod['name'].'
                                                                        </span> 
                                                                        <span class="pull-right">
                                                                        £'.$mod['price'].'
                                                                        </span>
                                                                    </a>
                                                                    </div>';
                                                endforeach;

                                            $modal.='                
                                                        </div>
                                                    </div>
                                                    </div>';
                                            }

                                        }
                                        ?>         
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                    }
                    elseif($cat['layout']==2)
                    {
                        if(isset($cat['product_row']))
                        {
                            ?>
                            <div class="card-body">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody id="place_pro_{{$cat['id']}}">
                                        @if(!empty($cat['description']))
                                            <tr>
                                                <td colspan="3">
                                                    <p class="proDes" style="text-transform: capitalize;  font-style: italic !important;">
                                                        <?php echo strip_tags(html_entity_decode($cat['description']));?>
                                                    </p>
                                                </td>
                                            </tr>
                                        @endif
                                        <?php 
                            
                                        foreach ($cat['product_row'] as $key => $sc) 
                                        {
                                            ?>
                                            <tr>
                                                <td colspan="3">
                                                    <span class="proName">{{$sc['name']}}</span><br>
                                                    <i>{{strip_tags(html_entity_decode($sc['description']))}}</i>
                                                </td>
                                            <?php
                                            foreach ($sc['sub_product_row'] as $key => $row) 
                                            {
                                            
                                            $interface=$row['interface'];
                                            
                                            ?>
                                            @if($interface!=2)
                                            
                                            <tr>
                                                <td width="80%">
                                                    <p class="proDes">{{$row['name']}}
                                                        <i><?php echo strip_tags(html_entity_decode($row['description']))?'<br>'.strip_tags(html_entity_decode($row['description'])):'';?></i>
                                                    </p>
                                                </td>
                                                <td>
                                                <span style="font-weight: 900;">
                                                @if($interface==3)
                                                <?php 
                                                $min_prince_row=0; 
                                                foreach($row['modal'] as $key=>$mod):
                                                    if($min_prince_row>0)
                                                    {
                                                        if($min_prince_row>$mod['price'])
                                                        {
                                                            $min_prince_row=$mod['price'];
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $min_prince_row=$mod['price'];
                                                    }
                                                endforeach;
                                                    echo "£".$min_prince_row;
                                                ?>
                                                @else
                                                    @if(!empty($row['price']))
                                                        £{{$row['price']}}
                                                    @endif
                                                @endif
                                                </span>
                                                </td>
                                                <td align="right">

                                                    <div class="prosec">
                                                        @if($interface==5)
                                                            <a href="javascript:void(0);" class="button-cart_wop button proButton modal-trigger" data-modal="pizza_modal_name_{{$row['id']}}"><i class="fa fa-plus"></i></a>
                                                        @elseif($interface==4)
                                                            <a href="javascript:void(0);" class="button-cart_wop button proButton modal-trigger" data-modal="ex_modal-name_{{$row['id']}}"><i class="fa fa-plus"></i></a>
                                                        @elseif($interface==3)
                                                            <a href="javascript:void(0);" class="button-cart_wop button proButton modal-trigger" data-modal="other_modal_name_{{$row['id']}}"><i class="fa fa-plus"></i></a>
                                                        @elseif($interface==2)
                                                            &nbsp;
                                                        @else
                                                        <p class="proPrice">
                                                            
                                                            <div style="height: 0px; width: 0px; overflow: hidden;">
                                                                <img src="{{url('front-theme/images/cart-icon.png')}}">
                                                            </div>
                                                            <a href="javascript:void(0);" data-id="{{$row['id']}}"  data-sub-name="{{$sc['name']}}"  class="proButton" data-toggle="modal" data-target="#itemModalCenter{{ $row['id'] }}"><i class="fa fa-plus"></i></a>
                                                        </p>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>


                                            @php
                                                $modal.= '<div class="modal fade" id="itemModalCenter'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-modal="true" style="z-index: 9999;">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title">'.$row['name'].'</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body bg-white container">
                                                                <form name="add_to_cart_form" id="add_to_cart_form">
                                                                    <div class="row">
                                                                        <h4 class="col-md-12">'.$row['name'].'</h4><br>
                                                                        <p class="col-md-12">'.strip_tags(html_entity_decode($row['description'])).'</p>
                                                                    </div>
                                                                    
                                                                    <div class="row price">
                                                                        <h4 class="col-md-12 heading">Price</h4>
                                                                        <hr>';
                                                                        $price = 0;
                                                                        if($interface==3){
                                                                                $min_prince_row=0; 
                                                                                foreach($row['modal'] as $key=>$mod){
                                                                                    if($min_prince_row>0)
                                                                                    {
                                                                                        if($min_prince_row>$mod['price'])
                                                                                        {
                                                                                            $min_prince_row=$mod['price'];
                                                                                        }
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $min_prince_row=$mod['price'];
                                                                                    }
                                                                                };
                                                                                $price = $min_prince_row;                            
                                                                            }else{
                                                                                if(!empty($row['price'])){
                                                                                    $price = $row['price'];
                                                                                }
                                                                            }
                                                                            $modal.='<div class="custom-control custom-radio mb-3 ml-3">';
                                                                                $modal.='<input class="custom-control-input" type="radio" name="exampleRadios'.$row['id'].'" id="product_price_'.$row['id'].'" value="'.$price.'" checked>
                                                                                        <label class="custom-control-label" for="product_price_'.$row['id'].'">
                                                                                            '.$price.'
                                                                                        </label>';
                                                                            $modal.='</div>';
                                                                        $modal.='</div>                   
                                                                    <div class="row quantity">
                                                                        <h4 class="col-md-12 heading">Quantity</h4>
                                                                        <hr>
                                                                        <div class="col-md-12 row">
                                                                            <div class="product__details__quantity col-md-3">
                                                                                <div class="quantity">
                                                                                    <div class="pro-qty product_qty_hgt">
                                                                                        <span class="product_count_item number-qty-decr  qtybtn popqnty-dec" id="number_qty_decr'.$row['id'].'" onclick="return decr('.$row['id'].')">-</span>
                                                                                            <input class="product_count_item number-qty main_item_qty popqnty-num" id="main_item_qty_'.$row['id'].'" type="text" value="1" min="1" max="10">
                                                                                        <span class="product_count_item number-qty-incrs  qtybtn popqnty-inc" onclick="return incr('.$row['id'].')">+</span>
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
                                                                <span class="priceOfItem_'.$row['id'].'" data-price="'.$price.'">'.$price.'</span>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary add-cart" id="add_cart_btn_'.$row['id'].'" data-id="'.$row['id'].'" data-quantity="1">Add To Cart</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>';
                                                @endphp
                                            @endif
                                            @if($interface==2)
                                                <td align="right">

                                                    <div class="prosec">
                                                        <p class="proPrice">
                                                            
                                                            <div style="height: 0px; width: 0px; overflow: hidden;">
                                                                <img src="{{url('front-theme/images/cart-icon.png')}}">
                                                            </div>
                                                            <a href="javascript:void(0);" data-id="{{$row['id']}}"  class="proButton" data-toggle="modal" data-target="#itemModalCenter{{ $sc['id'] }}"><i class="fa fa-plus"></i></a>
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php
                                            $modal.= '<div class="modal fade" id="itemModalCenter'.$sc['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-modal="true" style="z-index: 9999;">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title">'.$sc['name'].'</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body bg-white container">
                                                                <form name="add_to_cart_form" id="add_to_cart_form">
                                                                    <div class="row">
                                                                        <h4 class="col-md-12">'.$sc['name'].'</h4><br>
                                                                        <p class="col-md-12">'.strip_tags(html_entity_decode($sc['description'])).'</p>
                                                                    </div>
                                                                    
                                                                    <div class="row price">
                                                                        <h4 class="col-md-12 heading">Price</h4>
                                                                        <hr>';
                                                                        $price = 0;
                                                                        $dt_id = 0;
                                                                        foreach($row['ProductOneSubLevel'] as $dtkey => $dt){
                                                                            $modal.='<div class="form-check form-check-inline pl-3">';
                                                                            if ($dtkey == 0) {
                                                                                $price = $dt['price'];
                                                                                $dt_id = $dt['id'];
                                                                                $modal.='<label class="form-check-label">
                                                                                        <input class="form-check-input" type="radio" name="product_price_'.$row['id'].'" id="product_price_'.$row['id'].'" value="'.$dt['price'].'" style="-webkit-appearance: radio; display:block !important;" onclick="return subcat('.$row['id'].', '.$dt['id'].', '.$dt['price'].')" checked>
                                                                                            '.$dt['name'].' £'.$dt['price'].'
                                                                                        </label>';
                                                                            }else{
                                                                                $modal.='<label class="form-check-label">
                                                                                        <input class="form-check-input" type="radio" name="product_price_'.$row['id'].'" id="product_price_'.$row['id'].'" value="'.$dt['price'].'" style="-webkit-appearance: radio; display:block !important;" onclick="return subcat('.$row['id'].', '.$dt['id'].', '.$dt['price'].')">
                                                                                            '.$dt['name'].' £'.$dt['price'].'
                                                                                        </label>';
                                                                            }
                                                                            $modal.='</div>';
                                                                        }
                                                                        
                                                                        $modal.='</div>
                                                                                           
                                                                    <div class="row quantity">
                                                                        <h4 class="col-md-12 heading">Quantity</h4>
                                                                        <hr>
                                                                        <div class="col-md-12 row">
                                                                            <div class="product__details__quantity col-md-3">
                                                                                <div class="quantity">
                                                                                    <div class="pro-qty product_qty_hgt">
                                                                                        <span class="product_count_item number-qty-decr  qtybtn popqnty-dec" id="number_qty_decr'.$row['id'].'" onclick="return decr('.$row['id'].')">-</span>
                                                                                            <input class="product_count_item number-qty main_item_qty popqnty-num" id="main_item_qty_'.$row['id'].'" type="text" value="1" min="1" max="10">
                                                                                        <span class="product_count_item number-qty-incrs  qtybtn popqnty-inc" onclick="return incr('.$row['id'].')">+</span>
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
                                                            <span class="priceOfItem_'.$row['id'].'" data-price="'.$price.'">'.$price.'</span>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary add-subcat-cart" id="add_cart_btn_'.$row['id'].'" data-extra-id="'.$dt_id.'" data-sub-id="'.$sc['id'].'"  data-sub-name="'.$sc['name'].'"  data-id="'.$row['id'].'" data-quantity="1">Add To Cart</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>';
                                            ?>
                                                {{-- @foreach($row['ProductOneSubLevel'] as $dt)
                                                <tr>
                                                    <td width="60%" align="left" valign="top">
                                                        <span class="proName" style="font-weight: 100 !important;">{{$dt['name']}}</span>
                                                    </td>
                                                    <td align="right" style="font-weight: bold;"><span>£{{$dt['price']}}</span></td>
                                                    <td width="20%" align="right" valign="top">
                                                        <div class="prosec">
                                                            <p class="proPrice">
                                                                
                                                                <div style="height: 0px; width: 0px; overflow: hidden;">
                                                                    <img src="{{url('front-theme/images/cart-icon.png')}}">
                                                                </div>
                                                                <a href="javascript:void(0);"  data-extra-id="{{$dt['id']}}"  data-sub-name="{{$sc['name']}}"  data-id="{{$row['id']}}" class="proButton add-subcat-cart"><i class="fa fa-plus"></i></a>
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach --}}
                                            @endif
                                        <?php
                                            if($interface==5)
                                            {
                                                $modal_name_pizza="pizza_modal_name_".$row['id'];
                                                $modal.='<div class="modal" data-array="" id="'.$modal_name_pizza.'">
                                                            <div class="modal-sandbox"></div>
                                                            <div class="modal-box">
                                                                <div class="modal-header">
                                                                    <div class="close-modal">&#10006;</div> 
                                                                    <h4><i class="fa fa-info-circle"></i> '.$row['name'].' </h4>
                                                                </div>
                                                                <div class="modal-body modal_fixer">';

                                                            $modal.='<div class="col-md-12">';

                                                            

                                                            $modal.='<section class="custom-radio-section-two data-select-place" id="data-select-place"></section>

                                                                    <div class="menu_options-header"><h2 style="margin-bottom: 0px !important;">Select option:</h2></div>';


                                                            if(isset($row['PizzaSize']))
                                                            {
                                                                $modal.='<section class="custom-radio-section custom-border-style-bottom" id="dta-category">';
                                                            
                                                                foreach ($row['PizzaSize'] as $pzkey => $pz) {

                                                                    $modal.='<div class="custom-radio-input-group selection-category-part">
                                                                            <input data-modal-id="'.$modal_name_pizza.'"  class="pizza-check-category" type="radio" id="control_'.str_replace(' ','_',strtolower($row['id'])).'_'.$pzkey.'" name="'.str_replace(' ','_',strtolower($row['id'])).'" value="'.$pz['id'].'">
                                                                            <label for="control_'.str_replace(' ','_',strtolower($row['id'])).'_'.$pzkey.'" class="custom-radio-input-group-border-bottom">
                                                                                <p style="margin: 0px !important;">'.$pz['name'].'</p>
                                                                            </label>
                                                                            </div>';

                                                                }

                                                            


                                                            $modal.='
                                                                    </section>';
                                                            }



                                                        if(isset($row['PizzaFlabour']))
                                                        {

                                                        $modal.='<section class="custom-radio-section custom-border-style-bottom sub-category" id="sub-category_'.$row['id'].'" style="display: none !important;">';


                                                                foreach ($row['PizzaFlabour'] as $pzskey => $psz) {
                                                                $modal.='<div class="custom-radio-input-group selection-subcat-part">
                                                                        <input class="pizza-check-subcat" data-modal-id="'.$modal_name_pizza.'"  type="radio" id="control_'.str_replace(' ','_',strtolower($row['name'])).'_'.$pzskey.'" name="'.str_replace(' ','_',strtolower($row['name'])).'_subcat" value="'.$psz['id'].'">
                                                                        <label for="control_'.str_replace(' ','_',strtolower($row['name'])).'_'.$pzskey.'" class="custom-radio-input-group-border-bottom">
                                                                            <p style="margin: 0px !important;">'.$psz['name'].'</p>
                                                                        </label>
                                                                        </div>';
                                                                }

                                                            }

                                                            $modal.='</section>';


                                                            if(isset($row['pizzaExtra']))
                                                            {
                                                            $modal.='<style type="text/css">
                                                                        .table-under-quantity{ padding-right: 5px; }
                                                                        .table-under-quantity tbody tr td .proDesc a{ font-size:25px; }
                                                                        .table-under-quantity tbody tr td .proDesc{ line-height: 25px; font-size:15px; }
                                                                        .table-under-quantity tbody tr td{ border-bottom:2px #fff solid; }
                                                                        .table-under-quantity tbody tr td{ font-size: 20px !important;  padding-left: 5px; }
                                                                    </style>';


                                                            $modal.='<table class="table-under-quantity cat-extra-table" cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>';
                                                                            
                                                                        foreach($row['pizzaExtra'] as $indK=>$kr){
                                                                                
                                                                            $modal.='<tr style="">
                                                                                        <td width="60%" style="">
                                                                                            <span class="proName">'.$kr['name'].'</span>
                                                                                            <p class="proDesc classExtraCalculate" style="display: none;" data-extra-name="'.$kr['name'].'">
                                                                                                <a href="javascript:void(0)" class="deductQTYPizza" style="margin-right: 30px;">
                                                                                                    <i class="fa fa-minus-circle" aria-hidden="true"></i> 
                                                                                                </a>
                                                                                                <span>0</span> 
                                                                                                <i class="fa fa-times" aria-hidden="true"></i> 
                                                                                                <span>'.$kr['price'].'</span>
                                                                                                =
                                                                                                <span>1</span>
                                                                                            </p>
                                                                                        </td>
                                                                                        <td width="20%"></td>
                                                                                        <td width="20%" align="right">

                                                                                            <div class="prosec">
                                                                                                <p class="proPrice" style="margin-bottom: 5px;"><span>£'.$kr['price'].'</span>
                                                                                                    <a href="javascript:void(0);" data-price="'.$kr['price'].'" data-id="'.$kr['id'].'"  data-modal-id="'.$modal_name_pizza.'"  class="proButton add-to-extras"><i class="fa fa-plus"></i></a>
                                                                                                </p>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>';
                                                                                
                                                                            }
                                                                                
                                                                $modal.='</tbody>
                                                                    </table>';


                                                                    }





                                                        $modal.='</div>';     
                                                                
                                                        $modal.=' <div class="modal-footer" style="padding: 15px;">
                                                                        <button data-id="'.$row['id'].'" data-take="'.$modal_name_pizza.'" type="button" class="btn btn-primary left add-total-pizza-basket"  style="color: white; margin-bottom: 15px !important;">
                                                                            <i class="fa fa-shopping-cart"></i> <b>Skip Extras</b>
                                                                        </button>
                                                                        <span class="right" style="font-weight: 600; font-size: 16px; color: #000;">£<span class="totlabsk">'.$row['price'].'</span></span>
                                                                </div>';                
                                                            

                                                        $modal.='</div>
                                                            </div>
                                                    </div>';
                                            }
                                            elseif($interface==4)
                                            {
                                                $modal.='<div class="modal" id="ex_modal-name_'.$row['id'].'">
                                                            <div class="modal-sandbox"></div>
                                                            <div class="modal-box">
                                                                <div class="modal-header">
                                                                    <div class="close-modal">&#10006;</div> 
                                                                    <h4><i class="fa fa-info-circle"></i> MEAL FOR 2 PERSONS</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                        
                                                                    <form action="#" id="reg_form" style="padding-top:7px;">';


                                

                                                                $im=0;
                                                            foreach($row['ProductOneSubLevel'] as $index=>$itm):
                                                            
                                                            $ikm='';
                                                            if(isset($row['ProductOneSubLevel'][$index+1]))
                                                            {
                                                                    $ikm=$row['ProductOneSubLevel'][$index+1]['is_parent'];
                                                            }

                                                            if((!empty($ikm) && $ikm!=0 && $ikm!='No Parent') && $im==0)
                                                            {
                                                                    $im=1;
                                                                    $modal.='<div class="form_popup bgbor" data-m="'.$ikm.'" data-id="'.$itm['is_parent'].'">
                                                                            <div class="back_popup">';
                                                            }
                                                            

                                                            if($im==0)
                                                            {
                                                                    $modal.='<div class="form_popup bgbor" data-m="'.$ikm.'" data-id="'.$itm['is_parent'].'">
                                                                            <div class="back_popup">';
                                                            }
                                                            

                                                            
                                                        
                                                            
                                                                    
                                                            
                                                            
                                                            
                                                                        $modal.='<div class="cell-4" style="padding-top:12px;">
                                                                                    <label>'.$itm['name'].'</label>
                                                                                </div>
                                                                                <div class="cell-8" style="padding-top:7px;">
                                                                                    <select required="" title="'.$itm['name'].'">';     
                                                                            foreach($itm['dropdown'] as $drp):
                                                                                    $modal.='<option value="'.trim($drp).'">'.trim($drp).'</option>';  
                                                                            endforeach;          
                                                                        $modal.='</select>
                                                                                </div><div class="clearfix"></div>';

                                                                
                                                                if((!empty($ikm) && $ikm!=0 && $ikm!='No Parent') && $im==1)
                                                                {
                                                                        $im=1;
                                                                }
                                                                else
                                                                {
                                                                        $modal.='</div>
                                                                            </div>';
                                                                        $im=0;
                                                                }



                                                                endforeach;        
                                                                        
                                                            $modal.='<div class="form_popup">
                                                                            <a data-id="'.$row['id'].'" href="javascript:void(0);" class="btn executive-set-menu btn-mid main-bg"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                                                                        </div>                
                                                                    </form>

                                                                </div>
                                                            </div>
                                                    </div>';
                                            }
                                            elseif($interface==3)
                                            {
                                                $modal.='<div class="modal" id="other_modal_name_'.$row['id'].'">
                                                            <div class="modal-sandbox"></div>
                                                            <div class="modal-box">
                                                                <div class="modal-header">
                                                                <div class="close-modal">&#10006;</div> 
                                                                <h4><i class="fa fa-info-circle"></i> '.$row['name'].'</h4>

                                                            </div>
                                                            <div class="modal-header-details">
                                                                <p align="center">
                                                                <br>
                                                                <b>Please select a option.</b><br>
                                                                </p>   
                                                            </div>
                                                            <div class="modal-body" style="padding-bottom:10px;">';

                                                foreach($row['modal'] as $key=>$mod):
                                                    $modal.='       <div class="cell-6">
                                                                    <a data-id="'.$row['id'].'" snd-data-id="'.$mod['id'].'" name="options" id="option_0" class="btn add-snd-cart btn-optionlist"><span class="pull-left">
                                                                                '.$mod['name'].'
                                                                        </span> 
                                                                        <span class="pull-right">
                                                                        £'.$mod['price'].'
                                                                        </span>
                                                                    </a>
                                                                    </div>';
                                                endforeach;
                                            $modal.='                
                                                        </div>
                                                    </div>
                                                    </div>';
                                            }
                                        }

                                        }
                                        ?>         
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    </div>
                @endforeach
            @endif 

        </div>
    </div>
</div>


<!--modal start area-->
    <!--modal 1 start here-->
    <style type="text/css" media="screen">
        .modal-header h4{ margin: 0px !important;  }
        .form_popup{max-width: 550px; padding: 5px;  font-weight: normal!important;}
        .form_popup label{font-size: 13px;}
        .modal-body,.back_popup{  display: block; overflow: hidden;}
        .bgbor{ background-color: #F9F9F9;border-bottom: 1px dashed #dddddd;padding: 5px 0px 5px 0px; margin-bottom: 5px;}
        .back_popup select{ width: 50%; margin-top: 0px; margin-bottom: 5px;}

    </style>

    <?php echo $modal;?>
        <!-- Modal 3 End-->
<!--modal end area-->