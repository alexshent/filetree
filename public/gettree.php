<?php

spl_autoload_register(
    function ($class) {
        $root = dirname(__DIR__);
        $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
        
        if (is_readable($file)) {
            require $file;
        }
    }
);

// ----------------------

class Crawler {
    private $node_model;
    
    public function __construct() {
        $this->node_model = new \application\models\Node();
        $this->node_model->createTable();
    }
    
    public function read($path, $parent_id) {
        if (!is_dir($path)) {
            throw new \InvalidArgumentException('path is not a directory!');
        }
        
        // save this directory
        $id = $this->node_model->create(basename($path), "directory", $parent_id);
        // scan this directory
        $files = scandir($path);
        
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $new_path = "$path/$file";
                
                if (is_link($new_path)) {
                    $target = readlink($new_path);
                    // save child link
                    $this->node_model->create("$file -> $target", "link", $id);
                }
                elseif (is_dir($new_path)) {
                    // read child dir
                    $this->read($new_path, $id);
                }
                elseif (is_file($new_path)) {
                    // save child file
                    $this->node_model->create($file, "file", $id);
                }
            }
        }
    }
}

$crawler = new Crawler();
//$crawler->read("/home/alex/testroot", null);
$crawler->read("/proc", null);
