<?php

class Controller extends BaseController {

    public function index() {
        $this->smarty->assign('path', DEFAULT_PATH);
        parent::render();
    }
}