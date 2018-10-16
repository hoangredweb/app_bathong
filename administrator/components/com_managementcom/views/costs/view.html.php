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
* @subpackage	Costs
*/
class ManagementcomCkViewCosts extends ManagementcomClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('default', 'modal');

	/**
	* Execute and display a template : Costs
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

		$filter_frm = $state->get('filter.input_date_from');
		$filter_to= $state->get('filter.input_date_to');
		$filter_type = $state->get('filter.type_filter');
		//filter default first day of year - current day - month
		if ($filter_frm && $filter_to && $filter_type)
		{
			$tmp = ManagementcomHelper::getFilterByTypeDate($filter_frm, $filter_to, $filter_type);

			if(!empty($tmp))
			{
				$state->set('filter.input_date_from', $tmp[0]);
				$state->set('filter.input_date_to', $tmp[1]);
			}
		}
		
		$this->items		= $items	= $this->get('Items');

		$this->canDo		= $canDo	= ManagementcomHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = ManagementcomHelper::addSubmenu('costs', 'default');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument('Danh Sách Chi Phí');
		

		//Filters
		// Loại Chi Phí > Tên
		$modelTypecost_id = CkJModel::getInstance('typecosts', 'ManagementcomModel');
		$modelTypecost_id->set('context', $model->get('context'));
		$filters['filter_typecost_id']->jdomOptions = array(
			'list' => $modelTypecost_id->getItems()
		);

		// Sort by
		$filters['sortTable']->jdomOptions = array(
			'list' => $this->getSortFields('default')
		);

		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		// Toolbar
		JToolBarHelper::title('Danh Sách Chi Phí', 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('cost.add', "MANAGEMENTCOM_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('cost.edit', "MANAGEMENTCOM_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('MANAGEMENTCOM_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'cost.delete', "MANAGEMENTCOM_JTOOLBAR_DELETE");
		
		$state->set('filter.published', 1);
		$model->setState('list.limit', "all");
		$tmp_items	= 	$model->getItems();
		
		//sum_total_price
		$sum_total_price = 0;
		foreach ($tmp_items as $item){
			$sum_total_price += $item->price;
		}
		$this->sum_total_price = $sum_total_price;
	}

	/**
	* Execute and display a template : Costs
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
		$this->menu = ManagementcomHelper::addSubmenu('costs', 'modal');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_COSTS'));

		

		//Filters
		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		// Toolbar
		JToolBarHelper::title(JText::_('MANAGEMENTCOM_LAYOUT_COSTS'), 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('cost.add', "MANAGEMENTCOM_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('cost.edit', "MANAGEMENTCOM_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('MANAGEMENTCOM_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'cost.delete', "MANAGEMENTCOM_JTOOLBAR_DELETE");
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
			'typecost_id.name' => JText::_('Loại Chi Phí'),
			'a.price' => JText::_('Giá'),
			'a.id' => JText::_('id'),
		);
	}


}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomViewCosts')){ class ManagementcomViewCosts extends ManagementcomCkViewCosts{} }
