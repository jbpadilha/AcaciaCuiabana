<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @package VirtueMart
* @subpackage languages
* @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
* @translator soeren
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
global $VM_LANG;
$langvars = array (
	'CHARSET' => 'UTF-8',
	'PHPSHOP_MODULE_LIST_ORDER' => '列出訂單',
	'PHPSHOP_PRODUCT_INVENTORY_LBL' => '商品庫存',
	'PHPSHOP_PRODUCT_INVENTORY_STOCK' => '數量',
	'PHPSHOP_PRODUCT_INVENTORY_WEIGHT' => '重量',
	'PHPSHOP_PRODUCT_LIST_PUBLISH' => '發佈',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE' => 'Search Product',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRODUCT' => 'modyfied',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRICE' => 'with price modyfied',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_WITHOUTPRICE' => 'without price',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_AFTER' => 'After',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_BEFORE' => 'Before',
	'PHPSHOP_PRODUCT_FORM_SHOW_FLYPAGE' => '預覽商品介紹頁面',
	'PHPSHOP_PRODUCT_FORM_NEW_PRODUCT_LBL' => '新增商品',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL' => '商品資訊',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL' => '商品狀態',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL' => '商品體積和重量',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL' => '商品圖片',
	'PHPSHOP_PRODUCT_FORM_UPDATE_ITEM_LBL' => '更新項目',
	'PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL' => '項目資訊',
	'PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL' => '項目狀態',
	'PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL' => '項目的體積和重量',
	'PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL' => '項目圖片',
	'PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL' => '要更新現有圖片，請輸入新圖片的路徑。',
	'PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL' => '輸入 ',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_ITEMS_LBL' => '商品項目',
	'PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL' => '項目屬性',
	'PHPSHOP_PRODUCT_FORM_DELETE_PRODUCT_MSG' => '您確定要刪除相關的商品和項目嗎?',
	'PHPSHOP_PRODUCT_FORM_DELETE_ITEM_MSG' => '您確定要刪除此項目嗎?',
	'PHPSHOP_PRODUCT_FORM_MANUFACTURER' => '製造商',
	'PHPSHOP_PRODUCT_FORM_SKU' => '庫存料號',
	'PHPSHOP_PRODUCT_FORM_NAME' => '名稱',
	'PHPSHOP_PRODUCT_FORM_CATEGORY' => '類別',
	'PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE' => '有效日期',
	'PHPSHOP_PRODUCT_FORM_SPECIAL' => '特價中',
	'PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE' => '折扣類型',
	'PHPSHOP_PRODUCT_FORM_PUBLISH' => '發佈?',
	'PHPSHOP_PRODUCT_FORM_LENGTH' => '長',
	'PHPSHOP_PRODUCT_FORM_WIDTH' => '寬',
	'PHPSHOP_PRODUCT_FORM_HEIGHT' => '高',
	'PHPSHOP_PRODUCT_FORM_DIMENSION_UOM' => '計量單位',
	'PHPSHOP_PRODUCT_FORM_WEIGHT_UOM' => '計量單位',
	'PHPSHOP_PRODUCT_FORM_FULL_IMAGE' => '完整圖片',
	'PHPSHOP_PRODUCT_FORM_WEIGHT_UOM_DEFAULT' => 'pounds',
	'PHPSHOP_PRODUCT_FORM_DIMENSION_UOM_DEFAULT' => 'inches',
	'PHPSHOP_PRODUCT_FORM_PACKAGING' => 'Units in Packaging',
	'PHPSHOP_PRODUCT_FORM_PACKAGING_DESCRIPTION' => 'Here you can fill in a number unit in packaging. (max. 65535)',
	'PHPSHOP_PRODUCT_FORM_BOX' => 'Units in Box',
	'PHPSHOP_PRODUCT_FORM_BOX_DESCRIPTION' => 'Here you can fill in a number unit in box. (max. 65535)',
	'PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL' => '商品新增結果',
	'PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL' => '商品更新結果',
	'PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL' => '項目增加結果',
	'PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL' => '項目更新結果',
	'PHPSHOP_CATEGORY_FORM_LBL' => '類別資訊',
	'PHPSHOP_CATEGORY_FORM_NAME' => '類別名稱',
	'PHPSHOP_CATEGORY_FORM_PARENT' => '父類別',
	'PHPSHOP_CATEGORY_FORM_DESCRIPTION' => '類別描述',
	'PHPSHOP_CATEGORY_FORM_PUBLISH' => '發佈?',
	'PHPSHOP_CATEGORY_FORM_FLYPAGE' => '類別頁面',
	'PHPSHOP_ATTRIBUTE_LIST_LBL' => '屬性清單給',
	'PHPSHOP_ATTRIBUTE_LIST_NAME' => '屬性名稱',
	'PHPSHOP_ATTRIBUTE_LIST_ORDER' => '列出訂購',
	'PHPSHOP_ATTRIBUTE_FORM_LBL' => '屬性表格',
	'PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT' => '為商品增加新的屬性',
	'PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT' => '更新商品屬性',
	'PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM' => '新建項目屬性',
	'PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM' => '更新物品屬性',
	'PHPSHOP_ATTRIBUTE_FORM_NAME' => '屬性名稱',
	'PHPSHOP_ATTRIBUTE_FORM_ORDER' => '列出訂購',
	'PHPSHOP_PRICE_LIST_FOR_LBL' => '價格給',
	'PHPSHOP_PRICE_LIST_GROUP_NAME' => '群組名稱',
	'PHPSHOP_PRICE_LIST_PRICE' => '價格',
	'PHPSHOP_PRODUCT_LIST_CURRENCY' => '貨幣',
	'PHPSHOP_PRICE_FORM_LBL' => '價格資訊',
	'PHPSHOP_PRICE_FORM_NEW_FOR_PRODUCT' => '新建商品價格',
	'PHPSHOP_PRICE_FORM_UPDATE_FOR_PRODUCT' => '更新商品價格',
	'PHPSHOP_PRICE_FORM_NEW_FOR_ITEM' => '新價格給項目',
	'PHPSHOP_PRICE_FORM_UPDATE_FOR_ITEM' => '更新項目價格',
	'PHPSHOP_PRICE_FORM_PRICE' => '價格',
	'PHPSHOP_PRICE_FORM_CURRENCY' => '貨幣',
	'PHPSHOP_PRICE_FORM_GROUP' => '購物群組',
	'PHPSHOP_LEAVE_BLANK' => '(如果您沒有個別的PHP檔案給它<br />請留空!)',
	'PHPSHOP_PRODUCT_FORM_ITEM_LBL' => '項目',
	'PHPSHOP_PRODUCT_DISCOUNT_STARTDATE' => '折扣起始日期',
	'PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP' => '指定折扣起始日期',
	'PHPSHOP_PRODUCT_DISCOUNT_ENDDATE' => '折扣結束日期',
	'PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP' => '指定折扣結束日期',
	'PHPSHOP_FILEMANAGER_PUBLISHED' => '發佈?',
	'PHPSHOP_FILES_LIST' => '檔案管理員: 圖片/檔案清單給',
	'PHPSHOP_FILES_LIST_FILENAME' => '檔名',
	'PHPSHOP_FILES_LIST_FILETITLE' => '檔案抬頭',
	'PHPSHOP_FILES_LIST_FILETYPE' => '檔案類型',
	'PHPSHOP_FILES_LIST_FULL_IMG' => '完整圖片',
	'PHPSHOP_FILES_LIST_THUMBNAIL_IMG' => '縮圖',
	'PHPSHOP_FILES_FORM' => '上傳一個檔案給',
	'PHPSHOP_FILES_FORM_CURRENT_FILE' => '目前的檔案',
	'PHPSHOP_FILES_FORM_FILE' => '檔案',
	'PHPSHOP_FILES_FORM_IMAGE' => '圖片',
	'PHPSHOP_FILES_FORM_UPLOAD_TO' => '上傳至',
	'PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH' => '預設的商品圖片路徑',
	'PHPSHOP_FILES_FORM_UPLOAD_OWNPATH' => '指定的檔案所在地',
	'PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH' => '下載路徑 (例如. 販售下載商品時!)',
	'PHPSHOP_FILES_FORM_AUTO_THUMBNAIL' => '自動產生縮圖?',
	'PHPSHOP_FILES_FORM_FILE_PUBLISHED' => '發佈檔案?',
	'PHPSHOP_FILES_FORM_FILE_TITLE' => '檔案抬頭 (顧客會看到的)',
	'PHPSHOP_FILES_FORM_FILE_URL' => '檔案位址 (非必需)',
	'PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP1' => '在此輸入任何的文字將會在商品介紹頁面顯示給顧客.<br />例如: 24h, 48 hours, 3 - 5 days, On Order.....',
	'PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP2' => '或是選擇一個圖片顯示在詳細頁面 (介紹頁面).<br />圖片在目錄 <i>%s</i>裡面<br />',
	'PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES' => '<h4>自定義屬性清單格式的例子:</h4>
        <pre>名稱;額外;</strong>...</pre>',
	'PHPSHOP_IMAGE_ACTION' => '圖片動作',
	'PHPSHOP_PARAMETERS_LBL' => '參數',
	'PHPSHOP_PRODUCT_TYPE_LBL' => '商品類型',
	'PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_LBL' => '商品類型清單給',
	'PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_LBL' => '增加商品類型給',
	'PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_PRODUCT_TYPE' => '商品類型',
	'PHPSHOP_PRODUCT_TYPE_FORM_NAME' => '商品類型名稱',
	'PHPSHOP_PRODUCT_TYPE_FORM_DESCRIPTION' => '商品類型描述',
	'PHPSHOP_PRODUCT_TYPE_FORM_PARAMETERS' => '參數',
	'PHPSHOP_PRODUCT_TYPE_FORM_LBL' => '商品類型資訊',
	'PHPSHOP_PRODUCT_TYPE_FORM_PUBLISH' => '發佈?',
	'PHPSHOP_PRODUCT_TYPE_FORM_BROWSEPAGE' => '商品類型瀏覽頁面',
	'PHPSHOP_PRODUCT_TYPE_FORM_FLYPAGE' => '商品類型介紹頁面',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_LIST_LBL' => '商品類型的參數',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LBL' => '參數資訊',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NOT_FOUND' => '商品類型找不到!',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME' => '參數名稱',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME_DESCRIPTION' => '這個名稱將會是表格的行名. 必須是小寫而且無空白.<br/>例如: main_material',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LABEL' => '參數標籤',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_INTEGER' => '整數',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TEXT' => '文字',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_SHORTTEXT' => '簡短文字',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_FLOAT' => 'Float',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_CHAR' => 'Char',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATETIME' => '日期 及 時間',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE' => '日期',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME' => '時間',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_BREAK' => '斷行',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_MULTIVALUE' => '多個值',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES' => '可能的值',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_MULTISELECT' => '顯示可能的值作為多重選擇?',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES_DESCRIPTION' => '<strong>如果設定了可能的值, 參數將只能用這個值. 例子:</strong><br/><span class="sectionname">Steel;Wood;Plastic;...</span>',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT' => '預設值',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT_HELP_TEXT' => '參數預設值使用這種格式:<ul><li>Date: YYYY-MM-DD</li><li>Time: HH:MM:SS</li><li>Date & Time: YYYY-MM-DD HH:MM:SS</li></ul>',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_UNIT' => '單位',
	'PHPSHOP_PRODUCT_CLONE' => '複製商品',
	'PHPSHOP_HIDE_OUT_OF_STOCK' => 'Hide out of stock products',
	'PHPSHOP_FEATURED_PRODUCTS_LIST_LBL' => 'Featured & Discounted Products',
	'PHPSHOP_FEATURED' => 'Featured',
	'PHPSHOP_SHOW_FEATURED_AND_DISCOUNTED' => 'featured AND discounted',
	'PHPSHOP_SHOW_DISCOUNTED' => 'discounted products',
	'PHPSHOP_FILTER' => 'Filter',
	'PHPSHOP_PRODUCT_FORM_DISCOUNTED_PRICE' => 'Discounted Price',
	'PHPSHOP_PRODUCT_FORM_DISCOUNTED_PRICE_TIP' => 'Here you can override the discount setting fill in a special discount price for this product.<br/>
The Shop will create a new discount record from the discounted price.',
	'PHPSHOP_PRODUCT_LIST_QUANTITY_START' => 'Quantity Start',
	'PHPSHOP_PRODUCT_LIST_QUANTITY_END' => 'Quantity End',
	'VM_PRODUCTS_MOVE_LBL' => 'Move products from one category to another',
	'VM_PRODUCTS_MOVE_LIST' => 'You have chosen to move the following %s products',
	'VM_PRODUCTS_MOVE_TO_CATEGORY' => 'Move to the following category',
	'VM_PRODUCT_LIST_REORDER_TIP' => 'Select a product category to reorder products in a category',
	'VM_REVIEW_FORM_LBL' => 'Add Review',
	'PHPSHOP_REVIEW_EDIT' => 'Add/Edit a Review',
	'SEL_CATEGORY' => 'Select a category',
	'VM_PRODUCT_FORM_MIN_ORDER' => 'Minimum Purchase Quantity',
	'VM_PRODUCT_FORM_MAX_ORDER' => 'Maximum Purchase Quantity',
	'VM_DISPLAY_TABLE_HEADER' => 'Display Table Header',
	'VM_DISPLAY_LINK_TO_CHILD' => 'Link to child product from list',
	'VM_DISPLAY_INCLUDE_PRODUCT_TYPE' => 'Include Product Type With Child',
	'VM_DISPLAY_USE_LIST_BOX' => 'Use List box for child products',
	'VM_DISPLAY_LIST_STYLE' => 'List Style',
	'VM_DISPLAY_USE_PARENT_LABEL' => 'Use Parent Settings:',
	'VM_DISPLAY_LIST_TYPE' => 'List:',
	'VM_DISPLAY_QUANTITY_LABEL' => 'Quantity:',
	'VM_DISPLAY_QUANTITY_DROPDOWN_LABEL' => 'Drop Down Box Values',
	'VM_DISPLAY_CHILD_DESCRIPTION' => 'Display Child Description',
	'VM_DISPLAY_DESC_WIDTH' => 'Child Description Width',
	'VM_DISPLAY_ATTRIB_WIDTH' => 'Child Attribute Width',
	'VM_DISPLAY_CHILD_SUFFIX' => 'Child Class Suffix',
	'VM_INCLUDED_PRODUCT_ID' => 'Product IDs to include',
	'VM_EXTRA_PRODUCT_ID' => 'Extra IDs',
	'PHPSHOP_DISPLAY_RADIOBOX' => 'Use Radio Box',
	'PHPSHOP_PRODUCT_FORM_ITEM_DISPLAY_LBL' => 'Display Options',
	'PHPSHOP_DISPLAY_USE_PARENT' => 'Override Child products Display Values and use parents',
	'PHPSHOP_DISPLAY_NORMAL' => 'Standard Quantity Box',
	'PHPSHOP_DISPLAY_HIDE' => 'Hide Quantity Box',
	'PHPSHOP_DISPLAY_DROPDOWN' => 'Use Dropdown Box',
	'PHPSHOP_DISPLAY_CHECKBOX' => 'Use Check Box',
	'PHPSHOP_DISPLAY_ONE' => 'One Add to Cart Button',
	'PHPSHOP_DISPLAY_MANY' => 'Add to Cart Button for each Child',
	'PHPSHOP_DISPLAY_START' => 'Start Value',
	'PHPSHOP_DISPLAY_END' => 'End Value',
	'PHPSHOP_DISPLAY_STEP' => 'Step Value',
	'PRODUCT_WAITING_LIST_TAB' => 'Waiting List',
	'PRODUCT_WAITING_LIST_USERLIST' => 'Users waiting to be notified when this product is back in stock',
	'PRODUCT_WAITING_LIST_NOTIFYUSERS' => 'Notify these users now (when you have updated the number of products stock)',
	'PRODUCT_WAITING_LIST_NOTIFIED' => 'notified',
	'VM_PRODUCT_FORM_AVAILABILITY_SELECT_IMAGE' => 'Select Image',
	'VM_PRODUCT_RELATED_SEARCH' => 'Search for Products or Categories here:',
	'VM_FILES_LIST_ROLE' => 'Role',
	'VM_FILES_LIST_UP' => 'Up',
	'VM_FILES_LIST_GO_UP' => 'Go Up',
	'VM_CATEGORY_FORM_PRODUCTS_PER_ROW' => 'Show x products per row',
	'VM_CATEGORY_FORM_BROWSE_PAGE' => 'Category Browse Page',
	'VM_PRODUCT_CLONE_OPTIONS_TAB' => 'Clone Product Otions',
	'VM_PRODUCT_CLONE_OPTIONS_LBL' => 'Also clone these Child Items',
	'VM_PRODUCT_LIST_MEDIA' => 'Media',
	'VM_REVIEW_LIST_NAMEDATE' => 'Name/Date',
	'VM_PRODUCT_SELECT_ONE_OR_MORE' => 'Select one or more Products',
	'VM_PRODUCT_SEARCHING' => 'Searching...',
	'PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES' => '<h4>Examples for the Attribute List Format:</h4>
Title = Color, Property = Red ; Click on New Property to add a new color: Green ; Then click on New attribute to add a new attribute, and so on.
<h4>Inline price adjustments for using the Advanced Attributes modification:</h4>
Price = +10 to add this amount to the configured price.<br />  Price = -10 to subtract this amount from the configured price.<br />  Price = 10 to set the product\'s price to this amount.',
	'VM_FILES_FORM_PRODUCT_IMAGE' => 'Product Image (full and thumb)',
	'VM_FILES_FORM_DOWNLOADABLE' => 'Downloadable Product File (to be sold!)',
	'VM_FILES_FORM_RESIZE_IMAGE' => 'Resize Full Image File?'
); $VM_LANG->initModule( 'product', $langvars );
?>