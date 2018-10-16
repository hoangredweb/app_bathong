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
* Managementcom List Model
*
* @package	Managementcom
* @subpackage	Classes
*/
class ManagementcomCkModelProductcustomers extends ManagementcomClassModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'productcustomer';

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
		//Define the sortables fields (in lists)
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'_customer_id_nick_name', 'customer_id.nick_name',
				'a.total_weight', 'total_weight',
				'a.total_price', 'total_price',
				'_product_id_product_name', 'product_id.product_name',
				'a.input_date', 'input_date',
				'a.id', 'id',
			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'published' => 'varchar',
			'sortTable' => 'cmd',
			'directionTable' => 'cmd',
			'limit' => 'cmd',
			'id' => 'cmd',
			'customer_id' => 'cmd',
			'product_id' => 'cmd',
			'current_date' => 'date:d.m.Y',
			'input_date_from' => 'date:d.m.Y',
			'input_date_to' => 'date:d.m.Y',
			'star_type_date' => 'date:d.m.Y',
			'end_type_date' => 'date:d.m.Y',
			'profit' => 'cmd',
			'taste' => 'varchar',
			'payment_status' => 'varchar',
			'typefilter' => 'varchar',
			'vacuum' => 'cmd',
			'weight' => 'varchar'
				));

		//Define the searchable fields
		$this->set('search_vars', array(
			'search' => 'string'
				));


		parent::__construct($config);

		$this->hasOne('customer_id', // name
			'customers', // foreignModelClass
			'customer_id', // localKey
			'id' // foreignKey
		);

		$this->hasOne('product_id', // name
			'products', // foreignModelClass
			'product_id', // localKey
			'id' // foreignKey
		);
		
	}

	/**
	* Method to get the layout (including default).
	*
	* @access	public
	*
	* @return	string	The layout alias.
	*/
	public function getLayout()
	{
		$jinput = JFactory::getApplication()->input;
		return $jinput->get('layout', 'default', 'STRING');
	}

	/**
	* Method to get a store id based on model configuration state.
	* 
	* This is necessary because the model is used by the component and different
	* modules that might need different sets of data or differen ordering
	* requirements.
	*
	* @access	protected
	* @param	string	$id	A prefix for the store id.
	*
	*
	* @since	1.6
	*
	* @return	void
	*/
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('sortTable');
		$id	.= ':'.$this->getState('directionTable');
		$id	.= ':'.$this->getState('limit');
		$id	.= ':'.$this->getState('filter.customer_id');
		$id	.= ':'.$this->getState('filter.product_id');
		$id	.= ':'.$this->getState('filter.input_date');
		$id	.= ':'.$this->getState('filter.taste');
		$id	.= ':'.$this->getState('filter.payment_status');
		$id	.= ':'.$this->getState('search.search');
		$id	.= ':'.$this->getState('filter.vacuum');
		$id	.= ':'.$this->getState('filter.weight');
		return parent::getStoreId($id);
	}

	/**
	* ORM Predefined profile for 'layout.default'
	*
	* @access	protected
	*
	*
	* @since	3.1
	*
	* @return	void
	*/
	protected function ormLayoutDefault()
	{
		$this->orm(array(
			'select' => array(
				'id',
				'customer_id',
				'customer_id.nick_name',
				'customer_id.pricelist_id',
				'input_date',
				'note',
				'product_id',
				'product_id.product_name',
				'taste',
				'payment_status',
				'bill_id',
				'bill_name',
				'total_weight',
				'total_price',
				'vacuum',
				'weight'
			)
		));
	}

	/**
	* ORM Predefined profile for 'layout.modal'
	*
	* @access	protected
	*
	*
	* @since	3.1
	*
	* @return	void
	*/
	protected function ormLayoutModal()
	{
		$this->orm(array(
			'select' => array(
				'customer_id'
			)
		));
	}

	/**
	* Preparation of the list query.
	*
	* @access	protected
	* @param	object	&$query	returns a filled query object.
	*
	* @return	void
	*/
	protected function prepareQuery(&$query)
	{
		//FROM : Main table
		$query->from('#__managementcom_productcustomers AS a');
		
		// Automatic composition of the base query from ORM description
		$this->populateStatesOrm();
		$this->orm(array(
			'select' => array(
				'created_by',
				'published',
				'id',
				'customer_id',
				'customer_id.nick_name',
				'customer_id.pricelist_id',
				'input_date',
				'note',
				'bill_id',
				'bill_name',
				'product_id',
				'product_id.product_name',
				'taste',
				'payment_status',
				'total_weight',
				'total_price',
				'vacuum',
				'weight'
			),
			'access' => array(

				// ACCESS : Restricts accesses over the local table
				'a' => array(
					'publish' => 'published',
					'author' => 'created_by'
				)
			),
			'filter' => array(
				// FILTER () : id
				'id' => array(
					
				),
				
				// FILTER : Khách Hàng
				'customer_id' => array(
					'type' => 'fk'
				),

				// FILTER : Sản Phẩm
				'product_id' => array(
					'type' => 'fk'
				),

				// FILTER (Range) : Ngày Nhập
				'input_date' => array(
					'type' => 'range'
				),

				// FILTER : Vị
				'taste' => array(
					'type' => 'enum'
				),

				// FILTER : Trạng Thái Thanh Toán
				'payment_status' => array(
					'type' => 'enum'
				),

				// FILTER : Hút Chân Không
				'vacuum' => array(

				),

				// FILTER : Trọng Lượng
				'weight' => array(
					'type' => 'enum'
				)
			),
			'search' => array(

				// SEARCH : Khách Hàng -  Sản Phẩm - Vị - Ngày Nhập - Ghi Chú - Số lượng
				'search' => array(
					'on' => array(
						'customer_id.nick_name' => 'like',
						'product_id.product_name' => 'like',
						'taste' => 'like',
						/* 'input_date ' => 'like', */
						'note' => 'like',
						'total_weight' => 'like'
					)
				)
			)
		));

		// ORDERING
		$orderCol = $this->getState('list.ordering', 'a.id');
		$orderDir = $this->getState('list.direction', 'DESC');
		//utf8_encode
		/* var_dump($this->getState('search_search'));
		die; */
		if ($orderCol)
			$this->orm->order(array($orderCol => $orderDir));
		
		/* $filter_typefilter = $this->getState('filter.typefilter');
		$filter_end_type_date = $this->getState('filter.end_type_date');
		$filter_star_type_date = $this->getState('filter.star_type_date');
		var_dump($filter_typefilter);
		var_dump($filter_end_type_date);
		var_dump($filter_star_type_date); */


		
		// Apply all SQL directives to the query
		$this->applySqlStates($query);
	}
}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomModelProductcustomers')){ class ManagementcomModelProductcustomers extends ManagementcomCkModelProductcustomers{} }
