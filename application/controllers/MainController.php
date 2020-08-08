<?php

namespace application\controllers;

class MainController extends \core\Controller {
    public function indexAction() {
        $content = \core\View::render("main/index.php", [], true);
        \core\View::render("main/template.php",
            [
            'CSS' => \application\Config::CSS,
            'JS' => \application\Config::JS,
            'title' => 'Index',
            'body_content' => $content
            ]
        );
    }
    
    public function helloAction() {
        echo "hello from the MainController!";
    }
    
    public function treeAction() {
        $content = \core\View::render("main/tree.php", [], true);
        \core\View::render("main/template.php",
            [
            'CSS' => \application\Config::CSS,
            'JS' => \application\Config::JS,
            'title' => 'Tree',
            'body_content' => $content
            ]
        );
    }
}
