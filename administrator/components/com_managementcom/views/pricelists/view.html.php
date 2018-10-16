<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		ManagementCom
* @subpackage	pricelists
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
* @subpackage	pricelists
*/
class ManagementcomCkViewPricelists extends ManagementcomClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('default', 'modal', 'multiedit');

	/**
	* Execute and display a template : pricelists
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
		$this->menu = ManagementcomHelper::addSubmenu('pricelists', 'default');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('Danh Sách Bảng Giá'));

		

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
		JToolBarHelper::title('Danh Sách Bảng Giá', 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('pricelist.add', "MANAGEMENTCOM_JTOOLBAR_NEW");

		

		// Edit
		if ($model->canEdit())
		{
			JToolBarHelper::custom('pricelists.multiedit', 'edit', 'edit', 'Multiple Edit', false);
			JToolBarHelper::editList('pricelist.edit', "MANAGEMENTCOM_JTOOLBAR_EDIT");
		}

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('MANAGEMENTCOM_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'pricelist.delete', "MANAGEMENTCOM_JTOOLBAR_DELETE");
		
		// Sản Phẩm
		$modelProduct_id = CkJModel::getInstance('products', 'ManagementcomModel');
		$this->listProducts = $modelProduct_id->getItems();		
	}

	/**
	* Execute and display a template : pricelists
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayMultiEdit($tpl = null)
	{
		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$this->params 		= JComponentHelper::getParams('com_managementcom', true);
		$state->set('context', 'layout.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ManagementcomHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = ManagementcomHelper::addSubmenu('pricelists', 'default');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('Chỉnh Sửa Danh Sách Bảng Giá'));

		

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
		JToolBarHelper::title('Chỉnh Sửa Danh Sách Bảng Giá', 'list');

		// New
		JToolBarHelper::save('pricelist.savemultiple', "MANAGEMENTCOM_JTOOLBAR_SAVE");

		if ($model->canCreate())
			JToolBarHelper::addNew('pricelist.add', "MANAGEMENTCOM_JTOOLBAR_NEW");

		// Edit
		//JToolBarHelper::custom('pricelist.back', 'backward-2', 'backward-2', 'Back', true);

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('MANAGEMENTCOM_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'pricelist.delete', "MANAGEMENTCOM_JTOOLBAR_DELETE");
		
		// Sản Phẩm
		$modelProduct_id = CkJModel::getInstance('products', 'ManagementcomModel');
		$this->listProducts = $modelProduct_id->getItems();		
	}

	/**
	* Execute and display a template : pricelists
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
		$this->menu = ManagementcomHelper::addSubmenu('pricelists', 'modal');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_pricelistS'));

		

		//Filters
		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		// Toolbar
		JToolBarHelper::title(JText::_('MANAGEMENTCOM_LAYOUT_pricelistS'), 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('pricelist.add', "MANAGEMENTCOM_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('pricelist.edit', "MANAGEMENTCOM_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('MANAGEMENTCOM_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'pricelist.delete', "MANAGEMENTCOM_JTOOLBAR_DELETE");
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
			'name' => JText::_('MANAGEMENTCOM_FIELD_NICKNAME')
		);
	}


}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomViewPricelists')){ class ManagementcomViewPricelists extends ManagementcomCkViewPricelists{} }
