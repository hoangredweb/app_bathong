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
JHtml::_('behavior.calendar');
JHtml::_('jquery.framework');
?>

<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm">
	<div class="row-fluid">
		<div id="sidebar" class="span2">
			<div class="sidebar-nav">

				<!-- BRICK : menu -->
				<?php echo JDom::_('html.menu.submenu', array(
					'list' => $this->menu
				)); ?>
				
				<div class="filter-select hidden">
					<?php echo $this->filters['filter_end_type_date']->input;?>
					<?php echo $this->filters['filter_star_type_date']->input;?>
					<?php echo $this->filters['filter_typefilter']->input;?>  
				</div>
				
			</div>
		</div>
		<div id="contents" class="span10">
			<div class="pull-left">
				<?php echo $this->filters['search_search']->input;?>
			</div>
			<div class="clearfix"></div>
			<!-- BRICK : grid -->
			<?php echo $this->loadTemplate('grid'); ?>

		
		</div>
	</div>


	<?php 
		$jinput = JFactory::getApplication()->input;
		echo JDom::_('html.form.footer', array(
		'values' => array(
					'view' => $jinput->get('view', 'productcustomers'),
					'layout' => $jinput->get('layout', 'profit'),
					'boxchecked' => '0',
					'task' => 'profit',
					'filter_order' => $this->escape($this->state->get('list.ordering')),
					'filter_order_Dir' => $this->escape($this->state->get('list.direction'))
				)));
	?>
</form>

<div class="controls input-critical appendsearch">
    <label style="display: inline-block; margin-left:0px">From :</label>
	<div class="btn-group">
        <div class="input-append">
            <input type="text" id="jform_date_frm" name="filter_star_type_date" class="input-small" value="" size="32" placeholder="dd.mm.yyyy">
            <a id="jform_date_frm-btn" class="btn" style="cursor:pointer;" type="button"><i class="icon-calendar icomoon "></i></a>
        </div>
    </div>	
    
    <label style="display: inline-block;"> To :</label>
    <div class="btn-group">
        <div class="input-append">
            <input type="text" id="jform_date_to" name="filter_end_type_date" class="input-small" value="" size="32" placeholder="dd.mm.yyyy">
            <a id="jform_date_to-btn" class="btn" style="cursor:pointer;" type="button"><i class="icon-calendar icomoon "></i></a>
        </div>
    </div>	
    
    <div class="controls input-medium" style="display: inline-block; top: -4px; position: relative;">
        <select name="filter_typefilter" id="jform_typefilter">
			<option selected disabled>- Chọn Cách Lọc -</option> 
			<option value="1">Ngày</option>
			<option value="2">Tháng</option>
			<option value="3">Năm</option>
			<option value="4">Quý</option>
        </select>
    </div>	   	
</div>



<script>   
jQuery(function($){
     $(document).ready(function(){
		$("#search_search").hide();

		$('#search_search').on("keypress", function(e) {
            /* ENTER PRESSED*/
            if (e.keyCode == 13) {
				Joomla.submitform();
            }
		 });

        window.addEvent('domready', function() {if($("jform_date_frm")) Calendar.setup({
			inputField: "jform_date_frm",
			ifFormat: "%d.%m.%Y",	// Trigger for the calendar (button ID)
			button: "jform_date_frm-btn",
			align: "B2",
			
			singleClick: true,firstDay: 0
			});});
       window.addEvent('domready', function() {if($("jform_date_to")) Calendar.setup({
			inputField: "jform_date_to",
			ifFormat: "%d.%m.%Y",	// Trigger for the calendar (button ID)
			button: "jform_date_to-btn",
			align: "B2",

			singleClick: true,firstDay: 0
			});});
       
         $('#jform_date_frm').val($('#filter_star_type_date').val());
         $('#jform_date_to').val($('#filter_end_type_date').val());
         $('#jform_typefilter').val($('#filter_typefilter').val());
         $("#jform_typefilter").trigger("liszt:updated");  
          
		  
         $('.input-critical').insertBefore( $( ".form-search" ) );
		 //clear button
		 $("a").filter("[data-original-title=Clear]").removeAttr("onclick");
		 $("a").filter("[data-original-title=Clear]").click(function() {				
			 $('#jform_date_frm').val("");
			 $('#jform_date_to').val("");
			 $('#jform_typefilter').val("0");
			 Joomla.resetFilters();
		 });

 });});     
</script>

<style>
.appendsearch{
	float: left;
}
.form-search{
	float: left;
	margin-left: 20px;
	
}
</style>
