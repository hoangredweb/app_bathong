<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		ManagementCom
* @subpackage	ManagementCom
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

if (!class_exists('ManagementcomHelper'))
	require_once(JPATH_ADMINISTRATOR . '/components/com_managementcom/helpers/loader.php');


/**
* Form field for Managementcom.
*
* @package	Managementcom
* @subpackage	Form
*/
class ManagementcomCkFormFieldCkajax extends ManagementcomClassFormField
{
	/**
	* The form field type.
	*
	* @var string
	*/
	public $type = 'ckajax';

	/**
	* Method to get the field input markup.
	*
	* @access	public
	*
	*
	* @since	11.1
	*
	* @return	string	The field input markup.
	*/
	public function getInput()
	{

		$this->input = JDom::_('html.form.input.ajax', array_merge(array(
				'dataKey' => $this->getOption('name'),
				'domClass' => $this->getOption('class'),
				'domId' => $this->id,
				'domName' => $this->name,
				'ajaxContext' => $this->getOption('ajaxContext'),
				'ajaxVars' => array('values' => array($this->value)),
				'ajaxWrapper' => null,
				'dataValue' => $this->value,
				'prefix' => $this->getOption('prefix'),
				'responsive' => $this->getOption('responsive'),
				'suffix' => $this->getOption('suffix')
			), $this->jdomOptions));

		return parent::getInput();
	}


}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('JFormFieldCkajax')){ class JFormFieldCkajax extends ManagementcomCkFormFieldCkajax{} }
