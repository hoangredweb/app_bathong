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
* Managementcom List Model
*
* @package	Managementcom
* @subpackage	Classes
*/
class ManagementcomCkModelDebts extends ManagementcomClassModelList
{
	/**
	* Default item layout.
	*
	* @var array
	*/
	public $itemDefaultLayout = 'debt';

	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'debt';

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
				'a.ordering', 'ordering',
				'_customer_id_nick_name', 'customer_id.nick_name',
				'a.customer_id', 'customer_id',
				
				'a.amount_repayment', 'amount_repayment',
				'a.date_debt', 'date_debt',
				'a.amount_debt', 'amount_debt'
			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'published' => 'cmd',
			'sortTable' => 'cmd',
			'directionTable' => 'cmd',
			'limit' => 'cmd',
			'customer_id' => 'cmd',
			'city_id' => 'cmd',
			'country_id' => 'cmd',
			'type_customer_id' => 'cmd',
			'amount_repayment' => 'cmd',
			'date_debt' => 'date:d.m.Y',
			'date_debt_from' => 'date:d.m.Y',
			'date_debt_to' => 'date:d.m.Y',
			'creation_date_from' => 'varchar',
			'creation_date_to' => 'varchar'
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
		$id	.= ':'.$this->getState('filter.published');
		$id	.= ':'.$this->getState('filter.customer_id');
		
		$id	.= ':'.$this->getState('filter.city_id');
		$id	.= ':'.$this->getState('filter.country_id');
		$id	.= ':'.$this->getState('filter.amount_repayment');
		$id	.= ':'.$this->getState('filter.date_debt');
		$id	.= ':'.$this->getState('filter.creation_date');
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
				'amount_debt',
				'note',	
				'amount_repayment',
				'creation_date',
				'customer_id',
				'customer_id.nick_name',
				'date_debt',
				
				'ordering'
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
		$query->from('#__managementcom_debts AS a');

		switch($this->getState('context', 'all'))
		{
			case 'layout.statis':
				$this->addSelect('SUM(a.amount_debt) AS sum_amount_debt');
				$this->addSelect('SUM(a.amount_repayment) AS sum_amount_repayment');
				$this->addSelect('(SUM(a.amount_debt) - SUM(a.amount_repayment)) AS total_debt');
				$this->addGroupBy('a.customer_id');
				$this->setState('list.limit', 0);
			break;

			case 'layout.default':	
				$this->setState('list.ordering', 'creation_date');
				$this->setState('list.direction', 'DESC');
			break;
		}

		// Automatic composition of the base query from ORM description
		$this->populateStatesOrm();

		$this->orm(array(
			'select' => array(
				'published',
				'amount_debt',
				'note',
				'amount_repayment',
				'date_debt',
				'customer_id',
				'customer_id.nick_name',
			),
			'access' => array(

				// ACCESS : Restricts accesses over the local table
				'a' => array(
					'publish' => 'published'
				)
			),
			'filter' => array(

				// FILTER : State
				'published' => array(

				),

				// FILTER : Customer ID > Title
				'customer_id' => array(
					'type' => 'fk'
				),


				// FILTER : Amount Repayment
				'amount_repayment' => array(
					
				),

				// FILTER : Date Of Debt
				'date_debt' => array(
					'type' => 'range'
				),

				// FILTER (Range) : Creation date
				'creation_date' => array(
					'type' => 'range'
				)
			),
			'search' => array(

				// FILTER : 
				'search' => array(
					'format' => 'datetime',
					'customer_id.nick_name' => 'like',
				)
			)
		));



		// ORDERING
		$orderCol = $this->getState('list.ordering', 'a.id');
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
if (!class_exists('ManagementcomModelDebts')){ class ManagementcomModelDebts extends ManagementcomCkModelDebts{} }

