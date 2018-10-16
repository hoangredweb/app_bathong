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


if (!$this->form)
	return;

$fieldSets = $this->form->getFieldsets();
?>
<h3><?php echo $this->item->nick_name;?></h3>
<table class="table table-striped">
<tbody>
	<tr>
		<th>Nickname</th>
		<td><?php echo $this->item->nick_name;?></td>
	</tr>

	<tr>
		<th>Họ & Tên</th>
		<td><?php echo ($this->item->first_name)?$this->item->last_name.' '.$this->item->first_name:'-';?></td>
	</tr>

	<tr>
		<th>Điện Thoại </th>
		<td><?php echo ($this->item->phone)?$this->item->phone:'-';?></td>
	</tr>
	
	<tr>
		<th>Email</th>
		<td><?php echo ($this->item->email)?$this->item->email:'-';?></td>
	</tr>
	
	<tr>
		<th>Địa chỉ</th>
		<td><?php echo ($this->item->address)?$this->item->address:'-';?></td>
	</tr>

	<tr>
		<th>Ghi Chú</th>
		<td><?php echo ($this->item->note)?$this->item->note:'-';?></td>
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
