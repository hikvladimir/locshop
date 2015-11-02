<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.10.2015
 * Time: 17:07
 */

class Router {
  private $routes;

  public function __construct()
  {
     $routesPath=ROOT.'/sourse/config/routes.php';
     $this->routes=include($routesPath);
  }

    private function GetUrl()
    {
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'],'/');
        }
    }
  public function run()
  {
     $uri=$this->GetUrl();


      foreach($this->routes as $uriPattern=>$path){
          if(preg_match("~$uriPattern~",$uri)) {

              $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

              $seqments=explode('/',$internalRoute);

              $controllerName=array_shift($seqments).'Controller';
              $controllerName=ucfirst($controllerName);

              $actionName='action'.ucfirst(array_shift($seqments));

              $parameters=$seqments;

              $controllerFile=ROOT.'/sourse/controllers/'.$controllerName.'.php';
              if(file_exists($controllerFile)){
                  include_once ($controllerFile);
              }



              $controllerObject=new $controllerName;
              $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

              if ($result!=null){
                  break;
              }
          }
      }
  }
}