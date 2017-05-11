<?php

class Controller extends BaseController
{

    public function index()
    {
        if (isset($_POST['login']) && !isset($_SESSION['user_id']))
            $this->Login();

        if(isset($_SESSION['user_id']) && $_SESSION['user_id']>0)//if user logged in
            $this->dashboard();
        else
            parent::render('View');

    }

    public function Login()
    {
        $error = false;
        $captcha = false;

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


    public function dashboard()
    {
        if (!empty($this->session->get('user_id'))) {
            $url = explode('/', $_GET['path']);
            $url = $url[2];
            if (!isset($url))//for show posts in dashboard
                $url = 'posts';

            $this->smarty->assign('url', $url);

            // get candidate information for sidebar
            $candidate = $this->model->getCandInfo($this->session->get('user_id'));
            $this->smarty->assign('candidate', $candidate);

            switch ($url) {
                case 'posts':
                    $this->getposts();
                    break;
                case 'new':
                    $this->createpost();
                    break;
                case 'edit':
                    $this->showorsavepost();
                    break;
                case 'setting':
                    $this->savesetting();
                    break;
            }

            parent::render('dashboard');
        } else {
            parent::render('404');
        }
    }

    private function getposts()
    {
        //check for postd id to delete
        if(isset($_POST['postid'])){
            $this->model->deletePost($_POST['postid']);
            $msg = 'پست با موفقیت حذف شد';
            $this->smarty->assign('msg', $msg);
        }

        //get candidate posts for dashboard
        $posts = $this->model->getCandPosts($this->session->get('user_id'));

        //set jalali time
        Controller::loadLibrary('Jalali');
        for($i=0;$i<count($posts);$i++)
            $posts[$i]['time']=jdate('j F Y H:i:s', strtotime($posts[$i]['time']));
        $this->smarty->assign('posts', $posts);

    }

    private function createpost()
    {
        if (isset($_POST['title'])){//save new post
            if(empty($_POST['title']))
                $msg[0] = 'عنوان پست را وارد کنید';
            if(empty($_POST['body']))
                $msg[] = 'متن پست را وارد کنید';

            if(!isset($msg))//insert new post
            {
                //check image
                $target_dir = dirname(dirname(__dir__))."/images/";
                $file_name = md5($this->session->get('user_id').date('Y-m-d H:i:s'));
                $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                $target_file = $target_dir . $file_name .'.'. $extension;
                $uploadOk = 1;
                //Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if($check === false) {
                        $msg[]= "فایل تصویر درست انتخاب نشده است";
                        $uploadOk = 0;
                    }
                }else if ($_FILES["image"]["size"] > 500000) {
                    $msg[] = 'حجم تصویر انتخابی باید کوچکتر از یک مگابایت باشد';
                    $uploadOk = 0;
                }

                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        if ($this->model->savePost($this->session->get('user_id'),$_POST['title'],$_POST['body'],$file_name .'.'. $extension))
                            $msg = 'پست با موفقیت ذخیره شد';
                    } else {
                        $msg[] = 'مشکل در آپلود تصویر';
                    }
                }
            }

            $this->smarty->assign('msg', $msg);
        }
    }

    private function savesetting()
    {
        if (isset($_POST['newpass1'])) {//save setting
            if (strlen($_POST['newpass1'])<4)
                $msg[0] = 'کلمه عبور باید شامل حداقل ۴ کاراکتر باشد';
            if (($_POST['newpass1']) != ($_POST['newpass2']))
                $msg[] = 'کلمه عبور جدید و تکرار آن برابر نیستند';

            if (!isset($msg))//insert new post
            {
               if ($this->model->saveSetting($_POST['oldpass'], $_POST['newpass1'],$this->session->get('user_id')))
                   $msg[] = 'تغییرات با موفقیت ذخیره شد';
               else
                   $msg[] = 'مشکل در ذخیره سازی تغییرات';
            }
            $this->smarty->assign('msg', $msg);
        }
    }

    private function showorsavepost(){

        if(isset($_POST['title'])){
            if(empty($_POST['title']))
                $msg[0] = 'عنوان پست را وارد کنید';
            if(empty($_POST['body']))
                $msg[] = 'متن پست را وارد کنید';

            if(!isset($msg))//insert new post
            {
                $uploadOk = 1;
                $file_name = '';

                if (!empty($_FILES["image"]['name'])){
                    //check image
                    $target_dir = dirname(dirname(__dir__))."/images/";
                    $file_name = md5($this->session->get('user_id').date('Y-m-d H:i:s'));
                    $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                    $target_file = $target_dir . $file_name .'.'. $extension;
                    //Check if image file is a actual image or fake image
                    if(isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["image"]["tmp_name"]);
                        if($check === false) {
                            $msg[]= "فایل تصویر درست انتخاب نشده است";
                            $uploadOk = 0;
                        }
                    }else if ($_FILES["image"]["size"] > 500000) {
                        $msg[] = 'حجم تصویر انتخابی باید کوچکتر از یک مگابایت باشد';
                        $uploadOk = 0;
                    }

                    if ($uploadOk == 1) {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            $file_name = $file_name .'.'. $extension;
                            $uploadOk = 1;
                            $oldPicture = dirname(dirname(__DIR__)).'/images/'.$_POST['oldimage'];
                            chmod($oldPicture, 0644);
                            unlink($oldPicture);
                        }
                         else {
                            $msg[] = 'مشکل در آپلود تصویر';
                            $uploadOk = 0;
                        }
                    }
                }
                if ($uploadOk)
                    if ($this->model->saveEditPost($_POST['postid'], $this->session->get('user_id'),$_POST['title'],$_POST['body'],$file_name)) {
                        $msg = 'پست با موفقیت ذخیره شد';
                        $redirect = 'dashboard';
                        $this->smarty->assign('redirect', $redirect);
                    }
                    else
                        $msg[] = 'تغییرات ذخیره نشد';


                $this->smarty->assign('msg', $msg);

            }
        }
        else{
            $postid = $_POST['postid'];
            $post = $this->model->getPostinfo($postid);
            $post = $post[0];
            $this->smarty->assign('post', $post);
        }

}
}