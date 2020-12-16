<?php
error_reporting(0);

// Подключение к БД

$connect=mysqli_connect('localhost','id13292174_fnaffy','WouldYouKindly75+','id13292174_bro_toys') or die ("Ошибка".mysqli_error($connect));
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<title>ФНАФИ - интернет-магазин</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/go_top.css">
  <script src="script/jquery-2.2.1.min.js"></script>
  <script src="script/go_top.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" type="text/css" href="css/reset.css">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
	<script src="script/login.js" ></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
  <script type="text/javascript" src="script/slider.js"></script>
</head>
<body onload="<?php $whatbrand = "All"; ?>" class="here">
    
    <!-- Шапка -->
    
	<div class="bblack fixed dos">
	<nav class="navbar navbar-default dos blue black">
	<div class="container-fluid dos">
	<div class="">
	</button>
	<a href="#"><img class="logot navbar-brand up" src="img/logo.png"></a><a class="navbar-brand padw brand logote" href="#">ФНАФИ</a>
  <span class="navbar-brand padw" id="connum">Контактный номер: +79476835476</span>
  <span class="needcall navbar-brand padw"></span><a class="navbar-brand padw getcall open-modal" data-modal="#modalcall" href="#">Заказать звонок</a>
	</div>
	</div>
	</nav>
	</div>
	
	<!-- Блок с приветствием посетителя -->
	
	<div class="opac"><div class="hello">
		<h1 class="wel info">Добро пожаловать в онлайн-магазин детских игрушек "ФНАФИ"</h1>
    <center><img class="wave" src="img/wave.gif"></center>
	</div></div>
	
	<!-- Слайдер с преимуществами компании -->
	
	    <div class="slider">
      <ul class="slides">
        <li class="slide">
          <figure>
            <br><br><br><br><br><br><br><br>
            <img class="infoimg" src="img/petition.png">
            <br><br>
            <h2 class="info">Наличие всех товаров на складе</h2>
          </figure>
        </li>
        <li class="slide">
          <figure>
            <br><br><br><br><br><br><br><br>
            <img class="infoimg" src="img/clock.png">
            <h2 class="info">Круглосуточный прием заказов</h2>
          </figure>
        </li>
        <li class="slide">
          <figure>
            <br><br><br><br><br><br><br><br>
            <img class="infoimg" src="img/delivery.png">
            <h2 class="info">Бесплатная доставка по РФ</h2>
          </figure>
        </li>
        <li class="slide">
          <figure>
            <br><br><br><br><br><br><br><br>
            <img class="infoimg" src="img/fastdelivery.png">
            <h2 class="info">Срочная доставка</h2>
          </figure>
        </li>
        <li class="slide">
          <figure>
            <br><br><br><br><br><br><br><br>
            <img class="infoimg" src="img/toy.png">
            <br><br>
            <h2 class="info">Последние новинки из категории игрушек</h2>
          </figure>
        </li>
      </ul>
    </div>
    
    <!-- JavaScript код работы слайдера -->
    
    <script type="text/javascript">
$(function(){
  $('.slider').glide({
    autoplay: 3500,
    hoverpause: true,
    arrowRightText: '&rarr;',
    arrowLeftText: '&larr;'
  });
});
</script>

<!-- Блок со списком товаров -->

<section class="listings">
  <center>
  <form id="gettoys" method="POST" action="">
  <label class="filtik">Производитель:</label>
  <select value="All" name="whatbrand">
  <option value="All">Все</option>
  
  <!-- PHP код для вывода названий товаров из БД в выпадающий список -->
  
      <?php
         $query="select name from brands";
        $total=mysqli_query($connect, $query) or die(mysqli_error($connect));
        for ($data=[]; $row=mysqli_fetch_assoc($total);$data[]=$row);
          $total='';
          foreach ($data as $elem) {
            $total.='<option value="' . $elem['name'] . '">' . $elem['name'] . '</option>';
          }
      echo $total;
      ?>
  </select>
    <input value="Фильтровать" type="submit">
  </center>
    <div class="wrapper">
      <ul id="brandslist" class="properties_list">
          
      <!-- PHP код для вывода товаров из БД по фильтру -->
      
      <?php
      $whatbrand = $_POST['whatbrand'];
      if ($whatbrand == "All" || isset($whatbrand) == false) {
         $query='select id, name, price, img1 from toys';
      }
      else {
          $query='select id, name, price, img1 from toys where brand = "' . $whatbrand . '"';
      }
        $total=mysqli_query($connect, $query) or die(mysqli_error($connect));
        for ($data=[]; $row=mysqli_fetch_assoc($total);$data[]=$row);
        $count = 1;
          $total='';
          foreach ($data as $elem) {
            $total.='<li class="sometoy">';
            $total.='<a href="#" class="open-modal" data-modal="#modal' . $elem['id'] . '">';
            $total.='<img src="' . $elem['img1'] . '" alt="" title="" class="property_img"/>';
            $total.='</a>';
            $total.='<span class="price">' . $elem['price'] . '&nbspруб.</span>';
            $total.='<div class="property_details">';
            $total.='<h1>';
            $total.='<a href="#" class="open-modal" data-modal="#modal' . $elem['id'] . '">' . $elem['name'] . '</a>';
            $total.='</h1>';
            if ($count > 1 && $count < 4) {
                $total.='<br><br>';
            }
            $total.='</div>';
            $total.='</li>';
            $count+=1;
          }
      echo $total;
      $stopit = 1;
      ?>
      </ul>
      </form>
    </div>
  </section>
  
  <!-- Блок с информацией о консультантах -->
  
  <section class="bottomik">
    <div class="consult">
    <h1 class="constop">Информация о консультантах</h1>
    <center><img src="img/consult1.jpg" class="consimg"></center>
    <h2>Савельев Кассиан Ярославович</h2>
    <h2>Дата рождения: 20 июля 1993 г.</h2>
    <h2>Номер телефона: +79584736842</h2>
    <center><img src="img/consult2.jpg" class="consimg"></center>
    <h2>Устинова Ядвига Георгиевна</h2>
    <h2>Дата рождения: 15 сентября 1990 г.</h2>
    <h2>Номер телефона: +79572846723</h2>
    <center><img src="img/consult3.jpg" class="consimg"></center>
    <h2>Фадеева Джулия Павловна</h2>
    <h2>Дата рождения: 23 февраля 1980 г.</h2>
    <h2>Номер телефона: +795863265876</h2>
    </div>
  </section>
  
  <!-- Блок с информацией о брендах -->
  
  <section class="brands bottomik">
    <div>
    <h1 class="constop">Бренды</h1>
    <div class="col-md-2 col-md-offset-2">
      <center><img class="brandy2" width="179.83px" height="179.83px" src="img/lego.png">
        <h3>LEGO</h3>
        <p class="brandinfo">Основным продуктом компании LEGO являются разноцветные пластмассовые кирпичики, маленькие фигурки и т. п. Из LEGO можно собрать такие объекты, как транспортные средства, здания, а также движущихся роботов. Всё, что построено, затем можно разобрать, а детали использовать для создания других объектов.</p></center>
    </div>
    <div class="col-md-2">
      <center><img class="brandy" src="img/enchantimals.png">
        <h3>Enchantimals</h3>
        <p class="brandinfo">Enchantimals - это волшебные подружки, которые заботятся о своих любимых друзьях – зверюшках! Подружки живут в сказочном лесу в гармонии с природой, неразлучны со своими пушистыми друзьями, и даже черты характера и индивидуальные особенности у них так похожи!</p></center>
    </div>
    <div class="col-md-2">
      <center><img class="brandy" src="img/aurora.png">
        <h3>Aurora</h3>
        <p class="brandinfo">"AURORA World Corporation" являeтcя пpизнaнным мировым лидepoм в пpoизвoдcтвe выcoкoкaчecтвeнныx мягкиx игpушeк. Мягкие игрушки AURORA отличаются оригинальным дизaйном, больших количеством образов, разнообразием используемых материалов, расцветок и размеров.</p></center>
    </div>
    <div class="col-md-2">
      <center><img class="brandy" src="img/hotwheels.png">
        <h3>Hot Wheels</h3>
        <p class="brandinfo">Бренд американской компании Mattel, под которым выпускаются литые модели игрушечных автомобилей в масштабе 1:64. Игрушки под этой маркой впервые появились в 1968 году. До 1997 года главным конкурентом Hot Wheels был бренд Matchbox, затем его владелец, компания Tyco Toys, была куплена Mattel и превратилась в подразделение компании.</p></center>
    </div>
    </div>
  </section>
  
  <!-- Блок заказа товара -->
  
  <section id="herebuy" class="bottomik">
    <div class="consult buying">
    <h1 class="constop titbuy">Покупка товара</h1>
    <form id="getorder" method="POST">
    <div class="col-md-2 col-md-offset-4">
    <input class="inputichi" type="text" name="myname" placeholder="Ваше имя">
    </div>
    <div class="col-md-2 col-md-offset-1">
    <input class="inputichi" type="text" name="mymail" placeholder="E-mail">
    </div>
    <center><div class="col-md-12 orderlist">
      <label class="chooser">Выберите товар:</label>
    <select id="toyorder" name="ordertoy">
        
      <!-- PHP код для вывода названий товаров из БД в выпадающий список -->
      
      <?php
         $query="select name from toys";
        $total=mysqli_query($connect, $query) or die(mysqli_error($connect));
        for ($data=[]; $row=mysqli_fetch_assoc($total);$data[]=$row);
          $total='';
          foreach ($data as $elem) {
            $total.='<option value="' . $elem['name'] . '">' . $elem['name'] . '</option>';
          }
      echo $total;
      ?>
    </select>
    </div></center>
    </div>
    <center><button class="btn ordering" name="clickorder" onclick="document.getElementById('getorder').submit();">Заказать</button></center>
    </form>
    
    <!-- PHP код для занесения данных в БД о заказе -->
    
    <?php
        if (isset($_POST['myname']) && strlen($_POST['myname'])!=0 && isset($_POST['mymail']) && strlen($_POST['mymail'])!=0) {
            echo '<script type="text/javascript">alert("Товар успешно заказан!")</script>';
         $query="INSERT INTO `orders` (`name`, `mail`, `order`) VALUES ('" . $_POST['myname'] . "', '" . $_POST['mymail'] . "', '" . $_POST['ordertoy'] . "');";
        $total=mysqli_query($connect, $query) or die(mysqli_error($connect));
        }
        else {
            if (isset($_POST['clickorder'])) {
            echo '<script type="text/javascript">alert("Вы не заполнили все поля!")</script>';
            }
        }
      ?>
  </section>
  
  <!-- Блок подписки на обновления сайта -->
  
  <section class="bottomik">
    <div class="consult buying">
    <h1 class="constop titbuy">Подпишитесь на наши новинки</h1>
    <div class="col-md-2 col-md-offset-4">
    <form id="subscribers" method="POST">
    <input class="inputichi" type="text" name="myname2" placeholder="Ваше имя">
    </div>
    <div class="col-md-2 col-md-offset-1">
    <input class="inputichi" type="text" name="mymail2" placeholder="E-mail">
    </div>
    </div>
    <center><button class="btn ordering" name="clicksub" onclick="document.getElementById('subscribers').submit();">Подписаться</button></center>
    </form>
    
    <!-- PHP код для занесения данных в БД о подписке -->
    
    <?php
        if (isset($_POST['myname2']) && strlen($_POST['myname2'])!=0 && isset($_POST['mymail2']) && strlen($_POST['mymail2'])!=0) {
            echo '<script type="text/javascript">alert("Вы успешно подписались!")</script>';
         $query="INSERT INTO `subscribers` (`name`, `mail`) VALUES ('" . $_POST['myname2'] . "', '" . $_POST['mymail2'] . "');";
        $total=mysqli_query($connect, $query) or die(mysqli_error($connect));
        }
        else {
            if (isset($_POST['clicksub'])) {
            echo '<script type="text/javascript">alert("Вы не заполнили все поля!")</script>';
            }
        }
      ?>
  </section>
  
  <!-- PHP код для создания отдельных окон с подробным описанием о товаре взятых из БД -->
  
  <?php
         $query="select id, name, price, img2, description from toys";
        $total=mysqli_query($connect, $query) or die(mysqli_error($connect));
        for ($data=[]; $row=mysqli_fetch_assoc($total);$data[]=$row);
          $total='';
          foreach ($data as $elem) {
            $total.='<div class="modal minmodal2" id="modal' . $elem['id'] . '">';
            $total.='<div class="content">';
            $total.='<h1 class="title">' . $elem['name'] . '</h1>';
            $total.='<img src="' . $elem['img2'] . '" alt="" title="" class=""/>';
            $total.='<h2>' . $elem['price'] . '&nbspруб.</h2>';
            $total.='<p class="toyinfo">' . $elem['description'] . '</p>';
            $total.='<button onclick=window.location="#herebuy" class="btn close-modal" data-modal="#modal' . $elem['id'] . '">Купить</button>';
            $total.='</div>';
            $total.='</div>';
          }
      echo $total;
      ?>
      
      <!-- Окно заказа звонка -->
      
      <div class='modal minmodal' id='modalcall'>
    <div class='content'>
      <h1 class='title'>Заказать звонок</h1>
      <form id="request" method="POST">
      <input class="inputichi" type="text" name="myname3" placeholder="Ваше имя"><br><br>
      <input class="inputichi" type="text" name="phone" placeholder="Ваш телефон"><br><br>
      <textarea class="inputichi" rows="10" cols="42" type="text" name="phoneinfo" placeholder="Дополнительная информация"></textarea><br><br><br>
      <button class='btn' name="clickreq" data-modal="#modalcall" onclick="document.getElementById('request').submit();">Заказать</button>
      </form>
      
      <!-- PHP код для занесения данных в БД о заказе звонка -->
      
      <?php
        if (isset($_POST['myname3']) && strlen($_POST['myname3'])!=0 && isset($_POST['phone']) && strlen($_POST['phone'])!=0 && isset($_POST['phoneinfo']) && strlen($_POST['phoneinfo'])!=0) {
            echo '<script type="text/javascript">alert("Звонок был успешно заказан!")</script>';
         $query="INSERT INTO `request` (`name`, `phone`, `info`) VALUES ('" . $_POST['myname3'] . "', '" . $_POST['phone'] . "', '" . $_POST['phoneinfo'] . "');";
        $total=mysqli_query($connect, $query) or die(mysqli_error($connect));
        }
        else {
            if (isset($_POST['clickreq'])) {
            echo '<script type="text/javascript">alert("Вы не заполнили все поля!")</script>';
            }
        }
      ?>
    </div>  
  </div>
  
  <script  src="script/index.js"></script>
</body>
</html>