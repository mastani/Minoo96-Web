<?php

class Controller extends BaseController
{

    public function index()
    {
        Controller::loadLibrary('Jalali');

        $news_array = $this->model->get_news(10);
        foreach ($news_array as &$value) {
            $value['time'] = jdate('j F Y', strtotime($value['time']));
        }
        $this->smarty->assign('news_array', $news_array);

        $candidates_array = $this->model->get_candidates();
        foreach ($candidates_array as &$value) {
            $filter = '';

            if ($value['gender'] == 0)
                $filter .= 'gentleman';
            else
                $filter .= 'ladies';

            if ($value['re_candidate'] == 1)
                $filter .= ' recandidate';

            if ($value['age'] <= 30)
                $filter .= ' youngest';

            $value['filter'] = $filter;
        }
        $this->smarty->assign('candidates_array', $candidates_array);

        parent::render();
    }
}