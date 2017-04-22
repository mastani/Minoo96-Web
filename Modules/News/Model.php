<?php

class Model extends BaseModel {

    public function get_news($limit) {
        return $this->query('SELECT * FROM news ORDER BY id DESC LIMIT '.$limit, array());
    }

    public function get_single_news($id) {
        return $this->query('SELECT * FROM news WHERE id = ?', array('i', $id));
    }
}