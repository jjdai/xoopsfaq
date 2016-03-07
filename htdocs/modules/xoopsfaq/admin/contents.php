<?php
/**
 * Name: index.php
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
 * @author John Neill
 * @version $Id: index.php 0000 10/04/2009 08:56:26 John Neill $
 */
include 'admin_header.php';

$contents_handler = &xoops_getModuleHandler( 'contents' );

$op = xoopsFaq_CleanVars( $_REQUEST, 'op', 'default', 'string' );

switch ( $op ) {
	case 'add':
    $add =  (!xoopsfaq_getPermission(_FAQ_PERM_FAQ, _FAQ_PERM_ADD, true));
	case 'edit':
    if (!isset($add)) $add = false;
    $edit = xoopsfaq_getPermission(_FAQ_PERM_FAQ, _FAQ_PERM_EDIT, true); 
    if (!($add || $edit)) 
       redirect_header(_FAQ_URL_ADMIN_FAQ ,3,_NOPERM);
  
		$contents_id = xoopsFaq_CleanVars( $_REQUEST, 'contents_id', 0, 'int' );
		$obj = ( $contents_id == 0 ) ? $contents_handler->create() : $contents_handler->get( $contents_id );
		if ( is_object( $obj ) ) {
			xoops_cp_header();
//			xoopsFaq_AdminMenu( 0 );
			xoopsFaq_DisplayHeading( _AM_FAQ_CONTENTS_HEADER, _AM_FAQ_CATEGORY_EDIT_DSC, false );
			$obj->displayForm();
		} else {
			$contents_handler->displayError( _AM_FAQ_ERRORCOULDNOTEDITCAT );
		}
		break;

	case 'delete':
    if (!xoopsfaq_getPermission(_FAQ_PERM_FAQ, _FAQ_PERM_DELETE, true)) 
       redirect_header(_FAQ_URL_ADMIN_FAQ ,3,_NOPERM);
  
		$ok = xoopsFaq_CleanVars( $_REQUEST, 'ok', 0, 'int' );
		$contents_id = xoopsFaq_CleanVars( $_REQUEST, 'contents_id', 0, 'int' );
		if ( $ok == 1 ) {
			$obj = $contents_handler->get( $contents_id );
			if ( is_object( $obj ) ) {
				if ( $contents_handler->delete( $obj ) ) {
					$sql = sprintf( 'DELETE FROM %s WHERE contents_id = %u', $xoopsDB->prefix( 'xoopsfaq_contents' ), $contents_id );
					$xoopsDB->query( $sql );
					// delete comments
					xoops_comment_delete( $xoopsModule->getVar( 'mid' ), $contents_id );
					redirect_header( 'contents.php', 1, _AM_FAQ_DBSUCCESS );
				}
			}
			$contents_handler->displayError( _AM_FAQ_ERRORCOULDNOTDELCAT );
		} else {
			xoops_cp_header();
//			xoopsFaq_AdminMenu( 0 );
			xoopsFaq_DisplayHeading( _AM_FAQ_CONTENTS_HEADER, _AM_FAQ_CATEGORY_DELETE_DSC, false );
			xoops_confirm( array( 'op' => 'delete', 'contents_id' => $contents_id, 'ok' => 1 ), 'contents.php', _AM_FAQ_RUSURECAT );
		}
		break;

	case 'save':
		if ( !$GLOBALS['xoopsSecurity']->check() ) {
			redirect_header( 'contents.php', 0, $GLOBALS['xoopsSecurity']->getErrors( true ) );
		}
		$contents_id = xoopsFaq_CleanVars( $_REQUEST, 'contents_id', 0, 'int' );
		$obj = ( $contents_id == 0 ) ? $contents_handler->create() : $contents_handler->get( $contents_id );
		if ( is_object( $obj ) ) {
			$obj->setVars( $_REQUEST );
			$obj->setVar( 'contents_publish', strtotime(xoopsFaq_transformDate2Local($_REQUEST['contents_publish'] ) ) );
			$obj->setVar( 'dohtml', isset( $_REQUEST['dohtml'] ) ? 1 : 0 );
			$obj->setVar( 'dosmiley', isset( $_REQUEST['dosmiley'] ) ? 1 : 0 );
			$obj->setVar( 'doxcode', isset( $_REQUEST['doxcode'] ) ? 1 : 0 );
			$obj->setVar( 'doimage', isset( $_REQUEST['doimage'] ) ? 1 : 0 );
			$obj->setVar( 'dobr', isset( $_REQUEST['dobr'] ) ? 1 : 0 );
			$ret = $contents_handler->insert( $obj, true );
      
			if ( $ret ) {
				redirect_header( 'contents.php', 1, _AM_FAQ_DBSUCCESS );
			}
		}
		$contents_handler->displayError( $ret );
		break;
    
	case 'active':
    if (!xoopsfaq_getPermission(_FAQ_PERM_FAQ, _FAQ_PERM_EDIT, true)) 
       redirect_header(_FAQ_URL_ADMIN_FAQ ,3,_NOPERM);
  
		$contents_id = xoopsFaq_CleanVars( $_REQUEST, 'contents_id', 0, 'int' );
		$contents_active = xoopsFaq_CleanVars( $_REQUEST, 'contents_active', 1, 'int' );
		$obj = ( $contents_id == 0 ) ? $contents_handler->create() : $contents_handler->get( $contents_id );
		if ( is_object( $obj ) ) {
			$obj->setVars( $_REQUEST );
			$obj->setVar( 'contents_active', $contents_active );
			$ret = $contents_handler->insert( $obj, true );
      
      
      
			if ( $ret ) {
				redirect_header( "contents.php?sort={$_REQUEST['sort']}", 1, _AM_FAQ_DBSUCCESS );
			}
		}
		$contents_handler->displayError( $ret );
		break;
    
	case 'save_list':
//echoA($_REQUEST);exit;
    if (isset($_REQUEST['update'])){
      if (!xoopsfaq_getPermission(_FAQ_PERM_FAQ, _FAQ_PERM_EDIT, true)) 
         redirect_header(_FAQ_URL_ADMIN_FAQ ,3,_NOPERM);
         
        foreach($_REQUEST['answers']  as $contents_id=>$item)
        {
            //mise à jour
            $obj = $contents_handler->get( $contents_id );
            $obj->setVar( 'contents_weight',  $item['contents_weight']);
            $obj->setVar( 'contents_cid',  $item['contents_cid']);
            //$ret = $contents_handler->update( $obj, true );
            $ret = $contents_handler->insert( $obj, false );
        } 
        
    }elseif(isset($_REQUEST['delete'])){
      if (!xoopsfaq_getPermission(_FAQ_PERM_FAQ, _FAQ_PERM_DELETE, true)) 
         redirect_header(_FAQ_URL_ADMIN_FAQ ,3,_NOPERM);
         
  			xoops_cp_header();
  			xoopsFaq_DisplayHeading( _AM_FAQ_CONTENTS_HEADER, _AM_FAQ_CATEGORY_DELETE_DSC, false );
        $t = implode('|',array_keys($_REQUEST['del_answers']));    
  			xoops_confirm( array( 'op' => 'delete_list', 'contents_id' => $t, 'ok' => 1 ), 'contents.php', _AM_FAQ_RUSURECAT );
        // echoA($_REQUEST,'save_list',true);
         break;
    }
      
    $ret = true;
      
		if ( $ret ) {
			redirect_header( 'contents.php', 1, _AM_FAQ_DBSUCCESS );
		}

		$contents_handler->displayError( $ret );
		break;

	case 'delete_list':
    //echoA($_REQUEST,"delete_list",true);
    if (!xoopsfaq_getPermission(_FAQ_PERM_FAQ, _FAQ_PERM_DELETE, true)) redirect_header("" ,3,_NOPERM);
        $t = explode('|', $_REQUEST['contents_id']);
        //foreach($_REQUEST['del_answers']  as $contents_id)
        for($h=0; $h<count($t); $h++)  
        {
            $contents_id = $t[$h];
            //supression par lot
            $sql = sprintf( 'DELETE FROM %s WHERE contents_id = %u', $xoopsDB->prefix( 'xoopsfaq_contents' ), $contents_id );
            $xoopsDB->query( $sql );
            // delete comments
            xoops_comment_delete( $xoopsModule->getVar( 'mid' ), $contents_id );
        } 
    //echoA($_REQUEST,"delete_list",true);
     $ret = true;
			if ( $ret ) {
				redirect_header( 'contents.php', 1, _AM_FAQ_DBSUCCESS );
			}
		break;
  


	case 'default':
	default:
		xoops_cp_header();
//		xoopsFaq_AdminMenu( 0 );

    $index_admin = new ModuleAdmin();
    //echo $index_admin->addNavigation(_FAQ_DIRNAME);
    if (xoopsfaq_getPermission(_FAQ_PERM_FAQ, _FAQ_PERM_ADD, true)) {
      $url = _FAQ_URL .'/admin/'. basename( $_SERVER['SCRIPT_FILENAME'] ) . '?op=add&value=' . _AM_FAQ_CREATENEW ;
      $index_admin->addItemButton(_ADD, $url, 'add',"");
      echo  $index_admin->renderButton('right', '');
    }

		xoopsFaq_DisplayHeading( _AM_FAQ_CONTENTS_HEADER, _AM_FAQ_CONTENTS_LIST_DSC, false );
		$contents_handler->displayAdminListing();
		break;
}
xoopsFaq_cp_footer();

?>