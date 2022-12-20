<?php namespace App\Model;

    interface ICrudDao {
        public static function all();
        public static function getById(int $id);
        public static function save();
        public static function delete();
        public static function update();
    }
?>
