<?php
namespace Acme\Controllers;

use Acme\Models\User;
use Acme\Auth\LoggedIn;
use Acme\Validation\Validator;

class RegisterController extends BaseController
{

  public function getShowRegisterPage()
  {
    #require_once(__DIR__ . "/../views/register.php");
    echo $this->twig->render('register.html',[
      'session' => LoggedIn::user()]);
  }

  public function postShowRegisterPage()
  {
    $validation_data = [
      "first_name"    => "min:3",
      "last_name"     => "min:3",
      "email"         => "email|equalTo:verify_email",
      "verify_email"  => "email",
      "password"      => "min:5|equalTo:verify_password",
    ];
    # validate data
    $validator = new Validator;

    $errors = $validator->isValid($validation_data);

    if(count($errors))
    {
      #$_SESSION['msg'] = $errors;
      #header("Location: /register");
      echo $this->twig->render('register.html', [
        'session' => LoggedIn::user(),
        'notification' => $errors,
        'type' => 'error']);
      exit();
    }

    # save user in db
    $user = new User();
    $user->first_name = $_REQUEST['first_name'];
    $user->last_name = $_REQUEST['last_name'];
    $user->email = $_REQUEST['email'];
    $user->password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
    $user->save();

    $_SESSION['user'] = $user;

    echo $this->twig->render('home.html', [
      'session' => LoggedIn::user(),
      'notification' => ['Successful registered!'],
      'type' => 'info']);
  }

}
