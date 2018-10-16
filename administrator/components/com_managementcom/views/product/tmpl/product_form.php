<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		ManagementCom
* @subpackage	Products
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
?>

<?php $fieldSet = $this->form->getFieldset('product.form');?>
<fieldset class="fieldsform form-horizontal">

	<?php
	// Mã Sản Phẩm
	$field = $fieldSet['jform_product_code'];
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
	// Tên Sản Phẩm
	$field = $fieldSet['jform_product_name'];
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
	// Cột
	$field = $fieldSet['jform_column_ordering'];
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