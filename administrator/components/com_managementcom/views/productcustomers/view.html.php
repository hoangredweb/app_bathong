<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		ManagementCom
* @subpackage	ProductCustomers
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

require_once JPATH_COMPONENT.'/carbon/'.'Carbon.php';
use Carbon\Carbon;
/**
* HTML View class for the Managementcom component
*
* @package	Managementcom
* @subpackage	Productcustomers
*/
class ManagementcomCkViewProductcustomers extends ManagementcomClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('default', 'modal', 'statis', 'chart', 'profit', 'chartcolumn', 'chartcolumn');

	/**
	* Execute and display a template : ProductCustomers
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
		$this->menu = ManagementcomHelper::addSubmenu('productcustomers', 'default');
		$lists = array();
		$this->lists = &$lists;
	
		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_PRODUCTCUSTOMERS'));

		

		//Filters
		// Khách Hàng
		$modelCustomer_id = CkJModel::getInstance('customers', 'ManagementcomModel');
		$modelCustomer_id->set('context', $model->get('context'));
		$filters['filter_customer_id']->jdomOptions = array(
			'list' => $modelCustomer_id->getItems()
		);

		// Sản Phẩm
		$modelProduct_id = CkJModel::getInstance('products', 'ManagementcomModel');
		$modelProduct_id->set('context', $model->get('context'));
		$filters['filter_product_id']->jdomOptions = array(
			'list' => $modelProduct_id->getItems()
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
		JToolBarHelper::title('Danh Sách Hóa Đơn', 'list');
		
		
		// export_excel
		$model->setState('list.limit', "all");
		
		$tmp_items	= 	$model->getItems();
		$myinfo = array();
		foreach ($tmp_items as $item){
			$myinfo[]= $item->id;
		}
		$myinfo = implode(",",$myinfo);
		echo '<input type="hidden" id="myinfo_ids" value="'.$myinfo.'">';
		JToolBarHelper::custom('productcustomers.export_excel', 'print', 'print', 'Export to Excel', true);
		
		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('productcustomer.add', "MANAGEMENTCOM_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('productcustomer.edit', "MANAGEMENTCOM_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('MANAGEMENTCOM_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'productcustomer.delete', "MANAGEMENTCOM_JTOOLBAR_DELETE");
				
	}
	
	protected function displayStatis($tpl = null)
	{
		$this->model		= $model	= $this->getModel();		
		$this->state		= $state	= $this->get('State');
		$this->params 		= JComponentHelper::getParams('com_managementcom', true);
		$state->set('context', 'layout.statis');
		if ( !$state->get('filter.input_date_from') && !$state->get('filter.input_date_to') && !$state->get('filter.current_date') ){
			$state->set('filter.input_date_from', date("Y-m-d"));
			$state->set('filter.input_date_to', date("Y-m-d"));
			$state->set('filter.current_date', date("Y-m-d"));
		}
		else
			if ( $state->get('filter.current_date')){
				$state->set('filter.input_date_from', $state->get('filter.current_date') );
				$state->set('filter.input_date_to', $state->get('filter.current_date') );
			}
				
		
		$state->set('filter.published', 1);
		
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ManagementcomHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = ManagementcomHelper::addSubmenu('productcustomers', 'statis');
		$lists = array();
		$this->lists = &$lists;

		// Define the title  
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_PRODUCTCUSTOMERS'));

		$model->setState('list.limit', "all");
		//$model->setState('filter.published', "1");
		
		$tmp_items	= 	$model->getItems();
		
		//sum_total_weight
		$sum_total_weight = 0;
		$sum_total_price = 0;
		foreach ($tmp_items as $item){
			$sum_total_weight += $item->total_weight;
			$sum_total_price += $item->total_price;	
		}
		$this->sum_total_weight = $sum_total_weight;
		$this->sum_total_price = $sum_total_price;
		//Filters
		// Khách Hàng
		$modelCustomer_id = CkJModel::getInstance('customers', 'ManagementcomModel');
		$modelCustomer_id->set('context', $model->get('context'));
		$filters['filter_customer_id']->jdomOptions = array(
			'list' => $modelCustomer_id->getItems()
		);

		// Sản Phẩm
		$modelProduct_id = CkJModel::getInstance('products', 'ManagementcomModel');
		$modelProduct_id->set('context', $model->get('context'));
		$filters['filter_product_id']->jdomOptions = array(
			'list' => $modelProduct_id->getItems()
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
		JToolBarHelper::title('Thống Kê Hóa Đơn', 'list');
			
		// export_excel
		$model->setState('list.limit', "all");
		
		$tmp_items	= 	$model->getItems();
		$myinfo = array();
		foreach ($tmp_items as $item){
			$myinfo[]= $item->id;
		}
		$myinfo = implode(",",$myinfo);
		echo '<input type="hidden" id="myinfo_ids" value="'.$myinfo.'">';
		JToolBarHelper::custom('productcustomers.export_excel', 'print', 'print', 'Export to Excel', true);	
			
		// Edit
		if ($model->canEdit()){
			//JJToolBarHelper::editList('productcustomer.edit', "MANAGEMENTCOM_JTOOLBAR_EDIT");		
			JToolBarHelper::custom('productcustomer.edit_2', 'edit', 'edit', 'Edit', false, false);			
		}

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('MANAGEMENTCOM_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'productcustomer.delete', "MANAGEMENTCOM_JTOOLBAR_DELETE");
			

	}
	
	protected function displayProfit($tpl = null)
	{
		$this->model		= $model	= $this->getModel();		
		$this->state		= $state	= $this->get('State');
		$this->params 		= JComponentHelper::getParams('com_managementcom', true);
		$state->set('context', 'layout.profit');
		$state->set('filter.published', 1);
		
		//filter default first day of year - current day - month
		$filter_frm = $state->get('filter.star_type_date');
		$filter_to= $state->get('filter.end_type_date');
		$this->filter_type = $filter_type = $state->get('filter.typefilter');
		if (!$filter_frm || !$filter_to || !$filter_type) {
			//JFactory::getApplication()->enqueueMessage('Vui Lòng Chọn Ngày Lọc', 'error');
			$carbon = new Carbon(); 
			$state->set('filter.end_type_date', $carbon->toDateTimeString());
			$state->set('filter.star_type_date', $carbon->startOfYear()->toDateTimeString());
			$state->set('filter.filter_type', 2);
		}
		
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ManagementcomHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = ManagementcomHelper::addSubmenu('productcustomers', 'profit');
		$lists = array();
		$this->lists = &$lists;

		// Define the title  
		$this->_prepareDocument('Lợi Nhuận Ròng');

		$model->setState('list.limit', "all");
		//$model->setState('filter.published', "1");
		
		//Filters
		
		
		// Toolbar
		// Export_excel
		JToolBarHelper::custom('productcustomers.export_excel_profit', 'print', 'print', 'Export to Excel', true);

		JToolBarHelper::title('Lợi Nhuận Ròng', 'list');
		
		switch ($filter_type) {
			case 1:
				$this->items = ManagementcomHelper::filterByDay($filter_frm, $filter_to);
				break;
			case 2:
				$this->items = ManagementcomHelper::filterByMonth($filter_frm, $filter_to);
				break;
			case 3:
				$this->items = ManagementcomHelper::filterByYear($filter_frm, $filter_to);
				break;
			case 4:
				$this->items = ManagementcomHelper::filterByQuarter($filter_frm, $filter_to);
				break;
			default:
				$this->items = ManagementcomHelper::filterByMonth($filter_frm, $filter_to);
		}
		
		//
		
		//printf("Now: %s", Carbon::now());
		/* $begin = new DateTime( "2017-02-03" );
		$end   = new DateTime( "2017-02-09" );

		for($i = $begin; $begin <= $end; $i->modify('+1 day')){
			echo $i->format("Y-m-d")."<br>";
		} */
	}
	
	protected function displayChartcolumn($tpl = null)
	{
		$this->model		= $model	= $this->getModel();		
		$this->state		= $state	= $this->get('State');
		$this->params 		= JComponentHelper::getParams('com_managementcom', true);
		$state->set('context', 'layout.chartcolumn');
		$state->set('filter.published', 1);
		
		//filter default first day of year - current day - month
		$filter_frm = $state->get('filter.star_type_date');
		$filter_to= $state->get('filter.end_type_date');
		$this->filter_type = $filter_type = $state->get('filter.typefilter');
		if (!$filter_frm || !$filter_to || !$filter_type) {
			//JFactory::getApplication()->enqueueMessage('Vui Lòng Chọn Ngày Lọc', 'error');
			$carbon = new Carbon(); 
			$state->set('filter.end_type_date', $carbon->toDateTimeString());
			$state->set('filter.star_type_date', $carbon->startOfYear()->toDateTimeString());
			$state->set('filter.filter_type', 2);
		}
		
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ManagementcomHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = ManagementcomHelper::addSubmenu('productcustomers', 'chartcolumn');
		$lists = array();
		$this->lists = &$lists;

		// Define the title  
		$this->_prepareDocument('Biểu Đồ Lợi Nhuận');

		$model->setState('list.limit', "all");
		//$model->setState('filter.published', "1");
		
		//Filters
		
		
		// Toolbar
		JToolBarHelper::title('Biểu Đồ Lợi Nhuận', 'list');
		
		switch ($filter_type) {
			case 1:
				$this->items = ManagementcomHelper::filterByDay($filter_frm, $filter_to);
				break;
			case 2:
				$this->items = ManagementcomHelper::filterByMonth($filter_frm, $filter_to);
				break;
			case 3:
				$this->items = ManagementcomHelper::filterByYear($filter_frm, $filter_to);
				break;
			case 4:
				$this->items = ManagementcomHelper::filterByQuarter($filter_frm, $filter_to);
				break;
			default:
				$this->items = ManagementcomHelper::filterByMonth($filter_frm, $filter_to);
		}
		
		//
		
		//printf("Now: %s", Carbon::now());
		/* $begin = new DateTime( "2017-02-03" );
		$end   = new DateTime( "2017-02-09" );

		for($i = $begin; $begin <= $end; $i->modify('+1 day')){
			echo $i->format("Y-m-d")."<br>";
		} */
	}
	
	protected function displayChart($tpl = null)
	{
		$this->model		= $model	= $this->getModel();		
		$this->state		= $state	= $this->get('State');
		$this->params 		= JComponentHelper::getParams('com_managementcom', true);
		$state->set('context', 'layout.chart');
	
		if (!$state->get('filter.input_date_from') && !$state->get('filter.input_date_to'))
		{
			$state->set('filter.input_date_from', date("Y-m-d"));
			$state->set('filter.input_date_to', date("Y-m-d"));
		}
		
		$this->filter_customers_colum_chart = '';
		$this->filter_products_colum_chart = '';
		$this->filterColumnProductOrCustomer = '';
		$where = '';

		if ($state->get('filter.customer_id') && $state->get('filter.product_id'))
		{
			$where = 'customer_id = ' . $state->get('filter.customer_id');
			$where .= ' AND product_id = '. $state->get('filter.product_id');
			
		}
		elseif ($state->get('filter.customer_id'))
		{
			$where = 'customer_id = ' . $state->get('filter.customer_id');
		}
		elseif ($state->get('filter.product_id'))
		{
			$where = 'product_id = '. $state->get('filter.product_id');
		}

		if (!empty($where))
		{
			$where .= " AND (input_date between '" . $state->get('filter.input_date_from') . "' and '" . $state->get('filter.input_date_to') . "')";

			// Query for chart colum when only choose customer
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query = "SELECT round(sum(total_weight),2) as sum_total_weight, a.input_date
				FROM #__managementcom_productcustomers as a
				INNER JOIN #__managementcom_customers as b ON a.customer_id = b.id
				INNER JOIN #__managementcom_products as c ON a.product_id = c.id
				WHERE a.published=1 AND " . $where . " GROUP BY a.input_date";

			$this->filterColumnProductOrCustomer = $db->setQuery($query)->loadAssocList();
		}
		
		$this->filter_customers = '';
		$this->filter_products = '';

		if ($state->get('filter.customer_id'))
		{
			//$state->set('filter.product_id');
			$model->addSelect('round(sum(total_weight),2) as sum_total_weight');
			$model->addGroupBy('customer_id');
			
			//select from 
			$where = 'customer_id = '. $state->get('filter.customer_id');
			$where .= " AND (input_date between '".$state->get('filter.input_date_from')."' and '".$state->get('filter.input_date_to')."')";
			
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
		   
			$query = "SELECT taste, round(sum(total_weight),2) as sum_total_weight, c.product_name, c.product_code
					FROM #__managementcom_productcustomers as a
					INNER JOIN #__managementcom_customers as b ON a.customer_id = b.id
					INNER JOIN #__managementcom_products as c ON a.product_id = c.id
					WHERE a.published=1 AND ".$where." GROUP BY a.product_id";
			   
			$db->setQuery($query);
			//echo $db->replacePrefix((string) $query);
			$this->filter_customers = $db->loadAssocList();
			$i=0;
			foreach($this->filter_customers as $item)
			{
				$this->filter_customers[$i]['taste'] = ManagementcomHelperEnum::_('productcustomers_taste')[$item['taste']]['text'];				
				$i++;
			}
		}
		elseif ($state->get('filter.product_id'))
		{
			//$state->set('filter.customer_id');
			$model->addSelect('round(sum(total_weight),2) as sum_total_weight');
			$model->addGroupBy('product_id');
			
			
			//select from 
			$where = 'product_id = '. $state->get('filter.product_id');
			$where .= " AND (input_date between '".$state->get('filter.input_date_from')."' and '".$state->get('filter.input_date_to')."')";
			
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
		   
			$query = "SELECT round(sum(total_weight),2) as sum_total_weight, b.nick_name as _customer_id_nick_name
					FROM #__managementcom_productcustomers as a
					INNER JOIN #__managementcom_customers as b ON a.customer_id = b.id
					INNER JOIN #__managementcom_products as c ON a.product_id = c.id
					WHERE a.published=1 AND ".$where." GROUP BY a.customer_id";
			   
			$db->setQuery($query);
			//echo $db->replacePrefix((string) $query);
			$this->filter_products = $db->loadAssocList();
		}

		// Filter weight
		$where = " AND (a.input_date between '".$state->get('filter.input_date_from')."' and '".$state->get('filter.input_date_to')."')";
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
	   
		$query="SELECT round(sum(total_weight),2) as sum_total_weight, a.input_date
				FROM #__managementcom_productcustomers as a
				INNER JOIN #__managementcom_customers as b ON a.customer_id = b.id
				INNER JOIN #__managementcom_products as c ON a.product_id = c.id
				WHERE a.published=1 ".$where." GROUP BY a.input_date";
		   
		$db->setQuery($query);
		//echo $db->replacePrefix((string) $query);
		$this->filter_weights = $db->loadAssocList();
		for ( $i=0;$i<count($this->filter_weights);$i++ ){
			$this->filter_weights[$i]['input_date']  = date('d/m/Y', strtotime($this->filter_weights[$i]['input_date']));;
		}
		//var_dump($this->filter_weights);
		//end filter weight
		$state->set('filter.published', 1);
				
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ManagementcomHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = ManagementcomHelper::addSubmenu('productcustomers', 'chart');
		$lists = array();
		$this->lists = &$lists;
		
		// Define the title  
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_PRODUCTCUSTOMERS'));

		$model->setState('list.limit', "all");
		//$model->setState('filter.published', "1");
		
		//sum_total_weight
		if ( $state->get('filter.input_date_from') && $state->get('filter.input_date_to') ){
			$filter_frm = $state->get('filter.input_date_from');
			$filter_to = $state->get('filter.input_date_to');			
		}
		$this->sum_total_weight = ManagementcomHelper::getTotalEarn($filter_frm, $filter_to);
		
		//Filters
		// Khách Hàng
		$modelCustomer_id = CkJModel::getInstance('customers', 'ManagementcomModel');
		$modelCustomer_id->set('context', $model->get('context'));
		$filters['filter_customer_id']->jdomOptions = array(
			'list' => $modelCustomer_id->getItems()
		);

		// Sản Phẩm
		$modelProduct_id = CkJModel::getInstance('products', 'ManagementcomModel');
		$modelProduct_id->set('context', $model->get('context'));
		$filters['filter_product_id']->jdomOptions = array(
			'list' => $modelProduct_id->getItems()
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
		JToolBarHelper::title('Biểu Đồ', 'list');
		$where = "";
		if ( $state->get('filter.input_date_from') && $state->get('filter.input_date_to') ){
			$where = "input_date between '".$state->get('filter.input_date_from')."' and '".$state->get('filter.input_date_to')."'";
		}
		$db = JFactory::getDbo();
        $query = $db->getQuery(true);
       
        $query="SELECT b.nick_name as _customer_id_nick_name, round(sum(total_weight),2) as sum_total_weight
                FROM #__managementcom_productcustomers as a
				INNER JOIN #__managementcom_customers as b ON a.customer_id = b.id
				WHERE a.published=1 AND ".$where."
				GROUP BY a.customer_id ";
           
        $db->setQuery($query);
		//echo $db->replacePrefix((string) $query);
		$this->customers = $db->loadAssocList();
		
		
		
		$where = "";
		if ( $state->get('filter.input_date_from') && $state->get('filter.input_date_to') ){
			$where = "input_date between '".$state->get('filter.input_date_from')."' and '".$state->get('filter.input_date_to')."'";
		}
		$db = JFactory::getDbo();
        $query = $db->getQuery(true);
       
        $query="SELECT CONCAT(b.product_code,'-',b.product_name) as _product_id_product_name, round(sum(total_weight),2) as sum_total_weight
                FROM #__managementcom_productcustomers as a
				INNER JOIN #__managementcom_products as b ON a.product_id = b.id
				WHERE a.published=1 AND " . $where . "
				GROUP BY a.product_id ";
           
        $db->setQuery($query);
		//echo $db->replacePrefix((string) $query);
		$this->products = $db->loadAssocList();
	}
	/**
	* Execute and display a template : ProductCustomers
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
		$this->menu = ManagementcomHelper::addSubmenu('productcustomers', 'modal');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_PRODUCTCUSTOMERS'));

		

		//Filters
		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		// Toolbar
		JToolBarHelper::title(JText::_('MANAGEMENTCOM_LAYOUT_PRODUCTCUSTOMERS'), 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('productcustomer.add', "MANAGEMENTCOM_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('productcustomer.edit', "MANAGEMENTCOM_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('MANAGEMENTCOM_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'productcustomer.delete', "MANAGEMENTCOM_JTOOLBAR_DELETE");
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
			'a.id' => 'id',
			'customer_id.nick_name' => JText::_('MANAGEMENTCOM_FIELD_KHACH_HANG'),
			'total_weight' => JText::_('MANAGEMENTCOM_FIELD_S_LUNG'),
			'total_price' => 'Giá',
			'product_id.product_name' => JText::_('MANAGEMENTCOM_FIELD_SN_PHM'),
			'input_date' => JText::_('MANAGEMENTCOM_FIELD_NGAY_NHP')
		);
	}


}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomViewProductcustomers')){ class ManagementcomViewProductcustomers extends ManagementcomCkViewProductcustomers{} }
