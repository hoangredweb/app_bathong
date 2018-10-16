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
* Managementcom List Model
*
* @package	Managementcom
* @subpackage	Classes
*/
class ManagementcomCkModelCosts extends ManagementcomClassModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'cost';

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
				'_typecost_id_name', 'typecost_id.name',
				'price', 'a.price',
				'id', 'a.id',
			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'published' => 'cmd',
			'sortTable' => 'cmd',
			'directionTable' => 'cmd',
			'limit' => 'cmd',
			'typecost_id' => 'cmd',
			'type_filter' => 'cmd',
			'input_date_from' => 'date:d.m.Y',
			'input_date_to' => 'date:d.m.Y'
				));

		//Define the searchable fields
		$this->set('search_vars', array(
			'search' => 'string'
				));
				
		parent::__construct($config);

		$this->hasOne('typecost_id', // name
			'typecosts', // foreignModelClass
			'typecost_id', // localKey
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
		$id	.= ':'.$this->getState('filter.typecost_id');
		$id	.= ':'.$this->getState('filter.type_filter');
		$id	.= ':'.$this->getState('filter.input_date');
		$id	.= ':'.$this->getState('search.search');
		$id	.= ':'.$this->getState('filter.creation_date');
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
				'input_date',
				'price',
				'typecost_id',
				'typecost_id.name',
				'note'
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
				'typecost_id'
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
		$query->from('#__managementcom_costs AS a');

		// Automatic composition of the base query from ORM description
		$this->populateStatesOrm();

		$this->orm(array(
			'select' => array(
				'published'
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
				
				// FILTER : Loại Chi Phí > Tên
				'typecost_id' => array(
					'type' => 'fk'
				),

				// FILTER : Ngày Nhập
				'input_date' => array(
					'type' => 'range'
				),

				// FILTER (Range) : Creation date
				'creation_date' => array(
					'type' => 'range'
				)
			),
			'search' => array(

				// SEARCH : Khách Hàng -  Sản Phẩm - Vị - Ngày Nhập - Ghi Chú - Số lượng
				'search' => array(
					'on' => array(
						'typecost_id.name' => 'like',
						'input_date' => 'like',
						'note' => 'like',
						'price' => 'like'
					)
				)
			)
		));


		// ORDERING
		$orderCol = $this->getState('list.ordering', 'a.input_date');
		$orderDir = $this->getState('list.direction', 'DESC');

		

		if ($orderCol)
			$this->orm->order(array($orderCol => $orderDir));

		// Apply all SQL directives to the query
		$this->applySqlStates($query);
	}


}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomModelCosts')){ class ManagementcomModelCosts extends ManagementcomCkModelCosts{} }
