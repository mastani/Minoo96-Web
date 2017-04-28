<?php

class Controller extends BaseController
{

    public function index()
    {
        if (isset($_GET['logout']))
            $this->session->destroy();

        Controller::loadLibrary('Jalali');

        $news_array = $this->model->get_news(10);
        foreach ($news_array as &$value) {
            $news_id = $value['id'];
            $value['time'] = jdate('j F Y', strtotime($value['time']));
            //$value['title'] = "<a href=News/$news_id>" . $value['title'] . "</a>";

            // limit news content size
            $string = strip_tags($value['content']);
            if (strlen($string) > 400) {
                // truncate string
                $stringCut = substr($string, 0, 400);
                // make sure it ends in a word so assassinate doesn't become ass...
                $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . " ... <a href='News/$news_id'>مشاهده متن کامل خبر</a>";
            }
            $value['content'] = $string;
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

        // Shuffle candidate array for having equal chance to seen!
        shuffle($candidates_array);

        $this->smarty->assign('candidates_array', $candidates_array);

        parent::render();
    }
}