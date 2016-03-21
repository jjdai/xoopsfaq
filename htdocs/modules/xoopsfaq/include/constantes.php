<?php
/**
 * Name: constantes.php
 * Description: Module specific Functions for Xoops FAQ
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
 * @Module : Xoops FAQ
 * @subpackage : Functions
 * @since 2.5.7
 * @author Jean-Jacques DELALANDRE
 * @version $Id: functions.php 0000 10/01/20126 09:03:22 John Neill $
 */

//echo __FILE__ . "</br>"; 
global $xoopsModuleConfig;
    
$faq_dirname=basename (dirname(dirname(__FILE__))); 
//$faq_dirname='xoopsfaq'; 
//$faq_dirname=$xoopsModuleConfig['xoopsfaq']; 
echo "<hr>dirname : {$faq_dirname}<hr>";
define('_FAQ_DIRNAME', $faq_dirname);
define('_FAQ_PATH', XOOPS_ROOT_PATH  . "/modules/" . _FAQ_DIRNAME);
define('_FAQ_URL',  XOOPS_URL . "/modules/" . _FAQ_DIRNAME);
define('_FAQ_URL_ADMIN_CAT',  _FAQ_URL ."/admin/category.php");  
define('_FAQ_URL_ADMIN_FAQ',  _FAQ_URL ."/admin/contents.php");
 
define('_FAQ_ADMIN_PERM', $xoopsModuleConfig['admin_has_all_perms']); 
//echo "<hr>admin permissions _FAQ_ADMIN_PERM : ".(_FAQ_ADMIN_PERM?'oui':'non')."<hr>";
                                
//define('XOOPS_MA_URL', XOOPS_URL . '/Frameworks/moduleclasses');

define('_FAQ_FW_ICONS_16', XOOPS_URL . '/Frameworks/moduleclasses/icons/16/');
define('_FAQ_FW_ICONS_32', XOOPS_URL . '/Frameworks/moduleclasses/icons/32/');
define('_FAQ_PW_ICONS_16', XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/16/');
define('_FAQ_PW_ICONS_32', XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32/');

define('_FAQ_IMAGES',  _FAQ_URL . "/images");
define('_FAQ_ICONE16',  _FAQ_IMAGES . "/icons/16/");
define('_FAQ_ICONE32',  _FAQ_IMAGES . "/icons/32/");

define('_FAQ_BLANK', _FAQ_FW_ICONS_16 . "blank.gif");
define('_FAQ_ON',  _FAQ_FW_ICONS_16 . "on.png");
define('_FAQ_OFF', _FAQ_FW_ICONS_16 . "off.png");
define('_FAQ_DELETE', _FAQ_FW_ICONS_16 . "delete.png");
define('_FAQ_ATTACH', _FAQ_FW_ICONS_16 . "attach.png");
define('_FAQ_ADD', _FAQ_FW_ICONS_16 . "add.png");
define('_FAQ_EDIT', _FAQ_FW_ICONS_16 . "edit.png");
define('_FAQ_PRINTER', _FAQ_FW_ICONS_16 . "printer.png");
define('_FAQ_MAIL', _FAQ_FW_ICONS_16 . "mail_forward.png");
define('_FAQ_UP', _FAQ_FW_ICONS_16 . "up.png");

define('_FAQ_FAT_PROCOCOLE', '__protocole__');

/*********************************************************************/

define ("_FAQ_PERM_CAT",  'xoopsfaq_cat');
define ("_FAQ_PERM_FAQ",  'xoopsfaq_faq');

define ("_FAQ_PERM_ADD",  1);
define ("_FAQ_PERM_EDIT",  2);
define ("_FAQ_PERM_ACTIVE",  3);
define ("_FAQ_PERM_DELETE",  4);
define ("_FAQ_PERM_PRINT",  5);
define ("_FAQ_PERM_MAILTO",  6);
define ("_FAQ_PERM_COLSULT",  7);
define ("_FAQ_PERM_NB",  _FAQ_PERM_COLSULT + 1);

?>