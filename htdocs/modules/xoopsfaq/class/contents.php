<?php
/**
 * Name: contents.php
 * Description: Xoops FAQ Contents Class
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
 * @subpackage : Contents Class
 * @since 2.5.7
 * @author John Neill
 * @version $Id: contents.php 0000 10/04/2009 09:01:12 John Neill $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

/**
 * XoopsfaqContents
 *
 * @package
 * @author John
 * @copyright Copyright (c) 2009
 * @version $Id$
 * @access public
 */
class XoopsfaqContents extends XoopsObject {
	/**
	 * XoopsfaqContents::__construct()
	 */
	function __construct() {
		$this->XoopsObject();
		$this->initVar( 'contents_id', XOBJ_DTYPE_INT, null, false );
		$this->initVar( 'contents_cid', XOBJ_DTYPE_INT, 0, false );
		$this->initVar( 'contents_title', XOBJ_DTYPE_TXTBOX, null, true, 255 );
		$this->initVar( 'contents_contents', XOBJ_DTYPE_TXTAREA, null, false );
		$this->initVar( 'contents_publish', XOBJ_DTYPE_INT, time(), false );
		$this->initVar( 'contents_weight', XOBJ_DTYPE_INT, 0, false );
		$this->initVar( 'contents_active', XOBJ_DTYPE_INT, 1, false );
		$this->initVar( 'dohtml', XOBJ_DTYPE_INT, 0, false );
		$this->initVar( 'doxcode', XOBJ_DTYPE_INT, 1, false );
		$this->initVar( 'dosmiley', XOBJ_DTYPE_INT, 1, false );
		$this->initVar( 'doimage', XOBJ_DTYPE_INT, 1, false );
		$this->initVar( 'dobr', XOBJ_DTYPE_INT, 1, false );
		$this->initVar( 'contents_answer', XOBJ_DTYPE_TXTBOX, null, false, 255 );
		$this->initVar( 'contents_seealso1', XOBJ_DTYPE_TXTBOX, null, false, 255 );
		$this->initVar( 'contents_libseealso1', XOBJ_DTYPE_TXTBOX, null, false, 50 );
		$this->initVar( 'contents_seealso2', XOBJ_DTYPE_TXTBOX, null, false, 255 );
		$this->initVar( 'contents_libseealso2', XOBJ_DTYPE_TXTBOX, null, false, 50 );
		$this->initVar( 'contents_seealso3', XOBJ_DTYPE_TXTBOX, null, false, 255 );
		$this->initVar( 'contents_libseealso3', XOBJ_DTYPE_TXTBOX, null, false, 50 );
	}

	/**
	 * XoopsfaqContents::XoopsfaqContents()
	 */
	function XoopsfaqContents() {
		$this->__construct();
	}

	/**
	 * XoopsfaqContents::displayForm()
	 *
	 * @return
	 */
	function displayForm() {
		global $xoopsModuleConfig;

    if (!xoopsfaq_getPermission(_FAQ_PERM_FAQ, _FAQ_PERM_EDIT, true)) {
//     redirect_header( 'contents.php', 1, _AM_FAQ_DBSUCCESS );
//       redirect_header(XOOPS_URL."/",3,_NOPERM);
//       if ($xoopsUser) {             $_SERVER['HTTP_REFERER']
//     $url_arr = explode('/', strstr($_SERVER['REQUEST_URI'], '/modules/'));
//      redirect_header(strstr($_SERVER['REQUEST_URI']) ,3,_NOPERM);
      

    };
    
		$category_handler = &xoops_getModuleHandler( 'category' );
		if ( !$category_handler->getCount() ) {
			xoops_error( _AM_FAQ_ERRORNOCAT, $title = '' );
			xoops_cp_footer();
			exit();
		}

		include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

		$caption = ( $this->isNew() ) ? _AM_FAQ_CREATENEW: sprintf( _AM_FAQ_MODIFYITEM, $this->getVar( 'contents_title' ) );
		$form = new XoopsThemeForm( $caption, 'content', $_SERVER['REQUEST_URI'] );
		$form->addElement( new XoopsFormHiddenToken() );
		$form->addElement( new xoopsFormHidden( 'op', 'save' ) );
		$form->addElement( new xoopsFormHidden( 'contents_id', $this->getVar( 'contents_id', 'e' ) ) );
		// title
		$category_handler = &xoops_getModuleHandler( 'category' );
		$objects = $category_handler->getList();      
		$contents_cid = new XoopsFormSelect( _AM_FAQ_CONTENTS_CATEGORY, 'contents_cid', $this->getVar( 'contents_cid', 'e' ), 1, false );
		$contents_cid->setDescription( _AM_FAQ_CONTENTS_CATEGORY_DSC );
		$contents_cid->addOptionArray( $objects );
		$form->addElement( $contents_cid );

		$contents_title = new XoopsFormText( _AM_FAQ_CONTENTS_TITLE, 'contents_title', 50, 150, $this->getVar( 'contents_title', 'e' ) );
		$contents_title->setDescription( _AM_FAQ_CONTENTS_TITLE_DSC );
		$form->addElement( $contents_title, true );
		
		$contents_answer = new XoopsFormText( _AM_FAQ_CONTENTS_ANSWER, 'contents_answer', 50, 250, $this->getVar( 'contents_answer', 'e' ) );
		$contents_answer->setDescription( _AM_FAQ_CONTENTS_ANSWER_DSC );
		$form->addElement($contents_answer , false );
		
    $seealso = array();
    $libseealso = array();
    $contents_seealso = array();
    for ($k=1;$k<4;$k++)
    {
      $name = 'contents_seealso' . $k;
      
  		$seealso[$k] = new XoopsFormText( _AM_FAQ_CONTENTS_URL, $name, 100, 250, $this->getVar( $name, 'e' ) );
  		//$seealso[$k]->setDescription( _AM_FAQ_CONTENTS_SEEALSO_DSC );
  		//$form->addElement($seealso[$k] , false );
      
      $name = 'contents_libseealso' . $k;
  		$libseealso[$k] = new XoopsFormText( _AM_FAQ_CONTENTS_LIBSEEALSO, $name, 30, 50, $this->getVar( $name, 'e' ) );
  		//$libseealso[$k]->setDescription( _AM_FAQ_CONTENTS_LIBSEEALSO_DSC );
  		//$form->addElement($libseealso[$k] , false );
      
      $name  = "seealso" . $k;
    //$seealso[$k] = new XoopsFormElementTable( 'zzz');
     $contents_seealso[$k] = new XoopsFormElementTray(_AM_FAQ_CONTENTS_SEEALSO . " n&deg; " . $k);
  	 $contents_seealso[$k]->setDescription( _AM_FAQ_CONTENTS_SEEALSO_DSC );
     $contents_seealso[$k]->addElement($seealso[$k]);      
     $contents_seealso[$k]->addElement($libseealso[$k]);      
     $form->addElement($contents_seealso[$k], false);     
      
    }
 
//---------------------------------------------------------------------- 
//    $k = "depot_legal";
//   //$t[$k] = $this->myts->htmlspecialchars($t[$k]);
//   $depot_legal = new XoopsFormText(_CC_MED_DEPOT_LEGAL, sprintf($xName,$k), 30, 30, $t[$k]);      
//   //$form->addElement($xf[$k], false);     
//   
//   $k = "annee_sortie";
//   $annee_sortie = new XoopsFormText(_AM_MED_ANNEE_SORTIE, sprintf($xName,$k), 30, 30, $t[$k]);      
//   
//   $k = "edition";
//     $xf[$k] = new XoopsFormElementTable(_CC_MED_EDITION);
//     $xf[$k]->	addElement($dEditeur,null,true,250);      
//     $xf[$k]->	addElement($depot_legal,null,true,250);      
//     $xf[$k]->	addElement($annee_sortie,null,true,250);      
//     //$xf[$k]->	addElement($annee_sortie,null,true,250);      
//     $form->addElement($xf[$k], false);     
//-----------------------------------------------------------------
 
 
 
   
    // Ajout des groupes
   //---groupes
   /*
    $groups = new XoopsFormSelectGroup(_MI_FAQ_XOOPSFAQ_GROUPES, 'groups', false, '', 8, true) ; 
    $groups->setdescription(_MI_FAQ_XOOPSFAQ_GROUPES_DSC);
    $form->addElement($groups, true); 
    */
   
    
    /**
		 */
		$options_tray = new XoopsFormElementTray( _AM_FAQ_CONTENTS_CONTENT, '<br />' );
		if ( class_exists( 'XoopsFormEditor' ) ) {
			$options['name'] = 'contents_contents';
			$options['value'] = $this->getVar( 'contents_contents', 'e' );
			$options['rows'] = 25;
			$options['cols'] = '100%';
			$options['width'] = '100%';
			$options['height'] = '600px';
			$contents_contents = new XoopsFormEditor( '', $xoopsModuleConfig['use_wysiwyg'], $options, $nohtml = false, $onfailure = 'textarea' );
			$options_tray->addElement( $contents_contents );
		} else {
			$contents_contents = new XoopsFormDhtmlTextArea( '', 'contents_contents', $this->getVar( 'contents_contents', 'e' ), '100%', '100%' );
			$options_tray->addElement( $contents_contents );
		}

		if ( false == xoopsFaq_isEditorHTML() ) {
			if ( $this->isNew() ) {
				$this->setVar( 'dohtml', 0 );
				$this->setVar( 'dobr', 1 );
			}
			/**
			 */
			$html_checkbox = new XoopsFormCheckBox( '', 'dohtml', $this->getVar( 'dohtml', 'e' ) );
			$html_checkbox->addOption( 1, _AM_FAQ_DOHTML );
			$options_tray->addElement( $html_checkbox );
			/**
			 */
			$breaks_checkbox = new XoopsFormCheckBox( '', 'dobr', $this->getVar( 'dobr', 'e' ) );
			$breaks_checkbox->addOption( 1, _AM_FAQ_BREAKS );
			$options_tray->addElement( $breaks_checkbox );
		} else {
			$form->addElement( new xoopsFormHidden( 'dohtml', 1 ) );
			$form->addElement( new xoopsFormHidden( 'dobr', 0 ) );
		}

		/**
		 */
		$doimage_checkbox = new XoopsFormCheckBox( '', 'doimage', $this->getVar( 'doimage', 'e' ) );
		$doimage_checkbox->addOption( 1, _AM_FAQ_DOIMAGE );
		$options_tray->addElement( $doimage_checkbox );
		/**
		 */
		$xcodes_checkbox = new XoopsFormCheckBox( '', 'doxcode', $this->getVar( 'doxcode', 'e' ) );
		$xcodes_checkbox->addOption( 1, _AM_FAQ_DOXCODE );
		$options_tray->addElement( $xcodes_checkbox );
		/**
		 */
		$smiley_checkbox = new XoopsFormCheckBox( '', 'dosmiley', $this->getVar( 'dosmiley', 'e' ) );
		$smiley_checkbox->addOption( 1, _AM_FAQ_DOSMILEY );
		$options_tray->addElement( $smiley_checkbox );
		$form->addElement( $options_tray );
                                                
		$contents_publish = new XoopsFormTextDateSelect( _AM_FAQ_CONTENTS_PUBLISH, 'contents_publish', 20, $this->getVar( 'contents_publish' ), $this->isNew() );
		$contents_publish->setDescription( _AM_FAQ_CONTENTS_PUBLISH_DSC );
		$form->addElement( $contents_publish );

		$contents_weight = new XoopsFormText( _AM_FAQ_CONTENTS_WEIGHT, 'contents_weight', 5, 5, $this->getVar( 'contents_weight', 'e' ) );
		$contents_weight->setDescription( _AM_FAQ_CONTENTS_WEIGHT_DSC );
		$form->addElement( $contents_weight, false );

		$contents_active = new XoopsFormRadioYN( _AM_FAQ_CONTENTS_ACTIVE, 'contents_active', $this->getVar( 'contents_active', 'e' ), ' ' . _YES . '', ' ' . _NO . '' );
		$contents_active->setDescription( _AM_FAQ_CONTENTS_AVTIVE_DSC );
		$form->addElement( $contents_active );
    
		$form->addElement( new XoopsFormButton( '', 'submit', _SUBMIT, 'submit' ) );
		$form->display();
	}

	/**
	 * XoopsfaqContents::getActive()
	 *
	 * @return
	 */
	function getActive() {
		return $this->getVar( 'contents_active' ) ? _YES : _NO;
	}
	function getActiveIcone($sort='', $order='') {
    $active = $this->getVar( 'contents_active' );
    $img = ($active==1) ? _FAQ_ON : _FAQ_OFF;
    $url = _FAQ_URL . '/admin/contents.php?op=active&contents_id='.$this->getVar( 'contents_id' ).'&contents_active='  . (($active==1) ? 0 : 1)."&sort={$sort}&order={$order}";
    $html = "<a href='".$url."'><img src='".$img."' title='' alt=''></a>";
    //echo '===>'.$url;exit;
		return $html;
	}


	function getPublished( $timestamp = '') {
		if ( !$this->getVar( 'contents_publish' ) ) {
			return '';
		}
     $timestamp = 'd-m-Y' ;
     if ($GLOBALS['xoopsConfig']['language']=="french") 
     {
        $timestamp = 'd-m-Y' ;
     }else{
        $timestamp = 'Y-m-d' ;
     }
		return formatTimestamp( $this->getVar( 'contents_publish' ), $timestamp );
	}
  
	function getSeealso($index=1, $mode=0 ) {
    if ($mode > 0)
    {
      $link = xoopsfaq_getURL($this->getVar( 'contents_seealso' . $index ));
//       $link = $this->getVar( 'contents_seealso' . $index );
      if ($link=='') return $link;
      //-----------------------------------------------
//       if (substr($link, 0, 7) != 'http://' && substr($link, 0, 8) != 'https://')
//       {
//         $link = 'http://' . $link;
//       }
      if ($mode==2){
        $link = sprintf("<a href='%1\$s' title='' target='blank'>%2\$s</a>", $link, _AM_FAQ_CONTENTS_SEEALSO);
//  		    echo "<hr>{$exp}<br>{$link}<hr>";
      }
    }
    
  	return  $link;
	}   
	function getLibseealso($index=1 ) {
  	return  $this->getVar('contents_libseealso' . $index );
	}   
  
	function getAnswer( ) {
  	return  $this->getVar( 'contents_answer' );
	}   
  
}

/**
 * XoopsfaqContentsHandler
 *
 * @package
 * @author John
 * @copyright Copyright (c) 2009
 * @version $Id$
 * @access public
 */
class XoopsfaqContentsHandler extends XoopsPersistableObjectHandler {
	/**
	 * XoopsfaqContentsHandler::__construct()
	 *
	 * @param mixed $db
	 */
	function __construct( &$db ) {
		parent::__construct( $db, 'xoopsfaq_contents', 'XoopsfaqContents', 'contents_id', 'contents_title', 'contents_answer' );  //jjD
	}

	/**
	 * XoopsfaqContentsHandler::XoopsfaqContentsHandler()
	 *
	 * @param mixed $db
	 */
	function XoopsfaqContentsHandler( &$db ) {
		$this->__construct( $db );
	}

	/**
	 * XoopsfaqContentsHandler::getObj()
	 *
	 * @return
	 */
	function &getObj($criteria = null) {
		$obj = false;
    
    if ( is_null($criteria)) {
		  //$criteria = new CriteriaCompo();
		  $criteria = new CriteriaCompo();
			$criteria->setSort('contents_cid ASC, contents_weight ASC, contents_title'  ); //  'contents_title ASC, contents_id' 

			$criteria->setStart( 0 );
			$criteria->setLimit( 0 );                   
		}      

		$obj['count'] = $this->getCount( $criteria );
		$obj['list'] = &$this->getObjects( $criteria, false );
		return $obj;
	}

	/**
	 * XoopsfaqContentsHandler::getObj()
	 *
	 * @return
	 */
	function &getPublished( $id = '', $criteria=null) {
		$obj = false;
		$criteria = new CriteriaCompo();
		if ( !empty( $id ) ) {
			$criteria->add( new Criteria( 'contents_cid', $id, '=' ) );
		}
		$criteria->add( new Criteria( 'contents_active', 1, '=' ) );
		$criteriaPublished = new CriteriaCompo();
		$criteriaPublished->add( new Criteria( 'contents_publish', 0, '>' ) );
		$criteriaPublished->add( new Criteria( 'contents_publish', time(), '<=' ) );
		$criteria->add( $criteriaPublished );

		$obj['count'] = $this->getCount( $criteria );
			$criteria->setSort( 'contents_title ASC, contents_id' );     
			$criteria->setOrder( 'ASC' );
// 		if ( is_null($criteria)) {
			$criteria->setSort( 'contents_weight ASC, contents_title' );  //  contents_title 
			$criteria->setOrder( 'ASC' );
// 			$criteria->setStart( 0 );
// 			$criteria->setLimit( 0 );
// 		}
//exit;
		$obj['list'] = &$this->getObjects( $criteria, false );
		return $obj;
	}
    
	/**
	 * XoopsfaqContentsHandler::build_url_title($field, $oldField, $order, $title, $style)
	 * @param string $field 
	 * @param string $oldField 
	 * @param string $order 
	 * @param string $title 
	 * @param string $style
	 * @return string
	 */
	function build_url_title($field, $oldField, $order, $title, $style) {  
    
    if ($field == $oldField) {
      $order = ($order=='ASC' || $order=='' ) ? 'DESC' : 'ASC';
      $img = "<img src='" . _FAQ_FW_ICONS_16 . '/' . $order . ".png" . "' title='' alt=''>";
    }else{
      $order = '';
      $img = ""; 
    }
    $url = _FAQ_URL . '/admin/contents.php';
    $tpl = "<th style='%4\$s'><a href='{$url}?sort=%1\$s&order=%2\$s'>%3\$s%5\$s</a>";
    $link = sprintf($tpl, $field, $order, $title, $style, $img);  
    return $link;
  }
		 
	
  function displayAdminListing() {
  /*
  */
	global $xoopsUser;
  $groups =& $xoopsUser->getGroups();
  $count = count($groups);
//   for ($i = 0; $i < $count; ++$i) {
//     $sql = "INSERT INTO ".$db->prefix('group_permission')." (gperm_groupid, gperm_itemid, gperm_modid, gperm_name) VALUES (".$groups[$i].", ".$newid.", 1, 'block_read')";
//     $db->query($sql);
//   }

  
  
  
// $t=print_r($_REQUEST,true);
// echo "<pre>'{$t}</pre>";  
    if(!isset($_REQUEST['sort'])) $_REQUEST['sort']='contents_title';
    if(!isset($_REQUEST['order'])) $_REQUEST['order']='ASC';

    if ($_REQUEST['sort'] != '')
    {
		  $criteria = new CriteriaCompo();
			$criteria->setSort( $_REQUEST['sort']); 
      $criteria->setOrder($_REQUEST['order']);
			//$criteria->setSort( $_REQUEST['sort'], $_REQUEST['order']); 
      //			$criteria->setSort( $_REQUEST['sort'] . ' ' . $_REQUEST['order'] ); 

		}else{
      $criteria=null;
    }    
  
		$objects = $this->getObj($criteria);     
		$buttons = array( 'edit', 'delete' );
    $url = _FAQ_URL . '/admin/contents.php';
    $link="<a href='{$url}?sort=%1\$s&order=%2\$s'>%3\$s</a>'";
    $title = array();
                

		 	$title[] = $this->build_url_title('contents_id', $_REQUEST['sort'],  $_REQUEST['order'], _AM_FAQ_CONTENTS_ID, 'width: 5%;');
		 	$title[] = $this->build_url_title('contents_title', $_REQUEST['sort'],  $_REQUEST['order'], _AM_FAQ_CONTENTS_TITLE, 'text-align: left;');
		 	$title[] = $this->build_url_title('contents_answer', $_REQUEST['sort'],  $_REQUEST['order'], _AM_FAQ_CONTENTS_ANSWER, '');
		 	$title[] = $this->build_url_title('contents_active', $_REQUEST['sort'],  $_REQUEST['order'], _AM_FAQ_CONTENTS_ACTIVE, '');
		 	$title[] = $this->build_url_title('contents_cid', $_REQUEST['sort'],  $_REQUEST['order'], _AM_FAQ_CATEGORIES, '');
		 	$title[] = $this->build_url_title('contents_weight', $_REQUEST['sort'],  $_REQUEST['order'], _AM_FAQ_CONTENTS_WEIGHT, 'width: 5%;');
		 	$title[] = $this->build_url_title('contents_publish', $_REQUEST['sort'],  $_REQUEST['order'], _AM_FAQ_CONTENTS_PUBLISH, '');

		 	$title[] = "<th style='width: 20%;'>" . _AM_FAQ_ACTIONS . "</th>";


    
		$ret = "<form action='contents.php?op=save_list' method='post'>";
		$ret .= "<table width='100%' border='0' cellpadding='2' cellspacing='1' class='outer'>
		 <tr class='xoopsCenter'>" . implode('', $title) . "</tr>";
// 		 	<th>" . _AM_FAQ_CONTENTS_SEEALSO . "</th>
		if ( $objects['count'] > 0 ) {
			foreach( $objects['list'] as $object ) {
        $contents_id = $object->getVar( 'contents_id' );
        //$img = ($object->getVar( 'contents_active' )==1) ? $imgOn : $imgOff;
        $name= "answers[{$contents_id}][contents_weight]";
        //echo $name.'<br />';

        $txtOrder = "<input type='text' name='{$name}' id='{$name}' size='5' maxlength='5' value='".$object->getVar( 'contents_weight' )."' >";
        
				$ret .= "<tr class='xoopsCenter'>";
				$ret .= "<td class='even' style='text-align:center;'>" . $contents_id . "</td>";
				$ret .= "<td style='text-align: left;' class='even'>" . $object->getVar( 'contents_title' ) . "</td>";
				$ret .= "<td class='even'>" . $object->getAnswer() . "</td>";
				$ret .= "<td class='even' style='text-align:center;'>" . $object->getActiveIcone($_REQUEST['sort']) . "</td>";
 //--------------------------------------------------------------------------------------------   
 /*
 */    
include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
		$category_handler = &xoops_getModuleHandler( 'category' );
		$catList = $category_handler->getList();      
    $nameCid= "answers[{$contents_id}][contents_cid]";
		$contents_cid = new XoopsFormSelect( _AM_FAQ_CONTENTS_CATEGORY, $nameCid, $object->getVar( 'contents_cid', 'e' ), 1, false );
		$contents_cid->setDescription( _AM_FAQ_CONTENTS_CATEGORY_DSC );
		$contents_cid->addOptionArray( $catList );
		//$form->addElement( $contents_cid );
				$ret .= "<td class='even' style='text-align:center;'>". $contents_cid->render() ."</td>";
 //--------------------------------------------------------------------------------------------       
				$ret .= "<td class='even' style='text-align:center;'>" . $txtOrder . "</td>";  // .$object->getVar( 'contents_weight' )
				$ret .= "<td class='even' style='text-align:center;'>" . $object->getPublished() . "</td>";
					//<td class='even'><a href='".$object->getSeealso(1)."' target='blank'>" . $object->getSeealso(1) . "</a></td>
          
          
          
				$ret .= "<td class='even' style='text-align:center;'>";       
				$ret .= xoopsFaq_getIcons( $buttons, 'contents_id', $object->getVar( 'contents_id' ), $extra = null );
/*
*/        
      $nameDel = "del_answers[{$contents_id}]";  //  [delete]
			$contents_del = new XoopsFormCheckBox( '', $nameDel, 0 );
			$contents_del->addOption( 1, _DELETE );
			//$options_tray->addElement( $html_checkbox );
				$ret .= $contents_del->render();
        
        
        $ret .= "</td>";
				$ret .= "</tr>";
			}
		} else {
			$ret .= "<tr style='text-align: center;'><td colspan='9' class='even'>" . _AM_FAQ_NOLISTING . "</td></tr>";
		}
		$ret .= "<tr style='text-align: center;'><td colspan='9' class='head'>"
         ."<input type='submit' name='update' id='update' value='"._AM_FAQ_UPDATE_BY_SET."'>"
         ."<input type='submit' name='delete' id='delete' value='"._AM_FAQ_DELETE_BY_SET."'></td></tr>";

		$ret .= "</table>";
    //$ret .= " <input type='submit' value='Submit'> ";
		$ret .= "</form >";
		echo $ret;
	}

	/**
	 * XoopsfaqContentsHandler::DisplayError()
	 *
	 * @return
	 */
	function displayError( $errorString = '' ) {
		xoops_cp_header();
//		xoopsFaq_AdminMenu( 0 );
		xoopsFaq_DisplayHeading( _AM_FAQ_CONTENTS_HEADER, '', false );
		xoops_error( $errorString, _AM_FAQ_FAQ_SUBERROR );
		xoops_cp_footer();
		exit();
	}
}

?>