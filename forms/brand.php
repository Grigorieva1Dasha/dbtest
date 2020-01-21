<form action="<?= $url ?>" method="post" style="width: 50%; margin-left: 25%; margin-top: 10%;">

  <label>Название</label><br>
  <input class="form-control" type="text" name="name" value="<?= !empty($brand['name']) ? $brand['name'] : ""?>"><br>
  <label>Страна</label><br>
  <input class="form-control" type="text" name="country" value="<?= !empty($brand['country']) ? $brand['country'] : ""?>"><br>
  <br>
  <button class="btn btn-primary" type="submit">Сохранить</button>
  <button class="btn btn-primary" type="button" onclick="window.location='/index.php?function=brands'">Назад</button>
  <button class="btn btn-primary" type="button" onclick="window.location='/'">В главное меню</button>

</form>