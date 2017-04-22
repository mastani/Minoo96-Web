<?php

class Model extends BaseModel {

    public function insert_message($name, $email, $mobile, $message) {
        return $this->query('INSERT INTO contact_us (name, email, mobile, message) VALUES (?, ?, ?, ?)', array('ssss', $name, $email, $mobile, $message));
    }
}