<?php

namespace Controller;
session_start();

class LinkController {

    public function get($slug) {

        // if ($slug == "create") {
        //     echo \View\Loader::make()->render("templates/home.twig", array(
        //         "user" => \Model\UserModel::find($_SESSION["user"]),
        //     ));
        // } else
        if ($slug == "new") {
            echo \View\Loader::make()->render("templates/only-links.twig", array(
                "links" => \Model\LinkModel::new(),
                "session_user" => $_SESSION["user"],
                "page_title" => "New Discussions",
            ));
        } elseif ($slug == "top") {
            echo \View\Loader::make()->render("templates/only-links.twig", array(
                "links" => \Model\LinkModel::top(),
                "session_user" => $_SESSION["user"],
                "page_title" => "Top Discussions"
            ));
        } else {
            if ($_GET["sort"] == "top") {
                $sort = "top";
            } else {
                $sort = "new";
            }

            $comments = \Model\CommentModel::all_on_link($slug, $sort);
            for ($i = 0; $i < count($comments); $i++) {
                $comments[$i]["voted"] = \Model\VoteModel::if_user_comment($_SESSION["user"], $comments[$i]["id"]);
            }
            echo \View\Loader::make()->render("templates/link.twig", array(
                "session_user" => $_SESSION["user"],
                "link" => \Model\LinkModel::find($slug),
                "comments" => $comments,
                "sort" => $sort,
                "if_link" => \Model\VoteModel::if_user_link($_SESSION["user"], $slug),
                "tags" => \Model\TagModel::all_on_link($slug),
            ));
        }

    }

    public function post($slug) {
        
        if ($slug == "create") {
            if (empty($_POST["title"])) {
                header("location: /#create");
            } else {
                \Model\LinkModel::create($_SESSION["user"], $_POST["title"], $_POST["url"]);
                \Model\TagModel::add($_POST["url"], $_POST["tags"]);
                header("location: /link/" . $_POST["url"]);
            }
        } else {
            if (empty($_POST["content"])) {
                header("location: /link/" . $slug);
            } else {
                \Model\CommentModel::create($slug, $_POST["content"], $_SESSION["user"]);
                header("location: /link/" . $slug);
            }
        }

    }

}
