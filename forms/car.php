<form action="<?= $url ?>" method="post" style="width: 50%; margin-left: 25%; margin-top: 10%;">

<label>Бренд</label><br>
  <select name="id_brand" class="form-control">
    <?php
    foreach ($brands as $brand){
      echo '<option value="' . $brand['id_brand'] . '"' . ($brand['id_brand'] === $car['id_brand'] ? ' selected' : '') . '>';
      echo $brand['name'];
      echo '</option>';
      echo "\n";
    }
    ?>
  </select><br>

  <label>Цена</label><br>
  <input class="form-control" type="text" name="price" value="<?= !empty($car['price']) ? $car['price'] : ""?>"><br>
  <label>Дата выпуска</label><br>
  <input class="form-control" type="date" name="date_issue" value="<?= !empty($car['date_issue']) ? $car['date_issue'] : ""?>"><br>
  <br>
  <button class="btn btn-primary" type="submit">Сохранить</button>
  <button class="btn btn-primary" type="button" onclick="window.location='/index.php?function=cars'">Назад</button>
  <button class="btn btn-primary" type="button" onclick="window.location='/'">В главное меню</button>

</form>