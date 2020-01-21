<?php
if (isset($_GET['action'])){
  switch ($_GET['action']){
    case 'add':
      $clients = $this->pdo->query('SELECT * FROM `clients`');
      $url = '/index.php?function=clients&action=create';
      include 'forms/client.php';
    break;

    case 'create':
      $sql = $this->pdo->prepare('INSERT INTO `clients` (`surname`, `name`, `patronymic`, `phone`) VALUES (:surname, :name, :patronymic, :phone)');
      $sql->execute([
        ':surname' => $_POST['surname'],
        ':name' => $_POST['name'], 
        ':patronymic' => $_POST['patronymic'],
        ':phone' => $_POST['phone']
      ]);
      echo 'Новый клиент добавлен успешно!<br><br><a href="/index.php?function=clients" class="btn btn-primary">Назад</a>';
    break;
    
    case 'edit':
      $sql = $this->pdo->prepare('SELECT * FROM `clients` WHERE `id_client` = :id_client');
      $sql->execute([':id_client' => $_GET['id_client']]);
      $client = $sql->fetch();
      $url = '/index.php?function=clients&action=update&id_client=' . $_GET['id_client'];
      include 'forms/client.php';
    break;
    
    case 'update':
      $sql = $this->pdo->prepare('UPDATE `clients` SET `surname` = :surname, `name` = :name, `patronymic` = :patronymic, `phone` = :phone WHERE `id_client` = :id_client LIMIT 1');
      $sql->execute([
        ':id_client' => $_GET['id_client'],
        ':surname' => $_POST['surname'],
        ':name' => $_POST['name'], 
        ':patronymic' => $_POST['patronymic'],
        ':phone' => $_POST['phone']
      ]);
      echo 'Данные о клиенте успешно обновлены!<br><br><a href="/index.php?function=clients" class="btn btn-primary">Назад</a>';
    break;

    case 'delete':
      $sql = $this->pdo->prepare('DELETE FROM `clients` WHERE `id_client` = :id_client LIMIT 1');
      $sql->execute([':id_client' => $_GET['id_client']]);
      echo 'Данные о клиенте удалены!<br><br><a href="/index.php?function=clients" class="btn btn-primary">Назад</a>';
    break;
  }
}
else{
    $clients = $this->pdo->query('
      SELECT 
        `id_client`, 
        `surname`,
        `name`, 
        `patronymic`,
        `phone`
      FROM 
        `clients`
      ');

    echo '<table border="1" cellspacing="0" class="table table-striped" class="table table-striped">';

    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>ФИО</th>';
    echo '<th>Телефон</th>';
    echo '<th>&nbsp;</th>';
    echo '<th>&nbsp;</th>';
    echo '</tr>';

    foreach ($clients as $client)
    {
      echo '<tr>';
      echo '<td>' . $client['id_client'] . '</td> ' 
      . '<td>' .$client['surname'].' '. $client['name'] . ' '.$client['patronymic'].'</td> ' 
      . '<td>' . $client['phone'] . '</td> '
      . '<td><a class="badge badge-info" href="/index.php?function=clients&action=edit&id_client=' . $client['id_client'] . '">ред.</td>'
      . '<td></a> <a class="badge badge-danger" href="/index.php?function=clients&action=delete&id_client=' . $client['id_client'] . '">уд.</a></td>';
      echo '</tr>';

    }
    echo '</table>';
    echo '<a href="/index.php?function=clients&action=add" class="btn btn-primary" style="margin-bottom:1%; padding:1%;">Добавить</a><br>';
    echo '<a href="/" class="btn btn-primary" style="margin-top:1%; margin-top; padding:1%;">Вернуться на главную</a>';
}
