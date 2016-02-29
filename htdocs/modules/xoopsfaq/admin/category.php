<?php
/**
 * Name: category.php
 * Description: Category Admin file
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
 * @subpackage : Xoops FAQ ADmin
 * @since 2.5.7
 * @author John Neill
 * @version $Id: category.php 0000 10/04/2009 08:57:46 John Neill $
 */
include 'admin_header.php';

$category_handler = &xoops_getModuleHandler( 'category' );

$op = xoopsFaq_CleanVars( $_REQUEST, 'op', 'default', 'string' );
switch ( $op ) {
	case 'add':
    $add = xoopsfaq_getPermission(_FAQ_PERM_CAT, _FAQ_PERM_ADD, true); 
  case 'edit':
    if (!isset($add)) $add = false;
    $edit = xoopsfaq_getPermission(_FAQ_PERM_CAT, _FAQ_PERM_EDIT, true); 
    if (!($add || $edit)) 
       redirect_header(_FAQ_URL_ADMIN_CAT ,3,_NOPERM);
    
    
		xoops_cp_header();

//		xoopsFaq_AdminMenu( 1 );
		xoopsFaq_DisplayHeading( _AM_FAQ_CATEGORY_HEADER, _AM_FAQ_CATEGORY_EDIT_DSC, false );
		$category_id = xoopsFaq_CleanVars( $_REQUEST, 'category_id', 0, 'int' );
		$obj = ( $category_id == 0 ) ? $category_handler->create() : $category_handler->get( $category_id );
		if ( is_object( $obj ) ) {
			$obj->displayForm();
		} else {
			$category_handler->displayError( _AM_FAQ_ERRORCOULDNOTEDITCAT );
		}
		break;

	case 'delete':
    if (!xoopsfaq_getPermission(_FAQ_PERM_CAT, _FAQ_PERM_DELETE, true)) 
       redirect_header(_FAQ_URL_ADMIN_CAT ,3,_NOPERM);
    
		$ok = xoopsFaq_CleanVars( $_REQUEST, 'ok', 0, 'int' );
		$category_id = xoopsFaq_CleanVars( $_REQUEST, 'category_id', 0, 'int' );
		if ( $ok == 1 ) {
			$obj = $category_handler->get( $category_id );
			if ( is_object( $obj ) ) {
				if ( $category_handler->delete( $obj ) ) {
					$sql = sprintf( 'DELETE FROM %s WHERE category_id = %u', $xoopsDB->prefix( 'xoopsfaq_contents' ), $category_id );
					$xoopsDB->query( $sql );
					// delete comments
					xoops_comment_delete( $xoopsModule->getVar( 'mid' ), $category_id );
					redirect_header( 'category.php', 1, _AM_FAQ_DBSUCCESS );
				}
			}
			$category_handler->displayError( _AM_FAQ_ERRORCOULDNOTDELCAT );
		} else {
			xoops_cp_header();
//			xoopsFaq_AdminMenu( 1 );
			xoopsFaq_DisplayHeading( _AM_FAQ_CATEGORY_HEADER, _AM_FAQ_CATEGORY_DELETE_DSC, false );
			xoops_confirm( array( 'op' => 'delete', 'category_id' => $category_id, 'ok' => 1 ), 'category.php', _AM_FAQ_RUSURECAT );
		}
		break;

	case 'save':
		if ( !$GLOBALS['xoopsSecurity']->check() ) {
			redirect_header( $this->url, 0, $GLOBALS['xoopsSecurity']->getErrors( true ) );
		}
		$category_id = xoopsFaq_CleanVars( $_REQUEST, 'category_id', 0, 'int' );
		$obj = ( $category_id == 0 ) ? $category_handler->create() : $category_handler->get( $category_id );
		if ( is_object( $obj ) ) {
			$obj->setVar( 'category_title', xoopsFaq_CleanVars( $_REQUEST, 'category_title', '', 'string' ) );
			$obj->setVar( 'category_order', xoopsFaq_CleanVars( $_REQUEST, 'category_order', 0, 'int' ) );           
			$obj->setVar( 'category_active', xoopsFaq_CleanVars( $_REQUEST, 'category_active', 0, 'int' ) );           
			if ( $category_handler->insert( $obj, true ) ) {
				redirect_header( 'category.php', 1, _AM_FAQ_DBSUCCESS );
			}
		}
		$category_handler->displayError( _AM_FAQ_ERRORCOULDNOTADDCAT );
		break;

    
	case 'active':
    if (!xoopsfaq_getPermission(_FAQ_PERM_CAT, _FAQ_PERM_EDIT, true)) 
       redirect_header(_FAQ_URL_ADMIN_CAT ,3,_NOPERM);

// 		if ( !$GLOBALS['xoopsSecurity']->check() ) {
// 			redirect_header( 'contents.php', 0, $GLOBALS['xoopsSecurity']->getErrors( true ) );   
// 		}
		$category_id = xoopsFaq_CleanVars( $_REQUEST, 'category_id', 0, 'int' );
		$category_active = xoopsFaq_CleanVars( $_REQUEST, 'category_active', 1, 'int' );
		$obj = ( $category_id == 0 ) ? $category_handler->create() : $category_handler->get( $category_id );
		if ( is_object( $obj ) ) {
			$obj->setVars( $_REQUEST );
			$obj->setVar( 'category_active', $category_active );
			$ret = $category_handler->insert( $obj, true );
      
      
      
			if ( $ret ) {
				redirect_header( 'category.php', 1, _AM_FAQ_DBSUCCESS );
			}
		}
		$category_handler->displayError( $ret );
		break;
    
    case 'save_list':
      if (!xoopsfaq_getPermission(_FAQ_PERM_CAT, _FAQ_PERM_EDIT, true)) 
         redirect_header(_FAQ_URL_ADMIN_CAT ,3,_NOPERM);
// 		if ( !$GLOBALS['xoopsSecurity']->check() ) {
// 			redirect_header( 'category.php', 0, $GLOBALS['xoopsSecurity']->getErrors( true ) );   
// 		}

     if (xoopsfaq_getPermission(_FAQ_PERM_CAT, _FAQ_PERM_EDIT, true)) {
        foreach($_REQUEST['categories']  as $category_id=>$item)
        {
          echo $category_id."=". $item['category_order']. " |";
  		    $obj = $category_handler->get( $category_id );
  	 		 $obj->setVar( 'category_order', $item['category_order'] );
  			 $ret = $category_handler->insert( $obj, false );
        } 
      }

	case 'default':
	default:
		xoops_cp_header();
//		xoopsFaq_AdminMenu( 1 );
    $index_admin = new ModuleAdmin();
    //echo $index_admin->addNavigation('xoopsfaq');
    if (xoopsfaq_getPermission(_FAQ_PERM_CAT, _FAQ_PERM_ADD, true)) {
      $url = XOOPS_URL .'/modules/xoopsfaq/admin/'. basename( $_SERVER['SCRIPT_FILENAME'] ) . '?op=edit&value=' . _AM_FAQ_CREATENEW ;
      $index_admin->addItemButton(_ADD, $url, 'add',"");
      echo  $index_admin->renderButton('right', '');
    }



		xoopsFaq_DisplayHeading( _AM_FAQ_CATEGORY_HEADER, _AM_FAQ_CATEGORY_LIST_DSC, false );
		$category_handler->displayAdminListing();
		break;
}
xoopsFaq_cp_footer();

?>