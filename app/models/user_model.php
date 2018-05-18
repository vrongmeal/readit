<?php

namespace Model;

class UserModel {
    
    // public static function find($id) {
    //     $instance = new UserModel();
    //     //db query
    //     $instance->usernme = //result;
    //     $instance->email = //result;

    //     return $instance;
    // }

    public static function findByUsername($usernmae) {
        
    }
    public static function find($uname) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$uname]);
        $user = $stmt->fetch();
        return $user;
    }

    public static function signin($uname, $pass) {
        $db = \DB::get_instance();
        $hash = sha1($pass);
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->execute([$uname, $hash]);
        $user = $stmt->fetch();
        if ($user) {
            return $user;
        } else {
            return null;
        }
        $stmt = null;
    }

    public static function signup($uname, $pass) {
        $db = \DB::get_instance();
        if (empty($pass) || empty($uname)) {
            return 0;
        } else {
            $row_1 = self::find($uname);
            if ($row_1) {
                return 1;
            } else {
                $stmt_2 = $db->prepare("INSERT INTO users (username, password, rating) VALUES (?, ?, ?)");
                $stmt_2->execute([$uname, sha1($pass), 0]);
                $stmt_2 = null;
                $row_2 = self::find($uname);
                return $row_2;
            }
        }
    }

    public static function rating($uname) {
        $score = 0;
        $rating = 0;
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT upvotes FROM links WHERE username = ?");
        $stmt->execute([$uname]);
        $rows = $stmt->fetchAll();
        $len = count($rows);
        for ($i = 0; $i < $len; $i++) {
            $score += $rows[$i][0];
        }
        $stmt = null;
        $stmt = $db->prepare("SELECT upvotes FROM comments WHERE username = ?");
        $stmt->execute([$uname]);
        $rows = $stmt->fetchAll();
        $len = count($rows);
        for ($i = 0; $i < $len; $i++) {
            $score += $rows[$i][0];
        }
        $stmt = null;
        if ($score < 25) {
            $rating = 1;
        } elseif ($score >= 25 && $score < 100) {
            $rating = 2;
        } elseif ($score >= 100 && $score < 250) {
            $rating = 3;
        } elseif ($score >= 250 && $score < 500) {
            $rating = 4;
        } elseif ($score >= 500 && $score < 1000) {
            $rating = 5;
        } elseif ($score >= 1000 && $score < 5000) {
            $rating = 6;
        } else {
            $rating = 7;
        }
        return array("score" => $score, "rating" => $rating);
    }

}
