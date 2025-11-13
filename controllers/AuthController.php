<?php
require_once 'controllers/BaseController.php';
require_once 'models/User.php';
require_once 'utils/Session.php';

class AuthController extends BaseController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function showLogin() {
        Session::redirectIfLoggedIn();

        $data = [
            'title' => 'GLR Collabs - Login',
            'error' => Session::get('error')
        ];

        // Clear error message after displaying
        Session::set('error', null);

        $this->render('auth/login', $data);
    }

    public function showRegister() {
        Session::redirectIfLoggedIn();

        $data = [
            'title' => 'GLR Collabs - Sign Up',
            'error' => Session::get('error'),
            'success' => Session::get('success')
        ];

        // Clear messages after displaying
        Session::set('error', null);
        Session::set('success', null);

        $this->render('auth/register', $data);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
            return;
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            Session::set('error', 'Please fill in all fields.');
            $this->redirect('/login');
            return;
        }

        $user = $this->userModel->authenticate($email, $password);

        if ($user) {
            // Update last login
            $this->userModel->updateLastLogin($user['id']);

            // Set session variables
            Session::set('user_id', $user['id']);
            Session::set('user_name', $user['full_name']);
            Session::set('user_email', $user['email']);

            $this->redirect('/dashboard');
        } else {
            Session::set('error', 'Invalid email or password.');
            $this->redirect('/login');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/register');
            return;
        }

        $fullName = trim($_POST['full_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Basic validation
        if (empty($fullName) || empty($email) || empty($password)) {
            Session::set('error', 'Please fill in all fields.');
            $this->redirect('/register');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::set('error', 'Please enter a valid email address.');
            $this->redirect('/register');
            return;
        }

        if (strlen($password) < 6) {
            Session::set('error', 'Password must be at least 6 characters long.');
            $this->redirect('/register');
            return;
        }

        // Try to create user
        if ($this->userModel->create($fullName, $email, $password)) {
            Session::set('success', 'Account created successfully! Please log in.');
            $this->redirect('/login');
        } else {
            Session::set('error', 'Email already exists or registration failed.');
            $this->redirect('/register');
        }
    }

    public function logout() {
        Session::destroy();
        $this->redirect('/');
    }
}
?>