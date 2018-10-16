<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1.5   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		managementcom
* @subpackage	cities
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
class ManagementcomCkModelCities extends ManagementcomClassModelList
{
	/**
	* Default item layout.
	*
	* @var array
	*/
	public $itemDefaultLayout = 'city';

	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'city';

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
				'a.title', 'title',
				'_country_id_.title', 'country_id.title',
				'ordering', 'a.ordering',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'published' => 'cmd',
			'sortTable' => 'cmd',
			'directionTable' => 'cmd',
			'limit' => 'cmd',
			'country_id' => 'cmd'
				));

		//Define the searchable fields
		$this->set('search_vars', array(
			'search' => 'string'
				));


		parent::__construct($config);

		$this->hasOne('country_id', // name
			'countries', // foreignModelClass
			'country_id', // localKey
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
		$id	.= ':'.$this->getState('filter.country_id');
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
				'country_id',
				'country_id.title',
				'ordering',
				'title'
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
				'title'
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
		$query->from('#__managementcom_cities AS a');

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

				// FILTER : Country > Title
				'country_id' => array(
					'type' => 'fk'
				)
			),
			'search' => array(

				// FILTER : State
				'search' => array(

				)
			)
		));

		// ORDERING
		$orderCol = $this->getState('list.ordering', 'title');
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
if (!class_exists('ManagementcomModelCities')){ class ManagementcomModelCities extends ManagementcomCkModelCities{} }

