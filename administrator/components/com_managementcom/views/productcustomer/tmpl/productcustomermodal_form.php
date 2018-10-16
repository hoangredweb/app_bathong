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


if (!$this->form)
	return;

$fieldSets = $this->form->getFieldsets();
?>
<?php $fieldSet = $this->form->getFieldset('productcustomer.form');?>

<h3><?php echo $this->item->_customer_id_nick_name;?> - <?php echo $this->item->total_weight.'KG '.$this->item->_product_id_product_name.' '.ManagementcomHelperEnum::_('productcustomers_taste')[$this->item->taste]['text']; ?></h3>
<h3><?php echo number_format($this->item->total_price,0,',','.');?> VNĐ</h3>
<table class="table table-striped">
<tbody>
	<tr>
		<th>Khách Hàng</th>
		<td><?php echo $this->item->_customer_id_nick_name;?></td>
	</tr>

	<tr>
		<th>Số Lượng</th>
		<td><?php echo $this->item->total_weight;?>KG</td>
	</tr>
	
	<tr>
		<th>Trọng Lượng </th>
		<td><?php echo ManagementcomHelperEnum::_('productcustomers_weight')[$this->item->weight]['text'];?></td>
	</tr>

	<tr>
		<th>Sản Phẩm</th>
		<td><?php echo $this->item->_product_id_product_name;?></td>
	</tr>
	
	<tr>
		<th>Giá</th>
		<td><?php echo number_format($this->item->total_price,0,',','.');?> VNĐ</td>
	</tr>

	<tr>
		<th>Vị</th>
		<td><?php echo ManagementcomHelperEnum::_('productcustomers_taste')[$this->item->taste]['text'];?></td>
	</tr>
	<tr>
		<th>Hút Chân Không</th>
		<td><?php echo ($this->item->vacuum)?"Có":"Không";?></td>
	</tr>
	<tr>
		<th>Ghi Chú</th>
		<td><?php echo ($this->item->note)?$this->item->note:'-';?></td>
	</tr>
	<tr>
		<th>Ngày Nhập</th>
		<td><?php echo date("d/m/Y", strtotime($this->item->input_date) ); ?></td>
	</tr>
	<tr>
		<th>Ngày Tạo</th>
		<td><?php echo date("d/m/Y h:i:s", strtotime($this->item->creation_date) ); ?></td>
	</tr>
	<tr>
		<th>Status</th>
		<td><?php echo ($this->item->published)?"Active":"Inactive";?></td>
	</tr>
</tbody>
</table>
