<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.8     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.0.1
* @package		Ergo
* @subpackage	Ergo
* @copyright	mamako
* @author		harvey - ifoundries.com - 
* @license		
*
*             .oooO  Oooo.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

if (!class_exists('ErgoHelper'))
	require_once(JPATH_ADMINISTRATOR . '/components/com_managementcom/helpers/loader.php');


/**
* Form field for Ergo.
*
* @package	Ergo
* @subpackage	Form
*/
class ManagementcomCkFormFieldCktextarea extends ManagementcomClassFormField
{
	/**
	* The form field type.
	*
	* @var string
	*/
	public $type = 'cktextarea';

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

		$this->input = JDom::_('html.form.input.textarea', array_merge(array(
				'dataKey' => $this->getOption('name'),
				'domClass' => $this->getOption('class'),
				'domId' => $this->id,
				'domName' => $this->name,
				'cols' => $this->getOption('cols'),
				'dataValue' => $this->value,
				'height' => $this->getOption('height'),
				'responsive' => $this->getOption('responsive'),
				'rows' => $this->getOption('rows'),
				'width' => $this->getOption('width')
			), $this->jdomOptions));

		return parent::getInput();
	}


}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('JFormFieldCktextarea')){ class JFormFieldCktextarea extends ManagementcomCkFormFieldCktextarea{} }

