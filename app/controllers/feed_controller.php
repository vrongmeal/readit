<?php

namespace Controller;
session_start();

class FeedController {

    public function get() {

        if ($_SESSION["user"]) {
            echo \View\Loader::make()->render("templates/only-links.twig", array(
                "links" => array_values(\Model\FeedModel::all($_SESSION["user"])),
                "session_user" => $_SESSION["user"],
                "page_title" => "Personal Feed",
            ));
        } else {
            header("location: /");
        }

    }

}