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

$document = JFactory::getDocument();
$document->addScript(JURI::base().'/templates/sandmancontrol/js/morris.js');
$document->addScript(JURI::base().'/templates/sandmancontrol/js/raphael-min.js');
$document->addScript(JURI::base().'/templates/sandmancontrol/js/prettify.min.js');

$document->addStyleSheet(JURI::base().'/templates/sandmancontrol/js/prettify.min.css');
$document->addStyleSheet(JURI::base().'/templates/sandmancontrol/js/morris.css');


?>

<div class="clearfix"></div>
	<table class='table table-striped table-responsive hidden' id='grid-productcustomers'>
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

			</tr>
		</thead>
		<tbody>
		<?php
		$k = 0;
		$sum_total_earn = 0;
		$sum_total_cost = 0;
		$sum_total_profit = 0;
		for ($i=0, $n=count( $this->items ); $i < $n; $i++):
			$row = $this->items[$i];
			
			?>

			<tr class="<?php echo "row$k"; ?>">
				
				
				<td style="text-align:left">
					<?php echo $row['date'];?>
					
				</td>

				<td style="text-align:left">
					<?php echo number_format($row['total_earn'],0,',','.');
					$sum_total_earn += $row['total_earn'] ;
					?>
				</td>

				<td style="text-align:left">
					<?php echo number_format($row['total_cost'],0,',','.');
					$sum_total_cost += $row['total_cost'] ;
					?>
				</td>
				
				<td style="text-align:left">
					<?php echo number_format($row['total_profit'],0,',','.');
					$sum_total_profit += $row['total_profit'] ;
					?>
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
				
				

			</tr>
		</tfoot>
	</table>
<blockquote><pre><?php echo "Tổng Thu: ".number_format($sum_total_earn,0,',','.').' VNĐ'."<br>";
 echo "Tổng Chi: ".number_format($sum_total_cost,0,',','.').' VNĐ'."<br>";
 echo "Lợi Nhuận Ròng: ".number_format($sum_total_profit,0,',','.').' VNĐ'."<br>";
  ?>

</pre></blockquote>

<div id="graph"></div>




<script type="text/javascript">
	jQuery(function($){
		var data_profit = <?php echo json_encode($this->items); ?>;		
		
		
		var chart_profit = [];
		$.each(data_profit, function (i, elem) {
			var myObject = new Object();
			
			myObject.x = elem.date;
			myObject.a = (elem.total_earn);
			myObject.b = (elem.total_cost);
			myObject.c = (elem.total_profit);
			chart_profit.push(myObject);
		});
		//alert(JSON.stringify(chart_profit));
		
		Morris.Bar({
			  element: 'graph',
			  data: chart_profit,
			  xkey: 'x',
			  ykeys: ['a', 'b', 'c'],
			  labels: ['Thu', 'Chi', 'Lợi Nhuận'],
			  barColors: ['rgb(155,187,89)','rgb(79,129,189)','rgb(192,80,77)']
			}).on('click', function(i, row){
			  //console.log(i, row);
			});
		prettyPrint();
	 });
    
</script>
