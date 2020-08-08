<?php

namespace core;

abstract class Model {
    protected static function getDB() {
        static $db = null;

        if ($db === null) {
			$dbtype = \application\Config::PDO['dbtype'];
            $host = \application\Config::PDO['host'];
            $dbname = \application\Config::PDO['db'];
            $user = \application\Config::PDO['user'];
            $password = \application\Config::PDO['password'];
            $charset = \application\Config::PDO['charset'];
            
            try {
                $db = new \PDO("$dbtype:host=$host;dbname=$dbname;charset=$charset;", $user, $password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }

        return $db;
    }

    public function uuid(){
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
