<?php
declare(strict_types=1);
require dirname(__DIR__).'/app/bootstrap.php';
require dirname(__DIR__).'/app/Models/Book.php';
require dirname(__DIR__).'/app/Services/ReservationService.php';
$route=(string)($_GET['route']??'home');
try {
 switch($route){
 case 'home': render('home');break;
 case 'books': $q=trim((string)($_GET['q']??''));render('books/index',['q'=>$q,'books'=>Book::all($q)]);break;
 case 'login':
  if(user()){header('Location: '.url('books'));exit;}
  $error='';
  if($_SERVER['REQUEST_METHOD']==='POST'){
   verify_csrf();$s=db()->prepare('SELECT id,name,email,password_hash FROM users WHERE email=?');$s->execute([trim((string)($_POST['email']??''))]);$u=$s->fetch();
   if($u && password_verify((string)($_POST['password']??''),$u['password_hash'])){session_regenerate_id(true);$_SESSION['user']=['id'=>(int)$u['id'],'name'=>$u['name']];header('Location: '.url('books'));exit;}
   $error='Credenciales incorrectas.';
  }
  render('auth/login',['error'=>$error]);break;
 case 'logout': if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit;}verify_csrf();$_SESSION=[];session_destroy();header('Location: '.url());exit;
 case 'reserve': require_login();if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit;}verify_csrf();$id=filter_input(INPUT_POST,'book_id',FILTER_VALIDATE_INT);if(!$id){http_response_code(400);exit('Libro inválido.');}[$ok,$message]=ReservationService::create((int)user()['id'],$id);$_SESSION['flash']=$message;header('Location: '.url('reservations').'&ok='.($ok?'1':'0'));exit;
 case 'reservations': require_login();$rows=ReservationService::mine((int)user()['id']);render('reservations/index',['rows'=>$rows]);break;
 case 'cancel': require_login();if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit;}verify_csrf();$id=filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);$ok=$id?ReservationService::cancel((int)user()['id'],$id):false;header('Location: '.url('reservations').'&ok='.($ok?'1':'0'));exit;
 default: http_response_code(404);echo 'Página no encontrada.';
 }
} catch(PDOException $ex){http_response_code(500);echo '<h1>Error de conexión o base de datos</h1><p>Revisa config/database.php y que MySQL esté iniciado.</p>';}
