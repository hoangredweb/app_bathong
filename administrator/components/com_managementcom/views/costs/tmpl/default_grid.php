<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo----------------------------------  
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
	<table class='table table-striped table-responsive' id='grid-costs'>
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
					<?php echo JHTML::_('grid.sort',  "Loại Chi Phí", 'typecost_id.name', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "Giá", 'a.price', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_NGAY_NHP"); ?>
				</th>
				
				<th style="text-align:center">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_GHI_CHU"); ?>
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

			?>

			<tr class="<?php echo "row$k"; ?>">
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
				
				<td style="text-align:left">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'id',
						'dataObject' => $row,
						'modalHeight' => 400,
						'modalWidth' => 580,
						'route' => array('view' => 'cost','layout' => 'costmodal','cid[]' => $row->id),
						'target' => 'modal'
					));?>
				</td>

				<td style="text-align:left">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => '_typecost_id_name',
						'dataObject' => $row,
						'modalHeight' => 280,
						'modalWidth' => 500,
						'route' => array('view' => 'typecost','layout' => 'typecostmodal','cid[]' => $row->typecost_id),
						'target' => 'modal'
					));?>
				</td>

				<td style="text-align:left">
					<?php echo number_format(JDom::_('html.fly', array(
						'dataKey' => 'price',
						'dataObject' => $row
					)),0,',','.');?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.datetime', array(
						'dataKey' => 'input_date',
						'dataObject' => $row,
						'dateFormat' => 'd.m.Y'
					));?>
				</td>
				
				<td style="text-align:left">
					<?php echo ($row->note)?JDom::_('html.fly', array(
						'dataKey' => 'note',
						'dataObject' => $row
					)):'-';?>
				</td>

				<?php if ($model->canEditState()): ?>
				<td style="text-align:center">
					<?php echo JDom::_('html.grid.publish', array(
						'ctrl' => 'costs',
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
		<tfoot>
			<tr>
			
				<th>
					
				</th>
				
				<th style="text-align:left">
					
				</th>
				
				<th style="text-align:left">
					
				</th>

				
				<th style="text-align:left">
					<?php echo number_format($this->sum_total_price,0,',','.').' VNĐ'; ?>
				</th>
				
				<th style="text-align:left">
					
				</th>

				<th style="text-align:left">
					
				</th>
			</tr>
		</tfoot>
	</table>
</div>