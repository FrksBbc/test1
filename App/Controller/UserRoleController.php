<?php namespace App\Controller;

use App\Model\UserRoleDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class UserRoleController implements ICrudController
{
    public function list()
    {
        $data = UserRoleDao::all();
        $twig = (new UserRoleController())->setTwigEnvironment();
        echo $twig->render('user_role/user_roles.html.twig', ['userRoles'=>$data]);  
    }

    public function add(){
        $twig = (new UserRoleController())->setTwigEnvironment();
        echo $twig->render('user_role/new_user_role.html.twig'); 
    }

    public function save()
    {
        if (isset($_POST['save'])){
            UserRoleDao::save();
            header('Location: /userRoles');
        }
    }

    public function delete(){
        if (isset($_POST['delete'])){
            UserRoleDao::delete();
            header('Location: /userRoles');
        }
    }

    public function update(){
        if (isset($_POST['update'])){
            UserRoleDao::update();
            header('Location: /userRoles');
        }
    }

    public function editById(int $id){
        $twig = (new UserRoleController())->setTwigEnvironment();
        $userRoleData = UserRoleDao::getById($id);
        if ($userRoleData){
            echo $twig->render('user_role/edit_user_role.html.twig', ['userRole'=>$userRoleData]); 
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public function deleteById(int $id){
        $twig = (new UserRoleController())->setTwigEnvironment();
        $userRoleData = UserRoleDao::getById($id);
        if ($userRoleData){
            echo $twig->render('user_role/delete_user_role.html.twig', ['userRole'=>$userRoleData]); 
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public function setTwigEnvironment(){
        $loader = new FilesystemLoader(__DIR__ . '\..\View');
        $twig = new \Twig\Environment($loader, [
            'debug' => true, //var_dumphoz hasonló mukodés megvalosuljon
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        return $twig;
    }
}
