<?php
if (isset($_GET['action'])){
  switch ($_GET['action']){
    case 'add':
      $brands = $this->pdo->query('SELECT * FROM `brand`');
      $cars = $this->pdo->query('SELECT * FROM `cars`');
      $url = '/index.php?function=cars&action=create';
      include 'forms/car.php';
    break;

    case 'create':
      $sql = $this->pdo->prepare('INSERT INTO `cars` (`id_brand`, `price`, `date_issue`) VALUES (:id_brand, :price, :date_issue)');
      $sql->execute([
        ':id_brand' => $_POST['id_brand'], 
        ':price' => $_POST['price'],
        ':date_issue' => $_POST['date_issue']
      ]);
      echo 'Новый автомобиль добавлен успешно!<br><br><a href="/index.php?function=cars" class="btn btn-primary">Назад</a>';
    break;
    
    case 'edit':
      $brands = $this->pdo->query('SELECT * FROM `brand`');
      $sql = $this->pdo->prepare('SELECT * FROM `cars` WHERE `id_car` = :id_car');
      $sql->execute([':id_car' => $_GET['id_car']]);
      $car = $sql->fetch();
      $url = '/index.php?function=cars&action=update&id_car=' . $_GET['id_car'];
      include 'forms/car.php';
    break;
    
    case 'update':
      $brands = $this->pdo->query('SELECT * FROM `brand`');
      $sql = $this->pdo->prepare('UPDATE `cars` SET `id_brand` = :id_brand, `price` = :price, `date_issue` = :date_issue WHERE `id_car` = :id_car LIMIT 1');
      $sql->execute([
        ':id_car' => $_GET['id_car'],
        ':id_brand' => $_POST['id_brand'], 
        ':price' => $_POST['price'],
        ':date_issue' => $_POST['date_issue']
      ]);
      echo 'Данные об автомобиле успешно обновлены!<br><br><a href="/index.php?function=cars" class="btn btn-primary">Назад</a>';
    break;

    case 'delete':
      $sql = $this->pdo->prepare('DELETE FROM `cars` WHERE `id_car` = :id_car LIMIT 1');
      $sql->execute([':id_car' => $_GET['id_car']]);
      echo 'Данные об автомобиле удалены!<br><br><a href="/index.php?function=cars" class="btn btn-primary">Назад</a>';
    break;
  }
}
else{
    $cars = $this->pdo->query('
      SELECT 
        `c`.id_car,
        `b`.name, 
        `price`, 
        `date_issue`
      FROM 
        `cars` `c`,
        `brand` `b`
      WHERE
        `b`.id_brand = `c`.id_brand
      ');

    echo '<table border="1" cellspacing="0" class="table table-striped" class="table table-striped">';

    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>ID бренда</th>';
    echo '<th>Цена</th>';
    echo '<th>Дата выпуска</th>';
    echo '<th>&nbsp;</th>';
    echo '<th>&nbsp;</th>';
    echo '</tr>';

    foreach ($cars as $car)
    {
      echo '<tr>';
      echo '<td>' . $car['id_car'] . '</td> ' 
      . '<td>' . $car['name'] . '</td> '
      . '<td>' . $car['price'] . '</td> ' 
      . '<td>' . $car['date_issue'] . '</td> '
      . '<td><a class="badge badge-info" href="/index.php?function=cars&action=edit&id_car=' . $car['id_car'] . '">ред.</td>'
      . '<td></a> <a class="badge badge-danger" href="/index.php?function=cars&action=delete&id_car=' . $car['id_car'] . '">уд.</a></td>';
      echo '</tr>';

    }
    echo '</table>';
    echo '<a href="/index.php?function=cars&action=add" class="btn btn-primary" style="margin-bottom:1%; padding:1%;">Добавить</a><br>';
    echo '<a href="/" class="btn btn-primary" style="margin-top:1%; margin-top; padding:1%;">Вернуться на главную</a>';
}
