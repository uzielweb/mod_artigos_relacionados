<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_artigos_relacionados
 *
 * @copyright
 * @license     GNU/Public
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_artigos_relacionados
 *
 */
class ModArtigos_relacionadosHelper{
 
}
$itemid = Jfactory::getApplication()->input->getInt('Itemid');
$input=Jfactory::getApplication()->input;
if($input->getCmd('option')=='com_content' 
&& $input->getCmd('view')=='article' ){
  $db=JFactory::getDbo(); 
  $db->setQuery('select catid from #__content where id='.$input->getInt('id')); 
  $catid=$db->loadResult(); 
}

$category = JTable::getInstance('category');
$category->load($catid);
$parentCategory = ($category->parent_id > 1) ? $category->parent_id : '' ;

$db = JFactory::getDbo();
$query = "SELECT * FROM #__content WHERE (catid = '".$catid."' OR catid = '".$parentCategory."')  and state = '1' AND id != '".$input->getInt('id')."' ORDER BY created DESC LIMIT ".$params->get("total_de_itens").";";
$db->setQuery($query);
$meusitens = $db->loadObjectList();