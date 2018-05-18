<?php

namespace Controller;
session_start();

class UserController {

    public function get($slug, $fslug = null) {

        if ($slug == "logout") {
            $_SESSION = array();
            session_destroy();
            header("location: /");
        } elseif ($slug == "signin" || $slug == "signup") {
            if (isset($_SESSION["user"])) {
                header("location: /user/" . $_SESSION["user"]);
            } else {
                echo \View\Loader::make()->render("templates/" . $slug . ".twig", array(
                    "error" => $error,
                ));
            }
        } else {
            if (!$fslug) {
                echo \View\Loader::make()->render("templates/user.twig", array(
                    "session_user" => $_SESSION["user"],
                    "user" => \Model\UserModel::find($slug),
                    "links" => \Model\LinkModel::all_by_user($slug),
                    "rating" => \Model\UserModel::rating($slug),
                    "comments" => \Model\CommentModel::all_by_user($slug),
                    "followers" => \Model\FollowModel::followers($slug),
                    "following" => \Model\FollowModel::following($slug),
                    "if_following" => \Model\FollowModel::if_following($_SESSION["user"], $slug),
                ));
            } else {
                echo "Page not found";
            }
        }

    }

    public function post($slug, $fslug = null) {

        if ($slug == "signin") {
            $user = \Model\UserModel::signin($_POST["username"], $_POST["password"]);
            if ($user) {
                $_SESSION["user"] = $_POST["username"];
                header("location: /");
            } else {
                // $this->$error = "Username or password entered is wrong.";
                self::get($slug);
            }
        } elseif ($slug == "signup") {
            $user = \Model\UserModel::signup($_POST["username"], $_POST["password"]);
            if ($user == 0) {
                // $this->$error = "Do not leave the form empty!";
                self::get($slug);
            } elseif ($user == 1) {
                // $this->$error = "Username already exists.";
                self::get($slug);
            } else {
                $_SESSION["user"] = $_POST["username"];
                header("location: /");
            }
        }

    }

    public function post_xhr($slug, $fslug) {

        if ($fslug == "follow") {
            if ($_SESSION["user"] == $slug || !isset($_SESSION["user"])) {
                header("location: /user/" . $slug);
            } else {
                \Model\FollowModel::follow($_SESSION["user"], $slug);
                echo \Model\FollowModel::followers($slug);
            }
        } else {
            echo "Page not found";
        }

    }

}
