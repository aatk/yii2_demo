<?php

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Symfony</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="assets/js/main.controller.js"></script>
</head>
<body>

<div class="container">

    <div class="container">
        <div class="row">
            <div class="col">
                <button id="adduser" type="button" class="btn btn-success">Добавить</button>
            </div>
            <div class="col">
                <input id="findinput" />
                <button id="findusers" type="button" class="btn btn-primary">Найти</button>
            </div>
        </div>
    </div>
    
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Имя</th>
          <th scope="col">Фамилия</th>
          <th scope="col">Отчество</th>
          <th scope="col">Удалить</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <button id="more" type="button" class="btn btn-primary">Больше</button>
</div>


<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">User edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="userform">
            <input id="id" name="id" type="hidden" value=0 />
              <div class="form-group">
                <input class="form-control" id="firstname" name="firstname" value="" placeholder="Имя" />
              </div>
              <div class="form-group">
                <input class="form-control" id="secondname" name="secondname" value="" placeholder="Фамилия" />
              </div>
              <div class="form-group">
                <input class="form-control" id="surname" name="surname" value="" placeholder="Отчество" />
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="savechange" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>