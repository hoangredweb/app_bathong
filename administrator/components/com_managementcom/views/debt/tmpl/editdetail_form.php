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


if (!$this->form)
	return;

$fieldSets = $this->form->getFieldsets();
?>

<blockquote>
	<pre><br>Khách Hàng: <?php echo $this->item->_customer_id_nick_name?>
		<br>Tổng Nợ: <?php echo number_format($this->item->total_debt, 0, ',', '.') . ' VNĐ';?>
		<br>
	</pre>
</blockquote>


<?php $fieldSet = $this->form->getFieldset('debt.form');?>
<fieldset class="fieldsform form-horizontal">
	
<div class="">
	<h3>Chi Tiết Trả</h3>
	<table class="table table-striped table-responsive" id="grid-costs">
		<thead>
			<tr>
				<th style="text-align:left">Ngày Trả</th>
				<th style="text-align:left">Số Tiền Trả</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($this->item->list_debts as $index => $debt) :?>
				<?php if ($debt->amount_repayment): ?>
				<tr class="">
					<td style="text-align:left"><?php echo date('d-m-Y', strtotime($debt->date_repayment))?></td>
					<td style="text-align:left"><?php echo number_format($debt->amount_repayment, 0, ',', '.') . ' VNĐ';?></td>	
				</tr>
				<?php endif;?>
			<?php endforeach;?>
		</tbody>
		
	</table>
</div>

<hr>

<div class="">
	<h3>Chi Tiết Nợ</h3>
	<table class="table table-striped table-responsive" id="grid-costs">
		<thead>
			<tr>
				<th style="text-align:left">Hóa Đơn ID</th>
				<th style="text-align:left">Ngày Nợ</th>
				<th style="text-align:left">Số Tiền Nợ</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($this->item->list_debts as $index => $debt) :?>
				<?php if ($debt->amount_debt): ?>
				<tr class="">
					<td style="text-align:left"><?php echo $debt->order_id?></td>	
					<td style="text-align:left"><?php echo date('d-m-Y', strtotime($debt->date_debt))?></td>
					<td style="text-align:left"><?php echo number_format($debt->amount_debt, 0, ',', '.') . ' VNĐ';?></td>	
				</tr>
				<?php endif;?>
			<?php endforeach;?>
		</tbody>
		
	</table>
</div>
	
</fieldset>