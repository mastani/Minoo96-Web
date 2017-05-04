<?php

class Model extends BaseModel {

    public function Login($email_mobile, $password)
    {
        $password = sha1($password);
        $user_group = $this->query('SELECT id FROM user_group WHERE title = ?',array('s','SuperUser'));
        return $this->query('SELECT * FROM users WHERE (mobile = ? OR email = ?) AND password = ? AND usergroup = ?', array('ssss', $email_mobile, $email_mobile, $password, $user_group[0]['id']));
    }

    public function getUserInfo($userid)//get candidate information
    {
        $user = $this->query('SELECT * FROM users WHERE id = ?', array('s', $userid));
        return $user[0];
    }

    public function getPosts($page = 0)//get Posts
    {
        $start = ($page-1)*10;
        $end = $page*10;
        return $this->query('SELECT p.id as id,c.name,title,p.time,approved_id FROM posts p
          inner join candidates c on p.candidate_id=c.id ORDER BY time DESC 
            LIMIT ?,? ', array('ss', $start,$end));
    }

    public function getPost($postid)
    {
        return $this->query('SELECT * from posts where id = ?',array('s',$postid));
    }

    public function setPostApprove($postid,$approve)
    {
        return $this->query('update posts set approved_id = ? where id = ?',array('ss',$approve,$postid),true);
    }

    public function getComments($page = 0)//get Posts
    {
        $start = ($page-1)*10;
        $end = $page*10;
        return $this->query('SELECT * FROM comments ORDER BY time DESC
            LIMIT ?,? ', array('ss', $start,$end));
    }

    public function saveComments($post)
    {
        foreach ($post as $id => $val)
         $this->query('update comments set approved_id = ? where id = ?',array('ss',$val,$id));
    }

    public function getRecordCount($tablename = 'comments')
    {
        return $this->query('SELECT count(*) as count FROM '.$tablename);

    }

    public function saveNews($title, $body, $image)
    {
        $now = date('Y-m-d H:i:s');
        return $this->query('INSERT INTO news (image, title, content, time) VALUES(?,?,?,?)',
            array('ssss', $image, $title, $body, $now),
            true);
    }


}