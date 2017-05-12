<?php

/**
 * Description of HierInterface:
 * This is interface describe some methods for work with tree hierarhical data in db storeage.
 * @author tvitcom
 * @url github.com/tvitcom
 * @package test case application
 * @license https://www.apache.org/licenses/LICENSE-2.0 tvitcom
 */

interface HierInterface {
    
    /*
     * Return description of the element as item_id from join table
     */
    public static function getNameOfElement($item_id, $language_id);
    
    /*
     * Return nodes of the parent_id
     */
    public static function getNodesOfParentId($start_id);
    
    /*
    * Return number of top nodes (quantity of root nodes)
    */
    public static function getTopNodes();
}
