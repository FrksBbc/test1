<?php namespace App\Controller;

use App\Model\UserDao;
use App\Model\UserRoleDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class UserController implements ICrudController
{
    public function list()
    {
        $data = UserDao::all();
        $twig = (new UserController())->setTwigEnvironment();
        echo $twig->render('user/users.html.twig', ['users'=>$data]);  
    }

    public function add(){
        $twig = (new UserController())->setTwigEnvironment();
        $userRoles = UserRoleDao::all();
        echo $twig->render('user/new_user.html.twig', ['userRoles'=>$userRoles]); 
    }

    public function save()
    {
        if (isset($_POST['save'])){
            UserDao::save();
            header('Location: /users');
        }
    }

    public function delete(){
        if (isset($_POST['delete'])){
            UserDao::delete();
            header('Location: /users');
        }
    }

    public function update(){
        if (isset($_POST['update'])){
            UserDao::update();
            header('Location: /users');
        }
    }

    public function editById(int $id){
        $twig = (new UserController())->setTwigEnvironment();
        $userData = UserDao::getById($id);
        $userRoles = UserRoleDao::all();
        if ($userData){
            echo $twig->render('user/edit_user.html.twig', ['user'=>$userData, 'userRoles'=>$userRoles]); 
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public function deleteById(int $id){
        $twig = (new UserController())->setTwigEnvironment();
        $userData = UserDao::getById($id);
        if ($userData){
            echo $twig->render('user/delete_user.html.twig', ['user'=>$userData]); 
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
