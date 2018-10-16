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



/**
* HTML View class for the Managementcom component
*
* @package	Managementcom
* @subpackage	Debts
*/
class ManagementcomCkViewDebts extends ManagementcomClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('default', 'modal', 'statis');

	/**
	* Execute and display a template : debts
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
		$this->menu = ManagementcomHelper::addSubmenu('debts', 'default');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_DEBTS'));

		

		//Filters
		// Khách Hàng
		$modelCustomer_id = CkJModel::getInstance('customers', 'ManagementcomModel');
		$modelCustomer_id->set('context', $model->get('context'));
		$filters['filter_customer_id']->jdomOptions = array(
			'list' => $modelCustomer_id->getItems()
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
		JToolBarHelper::title(JText::_('MANAGEMENTCOM_LAYOUT_DEBTS'), 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('debt.paydebt_add', "MANAGEMENTCOM_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
		{
			JToolBarHelper::editList('debt.paydebt_edit', "MANAGEMENTCOM_JTOOLBAR_EDIT");
		}

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('MANAGEMENTCOM_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'debt.delete', "MANAGEMENTCOM_JTOOLBAR_DELETE");

		$model->setState('list.limit', 0);
		$model->setState('list.start', 0);
		
		$items	= $this->get('Items');

		$totalAmountRepayment = 0;
		$totalAmountDebt = 0;

		foreach($items as $key => $item)
		{
			$totalAmountRepayment += $item->amount_repayment;
			$totalAmountDebt += $item->amount_debt;
		}

		$this->totalAmountRepayment = $totalAmountRepayment;
		$this->totalAmountDebt = $totalAmountDebt;
		$this->totalDebt = $totalAmountDebt - $totalAmountRepayment;
		
		/*$db = JFactory::getDbo();
		
		//get total_cost ChiPhi
		$query = $db->getQuery(true);
		$query="SELECT a.*
				FROM #__managementcom_productcustomers as a
				WHERE a.published=1 AND (a.input_date BETWEEN '2018-01-01' AND '2018-02-24')";
		   
		$db->setQuery($query);
		$results = $db->loadObjectList();

		foreach ($results as $item)
		{
			$date = date('d.m.Y', strtotime($item->input_date));

			$modelDebts = CkJModel::getInstance('debts', 'ManagementcomModel');

			$modelDebts->setState('filter.date_debt_from', $date);
			$modelDebts->setState('filter.date_debt_to', $date);
			$modelDebts->setState('filter.customer_id', $item->customer_id);
			$listDebts = $modelDebts->getItems();
			
			

			$arr = ManagementcomHelper::getTotalDebt($item->customer_id, $item->input_date);

			$object = new stdClass();
			$object->customer_id = $item->customer_id;
			$object->amount_repayment = $arr['amount_repayment'];
			$object->amount_debt = $arr['amount_debt'];
			$object->date_debt = $item->input_date;
			$object->creation_date = JFactory::getDate()->toSql();
			$object->published = 1;

			$modelDebt = CkJModel::getInstance('debt', 'ManagementcomModel');

			// Update giá không update trạng thái thanh toán
			if (empty($listDebts))
			{
				$modelDebt->insert($object);
			}
			else
			{
				if (isset($listDebts[0]->id) && $listDebts[0]->id)
				{
					$object->id = $listDebts[0]->id;
					$modelDebt->update($object);
				}
			}
		}
		die;*/
	}

	/**
	* Execute and display a template : debts
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayStatis($tpl = null)
	{
		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$this->params 		= JComponentHelper::getParams('com_managementcom', true);
		$state->set('context', 'layout.statis');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ManagementcomHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = ManagementcomHelper::addSubmenu('debts', 'statis');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_DEBTS_STATIS'));

		

		//Filters
		// Khách Hàng
		$modelCustomer_id = CkJModel::getInstance('customers', 'ManagementcomModel');
		$modelCustomer_id->set('context', $model->get('context'));
		$filters['filter_customer_id']->jdomOptions = array(
			'list' => $modelCustomer_id->getItems()
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
		JToolBarHelper::title(JText::_('MANAGEMENTCOM_LAYOUT_DEBTS_STATIS'), 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('debt.paydebt_add', "MANAGEMENTCOM_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
		{
			JToolBarHelper::editList('debt.paydebt_edit', "MANAGEMENTCOM_JTOOLBAR_EDIT");
		}

		// Delete
		/*if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('MANAGEMENTCOM_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'debt.delete', "MANAGEMENTCOM_JTOOLBAR_DELETE");*/

		$model->setState('list.limit', 0);
		$model->setState('list.start', 0);
		
		$items	= $this->get('Items');

		$totalAmountRepayment = 0;
		$totalAmountDebt = 0;

		foreach($items as $key => $item)
		{
			$totalAmountRepayment += $item->sum_amount_repayment;
			$totalAmountDebt += $item->sum_amount_debt;
		}

		$this->totalAmountRepayment = $totalAmountRepayment;
		$this->totalAmountDebt = $totalAmountDebt;
		$this->totalDebt = $totalAmountDebt - $totalAmountRepayment;
	}


	/**
	* Execute and display a template : debts
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
		$this->menu = ManagementcomHelper::addSubmenu('debts', 'modal');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_DEBTS'));

		

		//Filters
		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		// Toolbar
		JToolBarHelper::title(JText::_('MANAGEMENTCOM_LAYOUT_DEBTS'), 'list');


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
			'ordering' => JText::_('MANAGEMENTCOM_FIELD_ORDERING'),
			'customer_id.nick_name' => JText::_('MANAGEMENTCOM_FIELD_CUSTOMER_ID_TITLE'),
			'date_repayment' => JText::_('MANAGEMENTCOM_FIELD_DATE_REPAYMENT'),
			'amount_repayment' => JText::_('MANAGEMENTCOM_FIELD_AMOUNT_REPAYMENT'),
			'date_debt' => JText::_('MANAGEMENTCOM_FIELD_DATE_OF_DEBT'),
			'total_debt' => JText::_('MANAGEMENTCOM_FIELD_TOTAL_DEBT'),
			'amount_debt' => JText::_('MANAGEMENTCOM_FIELD_AMOUNT_DEBT')
		);
	}


}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomViewDebts')){ class ManagementcomViewDebts extends ManagementcomCkViewDebts{} }

