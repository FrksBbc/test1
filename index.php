<?php 
require __DIR__ . '/vendor/autoload.php';
/*
use App\Lib\Config;
$LOG_PATH = Config::get('LOG_PATH', '');
echo "[LOG_PATH]: $LOG_PATH";
*/

/*
use App\Lib\Logger;
Logger::enableSystemLogs();
$logger = Logger::getInstance();
$logger->info('Hello World');
*/

use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Controller\Home;
use App\Controller\UserController;
use App\Controller\UserRoleController;

//REST-es műkődés elemei megvannak: METHOD (GET), path - elérési út /,
 //Melyik controllernek mit kell csinálnia, callback fv.
 //endpoint - végpont /

/*
Router::get('/twigTeszt', function(Request $req, Response $res) {
   $loader = new FilesystemLoader(__DIR__ . '\App\templates');
   $twig = new Environment($loader);
   echo $twig->render('users.html.twig', ['teszt'=>'Hello World3']);    
});
*/

Router::get('/', function() {
    (new Home())->indexAction();
});

/********************************************************/
/******************* Felhasználó endpointok ************/
/******************************************************/

//Felhasználók listázása
Router::get('/users', function(Request $req, Response $res) {
   return ((new UserController())->list());    
});

//Betölti az a felhasználó felvitelre szolgáló űrlapot
Router::get('/userAdd', function(Request $req, Response $res) {
    (new UserController())->add();
});

//DB mentés (controlleren és dao-n keresztül)
Router::post('/userAdd', function(Request $req, Response $res) {
    (new UserController())->save();
});

//id alapján betölti a módosítás felületre a user-t
Router::get('/userEdit/([0-9]*)', function(Request $req, Response $res) {
    (new UserController())->editById($req->params[0]);
});

//DB update - az űrlapon lévő adatokat bemódosítja a táblában
Router::post('/userEdit', function(Request $req, Response $res) {
    (new UserController())->update();
});

//id alapján betölti a törlés felületre a user-t
Router::get('/userDelete/([0-9]*)', function(Request $req, Response $res) {
    (new UserController())->deleteById($req->params[0]);
});

//DB update - deleted mezőt 0-ről 1-re állítja
Router::post('/userDelete', function(Request $req, Response $res) {
    (new UserController())->delete();
});

/********************************************************/
/***************** Jogosultságok endpointok ************/
/******************************************************/

Router::get('/userRoles', function(Request $req, Response $res) {
    return ((new UserRoleController())->list());    
 });
 
 Router::get('/userRoleAdd', function(Request $req, Response $res) {
     (new UserRoleController())->add();
 });
 
 Router::post('/userRoleAdd', function(Request $req, Response $res) {
     (new UserRoleController())->save();
 });
 
 Router::get('/userRoleEdit/([0-9]*)', function(Request $req, Response $res) {
     (new UserRoleController())->editById($req->params[0]);
 });
 
 Router::post('/userRoleEdit', function(Request $req, Response $res) {
     (new UserRoleController())->update();
 });
 
 Router::get('/userRoleDelete/([0-9]*)', function(Request $req, Response $res) {
     (new UserRoleController())->deleteById($req->params[0]);
 });
 
 Router::post('/userRoleDelete', function(Request $req, Response $res) {
     (new UserRoleController())->delete();
 });


App::run();
