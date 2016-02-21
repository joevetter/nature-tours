<?php

$router->map('GET', '/', 'Acme\Controllers\PageController@getShowHomePage', 'home');
# register routes
$router->map('GET', '/register', 'Acme\Controllers\RegisterController@getShowRegisterPage', 'register');
$router->map('POST', '/register', 'Acme\Controllers\RegisterController@postShowRegisterPage', 'register_post');
# authentication routes
$router->map('GET', '/login', 'Acme\Controllers\AuthenticationController@getShowLoginPage', 'login');
$router->map('POST', '/login', 'Acme\Controllers\AuthenticationController@postShowLoginPage', 'login_post');
$router->map('GET', '/logout', 'Acme\Controllers\AuthenticationController@getLogout', 'logout');
# test routes
$router->map('GET', '/testdb', 'Acme\Controllers\PageController@getTestDB', 'testdb');
$router->map('GET', '/testorm', 'Acme\Controllers\PageController@getTestORM', 'testorm');
$router->map('GET', '/slug', function(){
  $slug = new Cocur\Slugify\Slugify();
  echo $slug->slugify('About Acme')."<br>";
  echo $slug->slugify($_REQUEST['slug'])."<br>";
});
$router->map('GET', '/test', function(){
  echo "closure test<br>";
  #$user = Acme\models\User::find(1);
  $testimonials = Acme\models\User::find(1)->testimonials()->get();
  var_dump($testimonials);
});
# generic routes
$router->map('GET', '/[*]', 'Acme\Controllers\PageController@getShowPage', 'generic_page');
