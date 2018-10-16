<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		ManagementCom
* @subpackage	ProductCustomers
* @copyright	
* @author		 -  - 
* @license		
*
*             .oooO  Oooo.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/

// no direct access
defined('_JEXEC') or die('Restricted access');


if (!$this->form)
	return;

$fieldSets = $this->form->getFieldsets();
//don't plus vacuum 10.000 when pricelist_id = 1 (Gạo)
$flag_vacuum = (isset($this->item->_customer_id_pricelist_id) && $this->item->_customer_id_pricelist_id==1)?1:0;

?>

<?php $fieldSet = $this->form->getFieldset('productcustomer.form');?>
<fieldset class="fieldsform form-horizontal span8">
	
	<?php
	// Ngày Nhập
	$field = $fieldSet['jform_input_date'];
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>

	<?php
	// Khách Hàng
	$field = $fieldSet['jform_customer_id'];
	$field->jdomOptions = array(
		'list' => $this->lists['fk']['customer_id']
			);
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>

	
	<?php
	// Số Lượng
	$field = $fieldSet['jform_total_weight'];
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>
	
	<?php
	// Trọng Lượng
	$field = $fieldSet['jform_weight'];
	$field->jdomOptions = array(
		'list' => ManagementcomHelperEnum::_('productcustomers_weight')
			);
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>

	<?php
	// Sản Phẩm
	$field = $fieldSet['jform_product_id'];
	$field->jdomOptions = array(
		'list' =>  $this->lists['fk']['product_id']
			);

	//var_dump($this->lists['fk']['product_id']);
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls product_package" >
            <fieldset id="jform_product_id" class="radio btn-group" style="border:0 none;">

            <?php
            $count = 12 / count($this->lists['fk']['column_ordering']);
            $count = 3;

            for ($col=0; $col < count($this->lists['fk']['column_ordering']); $col++): ?>
                <div class="span<?php echo $count?>">
	                <?php foreach ($this->lists['fk']['product_id'] as $key => $product): ?>
	                <?php if ($product['column_ordering'] == $col+1): ?>
                        <?php $is_checked = '';
                            if (isset($this->item->product_id) && $this->item->product_id == $product['value']) $is_checked = 'checked';
                            elseif ($product['value'] == 1) $is_checked = 'checked';
                        ?>
                        <input type="radio" name="jform[product_id]" id="jform_product_id_<?php echo $key?>" value="<?php echo $product['value']?>" rel="[]" class="validate[required]" <?php echo $is_checked?>>
                        <label for="jform_product_id_<?php echo $key?>" class="btn <?php echo (!empty($is_checked)) ? 'active btn-success' : ''?>"><i style="margin-right:5px;" class="icon- icomoon "></i><?php echo $product['text']?></label>
                    <?php endif;?>
	                <?php endforeach;?>
                </div>
            <?php endfor;?>


            </fieldset>
			<?php //echo $field->input; ?>
		</div>
	</div>

	<?php
	// Vị
	$field = $fieldSet['jform_taste'];
	$field->jdomOptions = array(
		'list' => ManagementcomHelperEnum::_('productcustomers_taste')
			);
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>



	<?php
	// Hút Chân Không
	$field = $fieldSet['jform_vacuum'];
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>

	<?php
	//Giá
	$field = $fieldSet['jform_total_price'];
	?>
	<div class="control-group field-jform_total_price">
		<div class="control-label">
			<label id="jform_total_price-lbl" for="jform_total_price" class="required">Giá<span class="star" style="color: red;">&nbsp;*</span></label>
		</div>
	
	    <div class="controls">
			<!--<p class="price" style="margin: 5px 0 0 0;">0</p>-->
			<input type="text"  class="price" value="" size="32">
			<?php echo $field->input; ?>
		</div>
	</div>


	<?php
	// Ghi Chú
	$field = $fieldSet['jform_note'];
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>



	<?php
	// Payment Status
	$field = $fieldSet['jform_payment_status'];
	$field->jdomOptions = array(
		'list' => ManagementcomHelperEnum::_('productcustomers_payment_status')
			);
	?>
		<?php if (!method_exists($field, 'canView') || $field->canView()): ?>
		<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
			<div class="control-label">
				<?php echo $field->label; ?>
			</div>
	
		    <div class="controls">
				<?php echo $field->input; ?>
			</div>
		</div>
		<?php endif; ?>


	<input type="hidden" id="jform_bill_option" name="jform[json_bill_option]" value="0" size="32">
	
</fieldset>
<div class='span4 toolbar-2'>
<select id='arr_bill'>
	<option value="">- Select Hóa Đơn -</option>
</select>

<button class="btn btn-small btt-add"><span class="icon-plus"></span>Save Bill</button>
<button class="btn btn-small btn-danger btt-remove"><span class="icon-trash"></span>Remove</button>
</div>


<!--Add more -->
<script type="text/javascript">
jQuery(function($){
	
});
</script>

<script type="text/javascript">
jQuery(function($){
	var $toolbar = $('#toolbar').clone();
	$('.toolbar').html($toolbar);

	var json_listPrices= <?php echo json_encode($this->json_listPrices); ?>;
	var flag_vacuum= <?php echo json_encode($flag_vacuum); ?>;
	
	var vacuum = 10000;
	var flag_vacuum_yn = 'yes';
	if ( $('#jform_vacuum_0').is(':checked') )  flag_vacuum_yn = 'no';
	if ( $('#jform_vacuum_1').is(':checked') )  flag_vacuum_yn = 'yes';
	
	$("[name='jform[vacuum]']").click(function(){	
        if ($('#jform_vacuum_0').is(':checked') && flag_vacuum != 1 && flag_vacuum_yn =='yes' ) {
			total_price = parseFloat($('#jform_total_price').val()) - vacuum*parseFloat($("#jform_total_weight").val());
			$('.price').val(addCommas(total_price));
			$('#jform_total_price').val(total_price);
			flag_vacuum_yn = 'no';
		}    
		else if ($('#jform_vacuum_1').is(':checked')  && flag_vacuum != 1 && flag_vacuum_yn =='no' ) {
			total_price = parseFloat($('#jform_total_price').val()) + vacuum*parseFloat($("#jform_total_weight").val());
			$('.price').val(addCommas(total_price));
			$('#jform_total_price').val(total_price);
			flag_vacuum_yn = 'yes';
		}
    });
	
	//alert(JSON.stringify(json_listPrices));
	$("#jform_total_price").hide();
	
	//inital
	if ( $("#jform_total_price").val() !== "")
	{
		$('.price').val( addCommas($("#jform_total_price").val()));
	}
	
	if ( $("#jform_customer_id").val() !== "")
	{
		var selected_customer_id = $("#jform_customer_id").val() ; 
		dosomething2(1, selected_customer_id);
		dosomething3(1, selected_customer_id);		
	}
	
	if ( $("#jform_total_price").val() == "0" && $("#jform_total_weight").val() !== "" && $("#jform_customer_id").val() !== "" && $('input[name="jform[product_id]"]:checked').val() !== "") {
		var selected_product_id = $('input[name="jform[product_id]"]:checked').val() ; 			
		dosomething(1, selected_product_id);
	}
	
	//Customer  Change
	$("#jform_customer_id").chosen().change(function(event){
		if ( $(this).val() != "" )
		{
			var selected_customer_id = $("#jform_customer_id").val() ; 
			dosomething2(1, selected_customer_id);
			dosomething3(1, selected_customer_id);		
			dosomething(1, $('input[name="jform[product_id]"]:checked').val());
		}
		else
		{
			$(".price").val('');
		}
	});
	
	// Product Change
	$('input[name="jform[product_id]"]').click(function() {
		if ( $(this).val() != "" )
		{
			var selected_product_id = $(this).val(); 
			dosomething(1, selected_product_id);
		}
		else
		{
			$(".price").val('');
		}
	})
		
	$("#jform_total_weight").focusout(function() {
		if ( $(this).val() != "" )
		{
			var selected_product_id = $('input[name="jform[product_id]"]:checked').val() ; 			
			dosomething(1, selected_product_id);
		}
		else
		{
			$(".price").val('');
		}
		
		
	});
	
	$(".price").focusout(function() {
		price = $(this).val().split('.').join("");
		$('#jform_total_price').val(price);
	});
	
	function dosomething(flag, selected_product_id){
		var price = 0;

		for( i = 0; i < json_listPrices.length; i++ )
		{
			if( json_listPrices[i].id == selected_product_id)
			{
				price = json_listPrices[i].price;
			}	
		}

		var total_price = price * parseFloat($('#jform_total_weight').val());

		if ($('#jform_vacuum_1').is(':checked'))
		{
			total_price = total_price + vacuum * parseFloat($("#jform_total_weight").val());
		}
		
		$('.price').val(addCommas(total_price));
		$('#jform_total_price').val(total_price);
	}
	
	$("#jform_customer_id").chosen().change(function(event){
		if ( $(this).val() != "" )
		{
			var selected_customer_id = ($(this).chosen().val()); 
			dosomething2(1, selected_customer_id);
			dosomething3(1, selected_customer_id);
		}
		else
		{
			$(".price").val('');
		}
	});
	
	
	function dosomething2(flag, selected_customer_id){
		var data = 'selected_customer_id='+selected_customer_id;
		var a = window.location.protocol + "//" + window.location.host + window.location.pathname + '?option=com_managementcom&task=productcustomer.ajax_list_price';
		
		//call ajax - controller car_make
		jQuery.ajax({
			 type: "POST",
			 url: a,
			 data: data,
			 success: function(data){
				json_listPrices = $.parseJSON(data);
				/* alert(JSON.stringify(json_listPrices)); */
			}
		});
	}
	
	function dosomething3(flag, selected_customer_id){
		var data = 'selected_customer_id='+selected_customer_id;
		var a = window.location.protocol + "//" + window.location.host + window.location.pathname + '?option=com_managementcom&task=productcustomer.ajax_isFreeVacuum';
		
		//call ajax - controller car_make
		jQuery.ajax({
			 type: "POST",
			 url: a,
			 data: data,
			 success: function(data){
				flag_vacuum = $.parseJSON(data);
				if ( flag_vacuum == 1) flag_vacuum = 1;
				else
					flag_vacuum = 0;
			}
		});
	}
	function addCommas(nStr)
	{
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + '.' + '$2');
		}
		return x1 + x2;
	}
	
	//---------------addmore---------------------------------
	var num_bill = 1;
	//load form went multi bill - first bill
	var bill_id = <?php echo ($this->item->bill_id)?$this->item->bill_id:0;?>;	

	if (bill_id)
	{	
		call_ajax(bill_id);

		function call_ajax(bill_id){
			var data = 'selected_bill_id='+bill_id;
			var a = window.location.protocol + "//" + window.location.host + window.location.pathname + '?option=com_managementcom&task=productcustomer.ajax_getBill';
			
			//call ajax - controller car_make
			jQuery.ajax({
				 type: "POST",
				 url: a,
				 data: data,
				 async: false,
				 success: function(data){				
					bill = $.parseJSON($.parseJSON(data));
					var vl = '';
					$.each(bill, function( index, value ) {						
						var option_text = value.bill_name;
						var option_value = JSON.stringify(value);
						var option = new Option(option_text, option_value);
						$('#arr_bill').append($(option));
						$("#arr_bill").trigger("liszt:updated");
						
						// Remove string bill
						var str = option_text.replace('Sản Phẩm ','');
						if ( parseInt(str) > num_bill) num_bill = parseInt(str);
						vl = option_value;
					});		
					// Chosen change				
					num_bill++;	

					if (vl)
					{
						$("#arr_bill").val(vl);
						$("#arr_bill").trigger("liszt:updated");					
						setBill($.parseJSON(vl));
						$('.toolbar-2').show();
					}
				}
			});
		}
	}else{
		$('.toolbar-2').hide();
	}
	// Add button
	$('.btt-add').on('click', function(e){	
		if ( $("#adminForm").validationEngine('validate') )
		{
			var bill = {
				//customer_id: $('#jform_customer_id').val(),
				product_id: $('input[name="jform[product_id]"]:checked').val(),
				total_weight: $('#jform_total_weight').val(),
				total_price: $('#jform_total_price').val(),
				weight: $('#jform_weight').find('input:checked').val(),
				taste: $('#jform_taste').find('input:checked').val(),
				vacuum: $('#jform_vacuum').find('input:checked').val(),
				payment_status: $('#jform_payment_status').find('input:checked').val(),
				note: $('#jform_note').val()
			};
			
			if ($('#arr_bill').val())
			{
				var option_text = $("#arr_bill option[value='"+$('#arr_bill').val()+"']").text();
				//remove
				$("#arr_bill option[value='"+$('#arr_bill').val()+"']").remove();
			}
			else
			{
				var option_text = 'Sản Phẩm '+num_bill;
				num_bill++;
			}	

			var option_value = JSON.stringify(bill);
			var option = new Option(option_text, option_value);
			$('#arr_bill').append($(option));
			$("#arr_bill").trigger("liszt:updated");
			
			//reset form
			setFormDefault();
		}		
		
		
		e.preventDefault();
	});

	// Remove button
	$('.btt-remove').on('click', function(e){
		var vl = $("#arr_bill").chosen().val();
		$("#arr_bill option[value='"+vl+"']").remove();
		$("#arr_bill").trigger("liszt:updated");

		e.preventDefault();
	});

	// Submit form
	Joomla.submitform = function(task){
		switch (task){
			case "productcustomer.addmore":
				$('.toolbar-2').show();
				//new
				if ($('#arr_bill').val())
				{
					setFormDefault();
				}
				else							
				//edit - test and get value
				if ( $("#adminForm").validationEngine('validate') ){
					var bill = {
						//customer_id: $('#jform_customer_id').val(),
						product_id: $('input[name="jform[product_id]"]:checked').val(),
						total_weight: $('#jform_total_weight').val(),
						total_price: $('#jform_total_price').val(),
						weight: $('#jform_weight').find('input:checked').val(),
						taste: $('#jform_taste').find('input:checked').val(),
						vacuum: $('#jform_vacuum').find('input:checked').val(),
						payment_status: $('#jform_payment_status').find('input:checked').val(),
						note: $('#jform_note').val()
					};
					//alert(JSON.stringify(bill));
					
					//add to dropdown
					var option_text = 'Sản Phẩm '+num_bill;
					var option_value = JSON.stringify(bill);
					var option = new Option(option_text, option_value);
					$('#arr_bill').append($(option));
					$("#arr_bill").trigger("liszt:updated");
					num_bill++;
					
					//reset form
					setFormDefault();
				}	
				break;
			//remove
		
			//save json file
			case "productcustomer.save2new":
			case "productcustomer.save":
			case "productcustomer.apply":				
				var length = $('#arr_bill > option').length;
				//is multiple bills
				//set json value for elements of form
				if ( length > 1 ){
					var arr_bill_option = [];	
									
					$("#arr_bill option").each(function(name, val) { 
						var opt=val.value; 
						var el=val.text; 
						
						if (opt){							
							arr_bill_option.push('"' + el + '":' + opt);							
						}
					});
				
					arr_bill_option = '{' + JSON.parse(JSON.stringify(arr_bill_option)) + '}';
					//set value
					$("#arr_bill option").each(function(name, val) { 
						var opt = val.value; 
						if (opt){							
							$("#arr_bill").val(opt);	
							$("#arr_bill").trigger("liszt:updated");			
							bill = jQuery.parseJSON( opt );
							setBill(bill);
							return false;
						}
					});
					
					$("#jform_bill_option").val(arr_bill_option);
				}
				document.adminForm.task.value=task;
				document.adminForm.submit();
				break;
			default:
				document.adminForm.task.value=task;
				document.adminForm.submit();
			
		}
		
	}
	// Dropdown chosen bill change
	$("#arr_bill").chosen().change(function(event){
		if ( $(this).val() != "" )
		{
			var bill = $(this).chosen().val(); 
			bill = jQuery.parseJSON( bill );
			setBill(bill);
		}
		else{
			// Reset form
			setFormDefault();
		}
	});
	
	// Reset form
	function setFormDefault(){
		$('#jform_total_weight').val('');
		$('#jform_total_price').val('');
		$('.price').val('');
		$('#jform_note').val('');
		$('input[name="jform[product_id]"]:checked').attr('checked', false);
		$('#jform_product_id label').removeClass('active btn-success');
		
		$('#jform_weight').find('input:checked').removeAttr('checked');
		$('#jform_weight4').attr('checked', 'checked');
		$('#jform_weight label').removeClass('active btn-success');
		$('#jform_weight').find('label[for="jform_weight4"]').addClass('active btn-success');
		
		$('#jform_taste').find('input:checked').removeAttr('checked');
		$('#jform_taste0').attr('checked', 'checked');
		$('#jform_taste label').removeClass('active btn-success');
		$('#jform_taste').find('label[for="jform_taste0"]').addClass('active btn-success');	
		
		$('#jform_vacuum').find('input:checked').removeAttr('checked');
		$('#jform_vacuum_0').attr('checked', 'checked');
		$('#jform_vacuum label').removeClass('active btn-success');
		$('#jform_vacuum').find('label[for="jform_vacuum_0"]').addClass('active btn-success');

		$('#jform_payment_status').find('input:checked').removeAttr('checked');
		$('#jform_payment_status_0').attr('checked', 'checked');
		$('#jform_payment_status label').removeClass('active btn-success');
		$('#jform_payment_status').find('label[for="jform_payment_status_0"]').addClass('active btn-success');

		
		$('#jform_product_id_0').attr('checked', 'checked');
		$('#jform_product_id').find('label[for="jform_product_id_0"]').addClass('active btn-success');	
		

		$("#arr_bill").val('');
		$("#arr_bill").trigger("liszt:updated");
		
		flag_vacuum_yn = 'no';

		// Focus mouse in so luong
		$('#jform_total_weight').focus();
	}
	
	// Set bill
	function setBill(obj){		
		if ( obj!== null ){
			$('#jform_total_weight').val(obj.total_weight);
			$('#jform_total_price').val(obj.total_price);
			$('.price').val(addCommas(obj.total_price));
			$('#jform_note').val(obj.note);
			
			$('input[name="jform[product_id]"][value="' + obj.product_id + '"]').attr('checked', true); 
			$('#jform_product_id label').removeClass('active btn-success');
			$('input[name="jform[product_id]"][value="' + obj.product_id + '"]').next().addClass('active btn-success');
			
			obj.weight = obj.weight - 1;
			$('#jform_weight').find('input:checked').removeAttr('checked');
			$('#jform_weight' + obj.weight).attr('checked', 'checked');
			$('#jform_weight label').removeClass('active btn-success');
			$('#jform_weight').find('label[for="jform_weight' + obj.weight+'"]').addClass('active btn-success');
			
			$('#jform_taste').find('input:checked').removeAttr('checked');
			$('#jform_taste' + obj.taste).attr('checked', 'checked');
			$('#jform_taste label').removeClass('active btn-success');
			$('#jform_taste').find('label[for="jform_taste' + obj.taste + '"]').addClass('active btn-success');	
			
			$('#jform_vacuum').find('input:checked').removeAttr('checked');
			$('#jform_vacuum_' + obj.vacuum).attr('checked', 'checked');
			$('#jform_vacuum label').removeClass('active btn-success');
			$('#jform_vacuum').find('label[for="jform_vacuum_'+obj.vacuum+'"]').addClass('active btn-success');	

			$('#jform_payment_status').find('input:checked').removeAttr('checked');
			$('#jform_payment_status_' + obj.payment_status).attr('checked', 'checked');
			$('#jform_payment_status label').removeClass('active btn-success');
			$('#jform_payment_status').find('label[for="jform_payment_status_'+obj.payment_status+'"]').addClass('active btn-success');

			if ($('#jform_vacuum_0').is(':checked'))
			{
				flag_vacuum_yn = 'no';
			}

			if ($('#jform_vacuum_1').is(':checked'))
			{
				flag_vacuum_yn = 'yes';
			}
			
		}
	}
	
 });
</script>

<style>
.toolbar-2{
	float: right;
    text-align: right;
}
.chzn-container{
	text-align: left;
}
</style>
