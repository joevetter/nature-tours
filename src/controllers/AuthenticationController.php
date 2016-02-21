<?php
namespace Acme\Controllers;

use Acme\Models\User;
use Acme\Auth\LoggedIn;

class AuthenticationController extends BaseController
{

  public function getShowLoginPage()
  {
    #require_once(__DIR__ . "/../views/login.html");
    echo $this->twig->render('login.html', [
      'session' => LoggedIn::user()]);
  }

  public function postShowLoginPage()
  {
    #echo "Posted login!";
    $isUserVerified = false;
    # look up user
    $user = User::where('email', '=', $_REQUEST['email'])
                ->first();
    #var_dump($user);
    # validate credentials
    if(!empty($user))
    {
      if(password_verify($_REQUEST['password'], $user->password))
      {
        # if valid -> log in
        $_SESSION['user'] = $user;
        #$_SESSION['msg'] = "Successful login!";
        #header("Location: /");
        #unset($_SESSION['msg']);
        echo $this->twig->render('home.html', [
          'session' => LoggedIn::user(),
          'notification' => ['Successful login!'],
          'type' => 'info']);
        exit();
      }
    }

    # if not valid -> redirect to login page
    unset($_SESSION['user']);
    #$_SESSION['msg'] = "Invalid login!";
    #header("Location: /login");
    echo $this->twig->render('login.html', [
      'session' => LoggedIn::user(),
      'notification' => ['Invalid login!'],
      'type' => 'error']);
    exit();
  }

  public function getLogout()
  {
    unset($_SESSION['user']);
    session_destroy();
    echo $this->twig->render('login.html', [
      'session' => LoggedIn::user(),
      'notification' => ['Successful logout!'],
      'type' => 'info']);
    exit();
  }

  public function getTestUser()
  {
    LoggedIn::user();
  }

}
