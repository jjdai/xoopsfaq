<?php
/**
 * Media module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright	The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license             http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package	photowalls
 * @since		2.3.0
 * @author 		JJDai <http://xoops.kiolo.com>
 * @version		$Id$
**/


/***********************************************************************/
class XoopsfaqPermissions //extends Admin_tbl_entite
{


var $module_id = 0;

/*******************************************************************
 *
 *******************************************************************/
function __construct($p = null)
{
global $xoopsModule;  
  //$this->getInfo($p);

  $this->module_id = $xoopsModule->getVar('mid');
}


/***********************************************************************/
function render($perm=''){
global $xoopsModule, $index_admin;
$cat = 'cat';
$faq = 'faq';

      
  $frm = '';
  //--------------------------------------------------------------------  
  if ($perm == $cat || $perm == '')  
  {
    $perm_name = "xoopsfaq_" . $cat;
    $url = 'admin/permissions.php?perm=' . $cat;
    $title_of_form = _AM_FAQ_PERMISSIONS_CAT;
    $perm_desc = _AM_FAQ_PERMISSIONS_CAT_DESC;
    $tLib = array(_FAQ_PERM_EDIT     => _AM_FAQ_PERM_EDIT,      
                  _FAQ_PERM_ADD      => _AM_FAQ_PERM_ADD,
                  //_FAQ_PERM_COLSULT   => _AM_FAQ_PERM_COLSULT,      
                  _FAQ_PERM_DELETE   => _AM_FAQ_PERM_DELETE);      
    $form = new XoopsGroupPermForm($title_of_form, $this->module_id, $perm_name, $perm_desc, $url, true);
    while (list($key, $val)= each ($tLib)){
      $form->addItem($key, $val, 0, 25);
    }
    $frm .= $form->render();
  }
  
  //--------------------------------------------------------------------  
  if ($perm == $faq || $perm == '')  
  {
    $perm_name = "xoopsfaq_" . $faq;
    $url = 'admin/permissions.php?perm=' . $faq;
    $title_of_form = _AM_FAQ_PERMISSIONS_FAQ;
    $perm_desc = _AM_FAQ_PERMISSIONS_FAQ_DESC;
    $tLib = array(_FAQ_PERM_PRINT    => _AM_FAQ_PERM_PRINT,
                  _FAQ_PERM_MAILTO   => _AM_FAQ_PERM_MAILTO,
                  _FAQ_PERM_EDIT     => _AM_FAQ_PERM_EDIT,
                  //_FAQ_PERM_ACTIVE   => _AM_FAQ_PERM_ACTIVE,
                  _FAQ_PERM_ADD      => _AM_FAQ_PERM_ADD,
                  _FAQ_PERM_DELETE   => _AM_FAQ_PERM_DELETE);      
    $form = new XoopsGroupPermForm($title_of_form, $this->module_id, $perm_name, $perm_desc, $url, true);
    while (list($key, $val)= each ($tLib)){
      $form->addItem($key, $val, 0, 25);
    }
    $frm .= $form->render();
  }
  //--------------------------------------------------------------------  
      
   
  
  
  //$url = _FAQ_URL . '/admin/permissions.php';
  //-------------------------------------------------------------------
  //--------------------------------------------------------------------------------
  return $frm;
  
  
  
}
/************************************************************************
 *
 ***********************************************************************/
function display($p=null){
global $xoopsModule, $index_admin;
//echo "ici";exit;

  //echo $index_admin->addNavigation('rights');
  echo $this->render();
}


//-----------------------------------------------------------
} //fin de la classe

?>
