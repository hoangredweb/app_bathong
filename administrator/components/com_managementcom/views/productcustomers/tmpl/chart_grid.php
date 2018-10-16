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


JHtml::addIncludePath(JPATH_ADMIN_MANAGEMENTCOM.'/helpers/html');
JHtml::_('behavior.tooltip');
//JHtml::_('behavior.multiselect');

$model		= $this->model;
$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder	= $listOrder == 'a.ordering' && $listDirn != 'desc';

$document = JFactory::getDocument();
$document->addScript(JURI::base().'/templates/sandmancontrol/js/d3.js');
$document->addScript(JURI::base().'/templates/sandmancontrol/js/d3pie.js');

$document->addScript(JURI::base().'/templates/sandmancontrol/js/morris.js');
$document->addScript(JURI::base().'/templates/sandmancontrol/js/raphael-min.js');
$document->addScript(JURI::base().'/templates/sandmancontrol/js/prettify.min.js');

$document->addStyleSheet(JURI::base().'/templates/sandmancontrol/js/prettify.min.css');
$document->addStyleSheet(JURI::base().'/templates/sandmancontrol/js/morris.css');


$flag = true;
if( $this->state->get('filter.customer_id') && count($this->filter_customers)==0 ) $flag = false;
if( $this->state->get('filter.product_id') && count($this->filter_products)==0 ) $flag = false;
/*
var_dump($this->filter_customers_colum_chart);
var_dump($this->filter_customers);*/
?>

<div class="clearfix"></div>
<hr size="1" />

<blockquote><pre>
<?php 
echo "Tổng số lượng: " . number_format($this->sum_total_weight ,0, ',',' ') . ' KG' . '<br>';
if ( ($this->state->get('filter.customer_id') ) && count($this->items)>0  && isset($this->items[0]->_customer_id_nick_name))
	echo $this->items[0]->_customer_id_nick_name . ' - ' . number_format($this->items[0]->sum_total_weight ,0, ',',' ') . ' KG';	



if ( ($this->state->get('filter.product_id') ) && count($this->items)>0 && isset($this->items[0]->_product_id_product_name))
	echo $this->items[0]->_product_id_product_name . ' - '. number_format($this->items[0]->sum_total_weight, 0, ',', ' ') . ' KG';	
 ?>
  
</pre></blockquote>

<br />
<?php if (!$flag) echo "<h1 style='color:red'>Không Tìm Thấy!!!</h1>"?>
<br />
<!--pie default-->
<div class="default_pie">
	
	<h3>Khách Hàng</h3>
	<div id="pie" class='pie'></div>


	<h3>Sản Phẩm</h3>
	<div id="pie2" class='pie'></div>
	
	<h3>Ngày - Số Lượng</h3>
	<div id="graph"></div>
</div>
<!--pie filter_customer-->
<div class="filter_customer" stlye="display:none">
	<h3><?php echo (isset($this->items[0]->_customer_id_nick_name) && isset($this->items[0]->sum_total_weight))?$this->items[0]->_customer_id_nick_name.' - '. number_format($this->items[0]->sum_total_weight, 0, ',', ' ') . ' KG':'';	?></h3>
	<div id="pie3" class='pie'></div>
</div>
<!--pie filter_product-->
<div class="filter_product" stlye="display:none">
	<h3><?php echo (isset($this->items[0]->_product_id_product_name) && isset($this->items[0]->sum_total_weight))?$this->items[0]->_product_id_product_name.' - '. number_format($this->items[0]->sum_total_weight, 0, ',', ' ') .' KG':'';	?></h3>
	<div id="pie4" class='pie'></div>
</div>

<!--pie for customer-->
<?php if (!empty($this->filterColumnProductOrCustomer)): ?>
<div class="default_pie_customer">
	<h3>Ngày - Số Lượng</h3>
	<div id="graph_column_customer"></div>	
</div>
<?php endif;?>

<script>
jQuery(function($){
	var data_customer = <?php echo json_encode($this->customers); ?>;
	var data_product = <?php echo json_encode($this->products); ?>;
	var data_filter_customers = <?php echo ( $this->filter_customers)?json_encode($this->filter_customers):0; ?>;
	var data_filter_products= <?php echo ( $this->filter_products)?json_encode($this->filter_products):0; ?>;

	var chart_customer = [];
	var chart_product = [];
	var chart_filter_customers = [];
	var chart_filter_products = [];
   
   if ( data_filter_customers!= 0 ){
	    $('.default_pie').hide();
		$('.filter_product').hide();
	    $('.filter_customer').show();
	    $.each(data_filter_customers, function (i, elem) {
			var myObject = new Object();
			
			myObject.label = elem.product_name + ' - ' + elem.taste;
			myObject.value = parseFloat(elem.sum_total_weight);
			chart_filter_customers.push(myObject);
		});
		
		var pie3 = new d3pie("pie3", {
		data: {
			content: chart_filter_customers
		},
		tooltips: {
		  enabled: true,
		  type: "placeholder",
		  string: "{label}: {value}KG - {percentage}%",
		  styles: {
			fadeInSpeed: 500,
			backgroundColor: "rgb(234,30,55)",
			backgroundOpacity: 0.8,
			color: "#ffffcc",
			borderRadius: 4,
			font: "verdana",
			fontSize: 16,
			padding: 10
		  }
		},
		size: {
			canvasHeight: 500,
			canvasWidth: 800
			}
		});
   }
 
   
   if ( data_filter_products!= 0 ){
	    $('.default_pie').hide();
		$('.filter_customer').hide();
	    $('.filter_product').show();
	    $.each(data_filter_products, function (i, elem) {
			var myObject = new Object();
			
			myObject.label = elem._customer_id_nick_name;
			myObject.value = parseFloat(elem.sum_total_weight);
			chart_filter_products.push(myObject);
		});
		
		var pie4 = new d3pie("pie4", {
		data: {
			content: chart_filter_products
		},
		tooltips: {
		  enabled: true,
		  type: "placeholder",
		  string: "{label}: {value}KG - {percentage}%",
		  styles: {
			fadeInSpeed: 500,
			backgroundColor: "rgb(234,30,55)",
			backgroundOpacity: 0.8,
			color: "#ffffcc",
			borderRadius: 4,
			font: "verdana",
			fontSize: 16,
			padding: 10
		  }
		},
		size: {
			canvasHeight: 500,
			canvasWidth: 800
			}
		});
   }
   
   $.each(data_customer, function (i, elem) {
		var myObject = new Object();
		
	    myObject.label = elem._customer_id_nick_name;
	    myObject.value = parseFloat(elem.sum_total_weight);
	    chart_customer.push(myObject);
	});
	
	 $.each(data_product, function (i, elem) {
		var myObject = new Object();
		
	    myObject.label = elem._product_id_product_name;
	    myObject.value = parseFloat(elem.sum_total_weight);
	    chart_product.push(myObject);
	});
  
	var pie = new d3pie("pie", {
		data: {
			content: chart_customer
		},
    tooltips: {
      enabled: true,
      type: "placeholder",
      string: "{label}: {value}KG - {percentage}%",
      styles: {
        fadeInSpeed: 500,
        backgroundColor: "rgb(234,30,55)",
        backgroundOpacity: 0.8,
        color: "#ffffcc",
        borderRadius: 4,
        font: "verdana",
        fontSize: 16,
        padding: 10
      }
    },
	size: {
		canvasHeight: 500,
		canvasWidth: 800
		}
	});
	
	var pie2 = new d3pie("pie2", {
		data: {
			content: chart_product
		},
    tooltips: {
      enabled: true,
      type: "placeholder",
      string: "{label}: {value}KG - {percentage}%",
      styles: {
        fadeInSpeed: 500,
        backgroundColor: "rgb(234,30,55)",
        backgroundOpacity: 0.8,
        color: "#ffffcc",
        borderRadius: 4,
        font: "verdana",
        fontSize: 16,
        padding: 10
      }
    },
	size: {
		canvasHeight: 500,
		canvasWidth: 800
		}
	});
	
	
	//ngày - số lượng
	var data_weights = <?php echo json_encode($this->filter_weights); ?>;		
	
	var chart_weights = [];
	$.each(data_weights, function (i, elem) {
		var myObject = new Object();
		
		myObject.x = elem.input_date;
		myObject.a = (elem.sum_total_weight);		
		chart_weights.push(myObject);
	});
	//alert(JSON.stringify(chart_profit));
	
	Morris.Bar({
		  element: 'graph',
		  data: chart_weights,
		  barSizeRatio:0.55,
		  xkey: 'x',
		  ykeys: ['a'],
		  labels: ['Số lượng'],
		  barColors: ['#0B62A4']
		}).on('click', function(i, row){
		  //console.log(i, row);
		});
	prettyPrint();


	//ngày - số lượng cho customer
	var data_weights = <?php echo json_encode($this->filterColumnProductOrCustomer); ?>;		
	
	var chart_weights = [];
	$.each(data_weights, function (i, elem) {
		var myObject = new Object();
		
		myObject.x = elem.input_date;
		myObject.a = (elem.sum_total_weight);		
		chart_weights.push(myObject);
	});
	//alert(JSON.stringify(chart_profit));
	
	Morris.Bar({
		  element: 'graph_column_customer',
		  data: chart_weights,
		  barSizeRatio:0.55,
		  xkey: 'x',
		  ykeys: ['a'],
		  labels: ['Số lượng'],
		  barColors: ['#0B62A4']
		}).on('click', function(i, row){
		  //console.log(i, row);
		});
})
</script>




