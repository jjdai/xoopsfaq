<?php
/**
 * Name: category.php
 * Description: Xoops FAQ Category Class
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
 * @subpackage : Xoops FAQ Category
 * @since 2.5.7
 * @author John Neill
 * @version $Id: category.php 0000 10/04/2009 08:59:26 John Neill $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

/**
 * XoopsfaqCategory
 *
 * @package Xoops FAQ
 * @author John Neill
 * @copyright Copyright (c) 2009
 * @version $Id$
 * @access public
 */
class XoopsfaqCategory extends XoopsObject {
	/**
	 * XoopsfaqCategory::__construct()
	 */
	function __construct() {
		$this->XoopsObject();
		$this->initVar( 'category_id', XOBJ_DTYPE_INT, null, false );
		$this->initVar( 'category_title', XOBJ_DTYPE_TXTBOX, null, true, 255 );
		$this->initVar( 'category_order', XOBJ_DTYPE_INT, 0, false );
    $this->initVar( 'category_active', XOBJ_DTYPE_INT, 1, false );
	}

	/**
	 * XoopsfaqCategory::XoopsfaqCategory()
	 */
	function XoopsfaqCategory() {
		$this->__construct();
	}

	/**
	 * XoopsfaqCategory::displayForm()
	 *
	 * @return
	 */
	function displayForm() {
		include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
		$caption = ( $this->isNew() ) ? _AM_FAQ_CREATENEW : sprintf( _AM_FAQ_MODIFYITEM, $this->getVar( 'category_title' ) );

		$form = new XoopsThemeForm( $caption, 'content', xoops_getenv( 'PHP_SELF' ) );
		$form->addElement( new XoopsFormHiddenToken() );
		$form->addElement( new xoopsFormHidden( 'op', 'save' ) );
		$form->addElement( new xoopsFormHidden( 'category_id', $this->getVar( 'category_id', 'e' ) ) );
		// title
		$category_title = new XoopsFormText( _AM_FAQ_CATEGORY_TITLE, 'category_title', 50, 150, $this->getVar( 'category_title', 'e' ) );
		$form->addElement( $category_title, true );
		// order
		$category_order = new XoopsFormText( _AM_FAQ_CATEGORY_WEIGHT, 'category_order', 5, 5, $this->getVar( 'category_order', 'e' ) );
		$category_order->setDescription( _AM_FAQ_CATEGORY_WEIGHT_DSC );
		$form->addElement( $category_order, false );
    
    $category_active = new XoopsFormRadioYN( _AM_FAQ_CONTENTS_ACTIVE, 'category_active', $this->getVar( 'category_active', 'e' ), ' ' . _YES . '', ' ' . _NO . '' );
		$category_active->setDescription( _AM_FAQ_CONTENTS_AVTIVE_DSC );
		$form->addElement( $category_active );

   
		$form->addElement( new XoopsFormButton( '', 'submit', _SUBMIT, 'submit' ) );
		$form->display();
	}
	/**
	 * XoopsfaqContents::getActive()
	 *
	 * @return
	 */
	function getActive() {
		return $this->getVar( 'category_active' ) ? _YES : _NO;
	}
	function getActiveIcone() {
    $active = $this->getVar( 'category_active' );
    $img = ($active==1) ? _FAQ_ON : _FAQ_OFF;
    $url = _FAQ_URL . '/admin/category.php?op=active&category_id='.$this->getVar( 'category_id' ).'&category_active='  . (($active==1) ? 0 : 1);
    $html = "<a href='".$url."'><img src='".$img."' title='' alt=''></a>";
    //echo '===>'.$url;exit;
		return $html;
	}

  
}

/**
 * XoopsfaqCategoryHandler
 *
 * @package
 * @author John
 * @copyright Copyright (c) 2009
 * @version $Id$
 * @access public
 */
class XoopsfaqCategoryHandler extends XoopsPersistableObjectHandler {
	/**
	 * XoopsfaqCategoryHandler::__construct()
	 *
	 * @param mixed $db
	 */
	function __construct( &$db ) {
		parent::__construct( $db, 'xoopsfaq_categories', 'XoopsfaqCategory', 'category_id', 'category_title' );
	}

	/**
	 * XoopsfaqCategoryHandler::XoopsfaqCategoryHandler()
	 *
	 * @param mixed $db
	 */
	function XoopsfaqCategoryHandler( &$db ) {
		$this->__construct( $db );
	}

	/**
	 * XoopsfaqCategoryHandler::getObj()
	 *
	 * @return
	 */
	function &getObj($criteria = null) {
		$myts = &MyTextSanitizer::getInstance();
		$obj = false;
    
		if ( is_null($criteria)) {
		  $criteria = new CriteriaCompo();
			$criteria->setSort( 'category_order ASC, category_title'  );

			$criteria->setStart( 0 );
			$criteria->setLimit( 0 );                   
		}      
    
		$obj['count'] = $this->getCount( $criteria );
		//if ( !empty( $args[0] ) ) {
		$obj['list'] = &$this->getObjects( $criteria, false ); 
		return $obj;   
	}

  	/**
	 * XoopsfaqCategoryHandler::getObj()
	 *
	 * @return
	 */
	function &getCategories($criteria=null) {
		$obj = false;
		$criteria = new CriteriaCompo();

		$criteria->add( new Criteria( 'category_active', 1, '=' ) );
		$criteriaActive = new CriteriaCompo();
                            
		$criteria->add( $criteriaActive );

		$obj['count'] = $this->getCount( $criteria );
			$criteria->setSort( 'category_order, category_title' );     
			$criteria->setOrder( 'ASC' );
// 		if ( is_null($criteria)) {
// 			$criteria->setSort( 'category_title' );     
// 			$criteria->setOrder( 'ASC' );
// 			$criteria->setStart( 0 );
// 			$criteria->setLimit( 0 );
// 		}
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
    $url = _FAQ_URL . '/admin/category.php';
    $tpl = "<th style='%4\$s'><a href='{$url}?sort=%1\$s&order=%2\$s'>%3\$s%5\$s</a>";
    $link = sprintf($tpl, $field, $order, $title, $style, $img);  
    return $link;
  }

	/**
	 * XoopsfaqContentsHandler::getOrder($sort,$order)
	 * @param string $sort 
	 * @param string $order 
	 * @return string
	 */
  	function getOrder($sort,$order) { 
    if ($order=='ASC' || $order==''){
      switch ($sort){
      case 'category_id':
        $clause = 'category_id';
        break;
      case 'category_active':
        $clause = 'category_active,category_title';
        break;
      case 'category_order':
        $clause = 'category_order,category_title';
        break;
      case 'category_title':
      default:
        $clause = 'category_title';
        break;
      }
    }else{
      switch ($sort){
      case 'category_id':
        $clause = 'category_id';
        break;
      case 'category_active':
        $clause = 'category_active DESC,category_title';
        break;
      case 'category_order':
        $clause = 'category_order DESC,category_title';
        break;
      case 'category_title':
      default:
        $clause = 'category_title';
        break;
      }
    }
    
    return $clause;    
  
  } 
	/**
	 * XoopsfaqCategoryHandler::displayAdminListing()
	 *
	 * @return
	 */
	function displayAdminListing() {
    if(!isset($_REQUEST['sort'])) $_REQUEST['sort']='category_title';
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

     
     $title=array();
		 	$title[] = $this->build_url_title('category_id', $_REQUEST['sort'],  $_REQUEST['order'], _AM_FAQ_CATEGORY_ID, 'width: 5%;');
		 	$title[] = $this->build_url_title('category_title', $_REQUEST['sort'],  $_REQUEST['order'], _AM_FAQ_CATEGORY_TITLE, 'text-align: left;');
		 	$title[] = $this->build_url_title('category_active', $_REQUEST['sort'],  $_REQUEST['order'], _AM_FAQ_CONTENTS_ACTIVE, '');
		 	$title[] = $this->build_url_title('category_order', $_REQUEST['sort'],  $_REQUEST['order'], _AM_FAQ_CATEGORY_WEIGHT, 'width: 5%;');
     
		 	$title[] = "<th style='width: 20%;'>" . _AM_FAQ_ACTIONS . "</th>";
     
     	$ret = "<form action='category.php?op=save_list' method='post'>";
		  $ret .= "<table width='100%' border='0' cellpadding='2' cellspacing='1' class='outer'>
		           <tr class='xoopsCenter'>" . implode('', $title) . "</tr>";

		if ( $objects['count'] > 0 ) {
			foreach( $objects['list'] as $object ) {
        $category_id = $object->getVar( 'category_id' );
        //$img = ($object->getVar( 'contents_active' )==1) ? $imgOn : $imgOff;
        $name= "categories[{$category_id}][category_order]";
        //echo $name.'<br />';

        $txtOrder = "<input type='text' name='{$name}' id='{$name}' size='5' maxlength='5' value='".$object->getVar( 'category_order' )."' >";

				$ret .= "<tr class='xoopsCenter'>";
				$ret .= "<td class='even' style='text-align:center;'>" . $object->getVar( 'category_id' ) . "</td>";
				$ret .= "<td style='text-align: left;' class='even'>" . $object->getVar( 'category_title' ) . "</td>";
        $ret .= "<td class='even' style='text-align:center;'>" . $object->getActiveIcone() . "</td>";

				$ret .= "<td class='even' style='text-align:center;'>" . $txtOrder . "</td>";
				$ret .= "<td class='even' style='text-align:center;'>";
				$ret .= nsXfaq\getIcons( $buttons, 'category_id', $object->getVar( 'category_id' ), $extra = null );
				$ret .= "</tr>";
			}
		} else {
			$ret .= "<tr style='text-align: center;'><td colspan='5' class='even'>" . _AM_FAQ_NOLISTING . "</td></tr>";
		}
		$ret .= "<tr style='text-align: center;'><td colspan='5' class='head'>"
         . "<input type='submit' name='update' id='update' value='"._AM_FAQ_UPDATE_BY_SET."'></td></tr>";
		$ret .= "</table>";
    //$ret .= " <input type='submit' value='Submit'> ";
		$ret .= "</form >";
		echo $ret;
	}

	/**
	 * XoopsfaqCategoryHandler::DisplayError()
	 *
	 * @return
	 */
	function displayError( $errorString = '' ) {
		xoops_cp_header();
//		nsXfaq\AdminMenu( 1 );
		nsXfaq\DisplayHeading( _AM_FAQ_CATEGORY_HEADER, _AM_FAQ_FAQ_SUBERROR );
		if ( !is_array( $errorString ) ) {
			echo $errorString;
		} else {
			echo $errorString;
		}
		xoops_cp_footer();
		exit();
	}
}

?>