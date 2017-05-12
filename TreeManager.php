<?php

/**
 * TreeManager - render hierarhical menu from database entries
 * @author tvitcom
 * @url github.com/tvitcom
 * @package test case application
 * @license https://www.apache.org/licenses/LICENSE-2.0 tvitcom
 */
class TreeManager {
    
    /*
     * Storage for language_id value:
     */
    public static $language_id = '';
    
    /*
     * Storage for db sql driver value:
     */
    private static $sqldriver = '';
    
    /*
     * class notice 
     */
    public static $driver_notice='current work with default driver';
    
    public function __construct(){ 
  
    } 
  
    public static function factory($driver = 'Pdo'){ 
        $HandleClass = 'Tree'.$driver. 'Manager';
        return new $HandleClass;
    } 
  
    /*
     * Set sql driver string;
     */
    public static function setSqlDriver($sqldriver='pdo') {
        if ($sqldriver==='pdo') {
            self::$sqldriver='pdo';
            require_once 'TreePdoManager.php';
        } elseif ($sqldriver ==='mysqli') {
            self::$sqldriver='mysqli';
            require_once 'TreeMysqliManager.php';
        }
    }
    
    /*
     * Set sql driver string;
     */
    public static function getSqlDriver() {
        return self::$sqldriver;
    }

    /*
     * Return description of the element as item_id from join table
     */
    public static function getNameOfElement($item_id=0, $language_id=0) {  
        return self::factory(self::getSqlDriver())->getNameOfElement($item_id, $language_id);
    }
    
    /*
     * Return nodes of the parent_id
     */
    public static function getNodesOfParentId($start_id = 0) {
        return self::factory(self::getSqlDriver())->getNodesOfParentId($start_id);
    }
    
    /*
    * Return number of top nodes (quantity of root nodes)
    */
    public static function getTopNodes() {
        return self::factory(self::getSqlDriver())->getTopNodes();
    }
    
    
    
    /*
     * Return gap symbols accord $qty as quantity
     */
    public static function getGaps($qty=0) {
        $gaps='';
        for ($i=0;$i<=$qty;$i++) {
            $gaps .= '&nbsp;&nbsp;';
        }
        return '&nbsp;'.$gaps;
    }

    public static function renderTree($id_current_elem=0, $level=0) {
        $arr = TreeManager::getNameOfElement($id_current_elem, TreeManager::$language_id);
            echo TreeManager::getGaps($level) . $arr['item_name'].'<br>';
        $level++;
        //Находим массив прямых потомков данного элемента:
        $descendant = TreeManager::getNodesOfParentId($id_current_elem);
        //Обходим все потомки данного уровня и применяем рекурсивный вызов функции:
        foreach ($descendant as $el) {
            renderTree($el['item_id'], $level);
        }
    }
} 