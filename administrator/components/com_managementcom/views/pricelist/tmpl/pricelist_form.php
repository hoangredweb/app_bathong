<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		ManagementCom
* @subpackage	pricelists
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

if ( isset($this->item->price) && $this->item->price )
	$json_listPrices = json_decode($this->item->price, true);

$i = 0;

foreach ($this->listProducts as $item){
	$this->listProducts[$i]->price = 0;
	if ( isset($this->item->price) && $this->item->price ){
		foreach ($json_listPrices as $jitem){
			if ($jitem['id'] == $item->id ){
				$this->listProducts[$i]->price = ($jitem['price'])?$jitem['price']:'0';		
				break;
			}
		}
	}
	$i++;
}
?>

<?php $fieldSet = $this->form->getFieldset('pricelist.form');?>
<fieldset class="fieldsform form-horizontal">

	<?php
	// Name
	$field = $fieldSet['jform_name'];
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>
	<hr>
	<div class="control-group listprices">
	<?php
	// Giá
	foreach ($this->listProducts as $item):?>
	<div class="control-group">
		<div class="control-label">
			<label class="required"><?php echo $item->product_name; ?><span class="star" style="color: red;">&nbsp;*</span></label>
		</div>
	
	    <div class="controls">
			<input type="hidden" class="product_id" value="<?php echo $item->id?>" size="32">
			<input type="text" class="price" id="price<?php echo $item->price?>" value="<?php echo $item->price?>" size="32" >
		</div>
	</div>
	<?php
	endforeach;
	?>
	
	<input type="hidden" id="jform_price" name="jform[price]" value="" size="32">
	<hr>
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
	// Status
	$field = $fieldSet['jform_published'];
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

</fieldset>

<div class="toolbar"></div>
<script type="text/javascript">


jQuery(function($){
	Joomla.submitbutton = function(task){ 
	if ( task == 'pricelist.apply' || task == 'pricelist.save2new' || task == 'pricelist.save' ){
		//validate
		$flag = true;
		$('.price').each(function(i,v){
			var value = $(this).val();
			if ( !$.isNumeric(value) ){
				id = $(this).attr('id');
				$("#"+id).validationEngine('showPrompt', "<span>•</span> Enter Number Only.", 'asdas',"topLeft",1);
				$flag = false;
			} 
			if ( !(value) ){
				id = $(this).attr('id');
				$("#"+id).validationEngine('showPrompt', "<span>•</span> This field is required.", 'asdas',"topLeft",1);
				$flag = false;
			} 
		});
		
		if ($flag){
			var pricelists = [];	
			//create json file
			$('.product_id').each(function(i,v){
				var price = new Object();
				price.id =  $(this).val();
				price.price = $(this).parent().find('.price').val();		
				pricelists.push(price);	
			});
			
			$('#jform_price').val(JSON.stringify(pricelists));
			window.onbeforeunload = null;
			Joomla.submitform(task, $('#adminForm')); 	
		}                              
	 } 
	 else {
		window.onbeforeunload = null; 
		Joomla.submitform(task);
	 }
   }
	Joomla.submitform = function(task){
		if (task) {
			document.adminForm.task.value=task;
		}
		else	
		document.adminForm.task.value = "";
		if (typeof document.adminForm.onsubmit == "function") {
			document.adminForm.onsubmit();
		}
		document.adminForm.submit();
	}
		
 });
     
</script>
