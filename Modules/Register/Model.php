<?php

class Model extends BaseModel
{
    public function user_exist_mobile($mobile)
    {
        return $this->query('SELECT * FROM users WHERE mobile = ?', array('s', $mobile));
    }

    public function user_exist_email($email)
    {
        return $this->query('SELECT * FROM users WHERE email = ?', array('s', $email));
    }

    public function add_user($name, $last_name, $mobile, $email, $password)
    {
        $password = sha1($password);
        $now = date('Y-m-d H:i:s');
        return $this->query(
            'INSERT INTO users (name, last_name, mobile, email, password, register_date) VALUES (?, ?, ?, ?, ?, ?)',
            array('ssssss', $name, $last_name, $mobile, $email, $password, $now),
            true
        );
    }

    public function login($email_mobile, $password)
    {
        $password = sha1($password);
        return $this->query('SELECT * FROM users WHERE (mobile = ? OR email = ?) AND password = ?', array('sss', $email_mobile, $email_mobile, $password));
    }
}