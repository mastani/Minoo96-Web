<?php

class Model extends BaseModel {
    public function add_user($data) {
        $this->query(
            'INSERT INTO register_form (data) VALUES (?)',
            array('s', json_encode($data))
        );

        return $this->db->insert_id;
    }
}