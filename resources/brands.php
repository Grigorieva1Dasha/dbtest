<?php
if (isset($_GET['action'])){
  switch ($_GET['action']){
    case 'add':
      $brands = $this->pdo->query('SELECT * FROM `brand`');
      $url = '/index.php?function=brands&action=create';
      include 'forms/brand.php';
    break;

    case 'create':
      $sql = $this->pdo->prepare('INSERT INTO `brand` (`name`, `country`) VALUES (:name, :country)');
      $sql->execute([
        ':name' => $_POST['name'], 
        ':country' => $_POST['country']
      ]);
      echo 'Новый бренд добавлен успешно!<br><br><a href="/index.php?function=brands" class="btn btn-primary">Назад</a>';
    break;
    
    case 'edit':
      $sql = $this->pdo->prepare('SELECT * FROM `brand` WHERE `id_brand` = :id_brand');
      $sql->execute([':id_brand' => $_GET['id_brand']]);
      $brand = $sql->fetch();
      $url = '/index.php?function=brands&action=update&id_brand=' . $_GET['id_brand'];
      include 'forms/brand.php';
    break;
    
    case 'update':
      $sql = $this->pdo->prepare('UPDATE `brand` SET `name` = :name, `country` = :country WHERE `id_brand` = :id_brand LIMIT 1');
      $sql->execute([
        ':id_brand' => $_GET['id_brand'],
        ':name' => $_POST['name'], 
        ':country' => $_POST['country']
      ]);
      echo 'Данные о бренде успешно обновлены!<br><br><a href="/index.php?function=brands" class="btn btn-primary">Назад</a>';
    break;

    case 'delete':
      $sql = $this->pdo->prepare('DELETE FROM `brand` WHERE `id_brand` = :id_brand LIMIT 1');
      $sql->execute([':id_brand' => $_GET['id_brand']]);
      echo 'Данные о бренде удалены!<br><br><a href="/index.php?function=brands" class="btn btn-primary">Назад</a>';
    break;
  }
}
else{
    $brands = $this->pdo->query('
      SELECT 
        `id_brand`, 
        `name`, 
        `country`
      FROM 
        `brand`
      ');

    echo '<table border="1" cellspacing="0" class="table table-striped" class="table table-striped">';

    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Название</th>';
    echo '<th>Страна</th>';
    echo '<th>&nbsp;</th>';
    echo '<th>&nbsp;</th>';
    echo '</tr>';

    foreach ($brands as $brand)
    {
      echo '<tr>';
      echo '<td>' . $brand['id_brand'] . '</td> ' 
      . '<td>' . $brand['name'] . '</td> ' 
      . '<td>' . $brand['country'] . '</td> '
      . '<td><a class="badge badge-info" href="/index.php?function=brands&action=edit&id_brand=' . $brand['id_brand'] . '">ред.</td>'
      . '<td></a> <a class="badge badge-danger" href="/index.php?function=brands&action=delete&id_brand=' . $brand['id_brand'] . '">уд.</a></td>';
      echo '</tr>';

    }
    echo '</table>';
    echo '<a href="/index.php?function=brands&action=add" class="btn btn-primary" style="margin-bottom:1%; padding:1%;">Добавить</a><br>';
    echo '<a href="/" class="btn btn-primary" style="margin-top:1%; margin-top; padding:1%;">Вернуться на главную</a>';
}
