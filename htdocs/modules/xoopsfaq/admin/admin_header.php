<?php
/**
 * Name: admin_header.php
 * Description: Admin header for Xoops FAQ Module
 *
 * @package : Xoops Modules
 * @Module : Xoops FAQ Module
 * @subpackage : Administration
 * @since : v1.0.0
 * @author John Neill <catzwolf@xoops.org>
 * @copyright : Copyright (C) 2009 Xoops. All rights reserved.
 * @license : GNU/GPL, see docs/license.txt
 * @version : $Id: admin_header.php 0000 10/04/2009 08:47:40 John Neill $
 */
include dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/include/cp_header.php';

require_once XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' ) . '/include/functions.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' ) . '/include/constantes.php';
global $isFwModuleAdmin;

$faq_path32 = '../../Frameworks/moduleclasses/icons/32/';

  if (!xoopsfaq_isAdminModule())
  {
		redirect_header(XOOPS_URL."/",3,_NOPERM);
    exit();
  }

if (xoopsFaq_checkModuleAdmin()){
  $variable_name = new ModuleAdmin();
  $isFwModuleAdmin = 1;
}

?>