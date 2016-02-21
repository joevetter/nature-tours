<?php
namespace Acme\Controllers;

use Acme\Models\User;

class PageController extends BaseController
{

  public function getShowHomePage()
  {
    #require_once(__DIR__ . "/../views/home.php");
    echo $this->twig->render('home.html');
  }

  public function getShowPage()
  {
    echo "generic page";
  }

  public function getTestDB()
  {
    try {
      $conn = new PDO("mysql:host=localhost", "dbuser", "secret");
    } catch (PDOException $pe) {
      die("Connection error: " . $pe->getMessage());
    }

    $first_name = "";
    $sql = 'select * from acme.users';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "test db: ";
    print_r($rows);
  }

  public function getTestORM()
  {
    $user = User::find(1);
    echo "test orm: " . $user->first_name . "<br>";
    print_r($user);
  }

}
