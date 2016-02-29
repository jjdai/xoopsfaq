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
 
$faq_module='xoopsfaq'; 
define('_FAQ_PATH', XOOPS_ROOT_PATH  . "/modules/" . $faq_module);
define('_FAQ_URL',  XOOPS_URL . "/modules/" . $faq_module);
define('_FAQ_URL_ADMIN_CAT',  _FAQ_URL ."/admin/category.php");  
define('_FAQ_URL_ADMIN_FAQ',  _FAQ_URL ."/admin/contents.php");
                                 
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

// 
// define('_FAQ_BLANK', _FAQ_ICONE16 . "blank.gif");
// define('_FAQ_ON',  _FAQ_ICONE16 . "on.png");
// define('_FAQ_OFF', _FAQ_ICONE16 . "off.png");
// define('_FAQ_DELETE', _FAQ_ICONE16 . "delete.png");
// define('_FAQ_ATTACH', _FAQ_ICONE16 . "attach.png");
// define('_FAQ_ADD', _FAQ_ICONE16 . "add.png");
// define('_FAQ_EDIT', _FAQ_ICONE16 . "edit.png");
// define('_FAQ_PRINTER', _FAQ_ICONE16 . "printer.png");
// define('_FAQ_MAIL', _FAQ_ICONE16 . "mail_new.png");
// define('_FAQ_UP', _FAQ_ICONE16 . "up.png");
define('_FAQ_FAT_PROCOCOLE', '__protocole__');

/*********************************************************************/
//utilise dans la la liste déroulante de l'admin des permissions
//les nombre negatif indique des code d'administration
// 0 indique le trait de separation
//les nombre positif corrresponde aux id de la table photowalls
// define ("__PERM_ADMIN", -1);
// define ("__PERM_TRAIT",  0);
// define ("__PERM_ADD_WALL",  1);

//code des permissions
// define ("_FAQ_PERM_ADD_CAT",  1);
// define ("_FAQ_PERM_EDIT_CAT",  2);
// define ("_FAQ_PERM_DELETE_CAT",  3);
// define ("_FAQ_PERM_ADD_FAQ",  4);
// define ("_FAQ_PERM_EDIT_FAQ",  5);
// define ("_FAQ_PERM_DELETE_FAQ",  6);

define ("_FAQ_PERM_CAT",  'xoopsfaq_cat');
define ("_FAQ_PERM_FAQ",  'xoopsfaq_faq');

define ("_FAQ_PERM_ADD",  1);
define ("_FAQ_PERM_EDIT",  2);
define ("_FAQ_PERM_ACTIVE",  3);
define ("_FAQ_PERM_DELETE",  4);
define ("_FAQ_PERM_PRINT",  5);
define ("_FAQ_PERM_MAILTO",  6);
define ("_FAQ_PERM_NB",  _FAQ_PERM_MAILTO + 1);

?>