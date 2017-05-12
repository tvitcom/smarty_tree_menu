<?php

/**
 * Mysql fabric relate of fasade to TreeManager
 * @author tvitcom
 * @url github.com/tvitcom
 * @package test case application
 * @license https://www.apache.org/licenses/LICENSE-2.0 tvitcom
 */
class TreeMysqliManager implements HierInterface { 

    private static $instance = NULL;

    public function __construct()
    {

    }

    public function __clone()
    {

    }

    public static function getInstance()
    {
        if (!self::$instance) {            
            self::$instance = new mysqli('p:localhost','treemenu', 'pass_to_treemenu','treemenu','33306');
            self::$instance->set_charset("latin1");
        }
        return self::$instance;
    }

    /*
     * Return description of the element as item_id from join table
     */
    public static function getNameOfElement($item_id=0, $language_id=0) {
        $sql = "SELECT item_id, item_name FROM items_description WHERE item_id=" .
                (int) $item_id . " AND language_id=" . (int) $language_id . ";";
        if ($result = self::getInstance()->query($sql)) {
            $data = $result->fetch_assoc();
            $result->close();
        }
        return $data;
    }
    
    /*
     * Return nodes of the parent_id
     */
    public static function getNodesOfParentId($start_id = 0) {
       $sql = "SELECT item_id from items WHERE parent_id=".(int) $start_id . ";";
        if ($result = self::getInstance()->query($sql)) {
           $data = $result->fetch_all(MYSQLI_ASSOC);
           $result->close();
        }
        return $data;
    }
    
    /*
    * Return number of top nodes (quantity of root nodes)
    */
    public static function getTopNodes() {
        $sql = "SELECT item_id FROM items WHERE parent_id = (SELECT min(parent_id) FROM items);";
        if ($result = self::getInstance()->query($sql)) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result->close();
        }
        return $data;
    }
} 