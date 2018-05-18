<?php

require "../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\HomeController",
    "/user/:alpha" => "\Controller\UserController",
    "/user/:alpha/:alpha" => "\Controller\UserController",
    "/link/:alpha" => "\Controller\LinkController",
    "/link/:alpha/vote" => "\Controller\VoteController",
    "/link/:alpha/vote/:number" => "\Controller\VoteController",
    "/feed" => "\Controller\FeedController",
    "/tag/:alpha" => "\Controller\TagController",
));
