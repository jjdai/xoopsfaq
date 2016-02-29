<?php
/**
 * Name: modinfo.php
 * Description:
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
 * @subpackage : Menu Language
 * @since 2.5.7
 * @author John Neill
 * @version $Id: modinfo.php 0000 10/04/2009 09:08:46 John Neill $
 * Traduction: LionHell 
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Accès restreint' );

/**
 * Module Version
 */
define( '_XO_MI_XOOPSFAQ_NAME', 'Xoops FAQ' );
define( '_XO_MI_XOOPSFAQ_DESC', 'Gestionnaire de FAQ Xoops' );

/**
 * Module Menu
 */
define( '_XO_MI_MENU_MODULEHOME', 'Accueil du module' );
define( '_XO_MI_MENU_MODULEBLOCKS', 'Blocs' );
define( '_XO_MI_MENU_MODULETEMPLATES', 'Templates' );
define( '_XO_MI_MENU_MODULECOMMENTS', 'Commentaires' );
define( '_XO_MI_MENU_ADMININDEX', 'Index' );
define( '_XO_MI_MENU_ADMINCATEGORY', 'Catégorie' );

/**
 * Module Prefs
 */
 
 /***********************************************************************/
define( '_XO_MI_XOOPSFAQ_EDITORS', 'Choisir l\'éditeur:' );
define( '_XO_MI_XOOPSFAQ_EDITORS_DSC', 'Veuillez choisir l\'éditeur que vous souhaitez utiliser. <br />Peut-être aurez-vous à installer un éditeur avant de pouvoir l\'utiliser.' );

define( '_XO_MI_MENU_QUESTIONS', 'Questions' );

define( '_XO_MI_MENU_ADMINCATEGORYS', 'Catégories' );

define("_XO_MI_XOOPSFAQ_INFO" , "
<p>Gestionnaire de Foire aux questions.</p>
<p>C'est une mise à jour majeur du module.</p>
<h4>Fonctionalités :</h4>
<ul>  
  <li>Intégration du framework 'moduleadmin'</li>
  <li>Mise à jour pour Xoops 2.5.7 & supérieur.</li>  
</ul>
");

define( '_XO_MI_GROUP_ADMIN_DEL', 'Groupe autoriser à supprimer' );
define( '_XO_MI_GROUP_ADMIN_DEL_DSC', 'Groupes autorisés des catégories ou des FAQ.</ br>A utiliser pour les groupes qui peuvent administrer sans pouvoir supprimer pour autant.' );
             
define( '_XO_MI_MENU_PERMISSIONS', 'Permissions' );
define( '_XO_MI__MAILTO', 'Envoyer un courriel' );
?>