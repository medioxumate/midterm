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

//create an instance of the Base class/ fat free object
//instantiate fat free
$f3 = Base::instance();

//turn on fatfree error reporting
//debugging in fat free is difficult
$f3->set('DEBUG', 3);

//Survey array
$f3->set('questions', array('This midterm is easy', 'I don\'t like midterms',
    'Today is Monday', 'Today is not Tuesday', 'Help! Trapped in a survey design office!', 'I used my real name'));

//Define a default root
$f3->route('GET /', function(){
    //display a view
    $view = new Template();
    echo $view->render('views/survey.html');
});

$f3->route('GET|POST /survey', function($f3){
    //display a view
    $view = new Template();
    if (!empty($_POST['survey'])
        && isset($_POST['name']) && !empty($_POST['name'])){
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['survey'] = $_POST['survey'];
    }

    else {
        if (empty($_POST['survey'])) {
            $f3->set("errors['survey']", "error: Must check at least one box");
        }
        if (!isset($_POST['name']) && !empty($_POST['name'])){
            $f3->set("errors['name']", "error: Name field must be filled");
        }
    }

    echo $view->render('views/midterm.html');
});

$f3->route('GET|POST /results', function(){
    //display a view
    $view = new Template();

    echo $view->render('views/results.html');
});
//run Fat-free
$f3->run();