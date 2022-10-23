<!DOCTYPE html>

<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>
  <link rel="shortcut icon" href="favicon.png">
  <link type="text/css" rel="stylesheet" href="styles.css">
  <link type="text/css" rel="stylesheet" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
  </head>

<body>
 
 
  <div class="wrap">
   
  <form id="form" method="POST" action = "check.php">

    <header>
      <span class="title">Выбор пиццы</span>
      <img src="favicon.png">
    </header>

      <div class="pizza-name">
        <label class="label" for="get_pizza">Название:</label>
        <select id="get_pizza" name="pizza">
          <option value="">Выберите пиццу</option>
          <?php 
          include "dbconfig.php";
          $que = mysqli_query($conn, "SELECT * FROM Pizza");
          while ($result = mysqli_fetch_assoc($que)){
            echo "<option value='".$result['Name']."'>".$result['Name']."</option>";
          }
          ?>
        </select>
      </div>
      
      <div class="pizza-size">
        <label class="label" for="get_pizza">Размер, см:</label>
        <select id="get_pizza" name="size">
          <option value="">Выберите размер</option>
          <?php
          include "dbconfig.php";
          $que = mysqli_query($conn, "SELECT * FROM Diameter");
          while ($result = mysqli_fetch_assoc($que)){
            echo "<option value='".$result['Diameter']."'>".$result['Diameter']."</option>";
          }
          ?>
        </select>
      </div>

      <div class="pizza-sauce">
        <label class="label" for="get_pizza">Cоус:</label>
        <select id="get_pizza" name="sauce">
          <option value="">Выберите соус</option>
          <?php
          include "dbconfig.php";
          $que = mysqli_query($conn, "SELECT * FROM Sause");
          while ($result = mysqli_fetch_assoc($que)){
            echo "<option value='".$result['Sauce']."'>".$result['Sauce']."</option>";
          }
          ?>
        </select>
      </div>

      <input class="btn" type="submit" value="Заказать">
    </form>

    
  </div>
  <div id="divMessage"></div>

  <script type="text/javascript">
    $(document).ready(function(){ 
    $("#form").on("submit", function(e){
      e.preventDefault(); // Чтобы не отправлялась форма а обрабатывалась через Ajax 
      //отправка данных
      $.ajax({
        method: "POST",
        url: "check.php",
        //async: false,
        data: $(this).serialize(),  // Сериализация всей формы (все инпуты)
        success:function(data){ // при успешной обработке запроса  
          console.log(data); // В консоли вывести то что приходит ( echo это в php)
          $("#divMessage").html(data); // Вывод результата    
          $("#form").hide(1000); // убрать за секунду форму (1000 продолжительность анимации)
          $("title").text("Чек"); // Изменить TITLE страницы
        },
        error:function(data){
          //Обработчик ошибки
          console.log("Ошибка ",data);  
        }   
      });
    });   
    
  })
  </script>

</body>
</html>