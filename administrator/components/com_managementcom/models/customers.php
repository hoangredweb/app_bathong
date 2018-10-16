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
* Managementcom List Model
*
* @package	Managementcom
* @subpackage	Classes
*/
class ManagementcomCkModelCustomers extends ManagementcomClassModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'customer';

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
				'a.nick_name', 'nick_name',
				'a.first_name', 'first_name'
			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'published' => 'varchar',
			'sortTable' => 'cmd',
			'directionTable' => 'cmd',
			'limit' => 'cmd',
			'id' => 'cmd',
			'city_id' => 'cmd',
			'country_id' => 'cmd',
			'type_customer_id' => 'cmd',
			'creation_date_from' => 'varchar',
			'creation_date_to' => 'varchar'
				));

		//Define the searchable fields
		$this->set('search_vars', array(
			'search' => 'string'
				));

		
		$this->hasOne('pricelist_id', // name
			'pricelists', // foreignModelClass
			'pricelist_id', // localKey
			'id' // foreignKey
		);

		$this->hasOne('country_id', // name
			'countries', // foreignModelClass
			'country_id', // localKey
			'id' // foreignKey
		);

		$this->hasOne('city_id', // name
			'cities', // foreignModelClass
			'city_id', // localKey
			'id' // foreignKey
		);
		
		parent::__construct($config);

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
		$id	.= ':'.$this->getState('filter.creation_date');
		$id	.= ':'.$this->getState('filter.country_id');
		$id	.= ':'.$this->getState('filter.city_id');
		$id	.= ':'.$this->getState('filter.type_customer_id');
		$id	.= ':'.$this->getState('search.search');
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
				'address',
				'email',
				'first_name',
				'last_name',
				'nick_name',
				'pricelist_id.name',
				'pricelist_id',
				'country_id.title',
				'country_id',
				'city_id.title',
				'type_customer_id',
				'city_id',
				'note',
				'phone'
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
				'nick_name'
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
		$query->from('#__managementcom_customers AS a');

		// Automatic composition of the base query from ORM description
		$this->populateStatesOrm();

		$this->orm(array(
			'select' => array(
				'created_by',
				'published',
				'pricelist_id.name',
				'country_id.title',
				'city_id.title',
				'type_customer_id'
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
				// FILTER (Range) : Created By
				'creation_date' => array(
					'type' => 'range'
				),
				// FILTER : Loại Khách Hàng
				'type_customer_id' => array(
					'type' => 'enum'
				),
				// FILTER : Country > Title
				'country_id' => array(
					'type' => 'fk'
				)
				,
				// FILTER : City > Title
				'city_id' => array(
					'type' => 'fk'
				),
				// FILTER : Vị
				'type_customer_id' => array(
					'type' => 'enum'
				),
			),
			'search' => array(

				// SEARCH : Nickname + Họ + Tên + Địa Chỉ + Email + Ghi Chú
				'search' => array(
					'on' => array(
						'nick_name' => 'like',
						'last_name' => 'like',
						'first_name' => 'like',
						'pricelist_id.name' => 'like',
						'country_id.title' => 'like',
						'city_id.title' => 'like',
						'type_customer_id' => 'like',
						'address' => 'like',
						'email' => 'like',
						'note' => 'like'
					)
				)
			)
		));

		// ORDERING
		$orderCol = $this->getState('list.ordering', 'nick_name');
		$orderDir = $this->getState('list.direction', 'ASC');

		if ($orderCol)
			$this->orm->order(array($orderCol => $orderDir));

		// Apply all SQL directives to the query
		$this->applySqlStates($query);
	}


}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomModelCustomers')){ class ManagementcomModelCustomers extends ManagementcomCkModelCustomers{} }
