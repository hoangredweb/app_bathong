<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1.5   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		managementcom
* @subpackage	cities
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
* @subpackage	City
*/
class ManagementcomCkViewCity extends ManagementcomClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('city');

	/**
	* Execute and display a template : city
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayCity($tpl = null)
	{
		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$this->params 	= $state->get('params');
		$state->set('context', 'layout.city');
		$this->item		= $item		= $this->get('Item');

		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= ManagementcomHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_CITY'), $this->item, 'title');

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
		JToolBarHelper::title(JText::_('MANAGEMENTCOM_LAYOUT_CITY'), 'pencil-2');

		// Save & Close
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save('city.save', "MANAGEMENTCOM_JTOOLBAR_SAVE_CLOSE");
		// Save & New
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save2new('city.save2new', "MANAGEMENTCOM_JTOOLBAR_SAVE_NEW");
		// Save to Copy
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save2copy('city.save2copy', "MANAGEMENTCOM_JTOOLBAR_SAVE_TO_COPY");
		// Save
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::apply('city.apply', "MANAGEMENTCOM_JTOOLBAR_SAVE");
		// Cancel
		JToolBarHelper::cancel('city.cancel', "MANAGEMENTCOM_JTOOLBAR_CANCEL");
		$model_country_id = CkJModel::getInstance('Countries', 'ManagementcomModel');
		$model_country_id->addGroupOrder("a.title");
		$lists['fk']['country_id'] = $model_country_id->getItems();
	}


}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomViewCity')){ class ManagementcomViewCity extends ManagementcomCkViewCity{} }

