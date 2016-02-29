<?php
/**
 * Name: menu.php
 * Description: Menu for the Xoops FAQ Module
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
 * @subpackage : Xoops FAQ Adminisration
 * @since 2.5.7
 * @author John Neill
 * @version $Id: menu.php 0000 10/04/2009 08:55:20 John Neill $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );


$faq_path32 = '../../Frameworks/moduleclasses/icons/32/';
/**
 * Admin Menus
 */
$adminmenu[] = array( 'title' => _MI_FAQ_MENU_ADMININDEX, 
                      'link' => 'admin/index.php',
                      'icon' => $faq_path32 . 'index.png',
                      'menu' => '',
                      'desc' => '' );
                      
$adminmenu[] = array( 'title' => _MI_FAQ_MENU_ADMINCATEGORYS, 
                      'link' => 'admin/category.php',
                      'icon' => $faq_path32 . 'category.png',
                      'menu' => 'categorie',
                      'desc' => '' );


$adminmenu[] = array( 'title' => _MI_FAQ_MENU_QUESTIONS, 
                      'link' => 'admin/contents.php',
                      'icon' => $faq_path32 . 'translations.png',
                      'menu' => 'questions',
                      'desc' => '' );
                      
//---------------------------------------------------------------
// -- onglet permission                      
global $xoopsUser,$xoopsModule,$xoopsmod,$xoopsModuleConfig;
$bolOk = false;
  if ( $xoopsUser ) {
      $userGroups = array_values($xoopsUser->getGroups());
      $g = array_intersect($userGroups,array(1));
      if (count($g)>0)  $bolOk = true;
  }
if ($bolOk){
$adminmenu[] = array( 'title' => _MI_FAQ_MENU_PERMISSIONS, 
                      'link' => 'admin/permissions.php',
                      'icon' => $faq_path32 . 'permissions.png',
                      'menu' => 'permissions',
                      'desc' => '' );
}                      
//---------------------------------------------------------------

$adminmenu[] = array( 'title' => _AM_MODULEADMIN_ABOUT, 
                      'link' => 'admin/about.php',
                      'icon' => $faq_path32 . 'about.png',
                      'menu' => 'about',
                      'desc' => '' );
                      
?>   