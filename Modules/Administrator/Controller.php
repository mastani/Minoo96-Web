<?php

class Controller extends BaseController
{

    public function admininfo()//get admin name and url
    {
        $url = explode('/', $_GET['path']);
        //$url = $url[1];

        if (count($url) >= 2 && !empty($url[1])) {
            $url = $url[1];
        } else
            $url = 'dashboard';

        $view = './views/' . $url . '.tpl';
        $this->smarty->assign('view', $view);

        // get candidate information for sidebar
        $admin = $this->model->getUserInfo($_SESSION['user_id']);
        $this->smarty->assign('admin', $admin);

    }

    public function index()
    {

        if (isset($_POST['login']) && !isset($_SESSION['user_id']))
            $this->Login();

        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0)//if user logged in
            $this->dashboard();
        else
            parent::render('views/login');
    }

    public function Login()
    {
        $error = '';

        if (!isset($_POST['mobile_email']) ||
            !isset($_POST['password']) ||
            !isset($_POST['captcha'])
        ) {
            $error = 'فیلدها را کامل پر کنید';
        }

        if (!$error) {
            if (empty($_POST['mobile_email']) || empty($_POST['password']) || empty($_POST['captcha']))
                $error = 'فیلدها را کامل پر کنید';

            if ($_POST['captcha'] != $_SESSION['captcha']) {
                $error = 'کد امنیتی درست وارد نشده است';
            }
        }

        if (!$error) {
            $email_mobile = $_POST['mobile_email'];
            $password = $_POST['password'];

            $check = $this->model->Login($email_mobile, $password);

            if (count($check) > 0) {
                $_SESSION['user_id'] = $check[0]['id'];
                $_SESSION['access'] = 'admin';
            } else {
                $error = 'اطلاعات وارد شده درست نمی باشد';
                $this->smarty->assign('error', $error);
            }
        } else
            $this->smarty->assign('error', $error);
    }


    public function dashboard()
    {
        if (!empty($this->session->get('user_id'))) {
            $this->admininfo();
            parent::render();
        } else {
            parent::render('404');
        }
    }

    public function posts($page = 0)
    {
        $this->admininfo();

        //pagination
        $url = explode('/', $_GET['path']);
        if (count($url) >= 3 && !empty($url[2]))
            $page = $url[2];
        else
            $page = 1;

        //get comment count for pagination
        $recordcount = $this->model->getRecordCount('posts');

        $recordcount = ceil($recordcount[0]['count'] / 10);
        $this->smarty->assign('pages', $recordcount);

        $this->smarty->assign('activepage', $page);
        //end if pagination

        //get posts
        $posts = $this->model->getPosts($page);

        //set jalali time
        Controller::loadLibrary('Jalali');
        for ($i = 0; $i < count($posts); $i++)
            $posts[$i]['time'] = jdate('j F Y H:i:s', strtotime($posts[$i]['time']));

        $this->smarty->assign('posts', $posts);
        parent::render();
    }

    public function getpost()//get one post for  AJAX
    {
        $post = $this->model->getPost($_POST['id']);
        echo json_encode($post[0]);
    }

    public function setpostapprove()
    {
        $postid = $_POST['postid'];
        $approve = $_POST['approve'];
        if ($postid == 1)
            $postid = $_SESSION['user_id'];

        if ($this->model->setPostApprove($postid, $approve))
            echo $approve;

    }

    public function comments($page = 0)
    {
        $this->admininfo();

        if (isset($_POST['submit'])) {
            $this->model->saveComments($_POST);
            $msg = 'تغییرات با موفقیت ذخیره شد';
            $this->smarty->assign('msg', $msg);
        }

        //pagination
        $url = explode('/', $_GET['path']);
        if (count($url) >= 3 && !empty($url[2]))
            $page = $url[2];
        else
            $page = 1;

        //get comment count for pagination
        $recordcount = $this->model->getRecordCount('comments');

        $recordcount = ceil($recordcount[0]['count'] / 10);
        $this->smarty->assign('pages', $recordcount);

        $this->smarty->assign('activepage', $page);
        //end if pagination

        //get comments
        $comments = $this->model->getComments($page);

        //set jalali time
        Controller::loadLibrary('Jalali');
        for ($i = 0; $i < count($comments); $i++)
            $comments[$i]['time'] = jdate('j F Y H:i:s', strtotime($comments[$i]['time']));

        $this->smarty->assign('comments', $comments);

        $userid = $_SESSION['user_id'];
        $this->smarty->assign('userid', $userid);


        parent::render();
    }

    public function newnews()
    {
        $this->admininfo();

        if (isset($_POST['submit'])) {
            if (empty($_POST['title']))
                $msg[0] = 'عنوان خبر را وارد کنید';
            if (empty($_POST['body']))
                $msg[] = 'متن خبر را وارد کنید';

            if (!isset($msg))//insert new news
            {
                //check image
                $target_dir = dirname(dirname(__dir__)) . "/images/news/";
                $file_name = md5($this->session->get('user_id') . date('Y-m-d H:i:s'));
                $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                $target_file = $target_dir . $file_name . '.' . $extension;
                $uploadOk = 1;
                //Check if image file is a actual image or fake image
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if ($check === false) {
                        $msg[] = "فایل تصویر درست انتخاب نشده است";
                        $uploadOk = 0;
                    }
                } else if ($_FILES["image"]["size"] > 500000) {
                    $msg[] = 'حجم تصویر انتخابی باید کوچکتر از یک مگابایت باشد';
                    $uploadOk = 0;
                }
                var_dump($target_file);

                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        if ($this->model->saveNews($_POST['title'], $_POST['body'], $file_name . '.' . $extension))
                            $msg = 'خبر با موفقیت ذخیره شد';
                    } else {
                        $msg[] = 'مشکل در آپلود تصویر';
                    }
                }
            }

            $this->smarty->assign('msg', $msg);
        }

        parent::render();
    }


    public function newslist()
    {
        $this->admininfo();

        parent::render();
    }


}