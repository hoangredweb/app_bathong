<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		ManagementCom
* @subpackage	pricelists
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
* Managementcom pricelists Controller
*
* @package	Managementcom
* @subpackage	pricelists
*/
class ManagementcomCkControllerPricelists extends ManagementcomClassControllerList
{
	/**
	* The context for storing internal data, e.g. record.
	*
	* @var string
	*/
	protected $context = 'pricelists';

	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'pricelist';

	/**
	* The URL view list variable.
	*
	* @var string
	*/
	protected $view_list = 'pricelists';

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
	* Return the current layout.
	*
	* @access	protected
	* @param	bool	$default	If true, return the default layout.
	*
	* @return	string	Requested layout or default layout
	*/
	protected function getLayout($default = null)
	{
		if ($default)
			return 'default';

		$jinput = JFactory::getApplication()->input;
		return $jinput->get('layout', 'default', 'CMD');
	}

	/**
	* Redirect to multiedit view 
	*
	* @access	public
	* @param	array	$data	The post values.
	*
	* @return	void
	*/
	public function multiedit($object){
		$this->applyRedirection($result, array(
			'stay',
			'com_managementcom.pricelists.multiedit'
		));
    }
}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomControllerPricelists')){ class ManagementcomControllerPricelists extends ManagementcomCkControllerPricelists{} }
