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

require_once JPATH_COMPONENT.'/carbon/'.'Carbon.php';
use Carbon\Carbon;

/**
* Managementcom Productcustomers Controller
*
* @package	Managementcom
* @subpackage	Productcustomers
*/
class ManagementcomCkControllerProductcustomers extends ManagementcomClassControllerList
{
	/**
	* The context for storing internal data, e.g. record.
	*
	* @var string
	*/
	protected $context = 'productcustomers';

	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'productcustomer';

	/**
	* The URL view list variable.
	*
	* @var string
	*/
	protected $view_list = 'productcustomers';

	/**
	* Constructor
	*
	* @access	public
	* @param	array	$config	An optional associative array of configuration settings.
	*
	* @return	void
	*/
	public function __construct($config = array())
	{
		parent::__construct($config);
		$app = JFactory::getApplication();

	}

	/**
	* Return the current layout.
	*
	* @access	protected
	* @param	bool	$default	If true, return the default layout.
	*
	* @return	string	Requested layout or default layout
	*/
	protected function getLayout($default = null)
	{
		if ($default)
			return 'default';

		$jinput = JFactory::getApplication()->input;
		return $jinput->get('layout', 'default', 'CMD');
	}
	public function profit(){
		echo"xx";
		die;
	}
	
	
	// Export excel
	function array2csv(array &$array)
    {
		if (count($array) == 0) {
			return null;
		}
		ob_start();
		$df = fopen("php://output", 'w');
		fputs( $df, "\xEF\xBB\xBF" );
		fputcsv($df, array_keys(reset($array)));
		foreach ($array as $row) {
			fputcsv($df, $row);
		}
		fclose($df);
		return ob_get_clean();
    }

	function download_send_headers($filename) {
		header('Content-Encoding: UTF-8');
		header('Content-Type: text/csv; charset=utf-8' );
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

	function array_unshift_assoc(&$arr, $key, $val)
	{
		$arr = array_reverse($arr, true);
		$arr[$key] = $val;
		return array_reverse($arr, true);
	}

	public function export_excel_profit(){
		$jinput = JFactory::getApplication()->input;
		
		$filter_typefilter = $jinput->get('filter_typefilter', null, null);
		$filter_frm = $jinput->get('filter_star_type_date', null, null);
		$filter_to= $jinput->get('filter_end_type_date', null, null);

		switch ($filter_typefilter)
		{
			case 1:
				$items = ManagementcomHelper::filterByDay($filter_frm, $filter_to);
				break;
			case 2:
				$items = ManagementcomHelper::filterByMonth($filter_frm, $filter_to);
				break;
			case 3:
				$items = ManagementcomHelper::filterByYear($filter_frm, $filter_to);
				break;
			case 4:
				$items = ManagementcomHelper::filterByQuarter($filter_frm, $filter_to);
				break;
			default:
				$items = ManagementcomHelper::filterByMonth($filter_frm, $filter_to);
		}

		$list = array();

		foreach ($items as $data)
		{

			$tmp = $data['total_profit'];
			unset($data['total_profit']);
			$data = self::array_unshift_assoc($data, 'Doanh Số', $tmp);

			$tmp = $data['total_weight'];
			unset($data['total_weight']);
			$data = self::array_unshift_assoc($data, 'Lợi Nhuận Ròng', $tmp);

			$tmp = $data['total_earn'];
			unset($data['total_earn']);
			$data = self::array_unshift_assoc($data, 'Tổng Chi', $tmp);
			
			$tmp = $data['total_cost'];
			unset($data['total_cost']);
			$data = self::array_unshift_assoc($data, 'Tổng Thu', $tmp);
			
			$tmp = $data['date'];
			unset($data['date']);
			
			switch ($filter_typefilter)
			{
				case 1:
					$data = self::array_unshift_assoc($data, 'Ngày', $tmp);
					break;
				case 2:
					$data = self::array_unshift_assoc($data, 'Tháng', $tmp);
					break;
				case 3:
					$data = self::array_unshift_assoc($data, 'Năm', $tmp);
					break;
				case 4:
					$data = self::array_unshift_assoc($data, 'Quý', $tmp);
					break;
				default:
					$data = self::array_unshift_assoc($data, 'Tháng', $tmp);
			}
			
			array_push($list,$data);
		}
		self::download_send_headers('tk_loinhuanrong.csv');			
		echo self::array2csv($list);
		exit();
	}

	public function export_excel(){
		//---------------will delete ---------------
		/* $modelCustomer_id = CkJModel::getInstance('productcustomers', 'ManagementcomModel');
		$modelCustomer_id->setState('filter.id', null);
		$modelCustomer_id->setState('filter.customer_id', 16);
		$modelCustomer_id->setState('filter.product_id', 1);
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
	   
		$query="SELECT a.id, a.customer_id, a.product_id, a.total_weight, a.total_price, b.pricelist_id, d.price as json_listPrices, a.vacuum
				FROM #__managementcom_productcustomers as a
				INNER JOIN #__managementcom_customers as b ON a.customer_id = b.id
				INNER JOIN #__managementcom_products as c ON a.product_id = c.id
				INNER JOIN #__managementcom_pricelists as d ON b.pricelist_id = d.id
				WHERE a.published=1 ";
		   
		$db->setQuery($query);
		//echo $db->replacePrefix((string) $query);
		$list_productcustomers = $db->loadAssocList();
		
		$i=0;
		foreach ($list_productcustomers as $item){
			$json_listPrices = json_decode($item['json_listPrices']);
			foreach ($json_listPrices as $price){
				if ( $price->id == $item['product_id'] ){
					$list_productcustomers[$i]['total_price'] = $list_productcustomers[$i]['total_weight'] * $price->price;
					if ( $list_productcustomers[$i]['vacuum'] && $list_productcustomers[$i]['pricelist_id']!=1 ){
						$list_productcustomers[$i]['total_price'] += $list_productcustomers[$i]['total_weight'] * 10000;
					}
				}
			}
			$i++;
		}
		
		foreach ($list_productcustomers as $item){
			$object = new stdClass();
			// Must be a valid primary key value.
			$object->id = $item['id'];
			$object->total_price = $item['total_price'];
			
			// Update their details in the users table using id as the primary key.
			$result = JFactory::getDbo()->updateObject('#__managementcom_productcustomers', $object, 'id');
		} */
		//---end  will delete ---------------
		
        //$group_name = ErgoHelper::checkPermission();
		$jinput = JFactory::getApplication()->input;
		$str_arr = $jinput->get('myinfo', 'default_value', 'string');

		if ($str_arr!=null)
		{
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query="SELECT * 
					FROM #__managementcom_productcustomers
					WHERE id IN (".$str_arr.")ORDER BY id" ;
			// Reset the query using our newly populated query object.
			$db->setQuery($query);
			$result = $db->loadObjectList();
			$list =array ();
			
			
			foreach ($result as $data){
				// Khách hàng
				$modelCustomer_id = CkJModel::getInstance('customers', 'ManagementcomModel');
				$modelCustomer_id->setState('filter.id', $data->customer_id);
				$data->customer_id = $modelCustomer_id->getItems()[0]->nick_name;
				
				// Sản Phẩm
				$modelProduct_id = CkJModel::getInstance('products', 'ManagementcomModel');
				$modelProduct_id->setState('filter.id', $data->product_id);
				$data->product_id = (isset($modelProduct_id->getItems()[0]->product_code))?$modelProduct_id->getItems()[0]->product_code:'';
				
				/* // Bảng giá
				$modelPricelist_id = CkJModel::getInstance('pricelists', 'ManagementcomModel');
				$modelPricelist_id->setState('filter.id',$modelCustomer_id->getItems()[0]->pricelist_id);
				$data->pricelist = (isset($modelPricelist_id->getItems()[0]->name))?$modelPricelist_id->getItems()[0]->name:''; */
				
				//Trọng Lượng
				$data->weight = ManagementcomHelperEnum::_('productcustomers_weight')[$data->weight]['text'];
				
				//Vị
				$data->taste = ManagementcomHelperEnum::_('productcustomers_taste')[$data->taste]['text'];
				
				//Ngày nhập
				$data->input_date = ($data->input_date != '' )?date("d/m/Y", strtotime($data->input_date)):'';
				
				//created by
				if ( $data->published == 0 ) $data->published = "Inactive";
				if ( $data->published == 1 ) $data->published = "Active";
				
				if ( $data->created_by != null ){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query="SELECT username
							FROM #__users
							WHERE id=".$data->created_by ;
					$db->setQuery($query);
					$data->created_by = $db->loadResult();
				}
				//modified by
				if ( $data->modified_by != null ){
					$query="SELECT username
							FROM #__users
							WHERE id=".$data->modified_by ;
					$db->setQuery($query);
					$data->modified_by = $db->loadResult();
				}
				$data->creation_date = ($data->creation_date != '' )?date("d/m/Y H:m", strtotime($data->creation_date)):'';
				$data->modification_date = ($data->modification_date != '' )?date("d/m/Y H:m", strtotime($data->modification_date)):'';
				
					
				foreach($data as $key => $value){ 
					if ( $value == null || $value == '') $data->$key = '';
					
				}
                //dont need this but so scare to del in db
                $data = json_decode(json_encode($data), true);	
				//re-order
				unset($data['modified_by']);
				unset($data['modification_date']);
				
				
				$tmp = $data['creation_date'];
				unset($data['creation_date']);
				$data = self::array_unshift_assoc($data, 'Ngày tạo', $tmp);
				
				$tmp = $data['created_by'];
				unset($data['created_by']);
				$data = self::array_unshift_assoc($data, 'Người tạo', $tmp);
				
				$tmp = $data['published'];
				unset($data['published']);
				$data = self::array_unshift_assoc($data, 'Trạng Thái', $tmp);
				
				$tmp = $data['input_date'];
				unset($data['input_date']);
				$data = self::array_unshift_assoc($data, 'Ngày Nhập', $tmp);
				
				$tmp = $data['note'];
				unset($data['note']);
				$data = self::array_unshift_assoc($data, 'Ghi Chú', $tmp);
				
				$tmp = $data['vacuum'];
				unset($data['vacuum']);
				$data = self::array_unshift_assoc($data, 'Hút Chân Không', $tmp);
				
				$tmp = $data['taste'];
				unset($data['taste']);
				$data = self::array_unshift_assoc($data, 'Vị', $tmp);
				
				$tmp = $data['weight'];
				unset($data['weight']);
				$data = self::array_unshift_assoc($data, 'Trọng Lượng', $tmp);
				
				$tmp = $data['total_weight'];
				unset($data['total_weight']);
				$data = self::array_unshift_assoc($data, 'Số Lượng', $tmp);
				
				$tmp = $data['total_price'];
				unset($data['total_price']);
				$data = self::array_unshift_assoc($data, 'Giá', $tmp);
				
				/* $tmp = $data['pricelist'];
				unset($data['pricelist']);
				$data = self::array_unshift_assoc($data, 'Bảng Giá', $tmp); */
				
				$tmp = $data['product_id'];
				unset($data['product_id']);
				$data = self::array_unshift_assoc($data, 'Sản Phẩm', $tmp);
				
				$tmp = $data['customer_id'];
				unset($data['customer_id']);
				$data = self::array_unshift_assoc($data, 'Khách Hàng', $tmp);
				
				$tmp = $data['id'];
				unset($data['id']);
				$data = self::array_unshift_assoc($data, 'STT', $tmp);
				
				array_push($list,$data);
			}
			self::download_send_headers('cover.csv');			
			echo self::array2csv($list);
			exit();
		}
		else{
			$this->applyRedirection($result, array(
				'stay',
				'com_mangementcom.productcustomers.default'
			));      
		}   
    }
}

// Load the fork
ManagementcomHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomControllerProductcustomers')){ class ManagementcomControllerProductcustomers extends ManagementcomCkControllerProductcustomers{} }
