<?php
 
/**
 * @file
 * Contains \Drupal\simpleajaxcall\Controller\SimpleAjaxCallController
 */
 
namespace Drupal\simpleajaxcall\Controller;
 
use Drupal\Core\Controller\ControllerBase;
 
/**
 * Controller routines for theme example routes.
 */
class SimpleAjaxCallController extends ControllerBase {
 
   /**
   * callajax
   * @return string
   */
  public function callajax(){
      // get post data "type" and "action"
     $type = \Drupal::request()->request->get("type");
     $function = \Drupal::request()->request->get("action"); 
     $function = htmlspecialchars($function);
     $type = htmlspecialchars($type);
     
      // get path to theme or module
     $path= empty($type) ?  \Drupal::theme()->getActiveTheme()->getPath() :  drupal_get_path('module', $type);
     $url_file= $path."/functions.php";
     
     
      if (!file_exists($url_file)) { // check if file functions.php exist in theme or module
           exit ("<p>Pleas create a file functions.php in your theme or module </p>");
      }
      
      require $url_file; // import file from module or theme
      
      if (!function_exists($function)) { // check if function exist in functions.php from in theme or module
           exit ("<p> this function  $function () doesn't exist in your file functions.php  </p>");
      }
     $function(); // call function by name
     
    exit(); // that's it
    
  }
 
  
}

