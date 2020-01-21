<?php
if (isset($_GET['action'])){
  switch ($_GET['action']){
    case 'add':
      $workers = $this->pdo->query('SELECT * FROM `workers`');
      $url = '/index.php?function=workers&action=create';
      include 'forms/worker.php';
    break;

    case 'create':
      $sql = $this->pdo->prepare('INSERT INTO `workers` (`surname`, `name`, `patronymic`, `position`) VALUES (:surname, :name, :patronymic, :position)');
      $sql->execute([
        ':surname' => $_POST['surname'],
        ':name' => $_POST['name'], 
        ':patronymic' => $_POST['patronymic'],
        ':position' => $_POST['position']
      ]);
      echo 'Новый работник добавлен успешно!<br><br><a href="/index.php?function=workers" class="btn btn-primary">Назад</a>';
    break;
    
    case 'edit':
      $sql = $this->pdo->prepare('SELECT * FROM `workers` WHERE `id_worker` = :id_worker');
      $sql->execute([':id_worker' => $_GET['id_worker']]);
      $worker = $sql->fetch();
      $url = '/index.php?function=workers&action=update&id_worker=' . $_GET['id_worker'];
      include 'forms/worker.php';
    break;
    
    case 'update':
      $sql = $this->pdo->prepare('UPDATE `workers` SET `surname` = :surname, `name` = :name, `patronymic` = :patronymic, `position` = :position WHERE `id_worker` = :id_worker LIMIT 1');
      $sql->execute([
        ':id_worker' => $_GET['id_worker'],
        ':surname' => $_POST['surname'],
        ':name' => $_POST['name'], 
        ':patronymic' => $_POST['patronymic'],
        ':position' => $_POST['position']
      ]);
      echo 'Данные о работнике успешно обновлены!<br><br><a href="/index.php?function=workers" class="btn btn-primary">Назад</a>';
    break;

    case 'delete':
      $sql = $this->pdo->prepare('DELETE FROM `workers` WHERE `id_worker` = :id_worker LIMIT 1');
      $sql->execute([':id_worker' => $_GET['id_worker']]);
      echo 'Данные о работнике удалены!<br><br><a href="/index.php?function=workers" class="btn btn-primary">Назад</a>';
    break;
  }
}
else{
    $workers = $this->pdo->query('
      SELECT 
        `id_worker`, 
        `surname`,
        `name`, 
        `patronymic`,
        `position`
      FROM 
        `workers`
      ');

    echo '<table border="1" cellspacing="0" class="table table-striped" class="table table-striped">';

    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>ФИО</th>';
    echo '<th>Должность</th>';
    echo '<th>&nbsp;</th>';
    echo '<th>&nbsp;</th>';
    echo '</tr>';

    foreach ($workers as $worker)
    {
      echo '<tr>';
      echo '<td>' . $worker['id_worker'] . '</td> ' 
      . '<td>' .$worker['surname'].' '. $worker['name'] . ' '.$worker['patronymic'].'</td> ' 
      . '<td>' . $worker['position'] . '</td> '
      . '<td><a class="badge badge-info" href="/index.php?function=workers&action=edit&id_worker=' . $worker['id_worker'] . '">ред.</td>'
      . '<td></a> <a class="badge badge-danger" href="/index.php?function=workers&action=delete&id_worker=' . $worker['id_worker'] . '">уд.</a></td>';
      echo '</tr>';

    }
    echo '</table>';
    echo '<a href="/index.php?function=workers&action=add" class="btn btn-primary" style="margin-bottom:1%; padding:1%;">Добавить</a><br>';
    echo '<a href="/" class="btn btn-primary" style="margin-top:1%; margin-top; padding:1%;">Вернуться на главную</a>';
}
