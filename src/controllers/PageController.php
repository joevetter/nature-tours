<?php
namespace Acme\Controllers;

use Acme\Models\User;
use Acme\Models\Page;
use Acme\Auth\LoggedIn;

class PageController extends BaseController
{

  public function getShowHomePage()
  {
    #require_once(__DIR__ . "/../views/home.php");
    echo $this->twig->render('home.html',[
      'session' => LoggedIn::user()]);
  }

  public function getShowPage()
  {
    $title = '';
    $content = '';

    # extract page name from url
    $uri = explode("/", $_SERVER['REQUEST_URI']);
    $target = $uri[1];
    # find matching page in the db
    $page = Page::where('slug', '=', $target)->get();
    # look up page content
    foreach($page as $row)
    {
      $title = $row->title;
      $content = $row->content;
    }

    if(empty($title))
    {
      header("HTTP/1.0 404 Not Found");
      header("Location: /page-not-found");
      exit();
    }
    # pass content to twig te
    echo $this->twig->render('genericPage.html',[
      'session' => LoggedIn::user(),
      'title'   => $title,
      'content' => $content]);
    # render template

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
