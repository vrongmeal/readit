<?php

namespace Model;

class VoteModel {

    public static function upvote_link($uname, $url) {
        $db = \DB::get_instance();
        $stmt_1 = $db->prepare("SELECT upvotes FROM links WHERE url = ?");
        $stmt_1->execute([$url]);
        $upvotes = $stmt_1->fetch();
        $new_votes = $upvotes[0] + 1;
        $stmt_2 = $db->prepare("UPDATE links SET upvotes = ? WHERE url = ?");
        $stmt_2->execute([$new_votes, $url]);
        $stmt_2 = null;
        $stmt_2 = $db->prepare("INSERT INTO user_votes_link (username, url) VALUES (?, ?)");
        $stmt_2->execute([$uname, $url]);
        $stmt_2 = null;
    }

    public static function downvote_link($uname, $url) {
        $db = \DB::get_instance();
        $stmt_1 = $db->prepare("SELECT upvotes FROM links WHERE url = ?");
        $stmt_1->execute([$url]);
        $upvotes = $stmt_1->fetch();
        $new_votes = $upvotes[0] - 1;
        $stmt_2 = $db->prepare("UPDATE links SET upvotes = ? WHERE url = ?");
        $stmt_2->execute([$new_votes, $url]);
        $stmt_2 = null;
        $stmt_2 = $db->prepare("DELETE FROM user_votes_link WHERE username = ? AND url = ?");
        $stmt_2->execute([$uname, $url]);
        $stmt_2 = null;
    }

    public static function upvote_comment($uname, $id) {
        $db = \DB::get_instance();
        $stmt_1 = $db->prepare("SELECT upvotes FROM comments WHERE id = ?");
        $stmt_1->execute([$id]);
        $upvotes = $stmt_1->fetch();
        $new_votes = $upvotes[0] + 1;
        $stmt_2 = $db->prepare("UPDATE comments SET upvotes = ? WHERE id = ?");
        $stmt_2->execute([$new_votes, $id]);
        $stmt_2 = null;
        $stmt_2 = $db->prepare("INSERT INTO user_votes_comment (username, Cid) VALUES (?, ?)");
        $stmt_2->execute([$uname, $id]);
        $stmt_2 = null;
    }

    public static function downvote_comment($uname, $id) {
        $db = \DB::get_instance();
        $stmt_1 = $db->prepare("SELECT upvotes FROM comments WHERE id = ?");
        $stmt_1->execute([$id]);
        $upvotes = $stmt_1->fetch();
        $new_votes = $upvotes[0] - 1;
        $stmt_2 = $db->prepare("UPDATE comments SET upvotes = ? WHERE id = ?");
        $stmt_2->execute([$new_votes, $id]);
        $stmt_2 = null;
        $stmt_2 = $db->prepare("DELETE FROM user_votes_comment WHERE username = ? AND Cid = ?");
        $stmt_2->execute([$uname, $id]);
        $stmt_2 = null;
    }

    public static function if_user_link($uname, $url) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM user_votes_link WHERE username = ? AND url = ?");
        $stmt->execute([$uname, $url]);
        $row = $stmt->fetch();
        if ($row) {
            return false;
        } else {
            return true;
        }
    }

    public static function if_user_comment($uname, $id) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM user_votes_comment WHERE username = ? AND Cid = ?");
        $stmt->execute([$uname, $id]);
        $row = $stmt->fetch();
        if ($row) {
            return false;
        } else {
            return true;
        }
    }

    public static function num_votes_link($url) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT upvotes FROM links WHERE url = ?");
        $stmt->execute([$url]);
        $row = $stmt->fetch();
        $ans = $row[0];
        return $ans;
    }

    public static function num_votes_comment($id) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT upvotes FROM comments WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        $ans = $row[0];
        return $ans;
    }

}
