<?php

class Controller extends BaseController {

    public function index() {
        if (isset($_POST['register'])) {
            $result = $this->model->add_user($_POST);
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES["image"]["tmp_name"], dirname(__FILE__) . '/Images/' . 'img' . $result . '.' . $extension);
            $this->smarty->assign('success', 'true');
        }

        parent::render();
    }
}