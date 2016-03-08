<?php
   /*    
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
 * upgrade to xoops 2.5.7 by Jean-Jacques DELALANDRE
 */
 
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

define('_AM_FAQ_DELETE', "Supprimer item");
define('_AM_FAQ_CREATENEW', "Créer nouvel item");
define('_AM_FAQ_MODIFYITEM', "Modifier item: %s");
define('_AM_FAQ_NOLISTING', "Aucun item trouvé");
define('_AM_FAQ_CONTENTS_HEADER', "Gestion du contenu des Faq");
define('_AM_FAQ_CONTENTS_LIST_DSC', "Liste des questions");
define('_AM_FAQ_CONTENTS_ID', "#");
define('_AM_FAQ_CONTENTS_TITLE', "Titre du contenu");
define('_AM_FAQ_CONTENTS_WEIGHT', "Poids");
define('_AM_FAQ_CONTENTS_PUBLISH', "Publié");
define('_AM_FAQ_CONTENTS_ACTIVE', "Activer");
define('_AM_FAQ_ACTIONS', "Actions");
define('_AM_FAQ_CONTENTS_CATEGORY', "Catégorie du contenu:");
define('_AM_FAQ_CONTENTS_CATEGORY_DSC', "Choisir une catégorie pour placer cet article");
define('_AM_FAQ_CONTENTS_TITLE_DSC', "Saisir un titre pour cet item.");
define('_AM_FAQ_CONTENTS_CONTENT', "Contenu:");
define('_AM_FAQ_CONTENTS_PUBLISH_DSC', "Choisir la date de publication");
define('_AM_FAQ_CONTENTS_WEIGHT_DSC', "Saisir une valeur pour l'ordre de tri. ");
define('_AM_FAQ_CONTENTS_AVTIVE_DSC', "Définir si cet item sera caché ou pas");
define('_AM_FAQ_DOHTML', "Afficher en Html");
define('_AM_FAQ_BREAKS', "Convertir les retours à la ligne en Xoopskreaks");
define('_AM_FAQ_DOIMAGE', "Afficher les images Xoops");
define('_AM_FAQ_DOXCODE', "Afficher les codes Xoops");
define('_AM_FAQ_DOSMILEY', "Afficher les smileys Xoops");
define('_AM_FAQ_CATEGORY_HEADER', "Gestion des catégories de la Faq");
define('_AM_FAQ_CATEGORY_DELETE_DSC', "Confirmation de suppression ! Vous allez détruire cet item. Vous pouvez annuler cette action en cliquant sur le bouton annuler ou choisir de poursuivre.<br /><br />Cette action est irréversible.");
define('_AM_FAQ_CATEGORY_EDIT_DSC', "Mode édition: Vous pouvez modifier les propriétés de cet item ici. Cliquez sur le bouton envoyer pour confirmer le changement ou sur annuler pour retourner où vous étiez.");
define('_AM_FAQ_CATEGORY_LIST_DSC', "Liste des catégories");
define('_AM_FAQ_CATEGORY_ID', "#");
define('_AM_FAQ_CATEGORY_TITLE', "Titre");
define('_AM_FAQ_CATEGORY_WEIGHT', "Poids");
define('_AM_FAQ_CATEGORY_WEIGHT_DSC', "Ordre d'affichage des catégories");
define('_AM_FAQ_FAQ_SUBERROR', "Une erreur est survenue<br />");
define('_AM_FAQ_RUSURECAT', "Etes-vous sûr de vouloir supprimer cette catégorie et toutes ses questions ?");
define('_AM_FAQ_DBSUCCESS', "Base de données mise à jour avec succès !");
define('_AM_FAQ_ERRORCOULDNOTADDCAT', "Erreur: Impossible d'ajouter une catégorie à la base de données.");
define('_AM_FAQ_ERRORCOULDNOTDELCAT', "Erreur: Impossible de supprimer la catégorie désirée.");
define('_AM_FAQ_ERRORCOULDNOTEDITCAT', "Erreur: Impossible de modifier l'item voulu.");
define('_AM_FAQ_ERRORNOCAT', "Erreur: Il n'y a encore aucune catégorie créée. Avant de créer une nouvelle FAQ vous devez créer une catégorie.");
define('_AM_FAQ_CONTENTS_URL', "URL");
define('_AM_FAQ_CATEGORIES', "Catégories");
define('_AM_FAQ_CONTENTS_SEEALSO', "Voir aussi");
define('_AM_FAQ_CONTENTS_SEEALSO_DSC', "URL de référence. \"http://\" sera ajouté automatiquement si nécéssaire.</ br>Le libellé remplacera l'url pour l'affichage");
define('_AM_FAQ_CONTENTS_LIBSEEALSO', "Libellé");
define('_AM_FAQ_CONTENTS_LIBSEEALSO_DSC', "Libellé optionel de l'URL");
define('_AM_FAQ_CONTENTS_ANSWER', "Réponse courte");
define('_AM_FAQ_CONTENTS_ANSWER_DSC', "Réponse courte affichée dans les listes.");
define('_AM_FAQ_PERM_COLSULT', "Consulter");
define('_AM_FAQ_PERM_ADD', "Ajouter");
define('_AM_FAQ_PERM_EDIT', "Editer");
define('_AM_FAQ_PERM_ACTIVE', "Activer/Désactiver");
define('_AM_FAQ_PERM_DELETE', "Supprimer");
define('_AM_FAQ_PERM_PRINT', "Imprimer");
define('_AM_FAQ_PERMISSIONS_CAT', "CATEGORIES");
define('_AM_FAQ_PERMISSIONS_CAT_DESC', "Gestion des permissions des catégories du modules");
define('_AM_FAQ_PERMISSIONS_FAQ', "QUESTIONS");
define('_AM_FAQ_PERMISSIONS_FAQ_DESC', "Gestion des permissions des FAQ du modules");
define('_AM_FAQ_PERM_MAILTO', "Evoyer à un ami");
define('_AM_FAQ_ID_MODULE', "ID du module");
define('_AM_FAQ_FOLDER', "Dossier");
define('_AM_FAQ_VERSION', "Version");
define('_AM_FAQ_AUTHORS', "Auteur(s)");
define('_AM_FAQ_WEB_SITE', "WEB Site");
define('_AM_FAQ_MIN_VERSION', "Version minimum de");
define('_AM_FAQ_UPDATE_BY_SET', "Mise à jour par lot");
define('_AM_FAQ_DELETE_BY_SET', "Suppression par lot");

?>