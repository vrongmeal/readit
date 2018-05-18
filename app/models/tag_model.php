<?php

namespace Model;

class TagModel {

    public static function all_on_link($url) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM link_has_tags WHERE url = ?");
        $stmt->execute([$url]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function add($url, $tag_input) {
        $db = \DB::get_instance();
        $tags = explode("#", $tag_input);
        for ($i = 1; $i < count($tags); $i++) {
            $stmt = $db->prepare("INSERT INTO link_has_tags (url, tag) VALUES (?, ?)");
            $stmt->execute([$url, $tags[$i]]);
            $stmt = null;
        }
    }

    public static function links_by_tag($tag) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT url FROM link_has_tags WHERE tag = ?");
        $stmt->execute([$tag]);
        $rows = $stmt->fetchAll();
        for ($i = 0; $i < count($rows); $i++) {
            $stmt_0 = $db->prepare("SELECT * FROM links WHERE url = ?");
            $stmt_0->execute([$rows[$i][0]]);
            $links[$i] = $stmt_0->fetch();
            $stmt_0 = null;
        }
        $stmt = null;
        return $links;
    }

}