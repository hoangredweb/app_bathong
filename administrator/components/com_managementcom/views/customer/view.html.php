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
* @subpackage	Customer
*/
class ManagementcomCkViewCustomer extends ManagementcomClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('customer','customermodal');

	/**
	* Execute and display a template : Customer
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayCustomer($tpl = null)
	{
		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$this->params 	= $state->get('params');
		$state->set('context', 'layout.customer');
		$this->item		= $item		= $this->get('Item');

		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= ManagementcomHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_CUSTOMER'), $this->item, 'nick_name');

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check ACL before opening the form (prevent from direct access)
		if (!$model->canEdit($item, true))
			$model->setError(JText::_('JERROR_ALERTNOAUTHOR'));

		// Check for errors.
		if (count($errors = $model->getErrors()))
		{
			JError::raiseError(500, implode(BR, array_unique($errors)));
			return false;
		}
		//Toolbar
		JToolBarHelper::title('Khách Hàng', 'pencil-2');

		// Save
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::apply('customer.apply', "MANAGEMENTCOM_JTOOLBAR_SAVE");
		// Save & New
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save2new('customer.save2new', "MANAGEMENTCOM_JTOOLBAR_SAVE_NEW");
		// Save & Close
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save('customer.save', "MANAGEMENTCOM_JTOOLBAR_SAVE_CLOSE");
		// Cancel
		JToolBarHelper::cancel('customer.cancel', "MANAGEMENTCOM_JTOOLBAR_CANCEL");
		
		$model_pricelist_id = CkJModel::getInstance('pricelists', 'ManagementcomModel');
		$model_pricelist_id->addGroupOrder("a.name");
		$lists['fk']['pricelist_id'] = $model_pricelist_id->getItems();

		$model_country_id = CkJModel::getInstance('Countries', 'ManagementcomModel');
		$model_country_id->addGroupOrder("a.title");
		$lists['fk']['country_id'] = $model_country_id->getItems();

		$model_city_id = CkJModel::getInstance('Cities', 'ManagementcomModel');
		$model_city_id->addGroupOrder("a.title");
		$lists['fk']['city_id'] = $model_city_id->getItems();
	}

	protected function displayCustomermodal($tpl = null)
	{
		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$this->params 	= $state->get('params');
		$state->set('context', 'layout.customermodal');
		$this->item		= $item		= $this->get('Item');

		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= ManagementcomHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_CUSTOMER'), $this->item, 'nick_name');

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check ACL before opening the form (prevent from direct access)
		if (!$model->canEdit($item, true))
			$model->setError(JText::_('JERROR_ALERTNOAUTHOR'));

		// Check for errors.
		if (count($errors = $model->getErrors()))
		{
			JError::raiseError(500, implode(BR, array_unique($errors)));
			return false;
		}
		
	}
}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomViewCustomer')){ class ManagementcomViewCustomer extends ManagementcomCkViewCustomer{} }
