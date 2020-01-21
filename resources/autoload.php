<?php 
echo '<form action="" method="post" class="form-inline">
				<label>Информация о заказе автомобиля (по ФИО заказчика или по ID заказа)</label><br>
        <input class="form-control" placeholder="Введите ФИО заказчика" type="text" name="find_order_of_car1" >
        <button type="submit" class="btn btn-primary">Найти</button><br><br>
        <input class="form-control" placeholder="Введите ID заказа" type="text" name="find_order_of_car2" >
      <button type="submit" class="btn btn-primary">Найти</button><br><br>
      </form>';
if ($_POST){
	$order_view = $this->pdo->query('show tables');
	$is_exsists = 0;
	foreach ($order_view as $key => $value){
		if ($value[0] == 'find_order_car'){
			$is_exsists = 1;
			break;
		}
	}
	if ($is_exsists == 0){
    $this->pdo->query('
    CREATE VIEW `find_order_car` as select `orders_cars`.`id_order_car` as `id_order_car`, 
    CONCAT_WS(" ", `clients`.`surname`, `clients`.`name`, `clients`.`patronymic`) as `client_name`, 
    `brand`.name as `brand_name`,
    `cars`.price as `car_price`,
		CONCAT_WS(" ", `workers`.`surname`, `workers`.`name`, `workers`.`patronymic`) as `worker_name`, 
    `orders_cars`.status as `order_status`
	  FROM `orders_cars`,`clients`,`workers`,`brand`, `cars`
    WHERE `clients`.id_client = `orders_cars`.id_client and `brand`.id_brand = `cars`.id_brand and `cars`.id_car = `orders_cars`.id_car
    and `workers`.id_worker = `orders_cars`.id_worker ORDER BY id_order_car;
	  ');
  }
  if (!empty($_POST['find_order_of_car1'])){
    $sql = $this->pdo->prepare('SELECT * FROM find_order_car where client_name = :client_name');
    $sql->execute([':client_name' => $_POST['find_order_of_car1']]);
    $order_info = $sql->fetch();
  }
  if (!empty($_POST['find_order_of_car2'])){
    $sql = $this->pdo->prepare('SELECT * FROM find_order_car where id_order_car = :id_order_car');
    $sql->execute([':id_order_car' => $_POST['find_order_of_car2']]);
    $order_info = $sql->fetch();
  }
  if (empty($order_info)){
    echo "По данному заказчику нет информации<br><br>";
  }
  else {
    echo '<table border="1" cellspacing="0" class="table table-striped" >';
    echo '<tr>';
    echo '<th>ID заказа</th>';
    echo '<th>Имя заказчика</th>';
    echo '<th>Автомобиль</th>';
    echo '<th>Стоимость</th>';
    echo '<th>Имя работника</th>';
    echo '<th>Статус</th>';
    echo '</tr>';
      
    echo '<tr>';
    echo '<td>' . $order_info['id_order_car'] . '</td> ' 
      . '<td>' . $order_info['client_name']. '</td> '.
      '<td>' . $order_info['brand_name']. '</td> '.
      '<td>' . $order_info['car_price'] . '</td> '. 
      '<td>' . $order_info['worker_name']. '</td> '. 
      '<td>' . $order_info['order_status'] . '</td> ';
    echo '</tr>';
    echo '</table>';
    echo '</table>';
    echo '<a class="badge badge-info" href="" style="margin-bottom:10%">Скрыть</a>';
  }
}
echo '<ul class="list-group" >
  <li class="list-group-item"><a class="list-group-item" href="index.php?function=brands">Список брендов автомобилей</a></li>
  <li class="list-group-item"><a class="list-group-item" href="index.php?function=cars">Список автомобилей</a></li>
  <li class="list-group-item"><a class="list-group-item" href="index.php?function=clients">Список клиентов</a></li>
  <li class="list-group-item"><a class="list-group-item" href="index.php?function=workers">Список работников</a></li>
  <li class="list-group-item"><a class="list-group-item" href="index.php?function=orders_cars">Заказы на автомобили</a></li>
</ul>';
?>