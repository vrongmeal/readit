<?php

namespace Controller;
session_start();

class HomeController {

    public function get() {

        if (isset($_SESSION["user"])) {
            $user = \Model\UserModel::find($_SESSION["user"]);
        } else {
            $user = null;
        }

        echo \View\Loader::make()->render("templates/home.twig", array(
            "user" => $user,
            "trending" => \Model\LinkModel::trending(),
            "top" => \Model\LinkModel::top(),
            "new" => \Model\LinkModel::new(),
            "session_user" => $_SESSION["user"],
        ));

    }

}
