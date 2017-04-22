<?php

class Model extends BaseModel {

    public function get_candidate($profile) {
        return $this->query('SELECT * FROM candidates WHERE profile_name = ? ORDER BY id DESC', array('s', $profile));
    }

    public function get_candidate_posts($id) {
        return $this->query('SELECT *, (SELECT count(*) FROM likes WHERE posts.id = likes.post_id) AS likes, (SELECT count(*) FROM comments WHERE posts.id = comments.post_id) AS comments FROM posts WHERE candidate_id = ? ORDER BY id DESC', array('i', $id));
    }
}