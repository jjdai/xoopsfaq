<?php
/**
 * Name: permissions.php
 * Description: Admin Index File for Xoops FAQ Admin
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
 * @package : Xoops
 * @Module : Xoops FAQ
 * @subpackage : Xoops FAQ Admin
 * @since 2.5.7
 * @author Jean-Jacques DELALANDRE
 * @version $Id: index.php 0000 30/01/2016 08:56:26 Jean-Jacques DELALANDRE $
 */
include 'admin_header.php';
include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php'; 
include_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php'; 
include_once _FAQ_PATH . '/class/permissions.php'; 
xoops_cp_header();

$op = xoopsFaq_CleanVars( $_REQUEST, 'op', 'default', 'string' );
include_once _FAQ_PATH . "/class/permissions.php" ;
$permissions_handler = new XoopsfaqPermissions();

//$permissions_handler = &xoops_getModuleHandler( 'contents','xoopsfaq' );
$permissions_handler->display($_REQUEST);

xoopsfaq_getPermission('xoopsfaq_faq', 1);
xoopsfaq_getPermission('xoopsfaq_faq', 2);
xoopsfaq_getPermission('xoopsfaq_faq', 3);
xoopsfaq_getPermission('xoopsfaq_faq', 4);

xoopsfaq_getAPermissions('xoopsfaq_faq', 'permissions des faq');

xoops_cp_footer();

?>