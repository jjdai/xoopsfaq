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

$op = nsXfaq\CleanVars( $_REQUEST, 'op', 'default', 'string' );
include_once _FAQ_PATH . "/class/permissions.php" ;

// -- onglet permission                      

if (!nsXfaq\isAdminXoops()){ 
        redirect_header(XOOPS_URL, 1, _NOPERM);
        exit();
}

$permissions_handler = new XoopsfaqPermissions();

//$permissions_handler = &xoops_getModuleHandler( 'contents',_FAQ_DIRNAME );
$permissions_handler->display($_REQUEST);

nsXfaq\getPermission('xoopsfaq_faq', 1, _FAQ_ADMIN_PERM);
nsXfaq\getPermission('xoopsfaq_faq', 2, _FAQ_ADMIN_PERM);
nsXfaq\getPermission('xoopsfaq_faq', 3, _FAQ_ADMIN_PERM);
nsXfaq\getPermission('xoopsfaq_faq', 4, _FAQ_ADMIN_PERM);

nsXfaq\getAPermissions('xoopsfaq_faq', 'permissions des faq');

xoops_cp_footer();

?>