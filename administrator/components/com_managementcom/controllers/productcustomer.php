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
* Managementcom Productcustomer Controller
*
* @package	Managementcom
* @subpackage	Productcustomer
*/
class ManagementcomCkControllerProductcustomer extends ManagementcomClassControllerItem
{
	/**
	* The context for storing internal data, e.g. record.
	*
	* @var string
	*/
	protected $context = 'productcustomer';

	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'productcustomer';

	/**
	* The URL view list variable.
	*
	* @var string
	*/
	protected $view_list = 'productcustomers';

	/**
	* Constructor
	*
	* @access	public
	* @param	array	$config	An optional associative array of configuration settings.
	*
	* @return	void
	*/
	public function __construct($config = array())
	{
		parent::__construct($config);
		$app = JFactory::getApplication();

	}

	/**
	* Method to add an element.
	*
	* @access	public
	*
	* @return	void
	*/
	
	public function add()
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::add();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'default.add':
				$this->applyRedirection($result, array(
					'stay',
					'com_managementcom.productcustomer.productcustomer'
				), array(
			
				));
				break;

			case 'modal.add':
				$this->applyRedirection($result, array(
					'stay',
					'com_managementcom.productcustomer.productcustomer'
				), array(
			
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_managementcom.productcustomer.productcustomer'
				));
				break;
		}
	}

	/**
	* Override method when the author allowed to delete own.
	*
	* @access	protected
	* @param	array	$data	An array of input data.
	* @param	string	$ke(y	The name of the key for the primary key; default is id..
	*
	* @return	boolean	True on success
	*/
	protected function allowDelete($data = array(), $key = id)
	{
		return parent::allowDelete($data, $key, array(
		'key_author' => 'created_by'
		));
	}

	/**
	* Override method when the author allowed to edit own.
	*
	* @access	protected
	* @param	array	$data	An array of input data.
	* @param	string	$key	The name of the key for the primary key; default is id..
	*
	* @return	boolean	True on success
	*/
	protected function allowEdit($data = array(), $key = id)
	{
		return parent::allowEdit($data, $key, array(
		'key_author' => 'created_by'
		));
	}

	/**
	* Method to cancel an element.
	*
	* @access	public
	* @param	string	$key	The name of the primary key of the URL variable.
	*
	* @return	void
	*/
	public function cancel($key = null)
	{
		$this->_result = $result = parent::cancel();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'productcustomer.cancel':
				$this->applyRedirection($result, array(
					'stay',
					'com_managementcom.productcustomers.default'
				), array(
					'cid[]' => null
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_managementcom.productcustomers.default'
				));
				break;
		}
	}

	/**
	* Method to delete an element.
	*
	* @access	public
	*
	* @return	void
	*/
	public function delete()
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

		$model = $this->getModel();
		$item = $model->getItem();

		$this->_result = $result = parent::delete();
	
		// Update Thống kê Công Nợ - debts
		if (isset($item->input_date) && !empty($item->input_date) && isset($item->customer_id) && $item->customer_id)
		{
			$this->updateDebts($item->customer_id, $item->input_date);
		}
		
		// Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'default.delete':
				$this->applyRedirection($result, array(
					'stay',
					'com_managementcom.productcustomers.default'
				), array(
					'cid[]' => null
				));
				break;

			case 'modal.delete':
				$this->applyRedirection($result, array(
					'stay',
					'com_managementcom.productcustomers.default'
				), array(
					'cid[]' => null
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_managementcom.productcustomers.default'
				));
				break;
		}
	}

	/**
	* Method to edit an element.
	*
	* @access	public
	* @param	string	$key	The name of the primary key of the URL variable.
	* @param	string	$urlVar	The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	*
	* @return	void
	*/
	public function edit($key = null, $urlVar = null)
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::edit();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'default.edit':
				$this->applyRedirection($result, array(
					'stay',
					'com_managementcom.productcustomer.productcustomer'
				), array(
			
				));
				break;

			case 'modal.edit':
				$this->applyRedirection($result, array(
					'stay',
					'com_managementcom.productcustomer.productcustomer'
				), array(
			
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_managementcom.productcustomer.productcustomer'
				));
				break;
		}
	}

	/**
	* Return the current layout.
	*
	* @access	protected
	* @param	bool	$default	If true, return the default layout.
	*
	* @return	string	Requested layout or default layout
	*/
	protected function getLayout($default = null)
	{
		if ($default === 'edit')
			return 'productcustomer';

		if ($default)
			return 'productcustomer';

		$jinput = JFactory::getApplication()->input;
		return $jinput->get('layout', 'productcustomer', 'CMD');
	}

	/**
	* Method to save an element.
	*
	* @access	public
	* @param	string	$key	The name of the primary key of the URL variable.
	* @param	string	$urlVar	The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	*
	* @return	void
	*/
	
	public function edit_2($key = null, $urlVar = null){
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::edit();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_managementcom.productcustomer.productcustomer'
				), array(
					'return' => 'statis'
				));
				break;
		}
	}
	
	
	public function save($key = null, $urlVar = null)
	{		
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		//Check the ACLs
		$model = $this->getModel();
		$item = $model->getItem();
		$result = false;

		$lastItem = $item;

		if ($model->canEdit($item, true))
		{
			$result = parent::save();
			//Get the model through postSaveHook()
			if ($this->model)
			{
				$model = $this->model;
				$item = $model->getItem();	
				
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				
				$data  = $this->input->post->get('jform', array(), 'array');

				if ( isset($data["json_bill_option"]) && $data["json_bill_option"])
				{
					//delete all
					if ( isset($item->bill_id) && $item->bill_id)
					{
						// Delete for save
						$query = $db->getQuery(true);
						$conditions = array(
							$db->qn('bill_id') . ' = '.  $item->bill_id, 
						);
						$query->delete($db->qn('#__managementcom_productcustomers'));
						$query->where($conditions);
						$db->setQuery($query);
						$delete_result = $db->execute();
					} 
					else
					{
						// Delete for save
						$query = $db->getQuery(true);
						$conditions = array(
							$db->qn('id') . ' = '.  $item->id, 
						);
						$query->delete($db->qn('#__managementcom_productcustomers'));
						$query->where($conditions);
						$db->setQuery($query);
						$delete_result = $db->execute();
					}

					//solve json here
					$bills = json_decode($data["json_bill_option"]);
					//insert again	
					foreach ($bills as $key=>$value)
					{
						unset($bills->$key->id);
						$db = JFactory::getDbo();

						$bills->$key->customer_id = $item->customer_id;	
						$bills->$key->published = $item->published;	
						$bills->$key->input_date = $item->input_date;	
						$bills->$key->created_by = $item->created_by;	
						$bills->$key->modified_by = $item->modified_by;	
						$bills->$key->creation_date = $item->creation_date;	
						$bills->$key->modification_date	 = $item->modification_date;	
						$bills->$key->bill_name	 = $key;	
						$bills->$key->bill_id	 = $item->id;							
						$result_bill = $db->insertObject('#__managementcom_productcustomers', $bills->$key);
						$orderId = $db->insertid();


					}
				}

				if (isset($item->input_date) && !empty($item->input_date) && isset($item->customer_id) && $item->customer_id)
				{
					$this->updateDebts($item->customer_id, $item->input_date);

					if ($lastItem->input_date != $item->input_date)
					{
						$this->updateDebts($item->customer_id, $lastItem->input_date);
					}
				}
			}
		}
		else
			JError::raiseWarning( 403, JText::sprintf('ACL_UNAUTORIZED_TASK', JText::_('MANAGEMENTCOM_JTOOLBAR_SAVE')) );

		$this->_result = $result;
			
		
		
		$jinput = JFactory::getApplication()->input;
		$link_return = $jinput->get('return', '', 'CMD');
	
		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'productcustomer.apply':
				
				if ( isset($data["json_bill_option"]) && $data["json_bill_option"])
					$this->applyRedirection($result, array(
						'stay',
						'com_managementcom.productcustomer.productcustomer'
					), array(
						'cid[]' => $orderId
					));
				else
					$this->applyRedirection($result, array(
						'stay',
						'com_managementcom.productcustomer.productcustomer'
					), array(
						'cid[]' => $model->getState('productcustomer.id')		
					));
				break;

			case 'productcustomer.save':
				if (  $link_return == 'statis' )
					$this->applyRedirection($result, array(
						'stay',
						'com_managementcom.productcustomers.statis'
					), array(
						'cid[]' => null
					));
				else					
					$this->applyRedirection($result, array(
						'stay',
						'com_managementcom.productcustomers.default'
					), array(
						'cid[]' => null
					));
				
				break;

			case 'productcustomer.save2new':
				$this->applyRedirection($result, array(
					'stay',
					'com_managementcom.productcustomer.productcustomer'
				), array(
					'cid[]' => null
				));
				break;

			default:
				if (  $link_return == 'statis' )
					$this->applyRedirection($result, array(
						'stay',
						'com_managementcom.productcustomers.statis'
					));
				else
					$this->applyRedirection($result, array(
						'stay',
						'com_managementcom.productcustomer.productcustomer'
					), array(
					'cid[]' => null
				));
				
				break;
		}
	}
	
	public function updateDebts($customerId, $inputDate)
	{
		$date = date('d.m.Y', strtotime($inputDate));

		$modelDebts = CkJModel::getInstance('debts', 'ManagementcomModel');
		$modelDebts->setState('context', 'layout.default');
		$modelDebts->setState('filter.date_debt_from', $date);
		$modelDebts->setState('filter.date_debt_to', $date);
		$modelDebts->setState('filter.customer_id', $customerId);
		$listDebts = $modelDebts->getItems();
		
		$arr = ManagementcomHelper::getTotalDebt($customerId, $inputDate);

		$object = new stdClass();
		$object->customer_id = $customerId;
		$object->amount_repayment = $arr['amount_repayment'];
		$object->amount_debt = $arr['amount_debt'];
		$object->date_debt = $inputDate;
		$object->creation_date = JFactory::getDate()->toSql();
		$object->published = 1;

		$modelDebt = CkJModel::getInstance('debt', 'ManagementcomModel');
		// Update giá không update trạng thái thanh toán

		// TH1 cả 2 amount_debt va amount_repayment deu bằng 0 - xóa
		if ($arr['amount_debt'] == 0 && $arr['amount_repayment'] == 0)
		{
			if (isset($listDebts[0]->id) && $listDebts[0]->id)
			{
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);

				$query->delete($db->quoteName('#__managementcom_debts'))
				      ->where($db->quoteName('id') . ' = ' . $listDebts[0]->id);
				
				$result = $db->setQuery($query)->execute();
			}
		}
		else
		{
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
	}

	public function ajax_list_price(){
         $cid = JRequest::getVar('selected_customer_id');
         //get current value
        
        $db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query="SELECT a.id, a.price
				FROM #__managementcom_pricelists as a
				INNER JOIN #__managementcom_customers as b ON a.id = b.pricelist_id
				WHERE a.published = 1 AND b.id = ". $cid;
		// Reset the query using our newly populated query object.
		$db->setQuery($query);
		$result_price = $db->loadAssoc();
		
		$json_listPrices = '';
		if ( isset($result_price['price']) && $result_price['price'] )
			$json_listPrices = json_decode($result_price['price'], true);
        echo json_encode($json_listPrices);

        exit();
    }
	
	public function ajax_isFreeVacuum(){
         $cid = JRequest::getVar('selected_customer_id');
         //get current value
        
        $db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query="SELECT a.pricelist_id
				FROM #__managementcom_customers  as a
				WHERE a.published = 1 AND a.id = ". $cid;
		// Reset the query using our newly populated query object.
		$db->setQuery($query);
		$result = $db->loadResult();
	
        echo json_encode($result);

        exit();
    }
	
	public function ajax_getBill(){
         $cid = JRequest::getVar('selected_bill_id');
         //get current value
        
        $db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query="SELECT *
				FROM #__managementcom_productcustomers  as a
				WHERE a.published = 1 AND a.bill_id = ". $cid;
		// Reset the query using our newly populated query object.
		$db->setQuery($query);
		$result = $db->loadAssocList();
	
        echo json_encode(json_encode($result));

        exit();
    }
}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomControllerProductcustomer')){ class ManagementcomControllerProductcustomer extends ManagementcomCkControllerProductcustomer{} }
