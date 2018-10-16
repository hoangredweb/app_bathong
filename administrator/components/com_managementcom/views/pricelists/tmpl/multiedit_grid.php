<?php
/**
* @version		
* @package		ManagementCom
* @subpackage	pricelists
* @copyright	2017
* @author		harvey
* @license
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
	<table class='table table-striped table-responsive' id='grid-pricelists'>
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
					<?php echo JHTML::_('grid.sort',  "Bảng Giá", 'a.name', $listDirn, $listOrder ); ?>
				</th>
				<?php
				foreach ( $this->listProducts as $product):
				?>
					<th style="text-align:left">
						<?php echo $product->product_name; ?>
					</th>
				<?php
				endforeach;
				?>
				
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
			
			if ( isset($row->price) && $row->price )
				$json_listPrices = json_decode($row->price, true);

			$j=0;
			foreach ($this->listProducts as $item){
				$this->listProducts[$j]->price = 0;
				if ( isset($row->price) && $row->price ){
					foreach ($json_listPrices as $jitem){
						if ($jitem['id'] == $item->id ){
							$this->listProducts[$j]->price = ($jitem['price'])?$jitem['price']:'0';		
							break;
						}
					}
				}
				$j++;
			}
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
						'dataKey' => 'name',
						'dataObject' => $row,
						'modalHeight' => 500,
						'modalWidth' => 580,
						'route' => array('view' => 'pricelist','layout' => 'pricelistmodal','cid[]' => $row->id),
						'target' => 'modal'
					));?>
				</td>

				
				<?php
				foreach ( $this->listProducts as $index => $product):
				?>
					<td style="text-align:left">
						<?php $tmp = number_format($product->price, 0, ',', '.'); ?>
						<input type="hidden" class="product_id" value="<?php echo $product->id?>">
						<input type="text" class="price" id="price<?php echo '_' . $i . '_' . $index?>" value="<?php echo $tmp?>"  style="width: 80px">
					</td>
				<?php
				endforeach;
				?>


				<td style="text-align:left">
					<?php echo ($row->note)?JDom::_('html.fly', array(
						'dataKey' => 'note',
						'dataObject' => $row
					)):'-';?>
				</td>


				<?php if ($model->canEditState()): ?>
				<td style="text-align:center">
					<?php echo JDom::_('html.grid.publish', array(
						'ctrl' => 'pricelists',
						'dataKey' => 'published',
						'dataObject' => $row,
						'num' => $i
					));?>
				</td>
				<?php endif; ?>

				<input type="hidden" id="jform_price_<?php echo $i?>" name="jform[price][<?php echo $row->id?>]" value="">
			</tr>
			<?php
			$k = 1 - $k;
		endfor;
		?>
		</tbody>
	</table>
</div>

<script type="text/javascript">


jQuery(function($){
	Joomla.submitbutton = function(task){ 
	if ( task == 'pricelist.savemultiple'){
		//validate
		$flag = true;
		$('.price').each(function(i,v){
			var value =$(this).val().split('.').join("");
			$(this).val(value);

			if (!$.isNumeric(value))
			{
				id = $(this).attr('id');
				$("#"+id).validationEngine('showPrompt', "<span>•</span> Enter Number Only.", 'asdas',"topLeft",1);
				$flag = false;
			} 
			if (!value)
			{
				id = $(this).attr('id');
				$("#"+id).validationEngine('showPrompt', "<span>•</span> This field is required.", 'asdas',"topLeft",1);
				$flag = false;
			}
		});
		
		if ($flag)
		{
			//create json file
			$('tbody tr').each(function(i, row) {
				var $this = $(this);
				var pricelists = [];	
				$this.find(".product_id").each(function(){
			        //$this;
			        //this;
			        var price = new Object();
					price.id =  $(this).val();
					price.price = $(this).parent().find('.price').val();		
					pricelists.push(price);	
			    });

				$('#jform_price_'+i).val(JSON.stringify(pricelists));	
			    console.log(i);
			});

			window.onbeforeunload = null;
			Joomla.submitform(task, $('#adminForm'));
		}                              
	 } 
	 else {
		window.onbeforeunload = null; 
		Joomla.submitform(task);
	 }
   }
 });
     
</script>
