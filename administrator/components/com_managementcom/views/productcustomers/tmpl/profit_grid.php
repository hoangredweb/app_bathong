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
	<table class='table table-striped table-responsive' id='grid-productcustomers'>
		<thead>
			<tr>
				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "", 'a.id', $listDirn, $listOrder ); ?>
				</th>
				
				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "Tổng Thu", 'customer_id.nick_name', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "Tổng Chi", 'a.total_weight', $listDirn, $listOrder ); ?>
				</th>
				
				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "Lợi Nhuận Ròng", 'a.total_price', $listDirn, $listOrder ); ?>
				</th>
				
				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "Doanh Số", 'a.weight', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "Tỉ Suất Lợi Nhuận", 'a.weight', $listDirn, $listOrder ); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$k = 0;
		$sum_total_earn = 0;
		$sum_total_cost = 0;
		$sum_total_profit = 0;
		$sum_total_weight = 0;

		for ($i=0, $n = count( $this->items ); $i < $n; $i++):
			$row = $this->items[$i];
			?>

			<tr class="<?php echo "row$k"; ?>">
				<td style="text-align:left">
					<?php echo $row['date'];?>
					
				</td>

				<td style="text-align:left">
					<?php echo number_format($row['total_earn'],0,',','.');
					$sum_total_earn += $row['total_earn'];
					?>
				</td>

				<td style="text-align:left">
					<?php echo number_format($row['total_cost'],0,',','.');
					$sum_total_cost += $row['total_cost'] ;
					?>
				</td>
				
				<td style="text-align:left">
					<?php echo number_format($row['total_profit'],0,',','.');
					$sum_total_profit += $row['total_profit'];
					?>
				</td>
				
				<td style="text-align:left">
					<?php echo number_format($row['total_weight'],2,',',' ');
					$sum_total_weight += $row['total_weight'];
					?>
				</td>

				<td style="text-align:left">
					<?php
					if ($sum_total_earn != 0): ?>
						<?php echo number_format(($row['total_profit'] / $row['total_earn'] * 100), 2,',','.') .' %'; ?>
					<?php else:?>
						<?php echo '0 %'; ?>
					<?php endif;?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		endfor;
		?>
		</tbody>
		<tfoot>
			<tr>
			
				<th style="text-align:left">
					
				</th>
				
				<th style="text-align:left">
					<?php echo number_format($sum_total_earn,0,',','.').' VNĐ'; ?>
				</th>

				<th style="text-align:left">
					<?php echo number_format($sum_total_cost,0,',','.').' VNĐ'; ?>
				</th>
				
				<th style="text-align:left">
					<?php echo number_format($sum_total_profit,0,',','.').' VNĐ'; ?>
				</th>

				<th style="text-align:left">
					<?php echo number_format($sum_total_weight,2,',',' ').' KG'; ?>
				</th>
				<th style="text-align:left"></th>

			</tr>
		</tfoot>
	</table>
	
<input type="hidden" id="myinfo" name="myinfo" value="" />
<script type="text/javascript">
jQuery(function($){

    Joomla.submitbutton = function(task){
         if (task == 'productcustomers.export_excel_profit')
         {
            //$('#myinfo').val($('#myinfo_ids').val());       
            Joomla.submitform(task, $('#adminForm'));                                         
         } 
         else
         {
            Joomla.submitform(task);
         }
   }
	Joomla.submitform = function(task){
		if (task)
		{
			document.adminForm.task.value=task;
		}
		else
		{
			document.adminForm.task.value = "";
		}

		if (typeof document.adminForm.onsubmit == "function")
		{
			document.adminForm.onsubmit();
		}

		document.adminForm.submit();
	}
   //first child print export to excel
    $('#toolbar-print:first-child').find('button').removeAttr("onclick");
    $('#toolbar-print:first-child').find('button').attr("onclick","Joomla.submitbutton('productcustomers.export_excel_profit')");
	
 });
    
</script>
</div>