<?php
/**
 * Name: xoops_version.php
 * Description:
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package : XOOPS
 * @Module :
 * @subpackage :
 * @since 2.5.7
 * @author John Neill
 * @version $Id: xoops_version.php 0000 10/04/2009 09:30:53 John Neill $
 * 
 * Mise à jour pour Xoops 2.5.7
 * @author Jean-Jacques DELALANDRE
 * 
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

$modulePath =  dirname(__FILE__);
//echo "===>" . $modulePath."<hr>";
require_once $modulePath.'/include/constantes.php';
require_once $modulePath.'/language/' . $GLOBALS['xoopsConfig']['language'] . '/modinfo.php';

/**
 * Module configs
 */
$modversion = array( 'name' => _MI_FAQ_XOOPSFAQ_NAME,    
	'description' => _MI_FAQ_XOOPSFAQ_DESC,
	'author' => 'John Neill, Kazumi Ono,Jean-Jacques DELALANDRE',
	'nickname' => 'JNeill,Kazumi,JJD',
	'license' => 'GPL see LICENSE',
	'license_url' => 'www.gnu.org/licenses/gpl-2.0.html/',
	'contributors' => '',
	'credits' => 'The Xoops Module Development Team',
	'version' => 2.10,
	'module_status' => 'RC1',
	'release_date' => '2016/03/09',
	'official' => 1,
	'image' => 'images/slogo.png',
	'website_url' => 'http://www.xoops.org',
  'module_website_name' => 'XOOPS',  
	'dirname' => basename( dirname( __FILE__ ) ),
  'min_php' => '5.2',
  'min_xoops' => '2.5',
  'system_menu' => 1
	);

//interegration de moduleadmin  
  
  


/**
 * Module Sql
 */
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

$modversion["onInstall"]	= "include/install.php";
$modversion["onUninstall"] = "include/install.php";
$modversion["onUpdate"]		 = "include/install.php";

/**
 * Module SQL Tables
 */
$modversion['tables'] = array( 'xoopsfaq_contents', 'xoopsfaq_categories' ) ;

/**
 * Module Admin
 */
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

/**
 * Module Main
 */
$modversion['hasMain'] = 1;

/**
 * Module Search
 */
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'xoopsfaq_search';

/**
 * Module Templates
 */
$modversion['templates'][] = array( 'file' => 'xoopsfaq_index.html', 'description' => '' );
$modversion['templates'][] = array( 'file' => 'xoopsfaq_category.html', 'description' => '' );
$modversion['templates'][] = array( 'file' => 'xoopsfaq_print_contents.html', 'description' => '' );
$modversion['templates'][] = array( 'file' => 'xoopsfaq_btn_contents.html', 'description' => '' );
$modversion['templates'][] = array( 'file' => 'xoopsfaq_tellafriend.html', 'description' => 'Utilisation de tellafriend' );
                                  


/**
 * Module Comments
 */
$modversion['hasComments'] = 1;
$modversion['comments'][] = array( 'pageName' => 'index.php', 'itemName' => 'cat_id' );
 
/**
 * Module configs
 */
xoops_load('xoopseditorhandler');
$editor_handler = XoopsEditorHandler::getInstance();
$modversion['config'][] = array( 
   'name' => 'use_wysiwyg',
	'title' => '_MI_FAQ_XOOPSFAQ_EDITORS',
	'description' => '_MI_FAQ_XOOPSFAQ_EDITORS_DSC',
	'formtype' => 'select',
	'valuetype' => 'text',
	'default' => 'dhtmltextarea',
	'options' => array_flip($editor_handler->getList())
	);

//---------------------------------------------------------------

// $tableau = array();
// $group_handler =& xoops_gethandler('group');
// $group_arr = $group_handler->getObjects();
// foreach (array_keys($group_arr) as $k){
//     if($group_arr[$k]->getVar("groupid") != 3) {
//         $tableau[$group_arr[$k]->getVar("name")] = $group_arr[$k]->getVar("groupid");
//     }
// } 
// 
// $modversion['config'][] = array(
//   'name' => 'delete_allowed',
//   'title' => '_MI_FAQ_GROUP_ADMIN_DEL',
//   'description' => '_MI_FAQ_GROUP_ADMIN_DEL_DSC',
//   'formtype' => 'group_multi',      //       select_multi
//   'valuetype' => 'array',
//   'default' => 1,
//   'options' => $tableau
// )


?>