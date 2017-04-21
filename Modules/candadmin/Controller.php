<?php

class Controller extends BaseController
{

    public function index()
    {
        if ($this->hasPermission('user')) {
            $this->smarty->assign('logged_in_cand', true);
        }

        if (isset($_POST['login']))
            $this->Login();

         parent::render();
    }

    public function Login()
    {
        $error = false;

        if (!isset($_POST['mobile-email']) ||
            !isset($_POST['password']) ||
            !isset($_POST['captcha'])
        ) {
            $error = true;
        }

        if (!$error) {
            if (empty($_POST['mobile-email']))
                $error = true;
            if (empty($_POST['password']))
                $error = true;
            if (empty($_POST['captcha']))
                $error = true;
            if ($_POST['captcha'] != $_SESSION['captcha']) {
                    $error = true;
                    $captcha = true;
            }
        }
        $this->smarty->assign('captcha', $captcha);
        $this->smarty->assign('login_cand', '');
        if (!$error) {
            $email_mobile = $_POST['mobile-email'];
            $password = $_POST['password'];

            $check = $this->model->login($email_mobile, $password);

            if (count($check) > 0) {
                $_SESSION['user_id'] = $check[0]['id'];
                $this->smarty->assign('login_cand', 'success');
            } else {
                $this->smarty->assign('login_cand', 'fail');
            }
        }
    }


    public function dashboard(){
      if(!empty($this->session->get('user_id'))){
        $url = explode('/', $_GET['path']);
        $url = $profile[2];
        // get candidate information
        $candidate = $this->model->getCandInfo($this->session->get('user_id'));
        $this->smarty->assign('candidate', $candidate);

        //get candidate posts for dashboard
        $posts = $this->model->getCandPosts($this->session->get('user_id'));
        $this->smarty->assign('posts', $posts);

        parent::render('dashboard');
      }
      else {
        parent::render('404');
      }
      }

  }
