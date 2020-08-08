<?php

// https://www.php.net/manual/en/book.pdo.php
// https://www.php.net/manual/en/pdo.constants.php
// https://www.php.net/manual/en/pdostatement.bindvalue.php
// https://www.php.net/manual/en/pdostatement.fetchobject.php

namespace application\models;

class Node extends \core\Model {

    public function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS nodes
        (
        node_id CHAR(36) PRIMARY KEY,
        parent_id CHAR(36) NULL,
        name VARCHAR(128) NOT NULL,
        type ENUM('file', 'directory', 'link') NOT NULL,
        CONSTRAINT self_ref_check CHECK (parent_id != node_id),
        INDEX (parent_id)
        )
        ";
        
        static::getDB()->exec($sql);
    }
    
    public function create($name, $type, $parent_id) {
        $result = false;
        
        if (!empty($name) && !empty($type)) {
            $generated_id = $this->uuid();
            
            $sql = "INSERT INTO nodes (
            node_id,
            parent_id,
            name,
            type
            )
            VALUES (
            :node_id,
            :parent_id,
            :name,
            :type
            )
            ";
            
            $st = static::getDB()->prepare($sql);
            $st->bindValue(':node_id', $generated_id, \PDO::PARAM_STR);
            $st->bindValue(':parent_id', $parent_id, \PDO::PARAM_STR);
            $st->bindValue(':name', $name, \PDO::PARAM_STR);
            $st->bindValue(':type', $type, \PDO::PARAM_STR);
            $result = $st->execute();
        }
        
        if ($result) {
            $result = $generated_id;
        }
        
        return $result;
    }
    
    public function readChildren($node_id) {
        $nodes = [];
        
        $sql = "SELECT * from nodes WHERE parent_id = :parent_id ORDER BY name";
        
        $st = static::getDB()->prepare($sql);
        $st->bindValue(':parent_id', $node_id, \PDO::PARAM_STR);
        $execution_result = $st->execute();
        
        while($node = $st->fetchObject()) {
            $nodes[] = $node;
        }

        return $nodes;
    }
    
    public function readRoot() {
        $sql = "SELECT * from nodes WHERE parent_id IS NULL";
        $st = static::getDB()->query($sql);
        $root = $st->fetchObject();
        return $root;
    }
}
