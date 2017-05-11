<?php

class Controller extends BaseController {

    public function index() {
        $user_id = explode('/', $_GET['path']);

        if (isset($user_id[1]))
            $user_id = $user_id[1];

        if (!is_numeric($user_id))
            die();

        $this->smarty->assign('voted', '0');
        $this->smarty->assign('can_see', '0');
        $this->smarty->assign('see_result', '0');

        $voted = $this->model->is_user_voted($user_id);
        $voted = $voted[0];

        if (isset($_POST['result'])) {
            $result = $this->model->get_vote_result();
            $this->smarty->assign('result', $result);
            $this->smarty->assign('see_result', '1');
        } else if ($voted['vote1'] == 0) {
            if (isset($_POST['submit'])) {
                $votes = $_POST['vote'];
                foreach ($votes as &$vote) {
                    $id = str_replace("cand", "", $vote);
                    $this->model->up_vote($id);
                }
                $this->model->set_user_voted($user_id);
                $this->smarty->assign('voted', '1');
            } else {
                $cands = $this->model->get_all_vote_cands();
                $this->smarty->assign('cands', $cands);
                $this->smarty->assign('can_see', '1');
            }
        } else {
            $this->smarty->assign('voted', '1');
        }

        parent::render();
    }
}