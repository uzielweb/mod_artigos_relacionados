<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_artigos_relacionados
 *
 * @copyright
 * @license     GNU/Public
 */

defined('_JEXEC') or die;
/* @var $param \Joomla\Registry\Registry */

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_artigos_relacionados', $params->get('layout', 'default'));