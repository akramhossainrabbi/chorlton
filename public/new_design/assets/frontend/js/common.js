function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}


function isNumberDecimal(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31&& (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function validate_email(uname){
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var mail_format = regex.test(uname);
		
		if(!mail_format){
			$('#email').addClass('form-control-danger');
			$('#email').focus();
			$('.err_email').html('Please provide a valid email');
			//$('.disable').prop('disabled', true);
			return false;
		}
		else {
			$('#email').removeClass('form-control-danger');
			$('#email').addClass('form-control-success');
			$('.err_email').html('');
			//$('.disable').prop('disabled', false);
		} 
	 }
	 
function validate_mobile(phone){
	
	if(phone.length< 3){
		$('#phone').addClass('form-control-danger');
		$('#phone').focus();
		$('.err_phone').html("Mobile number should be minimum 3 digits.");
		return false;
	}else {
		$('#phone').removeClass('form-control-danger');
		$('#phone').addClass('form-control-success');
		$('.err_phone').html('');
		}
}

function validate_mobile1(phone){
	
	if(phone.length< 3){
		$('#phoneNumber').addClass('form-control-danger');
		$('#phoneNumber').focus();
		$('.err_phone').html("Mobile number should be minimum 3 digits.");
		return false;
	}else {
		$('#phoneNumber').removeClass('form-control-danger');
		$('#phoneNumber').addClass('form-control-success');
		$('.err_phone').html('');
		}
}

function fadeOut()
{
	setTimeout(function() {
	  $('.msg_error_success').fadeOut('slow');
	}, 3000); 
}

function refreshCart()
{
	url = site_url+'/home/cart';
	$('.loading-image').show();
	$.ajax({
			'type': "GET",
			'url': url,
			'dataType': 'html',
			success: function (data) {
				$('.loading-image').hide();
				$('.append_cart_item').html(data)
				
			}
		});
}

function refreshCheckout()
{
	url = site_url+'/checkout/refreshCheckout';
	$('.loading-image').show();
	$.ajax({
			'type': "GET",
			'url': url,
			'dataType': 'html',
			success: function (data) {
				$('.loading-image').hide();
				$('.append_cart_item').html(data)
				
			}
		});
}

function app()
{
	var qty = $('.main_item_qty').val();
	var basic_price  = parseFloat(document.querySelector('input[name="item_price"]:checked').value);
	var sum = 0;
	$('input.btnClass:checked').each(function () {
		var price = $(this).attr("price") 
		var name = $(this).attr("name") 
		if(name!='item_price')
		{
			var value = $(this).val() 
			var adonQty = $('#addon_item_qty_'+value).val();
			sum = sum+(price*adonQty)
		}
	});
	sum = sum+parseFloat(basic_price*qty)
	$('.priceOfItem').html(currency+' '+sum.toFixed(2))
}

function login(email,password)
{
	url = site_url+'/auth/login';
	$('.loading-image').show();
	$.ajax({
			'type': "POST",
			'url': url,
			'dataType': 'html',
			'data': { login_email: email,login_password:password},
			success: function (data) {
				$('.loading-image').hide();
				window.location.reload(1);
			}
		});
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

$(function () {
	
	var currentDate = new Date();
	$( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  dateFormat:'d-M-y'
    });
	
	
	$( ".datepickercurrent" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  minDate: currentDate,
	  dateFormat:'d-M-y',
	  yearRange: "-90:+1"
    });
	
	$('.changeScreen').on('click', function () {
		$('.edit-profile').toggle();
		$('.profile').toggle();
		
		$(this).text(function(i, text){
			return text === "Edit Profile" ? "View Profile" : "Edit Profile";
		})
		
	});
	
	$(document).on( "click", ".add-menu-item", function() {
		var item_id = $(this).attr( "data-id");
		
		$('.loading-image').show();
		url = site_url+'/cart/getCartForm';
		$.ajax({
			'type': "POST",
			'url': url,
			'data': { item_id: item_id},
			'dataType': 'html',
			success: function (data) {
				//alert(data)
				$('#takeaway_popup').html(data)
				$('#itemModalCenter').modal('show');
				$('.loading-image').hide();
			}
		});
	 });
	
	$(document).on('change','input[name="item_price"]', function () {
		var value  = document.querySelector('input[name="item_price"]:checked').value;
		var id = $('input[name="item_price"]:checked').attr("data-id");
		//alert(id);
		$('#variation_id').val(id)

	});
	
	$(document).on('click','.popupAddOnItemClass', function () {
		cat_id = $(this).attr("cat-id");
		type = $(this).attr("type");
		if(type=='radio')
		{
		$('.toggle_'+cat_id).prop('checked', false);
		$(this).prop('checked', true);
		}
	});
	
	$(document).on('click','.add_cart', function () {
		
		var item_id;
		var item_price;
		var discount;
		var cooking_ref;
		var ingredient;
		var quantity;
		var special_inst;
		
		item_id = $(this).attr("data-item-id");
		if ($("input[name='item_price']:checked").filter(':checked').length < 1){
			alert("Please Select Price");
			return false;
		}
		else
		{
			item_price = document.querySelector('input[name="item_price"]:checked').value;
		}
			 
		discount = $('#discount').val();
		if ($("input[name='cooking_ref']:checked").filter(':checked').length >0){
			cooking_ref = document.querySelector('input[name="cooking_ref"]:checked').value;
		}
		if ($("input[name='ingredient']:checked").filter(':checked').length >0){
			ingredient = document.querySelector('input[name="ingredient"]:checked').value;
		}
		quantity = $('#main_item_qty_' + item_id).val();
		if(quantity=='' && quantity== 0)
		{
			alert("Please Select number of quantity");
			return false;
		}
		special_inst = $('.special_inst').val();
		$('.addon_cat_id').each(function() {
		 var cat_id = $(this).val();
		 //alert(cat_id)
		})
		var sr = $('#add_to_cart_form').serialize();
		 $('.loading-image').show();
		   $.ajax({
			url: site_url+"/cart/addCart",
			method:"POST",
			'dataType': 'json',
			data:sr,
			success:function(res)
			{
				
				$('.loading-image').hide();
				$('#itemModalCenter').modal('hide');
				$('.msg_error_success').show()
				if(res.status==1)
				{
					
					$('.err').hide()
					$('.suss').show()
					$('.fixed_success').html(res.msg)
					fadeOut();
					refreshCart();
				}else{
					$('.suss').hide()
					$('.err').show()
					$('.fixed_error').html(res.msg)
					fadeOut();
				}
			}
		   });
	  
	  
	 });
	 	
	$(document).on('click','.number-qty-incrs', function () {
		var incId = $(this).attr('data-id');
		var type = $(this).attr('type');
		var qantityInput= type+'_qty_'+incId;
		var value = parseInt(document.getElementById(qantityInput).value);
		value = isNaN(value) ? 0 : value;
		value++;
		document.getElementById(qantityInput).value = value;
    });
	
	$(document).on('click','.number-qty-decr', function () {
		var qtyid = $(this).attr('data-id');
		var type = $(this).attr('type');
		var qantityInput= type+'_qty_'+qtyid;
		var value = parseInt(document.getElementById(qantityInput).value, 10);
		if(value>1){
			value = isNaN(value) ? 0 : value;
			value < 1 ? value = 1 : '';
			value--;
		}
		document.getElementById(qantityInput).value = value;
    });
	
	$(document).on('change','.btnClass', function () {
		app()
	});
	
	$(document).on('click','#add_to_cart_form .qtybtn', function () {
		app()
	});
		
	$( document ).on( "click", ".addUpdateAddress", function() {
		var id = $(this).attr( "id");
		
		$('#address_id').val('')
		$('#address_name').val('')
		$('#address_phoneNumber').val('')
		$('#address_pincode').val('')
		$('#address_addressLine1').val('')
		$('#address_addressLine2').val('')
		$('#address_type').val('')
			
		if(id!='')
		{
			var addType = $.trim($('.add_type_'+id).html())
			var ad = addType=='Home'?1:2;
			
			$('#address_id').val(id)
			$('#address_name').val($.trim($('.name_'+id).html()))
			$('#address_phoneNumber').val($.trim($('.phone_'+id).html()))
			$('#address_pincode').val($.trim($('.pincode_'+id).html()))
			$('#address_addressLine1').val($.trim($('.add_line_1_'+id).html()))
			$('#address_addressLine2').val($.trim($('.add_line_2_'+id).html()))
			$('#address_type').val(ad)
		}
		$('.loading-image').show();
		$('#addresspopup').modal('show');
		$('.loading-image').hide();
	});	
	
	$( document ).on( "click", ".ajaxAddress", function() {
		var address_id = $('#address_id').val();
		var address_name = $.trim($('#address_name').val());
		var address_phoneNumber = $.trim($('#address_phoneNumber').val());
		var address_pincode = $.trim($('#address_pincode').val());
		var address_addressLine1 = $.trim($('#address_addressLine1').val());
		var address_addressLine2 = $.trim($('#address_addressLine2').val());
		var address_type = $.trim($('#address_type').val());
		
		
		if(address_name=='')
		{
			$('#address_name').addClass('form-control-danger');
			$('#address_name').focus();
			$('.address_name_error').html('Name can\'t be blank.');
			return false;
		}else{
			$('#address_name').removeClass('form-control-danger');
			$('#address_name').addClass('form-control-success');
			$('.address_name_error').html('');
		}
		
		if(address_phoneNumber=='')
		{
			$('#address_phoneNumber').addClass('form-control-danger');
			$('#address_phoneNumber').focus();
			$('.error_address_phoneNumber').html('mobile number can\'t be blank.');
			return false;
		}else{
			if(address_phoneNumber.length< 3){
					$('#address_phoneNumber').addClass('form-control-danger');
					$('#address_phoneNumber').focus();
					$('.error_address_phoneNumber').html("Mobile number should be minimum 3 digits.");
					return false;
			}else {
					$('#address_phoneNumber').removeClass('form-control-danger');
					$('#address_phoneNumber').addClass('form-control-success');
					$('.error_address_phoneNumber').html('');
				}
		}
		
		
		if(address_pincode=='')
		{
			$('#address_pincode').addClass('form-control-danger');
			$('#address_pincode').focus();
			$('.pincode_add_error').html('Postcode can\'t be blank.');
			return false;
		}else{
			$('#address_pincode').removeClass('form-control-danger');
			$('#address_pincode').addClass('form-control-success');
			$('.pincode_add_error').html('');
		}
		
		if(address_addressLine1=='')
		{
			$('#address_addressLine1').addClass('form-control-danger');
			$('#address_addressLine1').focus();
			$('.address1_add_error').html('Address Line 1 can\'t be blank.');
			return false;
		}else{
			$('#address_addressLine1').removeClass('form-control-danger');
			$('#address_addressLine1').addClass('form-control-success');
			$('.address1_add_error').html('');
		}
		
		if(address_type=='')
		{
			$('#address_type').addClass('form-control-danger');
			$('#address_type').focus();
			$('.address_type_error').html('Address type can\'t be blank.');
			return false;
		}else{
			$('#address_type').removeClass('form-control-danger');
			$('#address_type').addClass('form-control-success');
			$('.address_type_error').html('');
		}
		
		$('.loading-image').show();
		url = site_url+'/user/addUpdateAddress';
		$.ajax({
			'type': "POST",
			'url': url,
			'dataType': 'json',
			'data': { address_id: address_id,address_name:address_name,address_phoneNumber:address_phoneNumber,address_pincode:address_pincode,address_addressLine1:address_addressLine1,address_addressLine2:address_addressLine2,address_type:address_type},
			'dataType': 'json',
			success: function (data) {
				$('.loading-image').hide();
				$('#addresspopup').modal('hide');
				$('.msg_error_success').show()
				
				if(data.status==1 && data.type=='update'){
					
					var ad = address_type==1?'Home':'Office';
					
					$.trim($('.name_'+address_id).html(address_name))
					$.trim($('.phone_'+address_id).html(address_phoneNumber))
					$.trim($('.pincode_'+address_id).html(address_pincode))
					$.trim($('.add_line_1_'+address_id).html(address_addressLine1))
					$.trim($('.add_line_2_'+address_id).html(address_addressLine2))
					$.trim($('.add_type_'+address_id).html(ad))
				}
				
				if(data.status==1)
				{
					
					$('.err').hide()
					$('.suss').show()
					$('.fixed_success').html(data.msg)
					fadeOut();
				}else{
					$('.suss').hide()
					$('.err').show()
					$('.fixed_error').html(data.msg)
					fadeOut();
				}
				setTimeout(function(){
				   window.location.reload(1);
				}, 2000);
				// window.location.reload();
				
			}
		});
	});
	
	$( document ).on( "click", ".deleteAddress", function() {
		var address_id = $(this).attr('id');
		if(confirm("Are you sure you want to delete this?")){
			$('.loading-image').show();
			url = site_url+'/user/deleteAddress';
			$.ajax({
				'type': "POST",
				'url': url,
				'dataType': 'json',
				'data': { address_id: address_id},
				'dataType': 'json',
				success: function (data) {
					$('.loading-image').hide();
					$('#addresspopup').modal('hide');
					$('.msg_error_success').show()
					$('.remove_'+address_id).remove()
					
					if(data.status==1)
					{
						
						$('.err').hide()
						$('.suss').show()
						$('.fixed_success').html(data.msg)
						fadeOut();
					}else{
						$('.suss').hide()
						$('.err').show()
						$('.fixed_error').html(data.msg)
						fadeOut();
					}
				
				}
			});
		}else{
			return false;
		}
		 
		
	});
	
	$( document ).on( "click", ".delete_item_cart", function() {
		var item_id = $(this).attr('data-id');
		var cart = $(this).attr('data-cart');
		
		if(confirm("Are you sure you want to delete this?")){
			$('.loading-image').show();
			url = site_url+'/cart/deleteItem';
			$.ajax({
				'type': "POST",
				'url': url,
				'dataType': 'json',
				'data': { item_id: item_id,cart:cart},
				'dataType': 'json',
				success: function (data) {
					$('.loading-image').hide();
					$('.msg_error_success').show()
					if(data.status==1)
					{
						$('.err').hide()
						$('.suss').show()
						$('.fixed_success').html(data.msg)
						refreshCart()
						fadeOut();
					}else{
						$('.suss').hide()
						$('.err').show()
						$('.fixed_error').html(data.msg)
						refreshCart()
						fadeOut();
					}
				
				}
			});
		}else{
			return false;
		}
		 
		
	});
	
	$( document ).on( "click", ".delete_addon_item_cart", function() {
		var item_id = $(this).attr('data-id');
		var cart = $(this).attr('data-cart');
		
		if(confirm("Are you sure you want to delete this?")){
			$('.loading-image').show();
			url = site_url+'/cart/deleteItem';
			$.ajax({
				'type': "POST",
				'url': url,
				'dataType': 'json',
				'data': { item_id: item_id,cart:cart,type:2},
				'dataType': 'json',
				success: function (data) {
					$('.loading-image').hide();
					$('.msg_error_success').show()
					if(data.status==1)
					{
						$('.err').hide()
						$('.suss').show()
						$('.fixed_success').html(data.msg)
						refreshCart()
						fadeOut();
					}else{
						$('.suss').hide()
						$('.err').show()
						$('.fixed_error').html(data.msg)
						refreshCart()
						fadeOut();
					}
				
				}
			});
		}else{
			return false;
		}
		 
		
	});
	
	$(document ).on("change", ".chk_type", function() {
		chk_type = $("input[name='order_type']:checked").val();
		$('.loading-image').show();
		url = site_url+'/cart/setOrderType';
		$.ajax({
			'type': "POST",
			'url': url,
			'dataType': 'html',
			'data': { chk_type: chk_type},
			'dataType': 'json',
			success: function (data) {
				$('.loading-image').hide();
				refreshCart()
				var postcode_close = getCookie("postcode_close");
				
				if(chk_type==2 && postcode_close!=1)
				{
					$('#postcodeModal').modal('show');
				}else{
					$('#postcodeModal').modal('hide');
				}
				
				if(data==1)
				{
					$('#delivery_fee_hide_show').hide()
				}else{
					
					$('#delivery_fee_hide_show').show()
				}
				
			}
		});
	});
	
	$(document).on('click','.update_item_cart', function () {
		
		var item_id;
		var item_price;
		var quantity;
		
		item_id = $(this).attr("data-id");
		cart_id = $(this).attr("data-cart");
		quantity = $('#main_item_qty_' + item_id).val();
		if(quantity=='' && quantity== 0)
		{
			alert("Please Select number of quantity");
			return false;
		}
		
		 $('.loading-image').show();
		   $.ajax({
			url: site_url+"/cart/updateCart",
			method:"POST",
			'dataType': 'json',
			data:{item_id:item_id,cart_id:cart_id,quantity:quantity},
			success:function(res)
			{
				$('.loading-image').hide();
				$('.msg_error_success').show()
				if(res.status==1)
				{
					
					$('.err').hide()
					$('.suss').show()
					$('.fixed_success').html(res.msg)
					fadeOut();
					refreshCart();
				}else{
					$('.suss').hide()
					$('.err').show()
					$('.fixed_error').html(res.msg)
					fadeOut();
				}
			}
		   });
	  
	  
	 });
	 
	$(document).on('click','.update_addon_item_cart', function () {
		
		var item_id;
		var item_price;
		var quantity;
		
		item_id = $(this).attr("data-id");
		cart_id = $(this).attr("data-cart");
		quantity = $('#addon_item_qty_' + item_id).val();
		if(quantity=='' && quantity== 0)
		{
			alert("Please Select number of quantity");
			return false;
		}
		
		 $('.loading-image').show();
		   $.ajax({
			url: site_url+"/cart/updateCart",
			method:"POST",
			'dataType': 'json',
			data:{item_id:item_id,cart_id:cart_id,quantity:quantity,type:2},
			success:function(res)
			{
				$('.loading-image').hide();
				$('.msg_error_success').show()
				if(res.status==1)
				{
					
					$('.err').hide()
					$('.suss').show()
					$('.fixed_success').html(res.msg)
					fadeOut();
					refreshCart();
				}else{
					$('.suss').hide()
					$('.err').show()
					$('.fixed_error').html(res.msg)
					fadeOut();
				}
			}
		   });
	  
	  
	 }); 
	 
	$(document).on('change','.paymentType', function () {
		
		var payment  = document.querySelector('input[name="payment_type"]:checked').value;
		if(payment==1)
		{
			$('#order_change').show();
		}else{
			$('#order_change').hide();
		}
	});
	
	$( document ).on( "click", ".order_view", function() {
		var id = $(this).attr( "data-id");
		$('.loading-image').show();
		$.ajax({
			url: site_url+"/order/orderView",
			method:"POST",
			'data': { id: id},
			'dataType': 'html',
			success: function (data) {
				$('.loading-image').hide();
				$('.appendOrderDetail').html(data);
				$('#viewOrderDetail').modal('show');
			}
		})
	});
	
	$( document ).on( "click", ".change-address", function() {
		var id = $(this).attr( "data-id");
		$('.loading-image').show();
		$('#postcodeModal').modal('show');
		$('.loading-image').hide();
	});
	
	$('#pincode').on('change', function () {
		var pincode = $.trim($('#pincode').val());
		$('.loading-image').show();
		$.ajax({
			'type': "POST",
			'url': base_url+'accounts/getCordinates',
			'data': { address: pincode},
			'dataType': 'json',
			success: function (data) {
				$('.loading-image').hide();
				if(data.status==1)
				{
					$('#pincode').parent().removeClass('invalid');
					$('.pincode').html('');
					$('#cordinates').val(data.cordinates)
					$('#countryCode').val(data.countrycode)
					//$.trim($('#cordinates').attr('readonly',true));
					//$('#cordinates').parent().removeClass('invalid');
					//$('.cordinates').html('');
				}
				else
				{
					$('#pincode').parent().addClass('invalid');
					$('#pincode').focus();
					//$('.pincode').html('Postcode is not valid if Postcode is valid please enter geocode manually.');
					//$('#cordinates').parent().addClass('invalid');
					//$('.cordinates').html('Cordinates can\'t be blank.');
					$.trim($('#cordinates').val(''));
					$.trim($('#countryCode').val(''));
					//$.trim($('#cordinates').removeAttr('readonly'));
					return false;
				}
			}
		});
	});
		
	// validation start
	$('#login').on('submit', function(e){
		var login_email =  $.trim($('#login_email').val());
		var login_password = $.trim($('#login_password').val());
		
		if(login_email=='')
		{
			$('#login_email').addClass('form-control-danger');
			$('#login_email').focus();
			$('.err_login_email').html('Username can\'t be blank.');
			return false;
		}else{
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test(login_email)) {
				$('#login_email').addClass('form-control-danger');
				$('#login_email').focus();
				$('.err_login_email').html('Please provide a valid email address');
				return false;
			}else{
				$('#login_email').removeClass('form-control-danger');
				$('#login_email').addClass('form-control-success');
				$('.err_login_email').html('');
			}
		}
		
		
		if(login_password=='')
		{
			$('#login_password').addClass('form-control-danger');
			$('#login_password').focus();
			$('.err_login_password').html('Password can\'t be blank.');
			return false;
		}else{
			$('#login_password').removeClass('form-control-danger');
			$('#login_password').addClass('form-control-success');
			$('.err_login_password').html('');
		}
		$('.disable').prop('disabled', true);
		$('#login').submit();
        
    });
	
	$('.registration_button').on('click', function(e){
		var full_name =  $.trim($('#full_name').val());
		var email = $.trim($('#email').val());
		var password =  $.trim($('#password').val());
		var cpassword =  $.trim($('#cpassword').val());
		var phone =  $.trim($('#phone').val());
		
		if(full_name=='')
		{
			$('#full_name').addClass('form-control-danger');
			$('#full_name').focus();
			$('.err_full_name').html('Name can\'t be blank.');
			return false;
		}else{
			$('#full_name').removeClass('form-control-danger');
			$('#full_name').addClass('form-control-success');
			$('.err_full_name').html('');
		}
		
		if(email=='')
		{
			$('#email').addClass('form-control-danger');
			$('#email').focus();
			$('.err_email').html('Email can\'t be blank.');
			return false;
		}else{
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test(email)) {
				$('#email').addClass('form-control-danger');
				$('#email').focus();
				$('.err_email').html('Please provide a valid email address');
				return false;
			}else{

				$('#email').removeClass('form-control-danger');
				$('#email').addClass('form-control-success');
				$('.err_email').html('');
			}
		}
		
		if(phone=='')
		{
			$('#phone').addClass('form-control-danger');
			$('#phone').focus();
			$('.err_phone').html('mobile number can\'t be blank.');
			return false;
		}else{
			if(phone.length< 3){
					$('#phone').addClass('form-control-danger');
					$('#phone').focus();
					$('.err_phone').html("Mobile number should be minimum 3 digits.");
					return false;
			}else {
					$('#phone').removeClass('form-control-danger');
					$('#phone').addClass('form-control-success');
					$('.err_phone').html('');
				}
		}
		
	
		if(password=='')
		{
			$('#password').addClass('form-control-danger');
			$('#password').focus();
			$('.err_password').html('Password can\'t be blank.');
			return false;
		}else{
			$('#password').removeClass('form-control-danger');
			$('#password').addClass('form-control-success');
			$('.err_password').html('');
		}
	
		if(cpassword=='')
		{
			$('#cpassword').addClass('form-control-danger');
			$('#cpassword').focus();
			$('.err_cpassword').html('Confirm password can\'t be blank.');
			return false;
		}else{
			$('#cpassword').removeClass('form-control-danger');
			$('#cpassword').addClass('form-control-success');
			$('.err_cpassword').html('');
		}
	
		if(password!= cpassword) 
		{
			$(".err_password").html('Password does not match.');
			$(".err_cpassword").html('Confirm Password does not match.');
			$('#password').addClass('form-control-danger');
			$('#cpassword').addClass('form-control-danger');
			return false;
		}else{
			$('#password').removeClass('form-control-danger');
			$('#cpassword').removeClass('form-control-danger');
			$('#password').addClass('form-control-success');
			$('#cpassword').addClass('form-control-success');
			$('.err_password').html('');
			$('.err_cpassword').html('');
		}

		//$('.disable').prop('disabled', true);
		//$('#registration').submit();
		
		$('.loading-image').show();
		url = site_url+'/auth/registration';
		$.ajax({
			'type': "POST",
			'url': url,
			'dataType': 'json',
			'data': { full_name: full_name,email:email,phone:phone,password:password,cpassword:cpassword},
			success: function (data) {
				$('.loading-image').hide();
				$('.errorMsg').html('')
				$('.successMsg').html('')
				if(data.status==1)
				{
					//$('#email').prop('disabled', true);
					$('.registration_toggle').hide();
					$('.registration_otp_toggle').show();
				
				}else{
					//$('#email').prop('disabled', false);
					$('.errorMsg').html(data.msg)
					$('.registration_toggle').show();
					$('.registration_otp_toggle').hide();
				}
				
			}
		});
        
    });
	
	$( document ).on( "click", ".submitRegOTP", function() {
		var email =  $.trim($('#email').val());
		var otp =  $.trim($('#registration_otp').val());
		var password =  $.trim($('#password').val());
		
		if(email=='')
		{
			$('.errorMsg').html('<div class="alert alert-danger alert-dismissible" role="alert"><span class="row">Email can\'t be blank</span></div>')
			return false;
		}else{
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test(email)) {
				$('#email').addClass('form-control-danger');
				$('#email').focus();
				$('.errorMsg').html('<div class="alert alert-danger alert-dismissible" role="alert"><span class="row">Please provide a valid email address</span></div>')
				$('.err_email').html('Please provide a valid email address');
				return false;
			}else{
				$('#email').removeClass('form-control-danger');
				$('#email').addClass('form-control-success');
				$('.err_email').html('');
				$('.errorMsg').html('');
			}
		}
		
		if(otp=='')
		{
			$('#registration_otp').addClass('form-control-danger');
			$('#registration_otp').focus();
			$('.err_otp').html('OTP can\'t be blank.');
			return false;
		}else{
			$('#registration_otp').removeClass('form-control-danger');
			$('#registration_otp').addClass('form-control-success');
			$('.err_otp').html('');
		}
	
		
		$('.loading-image').show();
		url = site_url+'/auth/verifyEmail';
		$.ajax({
			'type': "POST",
			'url': url,
			'dataType': 'json',
			'data': { email: email,otp:otp},
			success: function (data) {
				$('.loading-image').hide();
				$('.msg_error_success').show()
			
				if(data.status==1)
				{
					$('.err').hide()
					$('.suss').show()
					$('.fixed_success').html(data.msg)
					fadeOut();
					login(email,password)
					// setTimeout(function(){
					   // window.location.href=site_url+'/auth/login';
					// }, 3000);
				}else{
					$('.suss').hide()
					$('.err').show()
					$('.fixed_error').html(data.msg)
					fadeOut();
				}
				
			}
		});
        
    });
	
	$('.sendVerifyMailotp').on('click', function(e){
		var email = $.trim($('#email').val());
		var full_name = $.trim($('#full_name').val());
		
		$('.loading-image').show();
		url = site_url+'/auth/sendVerifyMailotp';
		$.ajax({
			'type': "POST",
			'url': url,
			'dataType': 'json',
			'data': {email:email,full_name:full_name},
			success: function (data) {
				$('.loading-image').hide();
				$('.msg_error_success').show()
				if(data.status==1)
				{
					$('.toggle_popup_email').hide();
					$('.toggle_popup_email_1').show();
					$('.err').hide()
					$('.suss').show()
					$('.fixed_success').html(data.msg)
					fadeOut();
				
				}else{
					$('.toggle_popup_email').show();
					$('.toggle_popup_email_1').hide();
					$('.suss').hide()
					$('.err').show()
					$('.fixed_error').html(data.msg)
					fadeOut();
				}
			}
		});
        
    });
	
	$( document ).on( "click", ".matchOTP", function() {
		var email =  $.trim($('#email').val());
		var otp =  $.trim($('#text_otp').val());
		
		if(otp=='')
		{
			$('#text_otp').addClass('form-control-danger');
			$('#text_otp').focus();
			$('.err_otp').html('OTP can\'t be blank.');
			return false;
		}else{
			$('#text_otp').removeClass('form-control-danger');
			$('#text_otp').addClass('form-control-success');
			$('.err_otp').html('');
		}
	
		$('.loading-image').show();
		url = site_url+'/auth/verifyEmail';
		$.ajax({
			'type': "POST",
			'url': url,
			'dataType': 'json',
			'data': { email: email,otp:otp},
			success: function (data) {
				$('.loading-image').hide();
				$('.msg_error_success').show()
				if(data.status==1)
				{
					$('.err').hide()
					$('.suss').show()
					$('.fixed_success').html(data.msg)
					fadeOut();
					setTimeout(function(){
					   window.location.reload(1);
					}, 2000);
				}else{
					$('.suss').hide()
					$('.err').show()
					$('.fixed_error').html(data.msg)
					fadeOut();
				}
				
			}
		});
        
    });
	
	$('#updateProfile').on('submit', function(e){
       
		var name =  $.trim($('#name').val());
		var email = $.trim($('#email').val());
		var phone = $.trim($('#phoneNumber').val());
        
		if(name=='')
		{
			$('#name').addClass('form-control-danger');
			$('#name').focus();
			$('.err_name').html('Name can\'t be blank.');
			return false;
		}else{
			$('#name').removeClass('form-control-danger');
			$('#name').addClass('form-control-success');
			$('.err_name').html('');
		}
			
		if(email=='')
		{
			$('#email').addClass('form-control-danger');
			$('#email').focus();
			$('.err_email').html('Email can\'t be blank.');
			return false;
		}else{
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test(email)) {
				$('#email').addClass('form-control-danger');
				$('#email').focus();
				$('.err_email').html('Please provide a valid email address');
				return false;
			}else{

				$('#email').removeClass('form-control-danger');
				$('#email').addClass('form-control-success');
				$('.err_email').html('');
			}
		}										
        
		if(phone=='')
		{
			$('#phoneNumber').addClass('form-control-danger');
			$('#phoneNumber').focus();
			$('.err_phone').html('mobile number can\'t be blank.');
			return false;
		}else{
			if(phone.length< 3){
				$('#phoneNumber').addClass('form-control-danger');
				$('#phoneNumber').focus();
				$('.err_phone').html("Mobile number should be minimum 3 digits.");
				return false;
			}else {
				$('#phoneNumber').removeClass('form-control-danger');
				$('#phoneNumber').addClass('form-control-success');
				$('.err_phone').html('');
				}
		}
		$('.disable').prop('disabled', true);
		$('#updateProfile').submit();
        
	});

	$('#change-password').on('submit', function(e){
		var old_password =  $.trim($('#old_password').val());
		var new_password =  $.trim($('#new_password').val());
		var c_new_password =  $.trim($('#c_new_password').val());
		
		if(old_password=='')
		{
			$('#old_password').addClass('form-control-danger');
			$('#old_password').focus();
			$('.err_old_password').html('Old Password can\'t be blank.');
			return false;
		}else{
			$('#old_password').removeClass('form-control-danger');
			$('#old_password').addClass('form-control-success');
			$('.err_old_password').html('');
		}
		
		if(new_password=='')
		{
			$('#new_password').addClass('form-control-danger');
			$('#new_password').focus();
			$('.err_new_password').html('New Password can\'t be blank.');
			return false;
		}else{
			if(new_password.length< 6){
					$('#new_password').addClass('form-control-danger');
					$('#new_password').focus();
					$('.err_new_password').html("Password should be minimum 6 digits.");
					return false;
			}else {
					$('#new_password').removeClass('form-control-danger');
					$('#new_password').addClass('form-control-success');
					$('.err_new_password').html('');
				}
		}
	
		if(c_new_password=='')
		{
			$('#c_new_password').addClass('form-control-danger');
			$('#c_new_password').focus();
			$('.err_c_new_password').html('Confirm password can\'t be blank.');
			return false;
		}else{
			$('#c_new_password').removeClass('form-control-danger');
			$('#c_new_password').addClass('form-control-success');
			$('.err_c_new_password').html('');
		}
	
		if(new_password!= c_new_password) 
		{
			$(".err_new_password").html('Password does not match.');
			$(".err_c_new_password").html('Confirm Password does not match.');
			$('#password').addClass('form-control-danger');
			$('#c_new_password').addClass('form-control-danger');
			return false;
		}else{
			$('#new_password').removeClass('form-control-danger');
			$('#c_new_password').removeClass('form-control-danger');
			$('#new_password').addClass('form-control-success');
			$('#c_new_password').addClass('form-control-success');
			$('.err_new_password').html('');
			$('.err_c_new_password').html('');
		}

		$('.disable').prop('disabled', true);
		$('#change-password').submit();
        
    });
	
	$( document ).on( "click", ".forgotpassword", function() {
		var email =  $.trim($('#email').val());
		
		if(email=='')
		{
			$('#email').addClass('form-control-danger');
			$('#email').focus();
			$('.err_email').html('Email can\'t be blank.');
			return false;
		}else{
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test(email)) {
				$('#email').addClass('form-control-danger');
				$('#email').focus();
				$('.err_email').html('Please provide a valid email address');
				return false;
			}else{
				$('#email').removeClass('form-control-danger');
				$('#email').addClass('form-control-success');
				$('.err_email').html('');
			}
		}
		
		$('.loading-image').show();
		url = site_url+'/auth/forgotPasswordAjax';
		$.ajax({
			'type': "POST",
			'url': url,
			'dataType': 'json',
			'data': { email: email},
			success: function (data) {
				$('.loading-image').hide();
				$('.msg_error_success').show()
			
				if(data.status==1)
				{
					$('#email').prop('disabled', true);
					$('.otpToggle').show();
					$('.forgotpassword').hide();
					$('.err').hide()
					$('.suss').show()
					$('.fixed_success').html(data.msg)
					fadeOut();
				}else{
					$('#email').prop('disabled', false);
					$('.otpToggle').hide();
					$('.forgotpassword').show();
					$('.suss').hide()
					$('.err').show()
					$('.fixed_error').html(data.msg)
					fadeOut();
				}
				
			}
		});
		//$('#forgot-password').submit();
        
    });
	
	
	$( document ).on( "click", ".forgotpasswordOTP", function() {
		var email =  $.trim($('#email').val());
		var otp =  $.trim($('#otp').val());
		var new_password =  $.trim($('#new_password').val());
		var c_new_password =  $.trim($('#c_new_password').val());
		
		if(email=='')
		{
			$('#email').addClass('form-control-danger');
			$('#email').focus();
			$('.err_email').html('Email can\'t be blank.');
			return false;
		}else{
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test(email)) {
				$('#email').addClass('form-control-danger');
				$('#email').focus();
				$('.err_email').html('Please provide a valid email address');
				return false;
			}else{
				$('#email').removeClass('form-control-danger');
				$('#email').addClass('form-control-success');
				$('.err_email').html('');
			}
		}
		
		if(otp=='')
		{
			$('#otp').addClass('form-control-danger');
			$('#otp').focus();
			$('.err_otp').html('OTP can\'t be blank.');
			return false;
		}else{
			$('#otp').removeClass('form-control-danger');
			$('#otp').addClass('form-control-success');
			$('.err_otp').html('');
		}
	
		if(new_password=='')
		{
			$('#new_password').addClass('form-control-danger');
			$('#new_password').focus();
			$('.err_new_password').html('New Password can\'t be blank.');
			return false;
		}else{
			$('#new_password').removeClass('form-control-danger');
			$('#new_password').addClass('form-control-success');
			$('.err_new_password').html('');
		}
		
		
		if(new_password=='')
		{
			$('#new_password').addClass('form-control-danger');
			$('#new_password').focus();
			$('.err_new_password').html('New Password can\'t be blank.');
			return false;
		}else{
			if(new_password.length< 6){
					$('#new_password').addClass('form-control-danger');
					$('#new_password').focus();
					$('.err_new_password').html("Password should be minimum 6 digits.");
					return false;
			}else {
					$('#new_password').removeClass('form-control-danger');
					$('#new_password').addClass('form-control-success');
					$('.err_new_password').html('');
				}
		}
		
		
	
		if(c_new_password=='')
		{
			$('#c_new_password').addClass('form-control-danger');
			$('#c_new_password').focus();
			$('.err_c_new_password').html('Confirm password can\'t be blank.');
			return false;
		}else{
			$('#c_new_password').removeClass('form-control-danger');
			$('#c_new_password').addClass('form-control-success');
			$('.err_c_new_password').html('');
		}
	
		if(new_password!= c_new_password) 
		{
			$(".err_new_password").html('Password does not match.');
			$(".err_c_new_password").html('Confirm Password does not match.');
			$('#password').addClass('form-control-danger');
			$('#c_new_password').addClass('form-control-danger');
			return false;
		}else{
			$('#new_password').removeClass('form-control-danger');
			$('#c_new_password').removeClass('form-control-danger');
			$('#new_password').addClass('form-control-success');
			$('#c_new_password').addClass('form-control-success');
			$('.err_new_password').html('');
			$('.err_c_new_password').html('');
		}
		
		$('.loading-image').show();
		url = site_url+'/auth/resetPassword';
		$.ajax({
			'type': "POST",
			'url': url,
			'dataType': 'json',
			'data': { email: email,otp:otp,new_password:new_password},
			success: function (data) {
				$('.loading-image').hide();
				$('.msg_error_success').show()
			
				if(data.status==1)
				{
					$('.err').hide()
					$('.suss').show()
					$('.fixed_success').html(data.msg)
					fadeOut();
					setTimeout(function(){
					   window.location.href=site_url+'/auth/login';
					}, 5000);
				}else{
					$('.suss').hide()
					$('.err').show()
					$('.fixed_error').html(data.msg)
					fadeOut();
				}
				
			}
		});
        
    });
	
	$(document).on('click','.searchPostcode', function () {
		
		var postcode;
		var delivery_type;
		var name;
		var postcode_name;
		
		postcode_name = postcode = $('#postcode').val();
		delivery_type = $('#delivery_type').val();
		if(delivery_type==1){
			name = $('option:selected','#postcode').attr('data-name');
			postcode_name = name;
		}else{
			name ='';
		}
		
		
		if(postcode=='')
		{
			$('#postcode').addClass('form-control-danger');
			$('#postcode').focus();
			$('.err_postcode').html('Postcode can\'t be blank.');
			return false;
		}else{
			$('#postcode').removeClass('form-control-danger');
			$('#postcode').addClass('form-control-success');
			$('.err_postcode').html('');
		}
		
		 $('.loading-image').show();
		 url = site_url+'/home/postcodecheck';
		   $.ajax({
			'type': "POST",
			'url': url,
			'dataType': 'json',
			'data': { postcode: postcode,delivery_type:delivery_type,name:name},
			success:function(res)
			{
				$('.loading-image').hide();	
				$('.msg_error_success').show()
				if(res.status==1)
				{
					$('.err').hide()
					$('.suss').show()
					$('#postcodeModal').modal('hide');
					$('.fixed_success').html(res.msg)
					document.cookie='address_postcode='+postcode_name; 
					document.cookie='can_deliverd=1'
					document.cookie='postcode_close=1';
					$('.deliverd').html('Delivery available on '+postcode_name); 
					$('.not-deliverd').html(''); 
					fadeOut();
					refreshCart()
				}else{
					$('.suss').hide()
					$('.err').show()
					$('.fixed_error').html(res.msg)
					document.cookie='address_postcode='+postcode_name; 
					document.cookie='can_deliverd=0';
					document.cookie='postcode_close=0';					
					$('.deliverd').html(''); 
					$('.not-deliverd').html('Delivery not available on '+postcode); 
					fadeOut();
					refreshCart()
				}
			}
		   });
	 });
	 
	$(document).on('click','.closeAddressPopup', function () {
		document.cookie='postcode_close=1'; 
		$('#postcodeModal').modal('hide');
	});
	
	$(document).on('click','.preOrderCookie', function () {
		document.cookie='preorderCookie=1'; 
		$('#preOrderModal').modal('hide');
	});
	
	$('#contactForm').on('submit', function(e){
       
		var name =  $.trim($('#name').val());
		var email = $.trim($('#email').val());
		var phone = $.trim($('#phoneNumber').val());
		var subject = $.trim($('#subject').val());
		var message = $.trim($('#message').val());
        
		if(name=='')
		{
			$('#name').addClass('form-control-danger');
			$('#name').focus();
			$('.err_name').html('Name can\'t be blank.');
			return false;
		}else{
			$('#name').removeClass('form-control-danger');
			$('#name').addClass('form-control-success');
			$('.err_name').html('');
		}
			
		if(email=='')
		{
			$('#email').addClass('form-control-danger');
			$('#email').focus();
			$('.err_email').html('Email can\'t be blank.');
			return false;
		}else{
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test(email)) {
				$('#email').addClass('form-control-danger');
				$('#email').focus();
				$('.err_email').html('Please provide a valid email address');
				return false;
			}else{

				$('#email').removeClass('form-control-danger');
				$('#email').addClass('form-control-success');
				$('.err_email').html('');
			}
		}										
        
		if(phone=='')
		{
			$('#phoneNumber').addClass('form-control-danger');
			$('#phoneNumber').focus();
			$('.err_phone').html('mobile number can\'t be blank.');
			return false;
		}else{
			if(phone.length< 3){
				$('#phoneNumber').addClass('form-control-danger');
				$('#phoneNumber').focus();
				$('.err_phone').html("Mobile number should be minimum 3 digits.");
				return false;
			}else {
				$('#phoneNumber').removeClass('form-control-danger');
				$('#phoneNumber').addClass('form-control-success');
				$('.err_phone').html('');
				}
		}
		
		if(subject=='')
		{
			$('#subject').addClass('form-control-danger');
			$('#subject').focus();
			$('.err_subject').html('Subject can\'t be blank.');
			return false;
		}else{
			$('#subject').removeClass('form-control-danger');
			$('#subject').addClass('form-control-success');
			$('.err_subject').html('');
		}
		
		if(message=='')
		{
			$('#message').addClass('form-control-danger');
			$('#message').focus();
			$('.err_message').html('Message can\'t be blank.');
			return false;
		}else{
			$('#message').removeClass('form-control-danger');
			$('#message').addClass('form-control-success');
			$('.err_message').html('');
		}
		
		$('.disable').prop('disabled', true);
		$('#contactForm').submit();
        
	});
	
	$('#paymentoption').on('submit', function(e){
       
		var postcode =  $.trim($('#postcode').val());
		var delivery_type = $.trim($('#delivery_type').val());
		
		if(delivery_type==1){
			if(postcode=='')
			{
				$('#postcode').addClass('form-control-danger');
				$('#postcode').focus();
				$('.err_postcode').html('Place can\'t be blank.');
				return false;
			}else{
				$('#postcode').removeClass('form-control-danger');
				$('#postcode').addClass('form-control-success');
				$('.err_postcode').html('');
			}
		}
		
		$('.disable').prop('disabled', true);
		$('#paymentoption').submit();
        
	});
	
	
	$("#apply").click(function(){
		var promocode =  $.trim($('#promocode').val());
		if(promocode!=''){
			$('.loading-image').show();
			url = site_url+'/checkout/applypromocode';
			$.ajax({
				'type': "POST",
				'url': url,
				'dataType': 'json',
				data:{promocode:promocode},
					success: function(dataResult){
						$('.loading-image').hide();
						
						//var dataResult = JSON.parse(data);
						if(dataResult.status==1){
							refreshCheckout();
							$('#apply').hide();
							$('#edit').show();
							$('#promocode').removeClass('form-control-danger');
							$('#promocode').addClass('form-control-success');
							$('.err_promocode').html(dataResult.msg);
						}
						else if(dataResult.status==0){
							$('#promocode').removeClass('form-control-success');
							$('#promocode').addClass('form-control-danger');
							$('.err_promocode').html(dataResult.msg);
						}
				}
			});
		}
		else{
			$('#promocode').addClass('form-control-danger');
			$('#promocode').focus();
			$('.err_promocode').html("Promocode can not be blank .Enter a Valid Promocode !");
		}
	});
	
	$("#edit").click(function(){
		
		$('.loading-image').show();
		url = site_url+'/checkout/removepromocode';
		$.ajax({
			'url': url,
			'dataType': 'json',
			success: function(dataResult){
				$('.loading-image').hide();
				if(dataResult.status==1){
					refreshCheckout();
					$('#promocode').val("");
					$('#apply').show();
					$('#edit').hide();
					$('.err_promocode').html('');
				}
				else if(dataResult.status==0){
					$('.err_promocode').html('Something went wrong.');
				}
			}
		});
	});
	
	
	$("#applyPoint").click(function(){
		var used_point =  $.trim($('#used_point').val());
		var sub_total =  $.trim($('#sub_total').val());
		if(used_point!='' && !isNaN(used_point)){
			$('.loading-image').show();
			url = site_url+'/checkout/applyPoint';
			$.ajax({
				'type': "POST",
				'url': url,
				'dataType': 'json',
				data:{used_point:used_point,sub_total:sub_total},
					success: function(dataResult){
						$('.loading-image').hide();
						
						//var dataResult = JSON.parse(data);
						if(dataResult.status==1){
							refreshCheckout();
							$('#applyPoint').hide();
							$('#removePoint').show();
							$('#used_point').removeClass('form-control-danger');
							$('#used_point').addClass('form-control-success');
							$('.err_used_point').html(dataResult.msg);
						}
						else if(dataResult.status==0){
							$('#used_point').removeClass('form-control-success');
							$('#used_point').addClass('form-control-danger');
							$('.err_used_point').html(dataResult.msg);
						}
				}
			});
		}
		else{
			$('#used_point').addClass('form-control-danger');
			$('#used_point').focus();
			$('.err_used_point').html("Loyalty points can not be blank or must be numeric value.Enter a Valid Points !");
		}
	});
	
	$("#removePoint").click(function(){
		
		$('.loading-image').show();
		url = site_url+'/checkout/removePoint';
		$.ajax({
			'url': url,
			'dataType': 'json',
			success: function(dataResult){
				$('.loading-image').hide();
				if(dataResult.status==1){
					refreshCheckout();
					$('#used_point').val("");
					$('#applyPoint').show();
					$('#removePoint').hide();
					$('.err_used_point').html('');
				}
				else if(dataResult.status==0){
					$('.err_used_point').html('Something went wrong.');
				}
			}
		});
	});
	
	
	$(document).on('click','#send-to-kitchen', function(e){

		var table_number =  $.trim($('#table_number').val());
		var name =  $.trim($('#name').val());
		var email = $.trim($('#email').val());
		var phone = $.trim($('#phone').val());
		
		if(table_number=='')
		{
			$('#table_number').addClass('form-control-danger');
			$('#table_number').focus();
			$('.err_table_number').html('Table number can\'t be blank.');
			return false;
		}else{
			$('#table_number').removeClass('form-control-danger');
			$('#table_number').addClass('form-control-success');
			$('.err_table_number').html('');
		}
		
		
		
		if(email!='')
		{
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test(email)) {
				$('#email').addClass('form-control-danger');
				$('#email').focus();
				$('.err_email').html('Please provide a valid email address');
				return false;
			}else{

				$('#email').removeClass('form-control-danger');
				$('#email').addClass('form-control-success');
				$('.err_email').html('');
			}
		}
			
		if(phone!='')
		{
			
		
			if(phone.length!=11){
				$('#phone').addClass('form-control-danger');
				$('#phone').focus();
				$('.err_phone').html("Mobile number should be 11 digits.");
				return false;
			}else {
				$('#phone').removeClass('form-control-danger');
				$('#phone').addClass('form-control-success');
				$('.err_phone').html('');
				}
		}
		
		$('.loading-image').show();
		url = site_url+'/order/sendtokitchen';
		$.ajax({
			'url': url,
			'dataType': 'json',
			method:'POST',
			data:{table_number:table_number,name:name,email:email,phone:phone},
			success: function(dataResult){
				$('.loading-image').hide();
				if(dataResult.status==1){
					$('.err').hide()
					$('.suss').show()
					$('.fixed_success').html(dataResult.msg)
					fadeOut();
					refreshCart();
				}else{
					$('.suss').hide()
					$('.err').show()
					$('.fixed_error').html(dataResult.msg)
					fadeOut();
				}
			}
		});
		// $('.disable').prop('disabled', true);
		// $('#paymentoption').submit();
        
	});
	
	$( document ).on( "click", ".delete_item_kitchen", function() {
		var item_id = $(this).attr('data-kitchen-id');
		
		if(confirm("Are you sure you want to delete this?")){
			$('.loading-image').show();
			url = site_url+'/cart/deleteKitchenItem';
			$.ajax({
				'type': "POST",
				'url': url,
				'dataType': 'json',
				'data': { item_id: item_id,type:1},
				'dataType': 'json',
				success: function (data) {
					$('.loading-image').hide();
					$('.msg_error_success').show()
					if(data.status==1)
					{
						$('.err').hide()
						$('.suss').show()
						$('.fixed_success').html(data.msg)
						refreshCart()
						fadeOut();
					}else{
						$('.suss').hide()
						$('.err').show()
						$('.fixed_error').html(data.msg)
						refreshCart()
						fadeOut();
					}
				
				}
			});
		}else{
			return false;
		}
		 
		
	});
	
	$( document ).on( "click", ".delete_addon_item_kitchen", function() {
		var item_id = $(this).attr('data-kitchen-id');
		
		if(confirm("Are you sure you want to delete this?")){
			$('.loading-image').show();
			url = site_url+'/cart/deleteKitchenItem';
			$.ajax({
				'type': "POST",
				'url': url,
				'dataType': 'json',
				'data': { item_id: item_id,type:2},
				'dataType': 'json',
				success: function (data) {
					$('.loading-image').hide();
					$('.msg_error_success').show()
					if(data.status==1)
					{
						$('.err').hide()
						$('.suss').show()
						$('.fixed_success').html(data.msg)
						refreshCart()
						fadeOut();
					}else{
						$('.suss').hide()
						$('.err').show()
						$('.fixed_error').html(data.msg)
						refreshCart()
						fadeOut();
					}
				
				}
			});
		}else{
			return false;
		}
		 
		
	});
	
	$(document).on('click','#quick_checkout_button', function(e){
       
		var order_type = $('input[name="order_type"]:checked').val();
		
		 if (typeof order_type == 'undefined') {          
			alert('Please select order type.')
			return false;
		 }
		$('#checkout').submit();
        
	});
	
	
	$('#reservation_form').on('submit', function(e){
		var name =  $.trim($('#name').val());
		var email = $.trim($('#email').val());
		var mobile = $.trim($('#mobile').val());
		var booking_date = $.trim($('#booking_date').val());
		var booking_time = $.trim($('#booking_time').val());
		var guest = $.trim($('#guest').val());
		
		
		if(name=='')
		{
			$('#name').addClass('form-control-danger');
			$('#name').focus();
			$('.err_name').html('Name can\'t be blank.');
			return false;
		}else{
			$('#name').removeClass('form-control-danger');
			$('#name').addClass('form-control-success');
			$('.err_name').html('');
		}
		
		
		if(email=='')
		{
			$('#email').addClass('form-control-danger');
			$('#email').focus();
			$('.err_email').html('Email can\'t be blank.');
			return false;
		}else{
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (!filter.test(email)) {
				$('#email').addClass('form-control-danger');
				$('#email').focus();
				$('.err_email').html('Please provide a valid email address');
				return false;
			}else{
				$('#email').removeClass('form-control-danger');
				$('#email').addClass('form-control-success');
				$('.err_email').html('');
			}
		}
		
		if(mobile=='')
		{
			$('#mobile').addClass('form-control-danger');
			$('#mobile').focus();
			$('.err_phone').html('mobile number can\'t be blank.');
			return false;
		}else{
			if(mobile.length!=11){
					$('#mobile').addClass('form-control-danger');
					$('#mobile').focus();
					$('.err_phone').html("Mobile number should be  11 digits.");
					return false;
			}else {
					$('#mobile').removeClass('form-control-danger');
					$('#mobile').addClass('form-control-success');
					$('.err_phone').html('');
				}
		}
		
		if(booking_date=='')
		{
			$('#booking_date').addClass('form-control-danger');
			$('#booking_date').focus();
			$('.err_booking_date').html('Booking Date can\'t be blank.');
			return false;
		}else{
			$('#booking_date').removeClass('form-control-danger');
			$('#booking_date').addClass('form-control-success');
			$('.err_booking_date').html('');
		}
		
		if(booking_time=='')
		{
			$('#booking_time').addClass('form-control-danger');
			$('#booking_time').focus();
			$('.err_booking_time').html('Booking Date can\'t be blank.');
			return false;
		}else{
			$('#booking_time').removeClass('form-control-danger');
			$('#booking_time').addClass('form-control-success');
			$('.err_booking_time').html('');
		}
		
		if(guest=='')
		{
			$('#guest').addClass('form-control-danger');
			$('#guest').focus();
			$('.err_guest').html('No. of person can\'t be blank.');
			return false;
		}else{
			$('#guest').removeClass('form-control-danger');
			$('#guest').addClass('form-control-success');
			$('.err_guest').html('');
		}
		
		$('.disable').prop('disabled', true);
		$('#reservation_form').submit();
        
    });
	
	
});