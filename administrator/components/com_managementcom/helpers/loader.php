<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		ManagementCom
* @subpackage	ManagementCom
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


// Some usefull constants
if(!defined('DS')) define('DS',DIRECTORY_SEPARATOR);
if(!defined('BR')) define("BR", "<br />");
if(!defined('LN')) define("LN", "\n");

// Main component aliases
if (!defined('COM_MANAGEMENTCOM')) define('COM_MANAGEMENTCOM', 'com_managementcom');
if (!defined('MANAGEMENTCOM_CLASS')) define('MANAGEMENTCOM_CLASS', 'Managementcom');

// Component paths constants
if (!defined('JPATH_ADMIN_MANAGEMENTCOM')) define('JPATH_ADMIN_MANAGEMENTCOM', JPATH_ADMINISTRATOR . '/components/' . COM_MANAGEMENTCOM);
if (!defined('JPATH_SITE_MANAGEMENTCOM')) define('JPATH_SITE_MANAGEMENTCOM', JPATH_SITE . '/components/' . COM_MANAGEMENTCOM);

$app = JFactory::getApplication();

// This constant is used for replacing JPATH_COMPONENT, in order to share code between components.
if (!defined('JPATH_MANAGEMENTCOM')) define('JPATH_MANAGEMENTCOM', ($app->isSite()?JPATH_SITE_MANAGEMENTCOM:JPATH_ADMIN_MANAGEMENTCOM));

// Load the component Dependencies
require_once(dirname(__FILE__) . '/helper.php');


jimport('joomla.version');
$version = new JVersion();

if (version_compare($version->RELEASE, '3.0', '<'))
	throw new JException('Joomla! 3.x is required.');

// Proxy alias class : CONTROLLER
if (!class_exists('CkJController')){ 	jimport('legacy.controller.legacy'); 	class CkJController extends JControllerLegacy{}}

// Proxy alias class : MODEL
if (!class_exists('CkJModel')){			jimport('legacy.model.legacy');			class CkJModel extends JModelLegacy{}}

// Proxy alias class : VIEW
if (!class_exists('CkJView')){	if (!class_exists('JViewLegacy', false))	jimport('legacy.view.legacy'); class CkJView extends JViewLegacy{}}

require_once(dirname(__FILE__) . '/../classes/loader.php');

ManagementcomClassLoader::setup(false, false);
ManagementcomClassLoader::discover('Managementcom', JPATH_ADMIN_MANAGEMENTCOM, false, true);

// Some helpers
ManagementcomClassLoader::register('JToolBarHelper', JPATH_ADMINISTRATOR ."/includes/toolbar.php", true);

CkJController::addModelPath(JPATH_MANAGEMENTCOM . '/models', 'ManagementcomModel');

//Instance JDom
if (!isset($app->dom))
{
	jimport('jdom.dom');
	if (!class_exists('JDom'))
		jexit('JDom plugin is required');

	JDom::getInstance();	
}

