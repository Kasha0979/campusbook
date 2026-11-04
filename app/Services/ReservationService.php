<?php
class ReservationService {
 public static function create(int $userId,int $bookId): array {
  $pdo=db();$pdo->beginTransaction();
  try {
   $s=$pdo->prepare('SELECT id,available_copies FROM books WHERE id=? FOR UPDATE');$s->execute([$bookId]);$book=$s->fetch();
   if (!$book || (int)$book['available_copies']<1){$pdo->rollBack();return [false,'No hay ejemplares disponibles.'];}
   $s=$pdo->prepare("SELECT COUNT(*) FROM reservations WHERE user_id=? AND book_id=? AND status='active'");$s->execute([$userId,$bookId]);
   if ((int)$s->fetchColumn()>0){$pdo->rollBack();return [false,'Ya tienes una reserva activa para este libro.'];}
   $s=$pdo->prepare('INSERT INTO reservations(user_id,book_id) VALUES(?,?)');$s->execute([$userId,$bookId]);
   $s=$pdo->prepare('UPDATE books SET available_copies=available_copies-1 WHERE id=?');$s->execute([$bookId]);
   $pdo->commit();return [true,'Reserva registrada correctamente.'];
  } catch(Throwable $ex){if($pdo->inTransaction())$pdo->rollBack();throw $ex;}
 }
 public static function mine(int $userId): array {
  $s=db()->prepare('SELECT r.id,r.reserved_at,r.status,b.title FROM reservations r JOIN books b ON b.id=r.book_id WHERE r.user_id=? ORDER BY r.id DESC');$s->execute([$userId]);return $s->fetchAll();
 }
 public static function cancel(int $userId,int $id): bool {
  $pdo=db();$pdo->beginTransaction();
  try {
   $s=$pdo->prepare("SELECT book_id FROM reservations WHERE id=? AND user_id=? AND status='active' FOR UPDATE");$s->execute([$id,$userId]);$row=$s->fetch();
   if(!$row){$pdo->rollBack();return false;}
   $s=$pdo->prepare("UPDATE reservations SET status='cancelled' WHERE id=?");$s->execute([$id]);
   $s=$pdo->prepare('UPDATE books SET available_copies=available_copies+1 WHERE id=?');$s->execute([$row['book_id']]);
   $pdo->commit();return true;
  } catch(Throwable $ex){if($pdo->inTransaction())$pdo->rollBack();throw $ex;}
 }
}
