<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		Managementcom
* @subpackage	Costs
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

<?php $fieldSet = $this->form->getFieldset('cost.form');?>
<fieldset class="fieldsform form-horizontal">

	<?php
	// JForms dynamic initialization (Cook Self Service proposal)
	$fieldSet['jform_typecost_id']->jdomOptions = array(
			'list' => $this->lists['fk']['typecost_id']
		);
	echo $this->renderFieldset($fieldSet);
	?>
</fieldset>

<script type="text/javascript">
jQuery(function($){
	var $toolbar = $('#toolbar').clone();
	$('.toolbar').html($toolbar);
 });
</script>

<script type="text/javascript">
jQuery(function($){
	var lastDateInput = "<?php echo $this->lastDateInput?>";
	$('#jform_input_date').val(lastDateInput);
});
</script>