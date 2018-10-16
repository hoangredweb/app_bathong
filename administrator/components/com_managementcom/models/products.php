<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		ManagementCom
* @subpackage	Products
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
class ManagementcomCkModelProducts extends ManagementcomClassModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'product';

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
				'a.product_code', 'product_code',
				'a.product_name', 'product_name',
				'ordering', 'a.ordering',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'published' => 'varchar',
			'sortTable' => 'cmd',
			'id' => 'cmd',
			'directionTable' => 'cmd',
			'limit' => 'cmd'
				));

		//Define the searchable fields
		$this->set('search_vars', array(
			'search' => 'string'
				));


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
				'product_code',
				'product_name',
				'column_ordering',
				'ordering'
			)
		));
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed to
	 * be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @access	protected
	 *
	 *
	 * @since	11.1
	 *
	 * @return	void
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();
		$session = JFactory::getSession();
		$acl = ManagementcomHelper::getActions();

		parent::populateState(
			($ordering ? $ordering : 'a.ordering'),
			($direction ? $direction : 'asc')
		);

		//Only show the published items
		if (!$acl->get('core.admin') && !$acl->get('core.edit.state'))
			$this->setState('filter.published', 1);
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
				'product_name'
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
		$query->from('#__managementcom_products AS a');

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
				// FILTER () : id
				'id' => array(
					
				)
			),
			'search' => array(

				// SEARCH : Tên Sản Phẩm + Mã Sản Phẩm
				'search' => array(
					'on' => array(
						'product_name' => 'like',
						'product_code' => 'like'
					)
				)
			)
		));

		// ORDERING
		$orderCol = $this->getState('list.ordering', 'product_name');
		$orderDir = $this->getState('list.direction', 'ASC');

		if ($orderCol)
		{
			$this->orm->order(array($orderCol => $orderDir));
		}
		// Apply all SQL directives to the query
		$this->applySqlStates($query);
	}


}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomModelProducts')){ class ManagementcomModelProducts extends ManagementcomCkModelProducts{} }
