<?php
/**
 * Created by PhpStorm.
 * User: dn
 * Date: 2018/9/4
 * Time: 12:59
 */

class Loader{

    // Load library classes
    public function library($lib){

        include LIB_PATH . "$lib.class.php";

    }


    // loader helper functions. Naming conversion is xxx_helper.php;
    public function helper($helper){

        include HELPER_PATH . "{$helper}_helper.php";

    }

}