<?php namespace App\Controller;

    interface ICrudController {
        public function list();
        public function add();
        public function save();
        public function delete();
        public function update();
        public function editById(int $id);
        public function deleteById(int $id);
    }
?>
