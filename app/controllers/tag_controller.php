<?php

namespace Controller;
session_start();

class TagController {

    public function get($slug) {

        echo \View\Loader::make()->render("templates/only-links.twig", array(
            "page_title" => "Links for #" . $slug,
            "session_user" => $_SESSION["user"],
            "links" => \Model\TagModel::links_by_tag($slug),
        ));

    }

}