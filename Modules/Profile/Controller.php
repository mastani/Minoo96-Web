<?php

class Controller extends BaseController
{

    public function index()
    {
        Controller::loadLibrary('Jalali');
        $profile = explode('/', $_GET['path']);
        $profile = $profile[1];

        $candidate_array = $this->model->get_candidate($profile);
        $candidate_array = $candidate_array[0];
        $candidate_array['register_date'] = jdate('j F Y', strtotime($candidate_array['register_date']));

        $this->smarty->assign('candidate', $candidate_array);

        $posts_array = $this->model->get_candidate_posts($candidate_array['id']);
        foreach ($posts_array as &$value) {
            $value['time'] = jdate('j F Y H:i:s', strtotime($value['time']));
        }

        $this->smarty->assign('posts', $posts_array);
        $this->smarty->assign('default_path', DEFAULT_PATH);
        parent::render();
    }
}
