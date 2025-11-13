<?php
require_once 'controllers/BaseController.php';
require_once 'models/User.php';
require_once 'utils/Session.php';

class DashboardController extends BaseController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function index() {
        Session::requireLogin();

        $userId = Session::get('user_id');
        $user = $this->userModel->findById($userId);

        $data = [
            'title' => 'GLR Collabs - Dashboard',
            'user' => $user,
            'userName' => Session::get('user_name')
        ];

        $this->render('dashboard/index', $data);
    }
}
?>