<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1.5   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		managementcom
* @subpackage	debts
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
JDom::_('framework.sortablelist', array(
	'domId' => 'grid-debts',
	'listOrder' => $listOrder,
	'listDirn' => $listDirn,
	'formId' => 'adminForm',
	'ctrl' => 'debts',
	'proceedSaveOrderButton' => true,
));
?>

<div class="clearfix"></div>
<div class="">
	<table class='table' id='grid-debts'>
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

				<?php if ($model->canEditState()): ?>
				<th style="text-align:center">
					<?php echo JHTML::_('grid.sort',  "MANAGEMENTCOM_HEADING_ORDERING", 'a.ordering', $listDirn, $listOrder ); ?>
				</th>
				<?php endif; ?>

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "MANAGEMENTCOM_FIELD_CUSTOMER_ID_TITLE", 'customer_id.nick_name', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "MANAGEMENTCOM_FIELD_DATE", 'a.date_debt', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "Nợ", 'amount_debt', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "Trả", 'amount_repayment', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left">Tình Trạng Công Nợ</th>
				<th style="text-align:left">Ghi Chú</th>
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

				<?php if ($model->canEditState()): ?>
				<td style="text-align:center">
					<?php echo JDom::_('html.grid.ordering', array(
						'aclAccess' => 'core.edit.state',
						'dataKey' => 'ordering',
						'dataObject' => $row,
						'enabled' => $saveOrder
					));?>
				</td>
				<?php endif; ?>

				<td style="text-align:left">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => '_customer_id_nick_name',
						'dataObject' => $row,
						'modalHeight' => 500,
						'modalWidth' => 580,
						'route' => array('view' => 'customer','layout' => 'customermodal','cid[]' => $row->customer_id),
						'target' => 'modal'
					));?>
				</td>


				<td style="text-align:left">
					<?php echo ($row->date_debt) ? JDom::_('html.fly.datetime', array(
						'dataKey' => 'date_debt',
						'dataObject' => $row,
						'dateFormat' => 'd-m-Y'
					)):'-';?>
				</td>

				<td style="text-align:left">
					<?php echo number_format($row->amount_debt, 0, ',', '.');?>
				</td>

				<td style="text-align:left">
					<?php echo number_format($row->amount_repayment, 0, ',', '.');?>
				</td>

				<td style="text-align:left">
					<?php echo number_format($row->amount_debt - $row->amount_repayment, 0, ',', '.');?>
				</td>

				<td style="text-align:left">
					<?php echo ($row->note)?JDom::_('html.fly', array(
						'dataKey' => 'note',
						'dataObject' => $row
					)):'-';?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		endfor;
		?>
		</tbody>
		<tfoot>
			<tr>
				<th style="text-align:left"></th>
				
				<th style="text-align:left"></th>

				<th style="text-align:left"></th>
				<th style="text-align:left"></th>
				
				<th style="text-align:left">
					<?php echo number_format($this->totalAmountDebt,0,',','.').' VNĐ'; ?>
				</th>

				<th style="text-align:left">
					<?php echo number_format($this->totalAmountRepayment,0,',','.').' VNĐ'; ?>
				</th>
				<th style="text-align:left"><?php echo number_format($this->totalDebt,0,',','.').' VNĐ'; ?></th>
				<th style="text-align:left"></th>
			</tr>
		</tfoot>
	</table>
</div>

