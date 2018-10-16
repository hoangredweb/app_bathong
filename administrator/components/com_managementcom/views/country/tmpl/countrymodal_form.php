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


if (!$this->form)
	return;

$fieldSets = $this->form->getFieldsets();
?>
<h3><?php echo 'Chi Phí '.$this->item->id;?></h3>
<table class="table table-striped">
<tbody>
	<tr>
		<th>Loại Chi Phí</th>
		<td><?php echo $this->typecost;?></td>
	</tr>
	<tr>
		<th>Giá</th>
		
		<td><?php echo number_format($this->item->price,0,',','.').' VNĐ';?></td>
	</tr>
	<tr>
		<th>Ngày Nhập</th>
		<td><?php echo date("d/m/Y ", strtotime($this->item->input_date) ); ?></td>
	</tr>
	<tr>
		<th>Ghi Chú</th>
		<td><?php echo ($this->item->note)?$this->item->note:'-'; ?></td>
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