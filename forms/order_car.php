<form action="<?= $url ?>" method="post" style="width: 50%; margin-left: 25%; margin-top: 10%;">

<label>ФИО клиента</label><br>

  <select name="id_client" class="form-control">
    <?php
    if (empty($_GET['id_order_car'])) {
      foreach ($clients as $client){
        echo '<option value="' . $client['id_client'] . '"' 
        . '>';
        echo $client['surname'].' '.$client['name'].' '.$client['patronymic'];
        echo '</option>';
        echo "\n";
      }
    }
    else {
      foreach ($clients as $client){
        echo '<option value="' . $client['id_client'] . '"' . ($client['id_client'] === $orders_cars['id_client'] ? ' selected' : '') 
        . '>';
        echo $client['surname'].' '.$client['name'].' '.$client['patronymic'];
        echo '</option>';
        echo "\n";
      }
    }
    ?>
  </select><br>

<label>Автомобиль</label><br>
  <select name="id_car" class="form-control">
    <?php
    if (empty($_GET['id_order_car'])){
        foreach ($cars as $car) {
            echo '<option value="' . $car['id_car'] . '"' 
            . '>';
            echo $car['id_brand'].' '.$car['price'];
            echo '</option>';
            echo "\n";
        }
      }
      else {
        foreach ($cars as $car) {
          echo '<option value="' . $car['id_car'] . '"' . ($car['id_car'] === $orders_cars['id_car'] ? ' selected' : '') 
          . '>';
          echo $car['id_brand'].' '.$car['price'];
          echo '</option>';
          echo "\n";
      }
      }
    ?>
  </select><br>

<label>ФИО работника</label><br>
    <select name="id_worker" class="form-control">
    <?php
    if (empty($_GET['id_order_car'])){
      foreach ($workers as $worker){
        echo '<option value="' . $worker['id_worker'] . '">';
        echo $worker['surname'].' '.$worker['name'].' '.$worker['patronymic'];
        echo '</option>';
        echo "\n";
      }
    }
    else{
      foreach ($workers as $worker){
          echo '<option value="' . $worker['id_worker'] . '"' . ($worker['id_worker'] === $orders_cars['id_worker'] ? ' selected' : '') 
          . '>';
          echo $worker['surname'].' '.$worker['name'].' '.$worker['patronymic'];
          echo '</option>';
          echo "\n";
      }
    }
    ?>
</select><br>

<label>Статус</label><br>
  <?php
  if (empty($_GET['id_order_car'])){
    echo '<input class="form-control" type="text" name="status"><br>';
  }
  else{
    echo '<input class="form-control" type="text" name="status" value = "' . $orders_cars['status'].'"><br>';
  }
  ?>
  <br>
  <button class="btn btn-primary" type="submit">Сохранить</button>
  <button class="btn btn-primary" type="button" onclick="window.location='/index.php?function=orders_cars'">Назад</button>
  <button class="btn btn-primary" type="button" onclick="window.location='/'">В главное меню</button>

</form>
