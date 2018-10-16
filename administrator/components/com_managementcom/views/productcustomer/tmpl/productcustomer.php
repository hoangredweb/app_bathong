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


ManagementcomHelper::headerDeclarations();
//Load the formvalidator scripts requirements.
JDom::_('html.toolbar');

$jinput = JFactory::getApplication()->input;
$link_return = $jinput->get('return', '', 'CMD');
?>

<script language="javascript" type="text/javascript">
	//Secure the user navigation on the page, in order preserve datas.
	var holdForm = true;
	window.onbeforeunload = function closeIt(){	if (holdForm) return false;};
</script>

<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm" class='form-validate' enctype='multipart/form-data'>
	<div class="row-fluid">
		<div id="contents" class="span12">
			<!-- BRICK : toolbar_sing -->
			<?php echo $this->renderToolbar();?>
			<!-- BRICK : form -->
			<?php echo $this->loadTemplate('form'); ?>
			
		</div>
	</div>


	<?php 
		$jinput = JFactory::getApplication()->input;
		echo JDom::_('html.form.footer', array(
		'dataObject' => $this->item,
		'values' => array(
					'id' => $this->state->get('productcustomer.id')
				)));
	?>
	<input type="hidden" id="return" name="return" value="<?php echo $link_return?>">
	
</form>
<div class="toolbar"></div>
<script type="text/javascript">


jQuery(function($){
	
	Joomla.submitbutton = function(task){ 
		var link_return = $_GET('return');
		var cid = $_GET('cid[]');
		
		if ( task == 'productcustomer.cancel'  && link_return == 'statis' ){
		
			//alert(link_return);
			var a = window.location.protocol + "//" + window.location.host + window.location.pathname + '?option=com_managementcom&view=productcustomers&layout=statis&cid[]=' + cid;
			//Joomla.submitform(task, $('#adminForm')); 	
			window.location.href = a;
		}	
		 else {
			window.onbeforeunload = null; 
			Joomla.submitform(task);
		 }
   }
   
   function $_GET(param) {
		var vars = {};
		window.location.href.replace( location.hash, '' ).replace( 
			/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
			function( m, key, value ) { // callback
				vars[key] = value !== undefined ? value : '';
			}
		);
	
		if ( param ) {
			return vars[param] ? vars[param] : null;	
		}
		return vars;
	}
	
 });
     
</script>
