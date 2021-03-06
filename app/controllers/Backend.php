<?php
include_once(APP_ROOT . 'app/models/PostManager.php');
include_once(APP_ROOT . 'app/models/Post.php');
include_once(APP_ROOT . 'app/models/CommentManager.php');
include_once(APP_ROOT . 'app/models/Comment.php');
include_once(APP_ROOT . 'app/models/UserManager.php');

class Backend
{
    private $postManager;
    private $commentManager;
    private $userManager;
    function __construct() {
        session_start();
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->userManager = new UserManager();
    }
    function login($GET, $POST)
    {
        if(isset($POST['password']) && isset($POST['username']))
            $this->testLogin($POST['password'], $POST['username']);
        else
            $this->showLogin();
    }

    private function showLogin() {
        require(APP_ROOT . 'app/views/login.php');
    }

    private function testLogin($username, $password) {
        $password = hash('sha256', $password);
        $isValid = $this->userManager->isUserValid($username, $password);
        if($isValid) {
            $_SESSION['isLogged'] = 1;
            header('Location: ' . WEB_ROOT . 'admin');
        } else {
            $this->showLogin();
        }
    }

    private function isLogged() {
        return isset($_SESSION['isLogged']);
    }

    public function admin() {
        if($this->isLogged()) {
            require(APP_ROOT . 'app/views/admin.php');
        } else {
            header('Location: ' . WEB_ROOT . 'login/');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . WEB_ROOT);
    }

    public function createPostPage($GET, $POST) {
        if($this->isLogged()) {
            if(isset($POST['content']) && isset($POST['title']))
                $this->createPost($POST['title'], $POST['content']);
            else
                require(APP_ROOT . 'app/views/createPost.php');
        } else {
            header('Location: ' . WEB_ROOT . 'login/');
        }
    }

    private function createPost($title, $content) {
        $newPost = new Post(null, $title, $content, null);
        $this->postManager->createPost($newPost);
        header('Location: ' . WEB_ROOT . 'chapitres/');
    }

    public function editPostPage($GET, $POST) {
        if($this->isLogged()) {
            if(isset($POST['content']) && isset($POST['title']) && isset($POST['id'])) {
                $this->editPost($POST);
            }
            else {
                $this->getEditPost($GET);
            }
        } else {
            header('Location: ' . WEB_ROOT . 'login/');
        }
    }

    private function editPost($POST) {
        $editPost = new Post($POST['id'], $POST['title'], $POST['content'], null);
        $this->postManager->editPost($editPost);
        header('Location: ' . WEB_ROOT . 'admin/listPosts');
    }

    private function getEditPost($GET) {
        if (isset($GET['id'])) {
            $editPost = $this->postManager->getPostByID($GET['id']); 
            require(APP_ROOT . 'app/views/editPost.php');
        } else {
            header('Location: ' . WEB_ROOT . 'admin/listPosts');
        }
    }

    public function listPosts() {
        if($this->isLogged()) {
            $posts = $this->postManager->getPostsWithoutDesc();
            require(APP_ROOT . 'app/views/listPosts.php');
        } else {
            header('Location: ' . WEB_ROOT . 'login/');
        }
    }

    public function listComments() {
        if($this->isLogged()) {
            $comments = $this->commentManager->getComments();
            require(APP_ROOT . 'app/views/listComments.php');
        } else {
            header('Location: ' . WEB_ROOT . 'login/');
        }
    }

    public function deletePost($GET) {
        if($this->isLogged()) {
            if(isset($GET['id']))
                $this->postManager->deletePost($GET['id']);
        }
        header('Location: ' . WEB_ROOT . 'admin/listPosts');
    }

    public function flagComments($GET, $POST) {
        if($this->isLogged()) {
            $comments = $this->commentManager->getFlagComments();
            require(APP_ROOT . 'app/views/flagComments.php');
        } else {
            header('Location: ' . WEB_ROOT . 'login/');
        }
    }

    public function deleteComment($GET) {
        if($this->isLogged()) {
            if(isset($GET['id']))
                $comments = $this->commentManager->deleteComment($GET['id']);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: ' . WEB_ROOT . 'login/');
        }
    }

    public function approveComment($GET) {
        if($this->isLogged()) {
            if(isset($GET['id']))
                $comments = $this->commentManager->approveComment($GET['id']);
                header('Location: ' . WEB_ROOT . 'admin/flagComments');
        } else {
            header('Location: ' . WEB_ROOT . 'login/');
        }
    }
}

?>