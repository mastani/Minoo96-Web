<?php

class Controller extends BaseController {

    public function index() {
        session_destroy();
        parent::render();
    }
}