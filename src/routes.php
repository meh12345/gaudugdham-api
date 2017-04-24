<?php
use Psr\Http\Message\ServerRequestInterface as Request ;
use Psr\Http\Message\ResponseInterface as Response;
// User Process routes
 $app->group("/auth",function() use ($app){
   require_once  __DIR__ .'/../modules/auth/register.php';
   require_once  __DIR__ .'/../modules/auth/login.php';
   require_once  __DIR__ .'/../modules/auth/reset.php';
   $app->post('/register/','register')->add('verify_mobile_unique');
   $app->post('/verify/','verify_user')->add('check_mobile_exists');
   $app->post('/login/','fetch_user_data')->add('login')->add('check_verify_status');
   $app->post('/verify_mobile_unique/','verify_mobile_unique');
   $app->post('/forget_password/','forget_password')->add('check_verify_status')->add('check_mobile_exists');
   $app->post('/reset_mobile/','reset_mobile')->add('check_mobile_exists')->add('verify_mobile_unique')->setName('reset_mobile');
   $app->post('/update_profile/','update_profile')->add('check_mobile_exists');
 });

// Home page feed routes
$app->group("/feed",function() use ($app){
  require_once  __DIR__ .'/../modules/feed/banner_feed.php';
  require_once  __DIR__ .'/../modules/feed/product_feed.php';
  require_once  __DIR__ .'/../modules/feed/home_feed.php';
  $app->post('/home/','home_feed')->add('product_category_feed')->add('banner_feed');
  $app->post('/products/','products_feed');
});
?>