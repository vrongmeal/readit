<?php

namespace Model;

class FollowModel {

    public static function if_following($uname, $that) {
        $db = \DB::get_instance();
        $stmt_1 = $db->prepare("SELECT * FROM this_follows_that WHERE this = ? AND that = ?");
        $stmt_1->execute([$uname, $that]);
        $row = $stmt_1->fetch();
        if ($row) {
            return true;
        } else {
            return false;
        }
    }

    public static function follow($uname, $that) {
        $db = \DB::get_instance();
        $stmt_1 = $db->prepare("SELECT * FROM this_follows_that WHERE this = ? AND that = ?");
        $stmt_1->execute([$uname, $that]);
        $row = $stmt_1->fetch();
        if ($row) {
            $stmt_2 = $db->prepare("DELETE FROM this_follows_that WHERE this = ? AND that = ?");
            $stmt_2->execute([$uname, $that]);
            $stmt_2 = null;
        } else {
            $stmt_2 = $db->prepare("INSERT INTO this_follows_that (this, that) VALUES (?, ?)");
            $stmt_2->execute([$uname, $that]);
            $stmt_2 = null;
        }
        $stmt_1 = null;
    }

    public static function followers($uname) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM this_follows_that WHERE that = ?");
        $stmt->execute([$uname]);
        $rows = $stmt->fetchAll();
        return count($rows);
    }

    public static function following($uname) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM this_follows_that WHERE this = ?");
        $stmt->execute([$uname]);
        $rows = $stmt->fetchAll();
        return count($rows);
    }

}
