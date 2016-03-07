<?php
/**
 * Name: admin_header.php
 * Description: Admin header for Xoops FAQ Module
 *
 * @package : Xoops Modules
 * @Module : Xoops FAQ Module
 * @subpackage : Administration
 * @since : v1.0.0
 * @author Jean-Jacques DELALANDRE <jjd@kiolo.com>
 * @copyright : Copyright (C) 2009 Xoops. All rights reserved.
 * @license : GNU/GPL, see docs/license.txt
 * @version : $Id: xoopsfaq_print.php 0000 10/01/2016 08:47:40 Jean-Jacques DELALANDRE $
 */

//include_once dirname( dirname( dirname( __FILE__ ) ) ) . DIRECTORY_SEPARATOR . 'mainfile.php';
$f = "mainfile.php";
while(!file_exists($f)){
  $f = "../" . $f;
}
if ( !include_once($f) ) {
    die("XOOPS root path not defined");
}     
// require_once  '../../../include/cp_header.php';
require_once XOOPS_ROOT_PATH . "/include/functions.php";
require_once XOOPS_ROOT_PATH . "/class/template.php";
//-------------------------------------------------------
global $xoopsConfig;
//$modulePath =  XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' );
$modulePath =  _FAQ_PATH;
require_once $modulePath.'/xoops_version.php';
require_once $modulePath.'/include/functions.php';
require_once $modulePath.'/include/constantes.php';
require_once $modulePath.'/language/' . $GLOBALS['xoopsConfig']['language'] . '/main.php';
//require_once  XOOPS_ROOT_PATH. '/include/cp_header.php';
 
//$xoopsOption['template_main'] = 'xoopsfaq_print_contents.html';
 /*
 xoopsfaq_print_contents
 
'http://localhost:8102/laboele/include/cp_header.php' 
                       laboele\include 
 */
  
  $xoopsTpl = new XoopsTpl();
  $xoopsTpl->assign('url_base', _FAQ_URL); 
  //$xoopsTpl->assign('print_alert', _MD_MED_PRINT_ALERT); 
  
$contents_handler = &xoops_getModuleHandler( 'contents',_FAQ_DIRNAME );
//echo "ici";exit; 
	$contents_id = $_REQUEST['contents_id'];
	$obj = $contents_handler->get( $contents_id ) ;
  $contents = $obj->toArray();
  $contents['date_publication'] = $obj->getPublished();
  
  $contents['seealso'] = array();
      for ($k=1;$k<4;$k++)    
      {
        $url = $obj->getSeealso($k,1);
        if ($url != '')
        {
          $t = array();
          $t['url'] = $url;
          $t['lib'] = $obj->getLibseealso($k);
  			 $contents['seealso'][] = $t;

        }
      }
  $contents['seealso_count'] = count($contents['seealso']);

  //echoA($contents);
  $xoopsTpl->assign('contents', $contents); 
  $xoopsTpl->assign('title0', $contents['contents_title']); 
  $xoopsTpl->assign('sitename', $xoopsConfig['sitename']); 
  $xoopsTpl->assign('path_icons32', '../../../Frameworks/moduleclasses/icons/32'); 
  //echoA($xoopsConfig);
                                                            
//   $xoopsTpl->assign('pied_de_page', "Copyright Jean-Jacques DELALANDRE - Tout droit de reproduction réservé");
//   $xoopsTpl->assign('site', "http://origami.jubile.fr");
  
  
  
    $xoopsTpl->display($modulePath . "/templates/xoopsfaq_print_contents.html");
    //$xoopsTpl->display("xoopsfaq_print_contents.html");

?>