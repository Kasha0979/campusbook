<?php
class Book {
 public static function all(string $q=''): array {
  $s=db()->prepare('SELECT id,title,author,category,total_copies,available_copies FROM books WHERE title LIKE :q1 OR author LIKE :q2 OR category LIKE :q3 ORDER BY title');
  $v='%'.$q.'%';$s->execute(['q1'=>$v,'q2'=>$v,'q3'=>$v]);return $s->fetchAll();
 }
}
