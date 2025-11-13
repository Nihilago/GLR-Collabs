<?php
require_once 'controllers/BaseController.php';
require_once 'utils/Session.php';

class HomeController extends BaseController {

    public function index() {
        $data = [
            'title' => 'GLR Collabs - Home',
            'isLoggedIn' => Session::isLoggedIn(),
            'userName' => Session::get('user_name')
        ];

        $this->render('home/index', $data);
    }
}
?>