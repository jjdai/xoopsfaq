<?php
/**
 * Name: functions.php
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
 * @author JEan-Jacques DELALANDRE
 * @version $Id: functions.php 0000 10/04/2009 09:03:22 John Neill $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );


function xoops_module_install_xoopsfaq(&$module) {   }

function xoops_module_uninstall_xoopsfaq(&$module) {   }

function xoops_module_update_xoopsfaq(&$module) {   

echo "<hr>xoops_module_update_xoopsfaq<hr>";
    update_tbl_contents();
    update_tbl_category();
  
}      



/************************************************************
 *
 ************************************************************/ 
function update_tbl_contents()
{
global $xoopsDB;
    $table=$xoopsDB->prefix("xoopsfaq_contents");
    $sql = "SHOW COLUMNS FROM {$table}";
    
    $rst=$xoopsDB->query($sql);
    $cols = array();
    while ($row = $xoopsDB->fetchArray($rst))
    {
      $cols[$row['Field']] = $row;
    } 
//echo "<pre>".print_r($cols,true)."</pre>" ;exit;    
    //---------------------------------------------------------------
    if (!isset($cols['contents_answer']))
    {
    
$sql = <<<__sql__
ALTER TABLE `{$table}` 
   ADD `contents_answer` VARCHAR(255) NOT NULL;
__sql__;

      $xoopsDB->queryF($sql);  
    }   
    //---------------------------------------------------------------
    if (!isset($cols['contents_seealso1']))
    {
$sql = <<<__sql__
ALTER TABLE `{$table}` 
   ADD `contents_seealso1` VARCHAR(255) NOT NULL,
   ADD `contents_libseealso1` VARCHAR(50) NOT NULL,
   ADD `contents_seealso2` VARCHAR(255) NOT NULL,
   ADD `contents_libseealso2` VARCHAR(50) NOT NULL,
   ADD `contents_seealso3` VARCHAR(255) NOT NULL,
   ADD `contents_libseealso3` VARCHAR(50) NOT NULL;
__sql__;


      $xoopsDB->queryF($sql);  
    } 
    //---------------------------------------------------------------
 //ALTER TABLE `x257_xoopsfaq_categories` CHANGE `category_order` `category_order` INT UNSIGNED NOT NULL DEFAULT '0';   
//[Type] => tinyint(3) unsigned
    if (substr($cols['contents_id']['Type'], 0, 8) == 'smallint')
    {

$sql = <<<__sql__
ALTER TABLE `{$table}` 
  CHANGE `contents_id` `contents_id` INT UNSIGNED NOT NULL AUTO_INCREMENT;
__sql__;
      $xoopsDB->queryF($sql);  
//echo $sql;exit;    
    }

    //---------------------------------------------------------------
 //ALTER TABLE `x257_xoopsfaq_categories` CHANGE `category_order` `category_order` INT UNSIGNED NOT NULL DEFAULT '0';   
//[Type] => tinyint(3) unsigned
    if (substr($cols['contents_cid']['Type'], 0, 7) == 'tinyint')
    {

$sql = <<<__sql__
ALTER TABLE `{$table}` 
  CHANGE `contents_cid` `contents_cid` INT UNSIGNED NOT NULL DEFAULT '0';   
__sql__;

      $xoopsDB->queryF($sql);  
//echo $sql;exit;    
    }
    
}    
    
/************************************************************
 * ALTER TABLE `x257_xoopsfaq_categories` DROP `category_active`;
 ************************************************************/ 
function update_tbl_category()
{
global $xoopsDB;
    $table=$xoopsDB->prefix("xoopsfaq_categories");
    $sql = "SHOW COLUMNS FROM {$table}";
    
    $rst=$xoopsDB->query($sql);
    $cols = array();
   
    while ($row = $xoopsDB->fetchArray($rst))
    {
//echo "<pre>".print_r($row,true)."</pre>" ;
      $cols[$row['Field']] = $row;
    } 
// exit; 
    //---------------------------------------------------------------
    if (!isset($cols['category_active']))
    {
    
$sql = <<<__sql__
ALTER TABLE `{$table}` 
  ADD `category_active` TINYINT(1) NOT NULL DEFAULT '1' ;
__sql__;

      $xoopsDB->queryF($sql);  
    }  
    //---------------------------------------------------------------
 //ALTER TABLE `x257_xoopsfaq_categories` CHANGE `category_order` `category_order` INT UNSIGNED NOT NULL DEFAULT '0';   
//[Type] => tinyint(3) unsigned
    if (substr($cols['category_order']['Type'], 0, 7) == 'tinyint')
    {
$sql = <<<__sql__
ALTER TABLE `{$table}` 
  CHANGE `category_id` `category_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,   
  CHANGE `category_order` `category_order` INT UNSIGNED NOT NULL DEFAULT '0';   
__sql__;

      $xoopsDB->queryF($sql);  
//echo $sql;exit;    
    }
 
}    

     
?>