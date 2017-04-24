<?php

class Model extends BaseModel {

    public function get_news($limit) {
        return $this->query('SELECT * FROM news ORDER BY id DESC LIMIT '.$limit, array());
    }

    public function get_candidates() {
        return $this->query('SELECT * FROM candidates ORDER BY id DESC LIMIT 10', array());
    }
}