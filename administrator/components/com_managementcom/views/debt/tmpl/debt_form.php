<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1.5   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		managementcom
* @subpackage	debts
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

<?php $fieldSet = $this->form->getFieldset('debt.form');?>
<fieldset class="fieldsform form-horizontal">
	<?php
	// JForms dynamic initialization (Cook Self Service proposal)
	/*$fieldSet['jform_order_id']->jdomOptions = array(
			'list' => $this->lists['fk']['order_id']
		);*/
	echo $this->renderFieldset($fieldSet);
	?>

	<?php
	// JForms dynamic initialization (Cook Self Service proposal)
	/*$fieldSet['jform_customer_id']->jdomOptions = array(
			'list' => $this->lists['fk']['customer_id']
		);*/
	echo $this->renderFieldset($fieldSet);
	?>
</fieldset>