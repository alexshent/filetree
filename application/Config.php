<?php

namespace application;

class Config {
    const PDO = [
        'dbtype' => 'mysql',
        'host' => 'localhost',
        'db' => 'treedb',
        'user' => 'treeuser',
        'password' => '1',
        'charset' => 'utf8'
    ];
    
    const CSS = [
        'Bootstrap' => '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">',
        'FontAwesome' => '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">'
    ];
    
    const JS = [
        'Jquery' => '<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>',
        'Bootstrap' => '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>',
    ];
}
