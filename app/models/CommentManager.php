<?php

class CommentManager
{
    private $bdd;
    function initConnection() {
        if (!$this->bdd)
            $this->bdd = new PDO('mysql:host=' . BDD_HOST . ';dbname=' . BDD_NAME . ';charset=utf8', BDD_USER, BDD_PASSWORD);
    }
    function getCommentsByPostID($PostID)
    {
        $this->initConnection();
        $req = $this->bdd->prepare('SELECT * FROM commentaires WHERE postID = ? ORDER BY date DESC');
        $req->execute(array($PostID));
        $comments = array();
        while ($element = $req->fetch()) {
            $comment = new Comment($element['id'], $element['postID'], $element['name'], $element['content'], date("d-m-Y H:i", strtotime($element['date'])));
            array_push($comments, $comment);
        }
        return $comments;
    }

    function getComments() {
        $this->initConnection();
        $req = $this->bdd->prepare('SELECT * FROM commentaires ORDER BY date DESC');
        $req->execute();
        $comments = array();
        while ($element = $req->fetch()) {
            $comment = new Comment($element['id'], $element['postID'], $element['name'], $element['content'], date("d-m-Y H:i", strtotime($element['date'])));
            array_push($comments, $comment);
        }
        return $comments;
    }

    function addComment($comment)
    {
        $this->initConnection();
        $req = $this->bdd->prepare('INSERT INTO commentaires(postID, name, content) VALUES(?, ?, ?)');
        $req->execute(array($comment->postID, $comment->name, $comment->content));
        return;
    }

    function getFlagComments() {
        $this->initConnection();
        $req = $this->bdd->prepare('SELECT * FROM commentaires WHERE flag = 1 AND approve = 0');
        $req->execute();
        $comments = array();
        while ($element = $req->fetch()) {
            $comment = new Comment($element['id'], $element['postID'], $element['name'], $element['content'], date("d-m-Y H:i", strtotime($element['date'])));
            array_push($comments, $comment);
        }
        return $comments;
    }

    function deleteComment($id) {
        $this->initConnection();
        $req = $this->bdd->prepare('DELETE FROM commentaires WHERE id = ?');
        $req->execute(array($id));
        return;
    }

    function flagComment($id) {
        $this->initConnection();
        $req = $this->bdd->prepare('UPDATE commentaires SET flag = 1 WHERE id = ?');
        $req->execute(array($id));
        return;
    }

    function approveComment($id) {
        $this->initConnection();
        $req = $this->bdd->prepare('UPDATE commentaires SET flag = 0, approve = 1 WHERE id = ?');
        $req->execute(array($id));
        return;
    }
}

?>