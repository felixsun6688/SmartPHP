<?php
/**
 * Created by PhpStorm.
 * User: dn
 * Date: 2018/9/4
 * Time: 12:31
 */

class Smartphp{

    public  static function run(){
        self::init();
        self::autoload();
        self::dispatch();
    }

    // Initialization

    private  static function  init(){
        // Define path constants

        define("DS", DIRECTORY_SEPARATOR);
        define("ROOT", getcwd() . DS);
        define("APP_PATH", ROOT . 'application' . DS);
        define("FRAMEWORK_PATH", ROOT . "smartphp" . DS);
        define("PUBLIC_PATH", ROOT . "public" . DS);
        define("CONFIG_PATH", APP_PATH . "config" . DS);
        define("CONTROLLER_PATH", APP_PATH . "controller" . DS);
        define("MODEL_PATH", APP_PATH . "model" . DS);
        define("VIEW_PATH", APP_PATH . "view" . DS);
        define("CORE_PATH", FRAMEWORK_PATH . "core" . DS);
        define('DB_PATH', FRAMEWORK_PATH . "database" . DS);
        define("LIB_PATH", FRAMEWORK_PATH . "library" . DS);
        define("HELPER_PATH", FRAMEWORK_PATH . "helper" . DS);
        define("UPLOAD_PATH", PUBLIC_PATH . "upload" . DS);

        // Define platform, controller, action, for example:
        // index.php?p=admin&c=Goods&a=add

        define("PLATFORM", isset($_REQUEST['p']) ? $_REQUEST['p'] : 'home');
        define("CONTROLLER", isset($_REQUEST['c']) ? $_REQUEST['c'] : 'Index');
        define("ACTION", isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index');
        define("CURR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS);
        define("CURR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);

        // Load core classes
        require CORE_PATH . "Controller.class.php";
        require CORE_PATH . "Loader.class.php";
        require DB_PATH . "Mysql.class.php";
        require CORE_PATH . "Model.class.php";

        // Load configuration file
        $GLOBALS['config'] = include CONFIG_PATH . "config.php";

        // Start session
        session_start();
    }

    private static function autoload(){
        spl_autoload_register(array(__CLASS__,'load'));
    }

    private  static function dispatch(){
        // Instantiate the controller class and call its action method
        $controller_name = CONTROLLER . "Controller";
        $action_name = ACTION . "Action";
        $controller = new $controller_name;
        $controller->$action_name();
    }

    // Define a custom load method
    private static function load($classname)
    {
        // Here simply autoload app&rsquo;s controller and model classes
        if (substr($classname, -10) == "Controller") {
            // Controller
            require_once CURR_CONTROLLER_PATH . "$classname.class.php";

        } elseif (substr($classname, -5) == "Model") {
            // Model
            require_once MODEL_PATH . "$classname.class.php";

        }
    }

}