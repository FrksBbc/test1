<?php namespace App\Model;

use App\Lib\Config;
use App\Lib\Database;
use App\Model\ICrudDao;
  
class UserRoleDao implements ICrudDao
{
    private static $DATA = [];

    public static function all(){
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $sql = "SELECT * FROM user_role WHERE deleted = 0 ORDER BY id;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function save()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $name = $_POST['name'];
        $status = isset($_POST['status']) ? 1 : 0;
        $sql = "INSERT INTO user_role(`name`,`status`,`created_at`) VALUES (:name, :status, NOW());";
        $statement = $conn->prepare($sql);
        $statement->execute([
            ':name'=>$name,
            ':status'=>$status
        ]);
    }

    public static function getById(int $id){
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $statement = $conn->prepare("SELECT * FROM user_role WHERE id =:id;");
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute([
            'id'=>$id,
        ]);
        return $statement->fetch();
    }

    public static function update(){
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $id = $_POST['id'];
        $name = $_POST['name'];
        $status = isset($_POST['status']) ? 1 : 0;
        $sql = "UPDATE user_role SET `name`=:name, `status`=:status,`updated_at` = NOW() WHERE `id` =:id;";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'name'=>$name,
                'status'=>$status,
                'id'=>$id,
            ]);
        } catch (\PDOException $ex) {
            var_dump($ex);
        }
    }

    public static function delete()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $id = $_POST['id'];
  
        $sql = "UPDATE user_role SET `deleted`=1,`deleted_at` = NOW() WHERE `id` =:id;";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'id'=>$id,
            ]);
        } catch (\PDOException $ex) {
            var_dump($ex);
        }
    }
}

