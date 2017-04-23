<?php

class Controller extends BaseController
{

    public function index()
    {
        if (isset($_POST['submit']))
            $this->Submit();

        parent::render();
    }

    private function Submit() {
        $error = false;

        if (!isset($_POST['name']) ||
            !isset($_POST['email']) ||
            !isset($_POST['mobile']) ||
            !isset($_POST['message'])
        ) {
            $error = true;
        }

        if (!$error) {
            if (empty($_POST['name']))
                $error = true;
            if (empty($_POST['message']))
                $error = true;
        }

        if (!$error) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $message = $_POST['message'];

            $this->model->insert_message($name, $email, $mobile, $message);
        }

        $this->smarty->assign('result', !$error);
    }
}