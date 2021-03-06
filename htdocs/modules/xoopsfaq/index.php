<?php
/**
 * Name: index.php
 * Description: Dispaly user side code, categories and faq answers
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
 * @subpackage : User side code
 * @since 2.5.7
 * @author John Neill
 * @version $Id: index.php 0000 10/04/2009 09:22:12 John Neill $
 */
include_once 'header.php';
include_once 'include/constantes.php';

$category_handler = &xoops_getModuleHandler( 'category' );
$content_handler = &xoops_getModuleHandler( 'contents' );

$cat_id = nsXfaq\CleanVars( $_GET, 'cat_id', 0, 'int' );
if ( $cat_id < 1 ) {
	$xoopsOption['template_main'] = 'xoopsfaq_index.html';
	include_once XOOPS_ROOT_PATH . '/header.php';
	/**
	 * Display Categories and a list of Answers Max 10
	 */
   
	//$objects = $category_handler->getObj();     
	$objects = $category_handler->getCategories();     
	if ( $objects['count'] > 0 ) {

		foreach( $objects['list'] as  $catObj) {
      $category = $catObj->toArray();
			$contentsObj = $content_handler->getPublished( $category['category_id']  );
			if ( $contentsObj['count'] ) {
				foreach( $contentsObj['list'] as $content ) {
					$category['questions'][] = array( 'id' => $content->getVar( 'contents_id' ),
                                            'cid' => $content->getVar( 'contents_cid' ), 
                                            'link' => $content->getVar( 'contents_id' ), 
                                            'title' => $content->getVar( 'contents_title' ),
                                            'answer' => $content->getVar( 'contents_answer'));
				}
			}
			$xoopsTpl->append_by_ref( 'categories', $category );
			unset( $category );
		}
	}
  $btnsFaq = nsXfaq\getBtnForUserInterfaceFaq();
	$xoopsTpl->assign( 'btnsFaq', $btnsFaq );
    
  $btnsCat = nsXfaq\getBtnForUserInterfaceCat();
	$xoopsTpl->assign( 'btnsCat', $btnsCat );

} else {
	$xoopsOption['template_main'] = 'xoopsfaq_category.html';
	include_once XOOPS_ROOT_PATH . '/header.php';
	/**
	 * Display answers to a specific category
	 */
	$catObj = $category_handler->get( $cat_id );
  $category = $catObj->toArray();
  //$category['id'] = $category['category_id'];
  
	$xoopsTpl->assign( 'category', $category);
	//$xoopsTpl->assign( 'category_name', $category->getVar( 'category_title' ) );
  
//   $z=array();
	$contentsObj = $content_handler->getPublished( $cat_id );
	if ( $contentsObj['count'] ) {
		foreach( $contentsObj['list'] as $obj ) {
			$question['title'] = $obj->getVar( 'contents_title' );
			$question['id'] = $obj->getVar( 'contents_id' );
			$question['cid'] = $obj->getVar( 'contents_cid' );
			$question['answer'] = $obj->getVar( 'contents_answer' );
			$question['contents'] = $obj->getVar( 'contents_contents' );
      
      $question['seealso'] = array();          
      for ($k=1;$k<4;$k++)    
      {
        $url = $obj->getSeealso($k,1);
        if ($url != '')
        {
          $t = array();
          $t['url'] = $url;
          $t['lib'] = $obj->getLibseealso($k);
  			 $question['seealso'][] = $t;

        }
      }
			$xoopsTpl->append( 'questions', $question );
//       $z[]=$question;
		}
    $btnsFaq = nsXfaq\getBtnForUserInterfaceFaq(true);
	  $xoopsTpl->assign( 'btnsFaq', $btnsFaq );
    
    $btnsCat = nsXfaq\getBtnForUserInterfaceCat();
	  $xoopsTpl->assign( 'btnsCat', $btnsCat );

	}

   
	include XOOPS_ROOT_PATH . '/include/comment_view.php';
}

include 'footer.php';

?>