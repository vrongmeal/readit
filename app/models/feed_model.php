<?php

namespace Model;

class FeedModel {

    private static function sort_new($x, $y) {
        $tx = strtotime($x["time"]);
        $ty = strtotime($y["time"]);
        if ($tx == $ty) return 0;
        return ($tx > $ty) ? -1 : 1;
    }

    public static function all($uname) {
        $result = array();
        $username = "";
        $db = \DB::get_instance();
        $stmt_1 = $db->prepare("SELECT * FROM this_follows_that WHERE this = ?");
        $stmt_1->execute([$uname]);
        $rows_1 = $stmt_1->fetchAll();
        if ($rows_1) {
            for ($i = 0; $i < count($rows_1); $i++) {
                $username = $rows_1[$i]["that"];
                $stmt_2 = $db->prepare("SELECT * FROM links WHERE username = ?");
                $stmt_2->execute([$username]);
                $rows_2 = $stmt_2->fetchAll();
                $result = array_merge($result, $rows_2);
            }
        }
        uasort($result, "self::sort_new");
        return $result;
    }

}