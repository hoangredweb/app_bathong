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


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
if(!defined('DS')) define('DS',DIRECTORY_SEPARATOR);

//Copy this line to be able to call the application from outside (Module, Plugin, Third component, ...)
require_once(JPATH_ADMINISTRATOR.'/components/com_managementcom/helpers/loader.php');

if (defined('JDEBUG') && count($_POST))
	$_SESSION['Managementcom']['$_POST'] = $_POST;

$jinput = JFactory::getApplication()->input;
// When this component is called to return a file
if ($jinput->get('task', null, 'CMD') == 'file')
	ManagementcomHelperFile::returnFile();


$controller = CkJController::getInstance('Managementcom');
$controller->execute($jinput->get('task', null, 'CMD'));
$controller->redirect();

