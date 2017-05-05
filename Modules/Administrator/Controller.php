<?php

class Controller extends BaseController
{

    public function admininfo()//get admin name and url
    {
        if(!isset($_SESSION['access']) || $_SESSION['access'] != 'admin')
            parent::render('views/404');

        $url = explode('/', $_GET['path']);
        //$url = $url[1];

        if (count($url) >= 2 && !empty($url[1]) && $url[1]!='loginman') {
            $url = $url[1];
        } else
            $url = 'dashboard';

        $view = './views/' . $url . '.tpl';
        $this->smarty->assign('view', $view);
        $this->smarty->assign('url', $url);

        // get candidate information for sidebar
        $admin = $this->model->getUserInfo($_SESSION['user_id']);
        $this->smarty->assign('admin', $admin);

        $posts_top = $this->model->getPosts();
        $comments_top = $this->model->getComments();
        $comment_count = $this->model->yellowCommentsCount();
        $comment_count = $comment_count[0]['count'];
        $post_count = $this->model->yellowPostsCount();
        $post_count = $post_count[0]['count'];

        $this->smarty->assign('posts_top', $posts_top);
        $this->smarty->assign('comments_top', $comments_top);
        $this->smarty->assign('comment_count', $comment_count);
        $this->smarty->assign('post_count', $post_count);


    }

    public function loginman()
    {

        if (isset($_POST['login']) && !isset($_SESSION['user_id']))
            $this->Login();

        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0)//if user logged in
            $this->dashboard();
        else
            parent::render('views/login');
    }

    public function index()
    {
            parent::render('views/404');
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

            $candidates = $this->model->getCandidates();
            $candidate_count = $this->model->getCandidateCount();
            $candidate_count = $candidate_count[0]['count'];
            $this->smarty->assign('candidates', $candidates);
            $this->smarty->assign('candidate_count', $candidate_count);

            $news_top = $this->model->getNewslist();
            $news_count = $this->model->getNewsCount();
            $news_count = $news_count[0]['count'];
            $this->smarty->assign('news_count', $news_count);
            $this->smarty->assign('news_top', $news_top);

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

        if (isset($_POST['submit'])) {
            $this->model->saveComments($_POST);
            $msg = 'تغییرات با موفقیت ذخیره شد';
            $this->smarty->assign('msg', $msg);
        }
        $this->admininfo();

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

        if(isset($_POST['newsid']))//delete post
        {
            if ($this->model->deleteNews($_POST['newsid']))
            {
                $msg = 'خبر با موفقیت حذف شد';
                $this->smarty->assign('msg', $msg);
            }

        }

        //pagination
        $url = explode('/', $_GET['path']);
        if (count($url) >= 3 && !empty($url[2]))
            $page = $url[2];
        else
            $page = 1;
        //get News count for pagination
        $recordcount = $this->model->getRecordCount('news');

        $recordcount = ceil($recordcount[0]['count'] / 10);
        $this->smarty->assign('pages', $recordcount);

        $this->smarty->assign('activepage', $page);
        //end if pagination

        //get posts
        $news = $this->model->getNewslist($page);

        //set jalali time
        Controller::loadLibrary('Jalali');
        for ($i = 0; $i < count($news); $i++)
            $news[$i]['time'] = jdate('j F Y H:i:s', strtotime($news[$i]['time']));

        $this->smarty->assign('news', $news);
        parent::render();
    }

    public function editnews()
    {

        $this->admininfo();
        if (isset($_POST['submit'])) {
            if (empty($_POST['title']))
                $msg[0] = 'عنوان خبر را وارد کنید';
            if (empty($_POST['body']))
                $msg[] = 'متن خبر را وارد کنید';

            if (!isset($msg))//insert new post
            {
                $uploadOk = 1;
                $file_name = '';

                if (!empty($_FILES["image"]['name'])) {
                    //check image
                    $target_dir = dirname(dirname(__dir__)) . "/images/news/";
                    $file_name = md5($this->session->get('user_id') . date('Y-m-d H:i:s'));
                    $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                    $target_file = $target_dir . $file_name . '.' . $extension;
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

                    if ($uploadOk == 1) {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            $file_name = $file_name . '.' . $extension;
                            $uploadOk = 1;
                            $oldPicture = dirname(dirname(__DIR__)) . '/images/news/' . $_POST['oldimage'];
                            chmod($oldPicture, 0644);
                            unlink($oldPicture);
                        } else {
                            $msg[] = 'مشکل در آپلود تصویر';
                            $uploadOk = 0;
                        }
                    }
                }
                if ($uploadOk)
                    if ($this->model->updateNews($_POST['newsid'], $_POST['title'], $_POST['body'], $file_name)) {
                        $msg = 'تغییرات با موفقیت ذخیره شد';
                    } else
                        $msg[] = 'تغییرات ذخیره نشد';

                $this->smarty->assign('msg', $msg);

            }
        } else {

            $newsid = $_POST['newsid'];
            $news = $this->model->getNews($newsid);
            $news = $news[0];
            $this->smarty->assign('news', $news);
        }
        parent::render();

    }
}