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
if ( isset($this->item->price) && $this->item->price )
	$json_listPrices = json_decode($this->item->price, true);

$i=0;
foreach ($this->listProducts as $item){
	$this->listProducts[$i]->price = 0;
	if ( isset($this->item->price) && $this->item->price ){
		foreach ($json_listPrices as $jitem){
			if ($jitem['id'] == $item->id ){
				$this->listProducts[$i]->price = ($jitem['price'])?$jitem['price']:'0';		
				break;
			}
		}
	}
	$i++;
}
?>
<h3><?php echo $this->item->name;?></h3>
<table class="table table-striped">
<tbody>
	<tr>
		<th>Tên </th>
		<td><?php echo $this->item->name;?></td>
	</tr>
	
	<?php
	// Giá
	foreach ($this->listProducts as $item):?>
	<tr>
		<th><?php echo $item->product_name; ?></th>
		<td><?php echo number_format($item->price,0,',','.')?></td>
	</tr>
	<?php
	endforeach;
	?>

	<tr>
		<th>Ghi Chú </th>
		<td><?php echo ($this->item->note)?$this->item->note:'-';?></td>
	</tr>
	<tr>
		<th>Ngày Tạo </th>
		<td><?php echo date("d/m/Y h:i:s", strtotime($this->item->creation_date) ); ?></td>
	</tr>
	<tr>
		<th>Status </th>
		<td><?php echo ($this->item->published)?"Active":"Inactive";?></td>
	</tr>
</tbody>
</table>
