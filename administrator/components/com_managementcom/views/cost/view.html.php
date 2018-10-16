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



/**
* HTML View class for the Managementcom component
*
* @package	Managementcom
* @subpackage	Cost
*/
class ManagementcomCkViewCost extends ManagementcomClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('cost','costmodal');

	/**
	* Execute and display a template : Cost
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayCost($tpl = null)
	{
		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$this->params 	= $state->get('params');
		$state->set('context', 'layout.cost');
		$this->item		= $item		= $this->get('Item');

		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= ManagementcomHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('Chi Phí'), $this->item, 'typecost_id');

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
		JToolBarHelper::title(JText::_('Chi Phí'), 'pencil-2');

		// Save & Close
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save('cost.save', "MANAGEMENTCOM_JTOOLBAR_SAVE_CLOSE");
		// Save & New
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save2new('cost.save2new', "MANAGEMENTCOM_JTOOLBAR_SAVE_NEW");
		// Save
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::apply('cost.apply', "MANAGEMENTCOM_JTOOLBAR_SAVE");
		// Cancel
		JToolBarHelper::cancel('cost.cancel', "MANAGEMENTCOM_JTOOLBAR_CANCEL");
		$model_typecost_id = CkJModel::getInstance('Typecosts', 'ManagementcomModel');
		$model_typecost_id->addWhere('a.published', 1);
		$model_typecost_id->addGroupOrder("a.name");
		$lists['fk']['typecost_id'] = $model_typecost_id->getItems();

		$session = JFactory::getSession();

		if ($session->get('last_input_date'))
		{
			$lastInputdate = date('d.m.Y', strtotime($session->get('last_input_date')));
			$this->lastDateInput = $lastInputdate;
		}
		else
		{
			$modelCosts = CkJModel::getInstance('costs', 'managementcomModel');
			$modelCosts->addSelect("MAX(a.input_date) as max_input_date");
			$itemMax = $modelCosts->getItems();

			$this->lastDateInput = date('d.m.Y');

			if (isset($itemMax[0]->max_input_date) && !empty($itemMax[0]->max_input_date))
			{
				$this->lastDateInput = date('d.m.Y', strtotime($itemMax[0]->max_input_date));
			}
		}
	}
	
	
	protected function displayCostmodal($tpl = null)
	{
		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$this->params 	= $state->get('params');
		$state->set('context', 'layout.cost');
		$this->item		= $item		= $this->get('Item');

		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= ManagementcomHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('Chi Phí'), $this->item, 'typecost_id');

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
		JToolBarHelper::title(JText::_('Chi Phí'), 'pencil-2');

		$model_typecost_id = CkJModel::getInstance('Typecosts', 'ManagementcomModel');
		$model_typecost_id->addGroupOrder("a.name");
		$listTypeCosts = $model_typecost_id->getItems();
		$this->typecost = '';
		foreach ($listTypeCosts as $cost){
			if ( $cost->id == $item->typecost_id) {
				$this->typecost = $cost->name;
				break;
			}
			
		}
		
	}

}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomViewCost')){ class ManagementcomViewCost extends ManagementcomCkViewCost{} }
