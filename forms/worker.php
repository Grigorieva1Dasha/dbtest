<form action="<?= $url ?>" method="post" style="width: 50%; margin-left: 25%; margin-top: 10%;">

  <label>Фамилия</label><br>
  <input class="form-control" type="text" name="surname" value="<?= !empty($worker['surname']) ? $worker['surname'] : ""?>"><br>
  <label>Имя</label><br>
  <input class="form-control" type="text" name="name" value="<?= !empty($worker['name']) ? $worker['name'] : ""?>"><br>
  <label>Отчество</label><br>
  <input class="form-control" type="text" name="patronymic" value="<?= !empty($worker['patronymic']) ? $worker['patronymic'] : ""?>"><br>
  <label>Телефон</label><br>
  <input class="form-control" type="text" name="position" value="<?= !empty($worker['position']) ? $worker['position'] : ""?>"><br>
  <br>
  <button class="btn btn-primary" type="submit">Сохранить</button>
  <button class="btn btn-primary" type="button" onclick="window.location='/index.php?function=workers'">Назад</button>
  <button class="btn btn-primary" type="button" onclick="window.location='/'">В главное меню</button>

</form>