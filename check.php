<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pizza Check</title>
  <link rel="shortcut icon" href="favicon.png">
  <link type="text/css" rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="wrap">

<?php
include "dbconfig.php";
//include "pizza.php";


    interface Check{
        function view();
        function sum_check();
    }

    class Order{

        public $pizza;
        public $sauce;
        public $size;
        public $sum;
        

        public function __construct (string $pizza = "No name", int $size = 0, string $sauce = "No name", $sum = 0){
            $this->pizza = $pizza;
            $this->sauce = $sauce;
            $this->size = $size;
            $this->sum = $sum;
        }

        function view (){
            ?>

    <div class="check">
      <div class="check-head">Pizza</div>
      <img class="logo" src="favicon.png" alt="img">
      <div class="check-order">
        <div class="order-order_title">Заказ №</div>
        <div class="order-order_number">0047</div>
      </div>
      <div class="check-pizza">
        <div class="check-pizza_name">
          <div class="name-label">Пицца:</div>
          <div class="name-title"><?php echo $this->pizza;?></div>
        </div>
        <div class="check-pizza_size">
          <div class="name-label">Размер:</div>
          <div class="name-title"><?php echo $this->size;?></div>
        </div>
        <div class="check-pizza_sauce">
          <div class="name-label">Соус:</div>
          <div class="name-title"><?php echo $this->sauce;?></div>
        </div>           

            <?php
        }

        function sum_check ($pizza_name, $sauce_name, $diameter, $conn){
            $price_pizza = mysqli_query($conn, "SELECT Price_USD FROM Pizza WHERE Name = '$pizza_name'");
            $result = mysqli_fetch_assoc($price_pizza);
            $s_pizza = (float)$result['Price_USD'];

            $price_sauce = mysqli_query($conn, "SELECT Price_USD FROM Sause WHERE Sauce = '$sauce_name'");
            $result2 = mysqli_fetch_assoc($price_sauce);
            $s_sause = (float)$result2['Price_USD'];

            $ratio = mysqli_query($conn, "SELECT Ratio FROM Diameter WHERE Diameter = '$diameter'");
            $result3 = mysqli_fetch_assoc($ratio);
            $s_diameter = (float)$result3['Ratio'];

            $sum = round(($s_pizza * $s_diameter + $s_sause), 2);

            echo "
            <div class='check-pizza_sauce'>
              <div class='name-label'>Сумма:</div>
              <div class='name-title'>".$sum." BYN</div>
            </div>
          </div>
          <div class='check-close'>
            <div class='check-close_txt'>ЗАКАЗ ОФОРМЛЕН</div>
            <div class='check-close_date'>9 мая 2022 15:05</div>
          </div>
        </div> 
            ";

            return $sum;
        }
    }

    $order = new Order ($_POST['pizza'], $_POST['size'], $_POST['sauce']);
    $order->view();
    
    $sum = $order->sum_check($order->pizza, $order->sauce, $order->size, $conn);

    //var_dump($a);
    exit;

    
    //Использование класса Пицца
    //$ii = new Pizza_Check ($_POST['pizza']);
    //$ii->view();
?>
  </div>
</body>

</html>