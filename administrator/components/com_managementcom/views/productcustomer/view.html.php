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



/**
* HTML View class for the Managementcom component
*
* @package	Managementcom
* @subpackage	Productcustomer
*/
class ManagementcomCkViewProductcustomer extends ManagementcomClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('productcustomer','productcustomermodal');

	/**
	* Execute and display a template : ProductCustomer
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayProductcustomer($tpl = null)
	{
		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$this->params 	= $state->get('params');
		$state->set('context', 'layout.productcustomer');
		$this->item		= $item		= $this->get('Item');

		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= ManagementcomHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_PRODUCTCUSTOMER'), $this->item, 'customer_id');

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
		JToolBarHelper::title('Hóa Đơn', 'pencil-2');
		JToolBarHelper::custom('productcustomer.addmore', 'plus', 'plus', 'Add More', false);
		// Save
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::apply('productcustomer.apply', "MANAGEMENTCOM_JTOOLBAR_SAVE");
		// Save & Close
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save('productcustomer.save', "MANAGEMENTCOM_JTOOLBAR_SAVE_CLOSE");
		// Save & New
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save2new('productcustomer.save2new', "MANAGEMENTCOM_JTOOLBAR_SAVE_NEW");
		
		// Cancel
		JToolBarHelper::cancel('productcustomer.cancel', "MANAGEMENTCOM_JTOOLBAR_CANCEL");
		$model_customer_id = CkJModel::getInstance('Customers', 'ManagementcomModel');
		$model_customer_id->addOrder("a.id");
		$lists['fk']['customer_id'] = $model_customer_id->getItems();

		$model_product_id = CkJModel::getInstance('Products', 'ManagementcomModel');
		$model_product_id->addOrder("a.ordering");
		$lists['fk']['product_id'] = $model_product_id->getItems();

		/*usort($lists['fk']['product_id'],function($first,$second){
			return $first->column_ordering > $second->column_ordering;
		});*/

		$arr = array();
		$lists['fk']['column_ordering'] = array();

		foreach ($lists['fk']['product_id'] as $product)
		{
			$arr[] = array('value' => $product->id, "text" => $product->product_name, "column_ordering" => $product->column_ordering );
			if (!in_array($product->column_ordering, $lists['fk']['column_ordering'])) $lists['fk']['column_ordering'][] = $product->column_ordering;
		}

		$lists['fk']['product_id'] = $arr;
		
		$this->json_listPrices = '';
		if (isset($this->item->_customer_id_pricelist_id))
		{
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query="SELECT * 
					FROM #__managementcom_pricelists
					WHERE published = 1 AND id = ".$this->item->_customer_id_pricelist_id;
			// Reset the query using our newly populated query object.
			$db->setQuery($query);
			$result_price = $db->loadAssoc();
			
			if (isset($result_price['price']) && $result_price['price'])
			{
				$this->json_listPrices = $json_listPrices = json_decode($result_price['price'], true);
			}
		}
		//var_dump($this->json_listPrices);die;
	}
	protected function displayProductcustomermodal($tpl = null)
	{
		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$this->params 	= $state->get('params');
		$state->set('context', 'layout.productcustomermodal');
		$this->item		= $item		= $this->get('Item');

		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= ManagementcomHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('MANAGEMENTCOM_LAYOUT_PRODUCTCUSTOMER'), $this->item, 'customer_id');

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
		JToolBarHelper::title(JText::_('MANAGEMENTCOM_LAYOUT_PRODUCTCUSTOMER'), 'pencil-2');

		$model_customer_id = CkJModel::getInstance('Customers', 'ManagementcomModel');
		$model_customer_id->addGroupOrder("a.nick_name");
		$lists['fk']['customer_id'] = $model_customer_id->getItems();

		$model_product_id = CkJModel::getInstance('Products', 'ManagementcomModel');
		$model_product_id->addGroupOrder("a.product_name");
		$lists['fk']['product_id'] = $model_product_id->getItems();
	}
}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomViewProductcustomer')){ class ManagementcomViewProductcustomer extends ManagementcomCkViewProductcustomer{} }
