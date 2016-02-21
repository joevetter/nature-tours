<?php
namespace Acme\Controllers;

#use Respect\Validation\Validator as Validator;
use Acme\Validation\Validator;
use Acme\Auth\LoggedIn;

class BaseController
{

  protected $loader;
  protected $twig;

  public function __construct()
  {
    $this->loader = new \Twig_Loader_Filesystem(__DIR__ . "/../views");
    $this->twig = new \Twig_Environment($this->loader,[
        'cache' => false,
        'debug' => true,
    ]);
  }

}
