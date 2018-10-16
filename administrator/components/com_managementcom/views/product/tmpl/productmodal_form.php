<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		ManagementCom
* @subpackage	Products
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

<?php $fieldSet = $this->form->getFieldset('product.form');?>
<h3><?php echo $this->item->product_name;?> - <?php echo $this->item->product_code;?></h3>
<table class="table table-striped">
<tbody>
	<tr>
		<th>Mã Sản Phẩm </th>
		<td><?php echo $this->item->product_code;?></td>
	</tr>

	<tr>
		<th>Tên Sản Phẩm </th>
		<td><?php echo $this->item->product_name;?></td>
	</tr>
</tbody>
</table>
