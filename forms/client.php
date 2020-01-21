<form action="<?= $url ?>" method="post" style="width: 50%; margin-left: 25%; margin-top: 10%;">

  <label>Фамилия</label><br>
  <input class="form-control" type="text" name="surname" value="<?= !empty($client['surname']) ? $client['surname'] : ""?>"><br>
  <label>Имя</label><br>
  <input class="form-control" type="text" name="name" value="<?= !empty($client['name']) ? $client['name'] : ""?>"><br>
  <label>Отчество</label><br>
  <input class="form-control" type="text" name="patronymic" value="<?= !empty($client['patronymic']) ? $client['patronymic'] : ""?>"><br>
  <label>Телефон</label><br>
  <input class="form-control" type="text" name="phone" value="<?= !empty($client['phone']) ? $client['phone'] : ""?>"><br>
  <br>
  <button class="btn btn-primary" type="submit">Сохранить</button>
  <button class="btn btn-primary" type="button" onclick="window.location='/index.php?function=clients'">Назад</button>
  <button class="btn btn-primary" type="button" onclick="window.location='/'">В главное меню</button>

</form>