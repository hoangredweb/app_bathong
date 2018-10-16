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
				'total_weight', 'total_weight',
				'_product_id_product_name', 'product_id.product_name',
				'input_date', 'input_date',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'published' => 'varchar'
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
		return $jinput->get('layout', '', 'STRING');
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

		return parent::getStoreId($id);
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
				'published'
			),
			'access' => array(

				// ACCESS : Restricts accesses over the local table
				'a' => array(
					'publish' => 'published',
					'author' => 'created_by'
				)
			)
		));

		// ORDERING
		$orderCol = $this->getState('list.ordering', 'customer_id');
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
if (!class_exists('ManagementcomModelProductcustomers')){ class ManagementcomModelProductcustomers extends ManagementcomCkModelProductcustomers{} }
