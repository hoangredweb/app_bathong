<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		ManagementCom
* @subpackage	Customers
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
	<table class='table table-striped table-responsive' id='grid-customers'>
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
					<?php echo JHTML::_('grid.sort',  "MANAGEMENTCOM_FIELD_NICKNAME", 'a.nick_name', $listDirn, $listOrder ); ?>
				</th>
				
				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "Bảng Giá", 'pricelist_id.name', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_H"); ?>
				</th>

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "MANAGEMENTCOM_FIELD_TEN", 'a.first_name', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_DA_CH"); ?>
				</th>

				<th style="text-align:left">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_DIN_THOI"); ?>
				</th>

				<th style="text-align:left">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_COUNTRY"); ?>
				</th>

				<th style="text-align:left">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_CITY"); ?>
				</th>

				<th style="text-align:left">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_TYPE_CUSTOMER"); ?>
				</th>

				<th style="text-align:left">
					<?php echo JText::_("MANAGEMENTCOM_FIELD_EMAIL"); ?>
				</th>

				<th style="text-align:left">
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
						'dataKey' => 'nick_name',
						'dataObject' => $row,
						'modalHeight' => 500,
						'modalWidth' => 580,
						'route' => array('view' => 'customer','layout' => 'customermodal','cid[]' => $row->id),
						'target' => 'modal'
					));?>
				</td>
				
				<td style="text-align:left">
					<?php echo ($row->_pricelist_id_name)?JDom::_('html.fly', array(
						'dataKey' => '_pricelist_id_name',
						'dataObject' => $row,
						'modalHeight' => 580,
						'modalWidth' => 580,
						'route' => array('view' => 'pricelist','layout' => 'pricelistmodal','cid[]' => $row->pricelist_id),
						'target' => 'modal'
					)):'-';?>
				</td>
				
				<td style="text-align:left">
					<?php echo ($row->last_name)?JDom::_('html.fly', array(
						'dataKey' => 'last_name',
						'dataObject' => $row
					)):'-';?>
				</td>

				<td style="text-align:left">
					<?php echo ($row->first_name)?JDom::_('html.fly', array(
						'dataKey' => 'first_name',
						'dataObject' => $row
					)):'-';?>
				</td>

				<td style="text-align:left">
					<?php echo ($row->address)?JDom::_('html.fly', array(
						'dataKey' => 'address',
						'dataObject' => $row
					)):'-';?>
				</td>

				<td style="text-align:left">
					<?php echo ($row->phone)?JDom::_('html.fly', array(
						'dataKey' => 'phone',
						'dataObject' => $row
					)):'-';?>
				</td>

				<td style="text-align:left">
					<?php echo ($row->country_id)?JDom::_('html.fly', array(
						'dataKey' => '_country_id_title',
						'dataObject' => $row
					)):'-';?>
				</td>

				<td style="text-align:left">
					<?php echo ($row->city_id)?JDom::_('html.fly', array(
						'dataKey' => '_city_id_title',
						'dataObject' => $row
					)):'-';?>
				</td>

				<td style="text-align:left">
					<?php echo ManagementcomHelperEnum::_('customers_type_customer_id')[$row->type_customer_id]['text']; ?>
				</td>

				<td style="text-align:left">
					<?php echo ($row->email)?JDom::_('html.fly', array(
						'dataKey' => 'email',
						'dataObject' => $row
					)):'-';?>
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
						'ctrl' => 'customers',
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