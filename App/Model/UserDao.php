<?php namespace App\Model;

use App\Lib\Config;
use App\Lib\Database;
use App\Model\ICrudDao;
  
class UserDao implements ICrudDao
{
    private static $DATA = [];

    public static function all(){
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $sql = "SELECT u.id, u.first_name, u.last_name, u.email, u.role_id, u.status, u.created_at, u.updated_at, u.deleted_at, u.created_by, u.updated_by, u.deleted_by, ur.name FROM user as u INNER JOIN user_role as ur ON u.role_id = ur.id WHERE u.deleted= 0 ORDER BY u.id;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function load()
    {
        $DB_PATH = Config::get('DB_PATH', __DIR__ . '/../../db.json');
        self::$DATA = json_decode(file_get_contents($DB_PATH));
    }

    public static function add($user)
    {
        self::$DATA[] = $user;
        self::save();
        return $user;
    }

    public static function save()
    {
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        $userRole = $_POST['userRole'];
        $status = isset($_POST['status']) ? 1 : 0;

        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "INSERT INTO user (`last_name`,`first_name`,`email`,`password`,`role_id`,`status`) VALUES (:lastName, :firstName, :email, :password, :roleId, :status);";
        $statement = $conn->prepare($sql);
        $statement->execute([
            'lastName'=>$lastName,
            'firstName'=>$firstName,
            'email'=>$email,
            'password'=>$password,
            'roleId'=>$userRole,
            'status'=>$status
        ]);
    }

    public static function getById(int $id){
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $statement = $conn->prepare("SELECT * FROM user WHERE id =:id;");
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
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $email = $_POST['email'];
        $userRole = $_POST['userRole'];
        $status = isset($_POST['status']) ? 1 : 0;
        $sql = "UPDATE user SET `last_name`=:lastName, `first_name`=:firstName, `email`=:email, `role_id`=:roleId,`status`=:status,`updated_at` = NOW() WHERE `id` =:id;";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'lastName'=>$lastName,
                'firstName'=>$firstName,
                'email'=>$email,
                'roleId'=>$userRole,
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
  
        $sql = "UPDATE user SET `deleted`=1,`deleted_at` = NOW() WHERE `id` =:id;";
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

