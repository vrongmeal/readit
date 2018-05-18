<?php

namespace Model;

class CommentModel {

    private static function sort_top($x, $y) {
        return $y["upvotes"] - $x["upvotes"];
    }

    private static function sort_new($x, $y) {
        return strtotime($y["time"]) - strtotime($x["time"]);
    }

    public static function all_on_link($url, $sort) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM comments WHERE url = ?");
        $stmt->execute([$url]);
        $rows = $stmt->fetchAll();
        if ($sort == "new") {
            uasort($rows, "self::sort_new");
        } else {
            uasort($rows, "self::sort_top");
        }
        return $rows;
    }

    public static function create($url, $content, $uname) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO comments (url, content, username, upvotes) VALUES (?, ?, ?, ?)");
        $stmt->execute([$url, $content, $uname, 0]);
        $stmt = null;
    }

    public static function all_by_user($user) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM comments WHERE username = ?");
        $stmt->execute([$user]);
        $rows = $stmt->fetchAll();
        uasort($rows, "self::sort_new");
        return $rows;
    }

}
