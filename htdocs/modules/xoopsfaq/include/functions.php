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
 * @author John Neill
 * @version $Id: functions.php 0000 10/04/2009 09:03:22 John Neill $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );
include_once 'constantes.php';


/**
 * xoopsFaq_CleanVars()
 *
 * @return
 */
function xoopsFaq_CleanVars( &$global, $key, $default = '', $type = 'int' ) {
	switch ( $type ) {
		case 'string':
			$ret = ( isset( $global[$key] ) ) ? filter_var( $global[$key], FILTER_SANITIZE_MAGIC_QUOTES ) : $default;
			break;
		case 'int':
		default:
			$ret = ( isset( $global[$key] ) ) ? filter_var( $global[$key], FILTER_SANITIZE_NUMBER_INT ) : $default;
			break;
	}
	if ( $ret === false ) {
		return $default;
	}
	return $ret;
}

/**
 * xoopsFaq_displayHeading()
 *
 * @param mixed $value
 * @return
 */
function xoopsFaq_DisplayHeading( $heading = '', $subheading = '', $showbutton = true ) {
	$ret = '';

	if ( !empty( $heading ) ) {
		$ret .= '<h4>' . $heading . '</h4>';
	}

	if ( !empty( $subheading ) ) {
		$ret .= '<div style="text-align: left; margin-bottom: 5px; margin-left: 5px;">' . $subheading . '</div><br />';
	}
	if ( $showbutton ) {
		$ret .= '<div style="text-align: right; margin-bottom: 10px;"><input type="button" name="button" onclick=\'location="' . basename( $_SERVER['SCRIPT_FILENAME'] ) . '?op=edit"\' value="' . _AM_FAQ_CREATENEW . '" /></div>';
	}
	echo $ret;
}

/**
 * xoopsFaq_cp_footer()
 *
 * @return
 */
function xoopsFaq_cp_footer() {
	global $xoopsModule;

	echo '<div style="padding-top: 16px; padding-bottom: 10px; text-align: center;">
		<a href="' . $xoopsModule->getInfo( 'website_url' ) . '" target="_blank">' . xoopsFaq_showImage( 'xoopsmicrobutton', '', '', 'gif' ) . '
		</a>
	</div>';
	xoops_cp_footer();
}

/**
 * xoopsFaq_showImage()
 *
 * @param string $name
 * @param string $title
 * @param string $align
 * @param string $ext
 * @param string $path
 * @param string $size
 * @return
 */
function xoopsFaq_showImage( $name = '', $title = '', $align = 'middle', $ext = 'png', $path = '', $size = '' ) {
	if ( empty( $path ) ) {
		$path = _FAQ_IMAGES . "/";
		//$path = XOOPS_URL . '/modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' ) . '/images';
	}
	if ( !empty( $name ) ) {
    if(file_exists(_FAQ_PATH . "/images/" . $name . '.' . $ext)){
       $fullpath = _FAQ_URL . "/images/" . $name . '.' . $ext;
    }elseif(file_exists( _FAQ_PW_ICONS_16 . $name . '.' . $ext)){ 
       $fullpath = _FAQ_FW_ICONS_16 . $name . '.' . $ext;
    }
    else{
       $fullpath = _FAQ_FW_ICONS_32 . $name . '.' . $ext;
   }

		$ret = '<img src="' . $fullpath . '" ';
		if ( !empty( $size ) ) {
			$ret = '<img src="' . $fullpath . '" ' . $size;
		}
		$ret .= ' title = "' . htmlspecialchars( $title ) . '"';
		$ret .= ' alt = "' . htmlspecialchars( $title ) . '"';
		if ( !empty( $align ) ) {
			$ret .= ' style="vertical-align: ' . $align . '; border: 0px;"';
		}
		$ret .= ' />';
		return $ret;
	} else {
		return '';
	}
}

/**
 * xoopsFaq_getIcons()
 *
 * @param array $_icon_array
 * @param mixed $key
 * @param mixed $value
 * @param mixed $extra
 * @return
 */
function xoopsFaq_getIcons( $_icon_array = array(), $key, $value = null, $extra = null ) {
	$ret = '';
  //$sep = "z<div style='position:relative;width:120px;'></div>";
  $sep = "&nbsp;&nbsp;&nbsp;";     
	if ( $value ) {
		foreach( $_icon_array as $_op => $icon ) {     
			$url = ( !is_numeric( $_op ) ) ? $_op . "?{$key}=" . $value : xoops_getenv( 'PHP_SELF' ) . "?op={$icon}&amp;{$key}=" . $value;
			if ( $extra != null ) {
			}
			$ret .= $sep .  '<a href="' . $url . '">' . xoopsFaq_showImage( $icon, xoopsFaq_getConstants($icon , '_AM_FAQ_'), null, 'png' ) . '</a>';
			 
		}
	}      
     
  $ret = $ret . $sep;
	return $ret;
}

/**
 * xoopsFaq_getConstants()
 *
 * @param mixed $_title
 * @param string $prefix
 * @param string $suffix
 * @return
 */
function xoopsFaq_getConstants( $_title, $prefix = '', $suffix = '' ) {

  	$prefix = ( $prefix != '' || $_title != 'action' ) ? trim( $prefix ) : '';
  	$suffix = trim( $suffix );
  	$name = strtoupper( "$prefix$_title$suffix" );

    if(!defined($name)) {
      $name = strtoupper( "_" . $_title );
    }
  	return constant($name);
}

/**
 * wfp_isEditorHTML()
 *
 * @return
 */
function xoopsFaq_isEditorHTML() {
	if ( isset( $GLOBALS['xoopsModuleConfig']['use_wysiwyg'] ) && in_array( $GLOBALS['xoopsModuleConfig']['use_wysiwyg'], array( 'tinymce', 'fckeditor', 'koivi', 'inbetween', 'spaw' ) ) ) {
		return true;
	}
	return false;
}


/***
 *
 **/
function xoopsFaq_checkModuleAdmin()
{
  $f = $GLOBALS['xoops']->path('/Frameworks/moduleclasses/moduleadmin/moduleadmin.php');
  if ( file_exists($f)){
    include_once $f;
    return true;
  }else{
    echo xoops_error("Error: You don't use the Frameworks \"adminmodule\". Please install this Frameworks");
    return false;
    }
}

/****************************************************************
 *  Transformation de la date fr -> en 
 ****************************************************************/
function xoopsFaq_transformDate2Local($mydate){

  if ($GLOBALS['xoopsConfig']['language']=="french") 

  {
    if(isset($mydate['date']))
    {
      @list($jour,$mois,$annee)=explode('/',$mydate['date']);
      $mydate['date'] = @date('Y-m-d',mktime(0,0,0,$mois,$jour,$annee));
    }else{
      @list($jour,$mois,$annee)=explode('/',$mydate);
      $mydate = @date('Y-m-d',mktime(0,0,0,$mois,$jour,$annee));
    }
  }  
  return $mydate;

}


/*******************************************************************
 *
 ********************************************************************/
 function xoopsFaq_getBtnForUserInterface($addUpBtn = false)
 {
 
 $btn = array();   
 $perms = xoopsfaq_getAPermissions(_FAQ_PERM_FAQ);
 $url_module = _FAQ_URL;       
      
 //echoA($perms,'interface-' . _FAQ_PERM_FAQ);
 //----------------------------------------------------
 if ( $perms[_FAQ_PERM_PRINT])
 {
   $b = array('icone'=>_FAQ_PRINTER, 
              'title'=> _MD_FAQ_PRINTER,  
              'url'=> $url_module ."/print-faq/xoopsfaq_print.php?op=print&contents_id=",
              'onclick' => 1,
              'action'=>'onclick');
   $btn[] = $b;
 }
 
 //----------------------------------------------------
//     <a target="_top" href="<{$mail_link|xoops_tellafriend}>">
 if ( $perms[_FAQ_PERM_MAILTO] && xoopsfaq_isTellafriend())
 {
   $b = array('icone'=>_FAQ_MAIL, 
              'title'=> _MI_FAQ_MAILTO,  
              //'url'=>$url_module ."/index.php?cat_id=1#q",
              'url'=>$url_module ."/index.php?cat_id=idCategorie#qidContents",
              //'url'=>'https://"ssss' ."/index.php?cat_id=idCategorie#qidContents",
              //'url'=> str_replace("://", 'xxx', $url_module)."/index.php?cat_id=idCategorie#qidContents",
              'action'=>'mailto');       
   $btn[] = $b;
 }
 //----------------------------------------------------
//  $b = array('icone'=>_FAQ_ATTACH,  
//             'title'=> _ATTACH, 
//             'url'=>XOOPS_URL ."?op=attach");
//  $btn[] = $b;
 
                                   
 //----------------------------------------------------
 if ( $perms[_FAQ_PERM_EDIT])
 {
    $b = array('icone'=>_FAQ_EDIT,    
               'title'=> _EDIT,   
               'url'=>$url_module ."/admin/contents.php?op=edit&contents_id=",
               'action'=>'');
     $btn[] = $b;
 }
     
 //----------------------------------------------------
 if ( $perms[_FAQ_PERM_ADD])
 {
  $b = array('icone'=>_FAQ_ADD,     
              'title'=> _ADD,    
              'url'=>$url_module . "/admin/contents.php?op=add&value=Cr%C3%A9er%20nouvel%20item",
               'action'=>'');
   $btn[] = $b;
 }
 
 
     //----------------------------------------------------
 if ( $perms[_FAQ_PERM_DELETE])
 {
     $b = array('icone'=>_FAQ_DELETE,  
                'title'=> _DELETE, 
                'url'=>$url_module ."/admin/contents.php?op=delete&contents_id=",
               'action'=>'');
     $btn[] = $b;
 }
 
     //----------------------------------------------------
 if ( $addUpBtn )
 {            
     $b = array('icone'=>_FAQ_UP,  
                'title'=> _MD_FAQ_BACKTOTOP, 
                'url'=> "#top",
                'top_page'=> 1,
                'action'=>'top_page');
     $btn[] = $b;
 }
     //----------------------------------------------------
 return $btn;
  
}
 
/************************************************************
 *
 ***********************************************************/
 function echoA($t, $title='', $bexit = false)
 {
  if ($title != '')
  {
    echo "===>" . $title;
  }
  $r = print_r($t, true);
  echo "<pre>".$r."</pre>";
  
  if ($bexit) exit;
 }   
  
/************************************************************
 *
 ***********************************************************/

function xoopsfaq_getURL($link)
  {
    if ($link=='') return $link;
    if (substr($link, 0, 7) != 'http://' && substr($link, 0, 8) != 'https://')
    {
      $link = 'http://' . $link;
    }
  	return  $link;
	}   

/************************************************************
 *
 ***********************************************************/

function xoopsfaq_getPermissions()
{   
global $xoopsUser,$xoopsModule,$xoopsmod,$xoopsModuleConfig;
$bolOk = 0;

  if ( $xoopsUser ) {
      $userGroups = array_values($xoopsUser->getGroups());
      
      //--- autorisation de supprimer (a completer eventuellement comme pour la suppression)
      $bolOk = 1; 
      
      //--- autorisation de supprimer
      $moduleGroups = $xoopsModuleConfig['delete_allowed'];
      $g = array_intersect($userGroups,$moduleGroups);
      if (count($g)>0)  $bolOk = $bolOk | 2;
      
//       echoA($g);
//       echoA($userGroups,'user');
//       echoA($moduleGroups,'module');
      
      return $bolOk;

  } else {
  	return $bolOk;
  }
}

/******************************************************************
 *
 ******************************************************************/ 
function xoopsfaq_getPermission($permName, $perm_itemid, $trueifadmin = true){
global $xoopsModule, $xoopsUser;  
  /* --------------------------------------------------------- */
  $mid = $xoopsModule->getVar('mid');
  //$userGroups = array_values($xoopsUser->getGroups());
  $userGroups =  $xoopsUser->getGroups();
 //$userGroups  = array(4);
  $gperm_handler =& xoops_gethandler('groupperm');
  $gPerm = $gperm_handler->checkRight( $permName, $perm_itemid, $userGroups, $mid, $trueifadmin);
// echoA($userGroups);  
// echo "<br>===>mid:{$mid} - permission = {$permName}-{$perm_itemid} = " . ($gPerm ? 1 : 0);

  return ($gPerm) ? 1 : 0;
  
}
/******************************************************************
 *
 ******************************************************************/ 
function xoopsfaq_getAPermissions($permName, $trueifadmin = true){ 
global $xoopsModule, $xoopsUser;  
    
  $mid = $xoopsModule->getVar('mid');
  $userGroups =  $xoopsUser->getGroups();
  $gperm_handler =& xoops_gethandler('groupperm');
 //$userGroups  = array(5);
 //  echoA($userGroups,'grp');
  
    $t = array();
    for ($h=1; $h<_FAQ_PERM_NB; $h++)
    {
      $gPerm = $gperm_handler->checkRight( $permName, $h, $userGroups, $mid, $trueifadmin);
      $t[$h] = ($gPerm ? 1 : 0);
    }

  /* --------------------------------------------------------- */
  //$userGroups = array_values($xoopsUser->getGroups());
 //$userGroups  = array(4);
//echoA($t);  
  return $t;
}




/************************************************************
 *
 ***********************************************************/

function xoopsfaq_isAdminXoops()
{                              
global $xoopsUser,$xoopsModule,$xoopsmod,$xoopsModuleConfig;
$bolOk = false;

  if ( $xoopsUser ) {
      $userGroups = array_values($xoopsUser->getGroups());
      $g = array_intersect($userGroups,array(1));
      if (count($g)>0)  $bolOk = true;
  }
  return $bolOk;

}

/************************************************************
 *
 ***********************************************************/


function xoopsfaq_isAdminModule()
{
global $xoopsUser,$xoopsModule,$xoopsmod;
$bolOk = false;
  if ( $xoopsUser ) {
    //echo "<hr>"._FAQ_DIRNAME."<hr>";
  	$xoopsModule = XoopsModule::getByDirname(_FAQ_DIRNAME);
  	$bolOk =  $xoopsUser->isAdmin($xoopsModule->mid()) ;
  }
  return $bolOk;
}


/************************************************************
 *
 ***********************************************************/
function xoopsfaq_isTellafriend()
{
  if (!is_readable(XOOPS_ROOT_PATH . "/class/smarty/plugins/modifier.xoops_tellafriend.php"))  {
    return false;
  }
  //---------------------------------------------------
  if (!is_readable(XOOPS_ROOT_PATH . "/modules/tellafriend"))  {
    return false;
  }
  //---------------------------------------------------
	$module_handler =& xoops_gethandler('module');
	$this_module =& $module_handler->getByDirname('tellafriend');
  if($this_module){
     //$mid = $this_module->getVar('mid');
//     echo "<hr>tellafriend = {$mid}<hr>";
//     echoA($this_module);
     return ($this_module->getVar('isactive')==1);
  }
  return false;
}


?>