<?php

class Model extends BaseModel {

    public function is_user_voted($user_id) {
        return $this->query('SELECT vote1 FROM app_users WHERE id = ?', array('i', $user_id));
    }

    public function get_all_vote_cands() {
        return $this->query('SELECT id, name FROM vote1', array());
    }

    public function up_vote($id) {
        return $this->query('UPDATE vote1 SET votes = votes + 1 WHERE id = ?', array('i', $id));
    }

    public function set_user_voted($user_id) {
        return $this->query('UPDATE app_users SET vote1 = 1 WHERE id = ?', array('i', $user_id));
    }

    public function get_vote_result() {
        return $this->query('SELECT name, votes FROM vote1 ORDER BY votes DESC', array());
    }

}