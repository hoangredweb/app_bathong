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


JHtml::addIncludePath(JPATH_ADMIN_MANAGEMENTCOM.'/helpers/html');
JHtml::_('behavior.tooltip');
//JHtml::_('behavior.multiselect');

$model		= $this->model;
$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder	= $listOrder == 'a.ordering' && $listDirn != 'desc';
?>

<div class="clearfix"></div>
<div class="">
	<table class='table  table-striped table-responsive' id='grid-productcustomers'>
		<thead>
			<tr>
				<?php if ($model->canSelect()): ?>
				<th>
					<?php echo JDom::_('html.form.input.checkbox', array(
						'dataKey' => 'checkall-toggle',
						'title' => JText::_('JGLOBAL_CHECK_ALL'),
						'selectors' => array(
							'onclick' => 'Joomla.checkAll(this);'
						)
					)); ?>
				</th>
				<?php endif; ?>
				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "id", 'a.id', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "MANAGEMENTCOM_FIELD_KHACH_HANG", 'customer_id.nick_name', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "MANAGEMENTCOM_FIELD_S_LUNG", 'a.total_weight', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "Giá", 'a.total_price', $listDirn, $listOrder ); ?>
				</th>


				<th style="text-align:center">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_TRNG_LUNG"); ?>
				</th>

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "MANAGEMENTCOM_FIELD_SN_PHM", 'product_id.product_name', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_V"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_HUT_CHAN_KHONG"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_GHI_CHU"); ?>
				</th>

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "MANAGEMENTCOM_FIELD_NGAY_NHP", 'a.input_date', $listDirn, $listOrder ); ?>
				</th>

				<?php if ($model->canEditState()): ?>
				<th style="text-align:center">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_STATUS"); ?>
				</th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
		<?php
		$k = 0;
		for ($i=0, $n=count( $this->items ); $i < $n; $i++):
			$row = $this->items[$i];

			$class  = 'bill_child';
			$class2 = '';

			if (!$row->bill_id)
			{
				$class='bill';
				$class2='';
			}
			elseif ( $i==0)
			{
				$class='bill';
				$class2='add_more';
			}
			elseif ($i>=1 && ($row->bill_id != $this->items[$i-1]->bill_id))
			{
				$class='bill';
				$class2='add_more';
			}
			?>

			<tr class="<?php echo "row$k"; ?> <?php echo $class; ?>">
				<?php if ($model->canSelect()): ?>
				<td>
					<?php if ($row->params->get('access-edit') || $row->params->get('tag-checkedout')): ?>
						<?php echo JDom::_('html.grid.checkedout', array(
													'dataObject' => $row,
													'num' => $i
														));
						?>
					<?php endif; ?>
				</td>
				<?php endif; ?>

				<td style="text-align:left" class="<?php echo $class2; ?>">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'id',
						'dataObject' => $row,
						'modalHeight' => 500,
						'modalWidth' => 580,
						'route' => array('view' => 'productcustomer','layout' => 'productcustomermodal','cid[]' => $row->id),
						'target' => 'modal'
					));?>
				</td>

				<td style="text-align:left">
					<?php
						$tmp = JDom::_('html.fly', array(
								'dataKey' => '_customer_id_nick_name',
								'dataObject' => $row,
								'modalHeight' => 500,
								'modalWidth' => 580,
								'route' => array('view' => 'customer','layout' => 'customermodal','cid[]' => $row->customer_id),
								'target' => 'modal'
							));
						if (!$row->bill_id) echo $tmp;
						elseif ( $i==0) echo $tmp ;
						elseif ( $i>=1 && ($row->bill_id != $this->items[$i-1]->bill_id)  ) echo  $tmp ;


					?>

				</td>
				<td class='hidden'>
					<input type="text" class="bill_id" name="" class="" value="<?php echo isset($row->bill_id)?$row->bill_id:''?>" size="32">
				</td>
				<!-- start -->
				<td style="text-align:left">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'total_weight',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:left">
					<?php echo number_format(JDom::_('html.fly', array(
						'dataKey' => 'total_price',
						'dataObject' => $row
					)),0,',','.');?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.enum', array(
						'dataKey' => 'weight',
						'dataObject' => $row,
						'labelKey' => 'text',
						'list' => ManagementcomHelperEnum::_('productcustomers_weight'),
						'listKey' => 'value'
					));?>
				</td>

				<td style="text-align:left">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => '_product_id_product_name',
						'dataObject' => $row,
						'modalHeight' => 300,
						'modalWidth' => 580,
						'route' => array('view' => 'product','layout' => 'productmodal','cid[]' => $row->product_id),
						'target' => 'modal'
					));?>
				</td>

				<td style="text-align:left">
					<?php echo JDom::_('html.fly.enum', array(
						'dataKey' => 'taste',
						'dataObject' => $row,
						'labelKey' => 'text',
						'list' => ManagementcomHelperEnum::_('productcustomers_taste'),
						'listKey' => 'value'
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.bool', array(
						'dataKey' => 'vacuum',
						'dataObject' => $row,
						'togglable' => false,
						'viewType' => 'icon'
					));?>
				</td>

				<td style="text-align:left">
					<?php echo ($row->note)?JDom::_('html.fly', array(
						'dataKey' => 'note',
						'dataObject' => $row
					)):'-';?>
				</td>
				<!-- end -->


				<td style="text-align:left">
					<?php echo JDom::_('html.fly.datetime', array(
						'dataKey' => 'input_date',
						'dataObject' => $row,
						'dateFormat' => 'd.m.Y'
					));?>
				</td>

				<?php if ($model->canEditState()): ?>
				<td style="text-align:center">
					<?php echo JDom::_('html.grid.publish', array(
						'ctrl' => 'productcustomers',
						'dataKey' => 'published',
						'dataObject' => $row,
						'num' => $i
					));?>
				</td>
				<?php endif; ?>
			</tr>
			<?php
			$k = 1 - $k;
		endfor;
		?>
		</tbody>
	</table>
</div>
<input type="hidden" id="myinfo" name="myinfo" value="" />
<script type="text/javascript">
jQuery(function($){

    Joomla.submitbutton = function(task){
         if (task == 'productcustomers.export_excel'){
            $('#myinfo').val($('#myinfo_ids').val());
            Joomla.submitform(task, $('#adminForm'));
         }
         else {
            Joomla.submitform(task);
         }
   }
	Joomla.submitform = function(task){
		if (task) {
			document.adminForm.task.value=task;
		}
		else
		document.adminForm.task.value = "";
		if (typeof document.adminForm.onsubmit == "function") {
			document.adminForm.onsubmit();
		}
		document.adminForm.submit();
	}
   //first child print export to excel
    $('#toolbar-print:first-child').find('button').removeAttr("onclick");
    $('#toolbar-print:first-child').find('button').attr("onclick","Joomla.submitbutton('productcustomers.export_excel')");

    $('#search_search').on("keypress", function(e) {
            /* ENTER PRESSED*/
            if (e.keyCode == 13) {
				Joomla.submitform();
            }
	});

	$('.add_more').on('click', function() {
		var bill_id = $(this).parent().find('.bill_id').val();
		$(this).toggleClass('add_more-plus');
		$('.table tr.bill_child').each(function() {
			var tmp = $(this).find('.bill_id').val();
			if ( tmp == bill_id ){
				$(this).slideToggle( "fast" );
			}
		});
	});
 });

</script>