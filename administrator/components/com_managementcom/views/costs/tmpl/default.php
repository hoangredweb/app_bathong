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


ManagementcomHelper::headerDeclarations();
//Load the formvalidator scripts requirements.
JDom::_('html.toolbar');
?>

<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm">
	<div class="row-fluid">
		<div id="sidebar" class="span2">
			<div class="sidebar-nav">

				<!-- BRICK : menu -->
				<?php echo JDom::_('html.menu.submenu', array(
					'list' => $this->menu
				)); ?>
				<!--
				<div class="nav-filters">
					<hr class="hr-condensed">
					<?php echo $this->filters['filter_typecost_id']->input;?>
					
					<hr class="hr-condensed">
						<?php echo $this->filters['filter_input_date_from']->input;?>
						<?php echo $this->filters['filter_input_date_to']->input;?>
				</div>
				 -->

			</div>
		</div>
		<div id="contents" class="span10">

			<!-- BRICK : filters -->
			<div class="pull-left">
				<?php echo $this->filters['search_search']->input;?>
			</div>


			<!-- BRICK : display -->
			<div class="pull-right">
				<?php echo $this->filters['sortTable']->input;?>
			</div>


			<div class="pull-right">
				<?php echo $this->filters['directionTable']->input;?>
			</div>


			<div class="pull-right">
				<?php echo $this->filters['limit']->input;?>
			</div>


			<div class="clearfix"></div>

			<div class="controls input-critical appendsearch">
				
				<?php echo $this->filters['filter_typecost_id']->input;?>
				
				<?php echo $this->filters['filter_input_date_from']->input;?>
				<?php echo $this->filters['filter_input_date_to']->input;?>
				<?php echo $this->filters['filter_type_filter']->input;?>

			</div>

			<div class="clearfix"></div>
			<!-- BRICK : grid -->
			<?php echo $this->loadTemplate('grid'); ?>

			<!-- BRICK : pagination -->
			<?php echo $this->pagination->getListFooter(); ?>

		</div>
	</div>


	<?php 
		$jinput = JFactory::getApplication()->input;
		echo JDom::_('html.form.footer', array(
		'values' => array(
					'view' => $jinput->get('view', 'costs'),
					'layout' => $jinput->get('layout', 'default'),
					'boxchecked' => '0',
					'filter_order' => $this->escape($this->state->get('list.ordering')),
					'filter_order_Dir' => $this->escape($this->state->get('list.direction'))
				)));
	?>
</form>
<script type="text/javascript">
jQuery(function($){
	$('#search_search').on("keypress", function(e) {
            /* ENTER PRESSED*/
            if (e.keyCode == 13) {
				Joomla.submitform();
            }
	 });

	window.addEvent('domready', function() {if($("filter_input_date_from")) Calendar.setup({
		inputField: "filter_input_date_from",
		ifFormat: "%d.%m.%Y",	// Trigger for the calendar (button ID)
		button: "filter_input_date_from-btn",
		align: "B2",
		
		singleClick: true,firstDay: 0
		});});
  	window.addEvent('domready', function() {if($("filter_input_date_to")) Calendar.setup({
		inputField: "filter_input_date_to",
		ifFormat: "%d.%m.%Y",	// Trigger for the calendar (button ID)
		button: "filter_input_date_to-btn",
		align: "B2",

		singleClick: true,firstDay: 0
		});});


	$('#filter_typecost_id').removeAttr('onchange');
	$('#filter_type_filter').removeAttr('onchange');
});
</script>