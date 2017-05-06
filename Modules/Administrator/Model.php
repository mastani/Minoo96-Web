<?php

class Model extends BaseModel {

    public function Login($email_mobile, $password)
    {
        $password = sha1($password);
        $user_group = $this->query('SELECT id FROM user_group WHERE title = ?',array('s','SuperUser'));
        return $this->query('SELECT * FROM users WHERE (mobile = ? OR email = ?) AND password = ? AND usergroup = ?', array('ssss', $email_mobile, $email_mobile, $password, $user_group[0]['id']));
    }

    public function getUserInfo($userid)//get user information
    {
        $user = $this->query('SELECT * FROM users WHERE id = ?', array('s', $userid));
        return $user[0];
    }

    public function getPosts($page = 1)//get Posts
    {
        $start = ($page-1)*10;
        $end = $page*10;
        return $this->query('SELECT p.id as id,c.name,content,p.time,approved_id FROM posts p
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

    public function getComments($page = 1)//get Comments
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

    public function getNewslist($page = 1)//get News
    {
        $start = ($page-1)*10;
        $end = $page*10;
        return $this->query('SELECT * FROM news ORDER BY time DESC
            LIMIT ?,? ', array('ss', $start,$end));
    }

    public function deleteNews($newsid)
    {
        return $this->query('delete from news where id = ?', array('s', $newsid), true);
    }

    public function getNews($newsid)
    {
        return $this->query('select * from news where id = ?', array('s',$newsid));
    }

    public function updateNews($newsid, $title, $body, $image)
    {

        if(!empty($image)) {
            return $this->query('update news set title = ?, content = ?, image = ? where id = ?',
                array('ssss', $title, $body, $image, $newsid),
                true);
        }
        else{
            return $this->query('update news set title = ?, content = ? where id = ?',
                array('sss', $title, $body, $newsid),
                true);
        }
    }

    public function yellowCommentsCount()
    {
        return $this->query('select count(*) as count from comments where approved_id = ?', array('s','0'));
    }

    public function yellowPostsCount()
    {
        return $this->query('select count(*) as count from posts where approved_id = ?', array('s','0'));
    }

    public function getCandidateCount()
    {
        return $this->query('select count(*) as count from candidates');
    }

    public function getNewsCount()
    {
        return $this->query('select count(*) as count from news');
    }

    public function getCandidates()
    {
        return $this->query('select * from candidates');
    }

    public function changePass($oldpass,$newpass,$userid)
    {
        $newpass = sha1($newpass);
        $oldpass = sha1($oldpass);

        return $this->query('update users set password = ? where id = ? and password = ?',array('sss',$newpass, $userid, $oldpass), true);

    }


}