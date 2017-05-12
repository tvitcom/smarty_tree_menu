<?php
/**
 * Render hierarhical menu from database entries
 * @author tvitcom
 * @url github.com/tvitcom
 * @package test case application
 * @license https://www.apache.org/licenses/LICENSE-2.0 tvitcom
 */

require './libs/Smarty.class.php';

$smarty = new Smarty;

$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = true;
$smarty->cache_lifetime = 120;

require_once 'TreeManager.php';
require_once 'HierInterface.php';

if (isset($_GET['driver']) && $_GET['driver'] ==='pdo') {
    TreeManager::setSqlDriver('pdo');
    TreeManager::$driver_notice = 'work with PDO db driver';
} else {
    TreeManager::setSqlDriver('mysqli');
    TreeManager::$driver_notice = 'work with mysqli db driver';
}
$smarty->assign("note", TreeManager::$driver_notice);
TreeManager::$language_id=1;

function renderTree($id_current_elem=0, $level=0) {
    $arr = TreeManager::getNameOfElement($id_current_elem, TreeManager::$language_id);
    $gaps = TreeManager::getGaps($level);
    $smarty = new Smarty;
    $smarty->assign("gaps", $gaps);
    
    $smarty->assign("item", $arr['item_name']);
    $smarty->display('menu.tpl');
    $level++;
    //Находим массив прямых потомков данного элемента:
    $descendant = TreeManager::getNodesOfParentId($id_current_elem);
    //Обходим все потомки данного уровня и применяем рекурсивный вызов функции:
    foreach ($descendant as $el) {
        renderTree($el['item_id'], $level);
    }
}

$smarty->display('header.tpl');
TreeManager::renderTree();
$smarty->display('content.tpl');
$smarty->display('footer.tpl');
