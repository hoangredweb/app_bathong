<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V3.1     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		ManagementCom
* @subpackage	ManagementCom
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
* Managementcom Helper functions.
*
* @package	Managementcom
* @subpackage	Helper
*/
class ManagementcomCkHelper
{
	/**
	* Cache for ACL actions
	*
	* @var object
	*/
	protected static $acl = null;

	/**
	* Directories aliases.
	*
	* @var array
	*/
	protected static $directories;

	/**
	* Determines when requirements have been loaded.
	*
	* @var boolean
	*/
	protected static $loaded = null;

	/**
	* Call a JS file. Manage fork files.
	*
	* @access	protected static
	* @param	string	$base	Component base from site root.
	* @param	string	$file	Script file.
	* @param	boolean	$replace	Replace the file or override. (Default : Replace)
	*
	*
	* @since	Cook 2.0
	*
	* @return	void
	*/
	protected static function addScript($base, $file, $replace = true)
	{
		$doc = JFactory::getDocument();

		$url = JURI::root(true) . '/' . $base . '/' . $file;
		$url = str_replace(DS, '/', $url);

		$urlFork = null;
		if (file_exists(JPATH_SITE .DS. $base .DS. 'fork' .DS. $file))
		{
			$urlFork = JURI::root(true) . '/' . $base . '/fork/' . $file;
			$urlFork = str_replace(DS, '/', $urlFork);
		}

		if ($replace && $urlFork)
			$url = $urlFork;

		$doc->addScript($url);

		if (!$replace && $urlFork)
			$doc->addScript($urlFork);
	}

	/**
	* Call a CSS file. Manage fork files.
	*
	* @access	protected static
	* @param	string	$base	Component base from site root.
	* @param	string	$file	Stylesheet file.
	* @param	boolean	$replace	Replace the file or override. (Default : Override)
	*
	*
	* @since	Cook 2.0
	*
	* @return	void
	*/
	protected static function addStyleSheet($base, $file, $replace = false)
	{
		$doc = JFactory::getDocument();

		$url = JURI::root(true) . '/' . $base . '/' . $file;
		$url = str_replace(DS, '/', $url);

		$urlFork = null;
		if (file_exists(JPATH_SITE .'/'. $base . '/fork/' . $file))
		{
			$urlFork = JURI::root(true) . '/' . $base . '/fork/' . $file;
			$urlFork = str_replace(DS, '/', $urlFork);
		}

		if ($replace && $urlFork)
			$url = $urlFork;

		$doc->addStyleSheet($url);

		if (!$replace && $urlFork)
			$doc->addStyleSheet($urlFork);
	}

	/**
	* Configure the Linkbar.
	*
	* @access	public static
	* @param	varchar	$view	The name of the active view.
	* @param	varchar	$layout	The name of the active layout.
	* @param	varchar	$alias	The name of the menu. Default : 'menu'
	*
	*
	* @since	1.6
	*
	* @return	void
	*/
	public static function addSubmenu($view, $layout, $alias = 'menu')
	{
		$items = static::getMenuItems();

		// Will be handled in XML in future (or/and with the Joomla native menus)
		// -> give your opinion on j-cook.pro/forum


		$client = 'admin';
		if (JFactory::getApplication()->isSite())
			$client = 'site';

		$links = array();
		switch($client)
		{
			case 'admin':
				switch($alias)
				{
					case 'cpanel':
					case 'menu':
					default:
						$links = array(
							'admin.countries.default',
							'admin.cities.default',
							'admin.customer.customer',
							'admin.customers.default',
							'admin.product.product',
							'admin.products.default',
							'admin.pricelist.pricelist',
							'admin.pricelists.default',
							'admin.productcustomer.productcustomer',
							'admin.productcustomers.default',
							'admin.typecost.typecost',
							'admin.typecosts.default',
							'admin.cost.cost',
							'admin.costs.default',
							'admin.debt.debt',
							'admin.debts.default',							
							'admin.debts.statis',
							'admin.productcustomers.statis',
							'admin.productcustomers.profit',
							'admin.productcustomers.chart',
							'admin.productcustomers.chartcolumn'
						);

						if ($alias != 'cpanel')
							array_unshift($links, 'admin.cpanel');

						break;
				}
				break;

			case 'site':
				switch($alias)
				{
					case 'cpanel':
					case 'menu':
					default:
						$links = array(				);

						if ($alias != 'cpanel')
							array_unshift($links, 'site.cpanel');

						break;
				}
				break;
		}


		//Compile with selected items in the right order
		$menu = array();
		foreach($links as $link)
		{
			if (!isset($items[$link]))
				continue;	// Not found

			$item = $items[$link];

			// Menu link
			$extension = 'com_managementcom';
			if (isset($item['extension']))
				$extension = $item['extension'];

			$url = 'index.php?option=' . $extension;
			if (isset($item['view']))
				$url .= '&view=' . $item['view'];
			if (isset($item['layout']))
				$url .= '&layout=' . $item['layout'];

			// Is active
			$active = ($item['view'] == $view);
			if (isset($item['layout']))
				$active = $active && ($item['layout'] == $layout);

			// Reconstruct it the Joomla format
			$menu[] = array(JText::_($item['label']), $url, $active, $item['icon']);

		}

		return $menu;
	}

	/**
	* Method to a model from a namespace.
	*
	* @access	public static
	* @param	string	$model	The namespaced model.
	* @param	boolean	$item	Sibling model. true: return ITEM model. false: return LIST model.
	*
	*
	* @since	Cook 3.0.10
	*
	* @return	JModel	The model.
	*/
	public static function componentModel($model, $item = null)
	{
		$extension = 'managementcom';

		$parts = explode('.', $model);
		if (count($parts) > 1)
		{
			if ($parts[0] != $extension)
			{
				$extension = $parts[0];
				self::loadComponentModels($extension);
			}
			$model = $parts[1];
		}

		$model = CkJModel::getInstance($model, ucfirst($extension) . 'Model');

		// Return a sibling model
		if ($item === true && method_exists($model, 'getNameItem'))
			$model = JModelLegacy::getInstance($model->getNameItem(), ucfirst($extension) . 'Model');
		else if ($item === false && method_exists($model, 'getNameList'))
			$model = JModelLegacy::getInstance($model->getNameList(), ucfirst($extension) . 'Model');

		return $model;
	}

	/**
	* Deprecated function. Prepare the enumeration static lists.
	* Use Instead : XxxxHelperEnum::_('my_list')
	*
	* @access	public static
	* @param	string	$ctrl	The model in wich to find the list.
	* @param	string	$fieldName	The field reference for this list.
	*
	* @return	array	Prepared arrays to fill lists.
	*/
	public static function enumList($ctrl, $fieldName)
	{
		// Proxy to the enumeration helper
		return ManagementcomHelperEnum::_($ctrl . '_' . $fieldName);
	}

	/**
	* Gets a list of the actions that can be performed.
	*
	* @access	public static
	*
	*
	* @deprecated	Cook 2.0
	*
	* @return	JObject	An ACL object containing authorizations
	*/
	public static function getAcl()
	{
		return self::getActions();
	}

	/**
	* Gets a list of the actions that can be performed.
	*
	* @access	public static
	* @param	integer	$itemId	The item ID.
	*
	*
	* @since	1.6
	*
	* @return	JObject	An ACL object containing authorizations
	*/
	public static function getActions($itemId = 0)
	{
		if (isset(self::$acl))
			return self::$acl;

		$user	= JFactory::getUser();
		$result	= new JObject;

		$actions = array(
			'core.admin',
			'core.manage',
			'core.create',
			'core.edit',
			'core.edit.state',
			'core.edit.own',
			'core.delete',
			'core.delete.own',
			'core.view.own',
		);

		foreach ($actions as $action)
			$result->set($action, $user->authorise($action, COM_MANAGEMENTCOM));

		self::$acl = $result;

		return $result;
	}

	/**
	* Serve any data using ORM.
	*
	* @access	public static
	* @param	string	$modelName	Root model name.
	* @param	array	$orm	ORM declaration.
	* @param	integer	$pk	Primary Key value. Optional
	*
	*
	* @since	Cook 3.1
	*
	* @return	mixed	List or Item depending of the requested model.
	*/
	public static function getData($modelName, $orm, $pk = null)
	{
		$model = ManagementcomClassModelOrm::getModel($modelName);
		if (!$model)
			return null;

		// Not supported yet
		if (!method_exists($model, 'orm'))
			return null;

		// LIST
		if (method_exists($model, 'getItems'))
		{
			// Applies ORM
			$model->orm($orm);

			// Get the list
			return $model->getItems();
		}


		// ITEM
		else if (method_exists($model, 'getItem'))
		{
			// Force ID loading on PK
			if ($pk)
				$orm['id'] = $pk;

			// Applies ORM
			$model->orm($orm);

			// Set PK
			if (!$pk && array_key_exists('id', $orm) && is_numeric($orm['id']))
				$pk = $orm['id'];

			return $model->getItem($pk);
		}

		return null;
	}

	/**
	* Return the directories aliases full paths
	*
	* @access	public static
	*
	*
	* @since	Cook 2.6.4
	*
	* @return	array	Arrays of aliases relative path from site root.
	*/
	public static function getDirectories()
	{
		if (!empty(self::$directories))
			return self::$directories;

		$comAlias = "com_managementcom";
		$configMedias = JComponentHelper::getParams('com_media');
		$config = JComponentHelper::getParams($comAlias);

		$directories = array(

			'DIR_FILES' => "[COM_SITE]" .DS. "files",
			'DIR_TRASH' => $config->get("trash_dir", 'images' . DS . "trash"),
			'IMAGES' => '[IMAGES]',
		);

		$bases = array(
			'COM_ADMIN' => "administrator" .DS. 'components' .DS. $comAlias,
			'ADMIN' => "administrator",
			'COM_SITE' => 'components' .DS. $comAlias,
			'IMAGES' => $config->get('image_path', 'images'),
			'MEDIAS' => $configMedias->get('file_path', 'images'),
			'ROOT' => '',

		);



		// Parse the directory aliases
		foreach($directories as $alias => $directory)
		{
			// Parse the component base folders
			foreach($bases as $aliasBase => $directoryBase)
				$directories[$alias] = preg_replace("/\[" . $aliasBase . "\]/", $directoryBase, $directories[$alias]);

			// Clean tags if remains
			$directories[$alias] = preg_replace("/\[.+\]/", "", $directories[$alias]);
		}

		self::$directories = $directories;
		return self::$directories;

	}

	/**
	* JDom helper. Get a file path or url depending of the method
	*
	* @access	public static
	* @param	string	$path	File path. Can contain directories aliases.
	* @param	string	$method	Method to access the file : [direct,indirect,physical]
	* @param	array	$attribs	Image thumb attributes. Can handle legacy array options.
	*
	*
	* @since	Cook 2.9
	*
	* @return	string	File path or url
	*/
	public static function getFile($path, $method = 'physical', $attribs = null)
	{
		if (is_array($attribs))
			$attribs = ManagementcomHelperFile::getAttributesFromLegacy($attribs);

		return ManagementcomHelperFile::getFileUrl($path, $method, $attribs);
	}

	/**
	* Load all menu items.
	*
	* @access	public static
	*
	*
	* @since	Cook 2.0
	*
	* @return	void
	*/
	public static function getMenuItems()
	{
		// Will be handled in XML in future (or/and with the Joomla native menus)
		// -> give your opinion on j-cook.pro/forum

		$items = array();
		$items['admin.countries.default'] = array(
			'label' => 'Quốc Gia',
			'view' => 'countries',
			'layout' => 'default',
			'icon' => 'managementcom_countries'
		);

		$items['admin.cities.default'] = array(
			'label' => 'Thành Phố',
			'view' => 'cities',
			'layout' => 'default',
			'icon' => 'managementcom_cities'
		);

		$items['admin.customer.customer'] = array(
			'label' => 'Khách Hàng',
			'view' => 'customer',
			'layout' => 'customer',
			'icon' => 'managementcom_customer'
		);
		
		$items['admin.customers.default'] = array(
			'label' => 'Danh Sách Khách Hàng',
			'view' => 'customers',
			'layout' => 'default',
			'icon' => 'managementcom_customers'
		);
		
		$items['admin.product.product'] = array(
			'label' => 'Sản Phẩm',
			'view' => 'product',
			'layout' => 'product',
			'icon' => 'managementcom_product'
		);
		
		$items['admin.products.default'] = array(
			'label' => 'Danh Sách Sản Phẩm',
			'view' => 'products',
			'layout' => 'default',
			'icon' => 'managementcom_products'
		);
		
		$items['admin.pricelist.pricelist'] = array(
			'label' => 'Bảng Giá',
			'view' => 'pricelist',
			'layout' => 'pricelist',
			'icon' => 'managementcom_pricelist'
		);
		
		$items['admin.pricelists.default'] = array(
			'label' => 'Danh Sách Bảng Giá',
			'view' => 'pricelists',
			'layout' => 'default',
			'icon' => 'managementcom_pricelists'
		);
		
		$items['admin.productcustomer.productcustomer'] = array(
			'label' => 'Hóa Đơn',
			'view' => 'productcustomer',
			'layout' => 'productcustomer',
			'icon' => 'managementcom_productcustomer'
		);

		$items['admin.productcustomers.default'] = array(
			'label' => 'Danh Sách Hóa Đơn',
			'view' => 'productcustomers',
			'layout' => 'default',
			'icon' => 'managementcom_productcustomers'
		);
		
		
		$items['admin.typecost.typecost'] = array(
			'label' => 'Loại Chi Phí',
			'view' => 'typecost',
			'layout' => 'typecost',
			'icon' => 'managementcom_typecost'
		);

		$items['admin.typecosts.default'] = array(
			'label' => 'Danh Sách Loại Chi Phí',
			'view' => 'typecosts',
			'layout' => 'default',
			'icon' => 'managementcom_typecosts'
		);
		
		$items['admin.cost.cost'] = array(
			'label' => 'Chi Phí',
			'view' => 'cost',
			'layout' => 'cost',
			'icon' => 'managementcom_cost'
		);

		$items['admin.costs.default'] = array(
			'label' => 'Danh Sách Chi Phí',
			'view' => 'costs',
			'layout' => 'default',
			'icon' => 'managementcom_costs'
		);

		$items['admin.debts.default'] = array(
			'label' => 'Danh Sách Công Nợ',
			'view' => 'debts',
			'layout' => 'default',
			'icon' => 'managementcom_debts'
		);

		$items['admin.debts.statis'] = array(
			'label' => 'Thống Kê Công Nợ',
			'view' => 'debts',
			'layout' => 'statis',
			'icon' => 'managementcom_debts_statis'
		);

		$items['admin.productcustomers.statis'] = array(
			'label' => 'Thống Kê Hóa Đơn',
			'view' => 'productcustomers',
			'layout' => 'statis',
			'icon' => 'managementcom_productcustomers_statis'
		);
		
		$items['admin.productcustomers.chart'] = array(
			'label' => 'Biểu đồ',
			'view' => 'productcustomers',
			'layout' => 'chart',
			'icon' => 'managementcom_productcustomers_chart'
		);
		
		
		$items['admin.productcustomers.profit'] = array(
			'label' => 'Lợi Nhuận Ròng',
			'view' => 'productcustomers',
			'layout' => 'profit',
			'icon' => 'managementcom_productcustomers_profit'
		);
		
		$items['admin.productcustomers.chartcolumn'] = array(
			'label' => 'Biểu đồ Lợi Nhuận',
			'view' => 'productcustomers',
			'layout' => 'chartcolumn',
			'icon' => 'managementcom_productcustomers_chartcolumn'
		);
		
				
		$items['admin.cpanel.default'] = array(
			'label' => 'MANAGEMENTCOM_LAYOUT_CONTROL_PANEL',
			'view' => 'cpanel',
			'layout' => 'default',
			'icon' => 'managementcom_cpanel'
		);

		$items['site.cpanel'] = array(
			'label' => 'MANAGEMENTCOM_LAYOUT_CONTROL_PANEL',
			'view' => 'cpanel',
			'icon' => 'managementcom_cpanel'
		);

		return $items;
	}

	/**
	* Defines the headers of your template.
	*
	* @access	public static
	*
	* @return	void
	*/
	public static function headerDeclarations()
	{
		if (self::$loaded)
			return;

		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();

		$siteUrl = JURI::root(true);

		$baseSite = 'components/' . COM_MANAGEMENTCOM;
		$baseAdmin = 'administrator/components/' . COM_MANAGEMENTCOM;

		$componentUrl = $siteUrl . '/' . $baseSite;
		$componentUrlAdmin = $siteUrl . '/' . $baseAdmin;

		JHtml::_('jquery.framework');
		JHtml::_('formbehavior.chosen', 'select');

		//JDom::_('framework.hook');
		JDom::_('html.icon.glyphicon');



		//Load the jQuery-Validation-Engine (MIT License, Copyright(c) 2011 Cedric Dugas http://www.position-absolute.com)
		self::addScript($baseAdmin, 'js/jquery.validationEngine.js');
		self::addStyleSheet($baseAdmin, 'css/validationEngine.jquery.css');
		ManagementcomHelperHtmlValidator::loadLanguageScript();
		ManagementcomHelperHtmlValidator::attachForm();


		//CSS
		if ($app->isAdmin())
		{


			self::addStyleSheet($baseAdmin, 'css/managementcom.css');
			self::addStyleSheet($baseAdmin, 'css/toolbar.css');

		}
		else if ($app->isSite())
		{
			self::addStyleSheet($baseSite, 'css/managementcom.css');
			self::addStyleSheet($baseSite, 'css/toolbar.css');

		}



		self::$loaded = true;
	}

	/**
	* Method to include the model paths in the loader.
	*
	* @access	public static
	* @param	string	$extension	The component alias.
	*
	*
	* @since	Cook 3.0.10
	*
	* @return	void
	*/
	public static function loadComponentModels($extension)
	{
		$basePath = (JFactory::getApplication()->isSite()?JPATH_SITE:JPATH_ADMINISTRATOR);
		CkJModel::addIncludePath($basePath .'/components/com_' . $extension . '/models');
	}

	/**
	* Load the fork file. (Cook Self Service concept)
	*
	* @access	public static
	* @param	string	$file	Current file to fork.
	*
	*
	* @since	Cook 2.6.3
	*
	* @return	void
	*/
	public static function loadFork($file)
	{
		//Transform the file path to reach the fork directory
		$file = preg_replace("#com_managementcom#", 'com_managementcom/fork', $file);

		// Load the fork file.
		if (!empty($file) && file_exists($file))
			include_once($file);
	}

	/**
	* Method to parse a field value.
	*
	* @access	public static
	* @param	Object	$item	The item data object.
	* @param	string	$labelKey	The field key. For concat : {field1} {field2}.
	*
	*
	* @since	Cook 3.0.10
	*
	* @return	mixed	Parsed value.
	*/
	public static function parseValue($item, $labelKey)
	{
		preg_match_all('/{([a-zA-Z0-9_]+)}/', $labelKey, $matches);

		if (!count($matches[0]))
			return $item->$labelKey;

		$replaceFrom = array();
		$replaceTo = array();

		foreach($matches[1] as $key)
		{
			$replaceFrom[] = '{' . $key . '}';
			$replaceTo[] = $item->$key;
		}

		$text = str_replace($replaceFrom, $replaceTo, $labelKey);

		return $text;
	}

	/**
	* Recreate the URL with a redirect in order to : -> keep an good SEF ->
	* always kill the post -> precisely control the request
	*
	* @access	public static
	* @param	array	$vars	The array to override the current request.
	*
	* @return	string	Routed URL.
	*/
	public static function urlRequest($vars = array())
	{
		$parts = array();

		// Authorisated followers
		$authorizedInUrl = array(
					'option' => null,
					'view' => null,
					'layout' => null,
					'format' => null,
					'Itemid' => null,
					'tmpl' => null,
					'object' => null,
					'lang' => null,
					'field' => null,
		);

		$jinput = JFactory::getApplication()->input;

		$request = $jinput->getArray($authorizedInUrl);

		foreach($request as $key => $value)
			if (!empty($value))
				$parts[] = $key . '=' . $value;

		$cid = $jinput->get('cid', array(), 'ARRAY');
		if (!empty($cid))
		{
			$cidVals = implode(",", $cid);
			if ($cidVals != '0')
				$parts[] = 'cid[]=' . $cidVals;
		}

		if (count($vars))
		foreach($vars as $key => $value)
			$parts[] = $key . '=' . $value;

		return JRoute::_("index.php?" . implode("&", $parts), false);
	}

	public static function getFilterByTypeDate($frm, $to, $typeDate){
		switch ($filter_typefilter)
		{
			default:
				$begin = new DateTime( $frm );
				$end   = new DateTime( $to );

				$dt = Carbon::createFromFormat('Y-m-d H:i:s',  $begin->format("Y-m-d H:i:s"));
				$frm_i= $dt->startOfMonth()->toDateTimeString();
				
				$dt = Carbon::createFromFormat('Y-m-d H:i:s',  $end->format("Y-m-d H:i:s"));
				$to_i = $dt->endOfMonth()->toDateTimeString();

				return array($frm_i, $to_i);
		}

		return array();
	}

	public static function filterByDay($frm, $to){
		//select from 
		
		$arr = array();
		$begin = new DateTime( $frm );
		$end   = new DateTime( $to );
		
		$db = JFactory::getDbo();
		for($i = $begin; $begin <= $end; $i->modify('+1 day')){
			
			$to_i = $frm_i = $i->format("Y-m-d H:i:s");
			$tmp = array('date'=>$i->format("d.m.Y"));
			
			//get total_cost ChiPhi
			$tmp['total_cost'] = static::getTotalCost($frm_i,$to_i);
			//get total_earn
			$tmp['total_earn'] = static::getTotalEarn($frm_i,$to_i);
			
			$tmp['total_profit'] = $tmp['total_earn'] - $tmp['total_cost'];
			//get total_weight
			$tmp['total_weight'] = static::getTotalWeight($frm_i,$to_i);
			
			$arr[] = $tmp;
		}
		return $arr;
	}
	
	public static function filterByMonth($frm, $to){
		//select from 
		
		$arr = array();
		$begin = new DateTime( $frm );
		$end   = new DateTime( $to );
		
		$db = JFactory::getDbo();
		for($i = $begin; $begin <= $end; $i->modify('+1 month')){
			//$to_i = $ftm_i = $i->format("Y-m");
			$tmp = array('date'=>$i->format("m.Y"));
			
			$dt = Carbon::createFromFormat('Y-m-d H:i:s',  $i->format("Y-m-d H:i:s"));
			$frm_i= $dt->startOfMonth()->toDateTimeString();
			$to_i = $dt->endOfMonth()->toDateTimeString();
			
			$tmp['total_cost'] = static::getTotalCost($frm_i,$to_i);
			$tmp['total_earn'] = static::getTotalEarn($frm_i,$to_i);
			//get total_weight
			$tmp['total_weight'] = static::getTotalWeight($frm_i,$to_i);
			$tmp['total_profit'] = $tmp['total_earn'] - $tmp['total_cost'];
			
			$arr[] = $tmp;
		}
		return $arr;
	}
	
	public static function filterByYear($frm, $to){
		//select from 
		
		$arr = array();
		$begin = new DateTime( $frm );
		$end   = new DateTime( $to );
		
		$db = JFactory::getDbo();
		for($i = $begin; $begin <= $end; $i->modify('+1 year')){
			//$to_i = $ftm_i = $i->format("Y-m");
			$tmp = array('date'=>$i->format("Y"));
			
			$dt = Carbon::createFromFormat('Y-m-d H:i:s',  $i->format("Y-m-d H:i:s"));
			$frm_i= $dt->startOfYear()->toDateTimeString();
			$to_i = $dt->endOfYear()->toDateTimeString();
			
			//get total_cost
			$tmp['total_cost'] = static::getTotalCost($frm_i,$to_i);
			//get total_earn
			$tmp['total_earn'] = static::getTotalEarn($frm_i,$to_i);
			$tmp['total_profit'] = $tmp['total_earn'] - $tmp['total_cost'];
			$tmp['total_weight'] = static::getTotalWeight($frm_i,$to_i);	
			$arr[] = $tmp;
		}
		return $arr;
	}
	
	public static function filterByQuarter($frm, $to){
		//select from 
		
		$arr = array();
		$begin = new DateTime( $frm );
		$end   = new DateTime( $to );
		
		$dt = Carbon::createFromFormat('Y-m-d H:i:s', $begin->format("Y-m-d H:i:s"));
		$begin = $dt->startOfYear()->toDateTimeString();
		$end = $dt->endOfYear()->toDateTimeString();
		$begin = new DateTime( $begin );
		$end   = new DateTime( $end );
		
		$db = JFactory::getDbo();
		
		$q = 1;
		for($i = $begin; $begin <= $end; $i->modify('+3 months')){
			//$to_i = $ftm_i = $i->format("Y-m");
			
			$tmp = array('date'=>'Quý '.$q.' - '.$i->format("Y"));
			$q++;
			
			
		
			$dt2 = Carbon::createFromFormat('Y-m-d H:i:s',  $i->format("Y-m-d H:i:s"));
			$to_i = $dt2->addMonths(2)->endOfMonth()->toDateTimeString(); 
			
			$dt3 = Carbon::createFromFormat('Y-m-d H:i:s',  $i->format("Y-m-d H:i:s"));
			$frm_i= $dt3->startOfMonth()->toDateTimeString();
			
			//get total_cost
			$tmp['total_cost'] = static::getTotalCost($frm_i,$to_i);
			//get total_earn
			$tmp['total_earn'] = static::getTotalEarn($frm_i,$to_i);
			$tmp['total_profit'] = $tmp['total_earn'] - $tmp['total_cost'];
			$tmp['total_weight'] = static::getTotalWeight($frm_i,$to_i);
			$arr[] = $tmp;
		}
		return $arr;
	}
	//get total_cost
	public static function getTotalCost($frm_i,$to_i){
		$db = JFactory::getDbo();
		$where = " (input_date BETWEEN '".$frm_i."' AND '".$to_i."')";
		
		//get total_cost ChiPhi
		$query = $db->getQuery(true);
		$query="SELECT round(sum(price)) as total_price_cost
				FROM #__managementcom_costs as a
				WHERE a.published=1 AND ".$where;
		   
		$db->setQuery($query);
		$result = $db->loadResult();
		return $result;
	}
	//get total_earn
	public static function getTotalEarn($frm_i,$to_i){
		$db = JFactory::getDbo();
		$where = " (input_date BETWEEN '".$frm_i."' AND '".$to_i."')";
		
		//get total_cost ChiPhi
		$query = $db->getQuery(true);
		$query="SELECT round(sum(total_price)) as total_price_earn
				FROM #__managementcom_productcustomers as a
				WHERE a.published=1 AND ".$where;
		   
		$db->setQuery($query);
		$result = $db->loadResult();
		return $result;
	}
	//get total_weight
	public static function getTotalWeight($frm_i,$to_i){
		$db = JFactory::getDbo();
		$where = " (input_date BETWEEN '".$frm_i."' AND '".$to_i."')";
		
		//get total_weight Doanh Số
		$query = $db->getQuery(true);
		$query="SELECT ROUND(sum(total_weight),2) as total_weight
				FROM #__managementcom_productcustomers as a
				WHERE a.published=1 AND ".$where;
		   
		$db->setQuery($query);
		$result = $db->loadResult();
		return $result;
	}
	//get amount debt - amount repayment 
	//int customerid
	//string input_date
	//return array['amount_repayment']['amount_debt']
	public static function getTotalDebt($customerId, $inputDate)
	{
		$inputDate = date('Y-m-d', strtotime($inputDate));

		// Get a db connection.
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select($db->quoteName(array('total_price', 'id', 'payment_status')));
		$query->from($db->quoteName('#__managementcom_productcustomers'));
		$query->where($db->quoteName('customer_id') . ' = '. $customerId);
		$query->where($db->quoteName('input_date') . ' = '. $db->quote($inputDate));

		// Load the results as a list of stdClass objects (see later for more options on retrieving data).
		$listProductCustomers = $db->setQuery($query)->loadObjectList();
		
		$arr = array('amount_repayment' => 0, 'amount_debt' => 0);

		foreach($listProductCustomers as $item)
		{
			if ($item->payment_status)
			{
				$arr['amount_repayment'] += $item->total_price;
			}
			else
			{
				$arr['amount_debt'] += $item->total_price;
			}
		}
		
		return $arr;
	}
}

// Load the fork
ManagementcomCkHelper::loadFork(__FILE__);

// Fallback if no fork has been found
if (!class_exists('ManagementcomHelper')){ class ManagementcomHelper extends ManagementcomCkHelper{} }
