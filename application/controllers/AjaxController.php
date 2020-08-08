<?php

namespace application\controllers;

class AjaxController extends \core\Controller {
    private $node_model;
    private $result;
    
    public function __construct() {
        $this->node_model = new \application\models\Node();
        $this->result = new \stdClass();
    }
    
    private function sendResponse() {
        header('Content-Type: application/json');
        echo json_encode($this->result);
    }

    public function childrenAction($params) {
        $parent_id = $params['parentid'];
        $children = $this->node_model->readChildren($parent_id);
        $this->result->children = $children;
        $this->sendResponse();
    }
    
    public function rootAction() {
        $root = $this->node_model->readRoot();
        $this->result->root = $root;
        $this->sendResponse();
    }
}
