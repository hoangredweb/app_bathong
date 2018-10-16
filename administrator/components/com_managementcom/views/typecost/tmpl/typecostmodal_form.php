<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		Managementcom
* @subpackage	Typecosts
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
<h3><?php echo $this->item->name;?></h3>
<table class="table table-striped">
<tbody>
	<tr>
		<th>Tên</th>
		<td><?php echo $this->item->name;?></td>
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