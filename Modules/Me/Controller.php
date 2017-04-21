<?php

class Controller extends BaseController
{

    public function index()
    {
        if (!$this->hasPermission('user')) {
            $this->smarty->assign('guest', true);
        }

        parent::render();
    }
}