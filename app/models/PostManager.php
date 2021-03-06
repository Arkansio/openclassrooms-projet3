<?php
class PostManager
{
    private $bdd;
    function initConnection() {
        if (!$this->bdd)
            $this->bdd = new PDO('mysql:host=' . BDD_HOST . ';dbname=' . BDD_NAME . ';charset=utf8', BDD_USER, BDD_PASSWORD);
    }
    function getPostByID($id)
    {
        $this->initConnection();
        $req = $this->bdd->prepare('SELECT * FROM billets WHERE id = ? LIMIT 1');
        $req->execute(array($id));
        $data = $req->fetch();
        return new Post($data['id'], $data['title'], $data['content'], date("d-m-Y H:i", strtotime($data['date'])));
    }
    function getPosts($from, $to) {
        $this->initConnection();
        $req = $this->bdd->prepare('SELECT id, title, SUBSTRING(content, 1, 120), date FROM billets ORDER BY date DESC LIMIT ?, ?');
        $req->bindParam(1, $from, PDO::PARAM_INT);
        $req->bindParam(2, $to, PDO::PARAM_INT);
        $req->execute();
        $posts = array();
        while ($element = $req->fetch()) {
            $post = new Post($element['id'], $element['title'], $element['SUBSTRING(content, 1, 120)'], date("d-m-Y H:i", strtotime($element['date'])));
            array_push($posts, $post);
        }
        return $posts;
    }

    function getPostsWithoutDesc() {
        $this->initConnection();
        $req = $this->bdd->prepare('SELECT id, title, date FROM billets ORDER BY date DESC');
        $req->execute();
        $posts = array();
        while ($element = $req->fetch()) {
            $post = new Post($element['id'], $element['title'], null, date("d-m-Y H:i", strtotime($element['date'])));
            array_push($posts, $post);
        }
        return $posts;
    }

    function countPosts() {
        $this->initConnection();
        $req = $this->bdd->prepare('SELECT COUNT(id) FROM billets');
        $req->execute();
        return $req->fetch();
    }

    function createPost($post) {
        $this->initConnection();
        $req = $this->bdd->prepare('INSERT INTO billets(title, content) VALUES(?, ?)');
        $req->execute(array($post->title, $post->content));
        return;
    }

    function deletePost($id) {
        $this->initConnection();
        $req = $this->bdd->prepare('DELETE FROM billets WHERE id = ?');
        $req->execute(array($id));
        return;
    }

    function editPost($post) {
        $this->initConnection();
        $req = $this->bdd->prepare('UPDATE billets SET title = ?, content = ? WHERE id = ?');
        $req->execute(array($post->title, $post->content, $post->id));
        return;
    }
}

?>