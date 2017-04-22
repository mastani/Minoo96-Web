<?php

class Controller extends BaseController
{

    public function index()
    {
        Controller::loadLibrary('Jalali');

        $news_id = explode('/', $_GET['path']);

        if (isset($news_id[1]))
            $news_id = $news_id[1];

        if (is_numeric($news_id)) {
            $news_array = $this->model->get_single_news($news_id);
        } else {
            $news_array = $this->model->get_news(100);
        }

        foreach ($news_array as &$value) {
            $value['time'] = jdate('j F Y', strtotime($value['time']));
        }
        $this->smarty->assign('news_array', $news_array);

        parent::render();
    }
}