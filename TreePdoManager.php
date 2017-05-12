<?php

/**
 * PDO fabric relate of fasade to TreeManager
 * @author tvitcom
 * @url github.com/tvitcom
 * @package test case application
 * @license https://www.apache.org/licenses/LICENSE-2.0 tvitcom
 */
class TreePdoManager implements HierInterface {
    
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
            $opt = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            );            
            self::$instance = new PDO('mysql:host=localhost;dbname=treemenu;port=33306;charset=utf8', 'treemenu', 'pass_to_treemenu',$opt);
        }
        return self::$instance;
    }

    /*
     * Return description of the element as item_id from join table
     */
    public static function getNameOfElement($item_id=0, $language_id=0) {
        $sql = "SELECT item_id, item_name FROM items_description WHERE item_id=:item_id AND language_id=:language_id;";
        $stmt = self::getInstance()->prepare($sql);
        $stmt->bindValue(':item_id',$item_id, PDO::PARAM_INT);
        $stmt->bindValue(':language_id',$language_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /*
     * Return nodes of the parent_id
     */
    public static function getNodesOfParentId($start_id = 0) {
        $sql = "SELECT item_id from items WHERE parent_id=:start_id;";
        $stmt = self::getInstance()->prepare($sql);
        $stmt->bindValue(':start_id',$start_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /*
    * Return number of top nodes (quantity of root nodes)
    */
    public static function getTopNodes() {
        $sql = "SELECT item_id FROM items WHERE parent_id = (SELECT min(parent_id) FROM items);";
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 