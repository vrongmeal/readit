<?php

namespace Controller;
session_start();

class VoteController {

    public function post_xhr($slug_1, $slug_2 = null) {

        $check_link = \Model\LinkModel::find($slug_1);
        if($check_link && $_SESSION["user"]) {

            if ($slug_2) {
                $check = \Model\VoteModel::if_user_comment($_SESSION["user"], $slug_2);
                if ($check) {
                    \Model\VoteModel::upvote_comment($_SESSION["user"], $slug_2);
                } else {
                    \Model\VoteModel::downvote_comment($_SESSION["user"], $slug_2);
                }
                echo \Model\VoteModel::num_votes_comment($slug_2);
            } else {
                $check = \Model\VoteModel::if_user_link($_SESSION["user"], $slug_1);
                if ($check) {
                    \Model\VoteModel::upvote_link($_SESSION["user"], $slug_1);
                } else {
                    \Model\VoteModel::downvote_link($_SESSION["user"], $slug_1);
                }
                echo \Model\VoteModel::num_votes_link($slug_1);
            }

        }
        
    }

}
