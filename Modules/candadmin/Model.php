<?php

class Model extends BaseModel
{

    public function login($email_mobile, $password)
    {
        $password = sha1($password);
        $user_group = $this->query('SELECT id FROM user_group WHERE title = ?',array('s','candidate'));
        return $this->query('SELECT * FROM users WHERE (mobile = ? OR email = ?) AND password = ? AND usergroup = ?', array('ssss', $email_mobile, $email_mobile, $password, $user_group[0]['id']));
    }

    public function getCandInfo($userid)//get candidate information
    {
        $user = $this->query('SELECT c.* FROM candidates c inner join users u on u.candidate_id=c.id  WHERE u.id = ?', array('s', $userid));
        return $user[0];
    }

    public function getCandPosts($userid)//get candidate Posts
    {
        return $this->query('SELECT p.id,title,content,time FROM posts p
          inner join candidates c on p.candidate_id=c.id
          inner join users u  on c.id=u.candidate_id
            WHERE u.id = ?', array('s', $userid));
    }
}
