<?php

class Controller extends BaseController
{

    public function index()
    {
        if ($this->hasPermission('user')) {
            $this->smarty->assign('logged_in', true);
        }

        if (isset($_POST['register']))
            $this->Register();

        if (isset($_POST['login']))
            $this->Login();

        parent::render();
    }

    public function Login()
    {
        $error = false;

        if (!isset($_POST['mobile-email']) ||
            !isset($_POST['password'])
        ) {
            $error = true;
        }

        if (!$error) {
            if (empty($_POST['mobile-email']))
                $error = true;
            if (empty($_POST['password']))
                $error = true;
        }

        if (!$error) {
            $email_mobile = $_POST['mobile-email'];
            $password = $_POST['password'];

            $check = $this->model->login($email_mobile, $password);

            if (count($check) > 0) {
                $_SESSION['user_id'] = $check[0]['id'];
                $this->smarty->assign('login_result', 'success');
            } else {
                $this->smarty->assign('login_result', 'fail');
            }
        }
    }

    public function Register()
    {
        $error = false;
        $captcha = false;

        if (!isset($_POST['name']) ||
            !isset($_POST['last_name']) ||
            !isset($_POST['email']) ||
            !isset($_POST['mobile']) ||
            !isset($_POST['password']) ||
            !isset($_POST['confirm-password']) ||
            !isset($_POST['captcha'])
        ) {
            $error = true;
        }

        if (!$error) {
            if (empty($_POST['name']))
                $error = true;
            if (empty($_POST['last_name']))
                $error = true;
            if (empty($_POST['email']))
                $error = true;
            if (empty($_POST['mobile']))
                $error = true;
            if (empty($_POST['password']))
                $error = true;
            if (empty($_POST['confirm-password']))
                $error = true;
            if (empty($_POST['captcha']))
                $error = true;

            if ($_POST['password'] != $_POST['confirm-password'])
                $error = true;

            if ($_POST['captcha'] != $_SESSION['captcha']) {
                $error = true;
                $captcha = true;
            }
        }

        $this->smarty->assign('result', '');
        $this->smarty->assign('captcha', $captcha);

        if (!$error) {
            $check1 = $this->model->user_exist_mobile($_POST['mobile']);
            if (count($check1) > 0) {
                $error = true;
                $this->smarty->assign('result', 'exist_mobile');
            }
            $check2 = $this->model->user_exist_email($_POST['email']);
            if (count($check2) > 0) {
                $error = true;
                $this->smarty->assign('result', 'exist_email');
            }
            if (!$error)
                if ($this->model->add_user($_POST['name'], $_POST['last_name'], $_POST['mobile'], $_POST['email'], $_POST['password']))
                    $this->smarty->assign('success', '');
        }
    }
}