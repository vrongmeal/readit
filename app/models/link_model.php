<?php

namespace Model;

class LinkModel {

    private static function sort_top($x, $y) {
        $ux = $x["upvotes"];
        $uy = $y["upvotes"];
        if ($ux == $uy) return 0;
        return ($ux > $uy) ? -1 : 1;
    }

    private static function sort_new($x, $y) {
        $tx = strtotime($x["time"]);
        $ty = strtotime($y["time"]);
        if ($tx == $ty) return 0;
        return ($tx > $ty) ? -1 : 1;
    }

    private static function sort_trending($x, $y) {
        $current = time();
        $vx = ($x["upvotes"])/($current - strtotime($x["time"]));
        $vy = ($y["upvotes"])/($current - strtotime($y["time"]));
        if ($vx == $vy) return 0;
        return ($vx > $vy) ? -1 : 1;
    }

    private static function all() {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM links");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function find($url) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM links WHERE url = ?");
        $stmt->execute([$url]);
        $row = $stmt->fetch();
        return $row;
    }

    public static function all_by_user($user) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM links WHERE username = ?");
        $stmt->execute([$user]);
        $rows = $stmt->fetchAll();
        uasort($rows, "self::sort_new");
        return $rows;
    }

    public static function create($uname, $title, $url) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO links (username, title, url, upvotes) VALUES (?, ?, ?, ?)");
        $stmt->execute([$uname, $title, $url, 0]);
        $stmt = null;
    }

    public static function top() {
        $rows = self::all();
        uasort($rows, "self::sort_top");
        $top = array_values($rows);
        return $top;
    }

    public static function new() {
        $rows = self::all();
        uasort($rows, "self::sort_new");
        $new = array_values($rows);
        return $new;
    }

    public static function trending() {
        $rows = self::all();
        uasort($rows, "self::sort_trending");
        $trending = array_values($rows);
        return $trending;
    }

}
