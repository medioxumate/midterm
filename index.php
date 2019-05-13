<?php

/**
 * The midterm
 * Created by PhpStorm.
 * @author Brian Kiehn
 * @version 1.0
 * @date 5/13/2019
 *
 */

//Session
session_start();

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload file
require_once('vendor/autoload.php');
require('model/validation-functions.php');

//create an instance of the Base class/ fat free object
//instantiate fat free
$f3 = Base::instance();

//turn on fatfree error reporting
//debugging in fat free is difficult
$f3->set('DEBUG', 3);

//Define a default root
$f3->route('GET /', function(){
    //display a view
    $view = new Template();
    echo $view->render('views/survey.html');
});