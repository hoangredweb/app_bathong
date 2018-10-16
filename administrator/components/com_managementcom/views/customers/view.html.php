<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		ManagementCom
* @subpackage	Customers
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



/**
* HTML View class for the Managementcom component
*
* @package	Managementcom
* @subpackage	Customers
*/
class ManagementcomCkViewCustomers extends ManagementcomClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('default', 'modal');

	/**
	* Execute and display a template : Customers
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayDefault($tpl = null)
	{
		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$this->params 		= JComponentHelper::getParams('com_managementcom', true);
		$state->set('context', 'layout.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ManagementcomHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = ManagementcomHelper::addSubmenu('customers', 'default');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_CUSTOMERS'));

		// Country > Title
		$modelCountry_id = CkJModel::getInstance('countries', 'ManagementcomModel');
		$modelCountry_id->set('context', $model->get('context'));
		$filters['filter_country_id']->jdomOptions = array(
			'list' => $modelCountry_id->getItems()
		);

		$modelCity_id = CkJModel::getInstance('cities', 'ManagementcomModel');
		$modelCity_id->set('context', $model->get('context'));
		$filters['filter_city_id']->jdomOptions = array(
			'list' => $modelCity_id->getItems()
		);

		$filters['filter_type_customer_id']->jdomOptions = array(
			'list' => ManagementcomHelperEnum::_('customers_type_customer_id')
		);

		//Filters
		// Sort by
		$filters['sortTable']->jdomOptions = array(
			'list' => $this->getSortFields('default')
		);

		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		// Toolbar
		JToolBarHelper::title('Danh Sách Khách Hàng', 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('customer.add', "MANAGEMENTCOM_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('customer.edit', "MANAGEMENTCOM_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('MANAGEMENTCOM_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'customer.delete', "MANAGEMENTCOM_JTOOLBAR_DELETE");
	}

	/**
	* Execute and display a template : Customers
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayModal($tpl = null)
	{
		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$this->params 		= JComponentHelper::getParams('com_managementcom', true);
		$state->set('context', 'layout.modal');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ManagementcomHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('modal.filters');
		$this->menu = ManagementcomHelper::addSubmenu('customers', 'modal');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_CUSTOMERS'));

		

		//Filters
		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		// Toolbar
		JToolBarHelper::title(JText::_('MANAGEMENTCOM_LAYOUT_CUSTOMERS'), 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('customer.add', "MANAGEMENTCOM_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('customer.edit', "MANAGEMENTCOM_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('MANAGEMENTCOM_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'customer.delete', "MANAGEMENTCOM_JTOOLBAR_DELETE");
	}

	/**
	* Returns an array of fields the table can be sorted by.
	*
	* @access	protected
	* @param	string	$layout	The name of the called layout. Not used yet
	*
	*
	* @since	3.0
	*
	* @return	array	Array containing the field name to sort by as the key and display text as value.
	*/
	protected function getSortFields($layout = null)
	{
		return array(
			'nick_name' => JText::_('MANAGEMENTCOM_FIELD_NICKNAME'),
			'first_name' => JText::_('MANAGEMENTCOM_FIELD_TEN')
		);
	}


}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomViewCustomers')){ class ManagementcomViewCustomers extends ManagementcomCkViewCustomers{} }
