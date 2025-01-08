<?PHP

require_once('./php/helpers.php');
require_once './php/countdown.php';
session_start();
$auth = $_SESSION['auth'] ?? null;
$birthDate = $_SESSION['birthDate'] ?? null;
$userName = $_SESSION['userName'] ?? null;
$showBirthday = $_COOKIE['showBirthday'] ?? null;

if (!$showBirthday) {
  setcookie("showBirthday", true, strtotime('+1 day'));
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
    rel="stylesheet">
  <?php
  if ($showBirthday) {
    echo '<link rel="stylesheet" href="./styles/birthday_dialog.css">';
  }
  ?>
  <link rel="stylesheet" href="./styles/main.css">
  <title>Спа-салон RandomSpa</title>
</head>

<body>

  <?php

  include_once './php/components/header.php';

  if (!$auth) {
    include_once './php/components/auth_dialog.html';
    include_once './php/components/register_dialog.html';
  }

  if ($showBirthday && $auth) {
    include_once './php/components/birthday_dialog.php';
  }

  ?>

  <div class="hero">
    <div class="parallax-container">
      <h1>Элегантность и покой<br>в идеальной<br><span id="last-word">гармонии</span></h1>
    </div>
  </div>

  <div class="separator--wrapper">
    <div class="separator"></div>
  </div>

  <div class="content">

    <section class="description">
      <div class="description--text">
        <h2>О нас</h2>
        <p>В своем спа-салоне мы стараемся создать уникальную атмосферу спокойствия и гармонии. Более 10 лет мы помогаем
          нашим клиентам отвлечься от повседневных забот.</p>
      </div>
      <div class="description--one-frame">
        <img src="./assets/description-frame-main.jpg" alt="">
      </div>
    </section>

    <div class="separator--wrapper">
      <div class="separator"></div>
    </div>

    <section class="services">
      <div class="description--text">
        <h2>Наши услуги</h2>
        <p>Мы собрали команду лучших специалистов, которые обеспечат вам профессиональный уход и проявят чуткое внимание
          к вашим пожеланиям.</p>
      </div>
      <div class="slider">
        <div class="slide" id="slide1">Уход за лицом</div>
        <div class="slide" id="slide2">Профессиональный маникюр</div>
        <div class="slide" id="slide3">Успокаивающий массаж</div>
        <div class="slide" id="slide4">Хамам</div>
        <div class="slide" id="slide5">Уход за волосами</div>
      </div>
    </section>

    <div class="separator--wrapper">
      <div class="separator"></div>
    </div>

    <section class="reviews">
      <div class="description--text">
        <h2>Отзывы о нашей работе</h2>
        <p>Более 9000 довольных клиентов за 10 лет работы. Каждый день мы стараемся быть лучше для вас.</p>
      </div>
      <div class="reviews--wrapper">
        <div class="slider" id="reviews-slider">
          <div class="review">
            <img src="./assets/rew_user_1.jpg" alt="Фото клиента" width="210" height="210">
            <p>Алина М.</p>
            <img src="./assets/stars.svg" alt="Рейтинг">
            <p>Отличный спа, массаж потрясающий. Выбрали программу «девичник», погрелись в хамаме, очень приятный и
              внимательный сервис, есть все необходимое для комфортного времяпровождения, далее забрали на
              скрабирование, тело после него было идеальное, и часовой массаж с проработкой всех зон.</p>
          </div>
          <div class="review">
            <img src="./assets/rew_user_2.jpg" alt="Фото клиента" width="210" height="210">
            <p>Мария А.</p>
            <img src="./assets/stars.svg" alt="Рейтинг">
            <p>Часто прихожу в этот массажный салон. Здесь уютно, чисто, всегда хорошая музыка и запахи классные. Очень
              большой выбор массажей, для похудения, для лица, массаж ног, спа процедуры на двоих и т.д.</p>
          </div>
          <div class="review">
            <img src="./assets/rew_user_3.jpg" alt="Фото клиента" width="210" height="210">
            <p>Ольга С.</p>
            <img src="./assets/stars.svg" alt="Рейтинг">
            <p>Очень приятное место, расслабляющая атмосфера, продуманные детали для комфортного пребывания. Можно даже
              принять душ перед массажем, что очень необходимо после рабочего дня. У меня был не мастер - богиня! Их дар
              чувствования твоего тела не устает удивлять! Очень рекомендую к посещению</p>
          </div>
          <div class="review">
            <img src="./assets/rew_user_4.jpg" alt="Фото клиента" width="210" height="210">
            <p>Евгения П.</p>
            <img src="./assets/stars.svg" alt="Рейтинг">
            <p>Много спа процедур, программ, видов массажа, для тела, головы и т.д. Я выбрала массаж лица – быстрый
              лифтинг. Супер процедура, больше 30 минут, результат хороший подтягивает кожу лица, улучшается внешний вид
              кожи и разглаживаются морщинки.</p>
          </div>
          <div class="review">
            <img src="./assets/rew_user_5.jpg" alt="Фото клиента" width="210" height="210">
            <p>Сергей А.</p>
            <img src="./assets/stars.svg" alt="Рейтинг">
            <p>Каждую субботу прихожу на массаж. Отдыхаю телом и душой. Расслабляюсь, набираюсь и энергии. Мастера
              настоящие профессионалы. Хорошее отношение к клиенту. Массаж на любой вкус, много видов.</p>
          </div>
          <div class="review">
            <img src="./assets/rew_user_6.jpg" alt="Фото клиента" width="210" height="210">
            <p>Наталья М.</p>
            <img src="./assets/stars.svg" alt="Рейтинг">
            <p>С мужем каждые выходные приходим на массаж. Не выезжая в Тайланд проводим мини отпуск. Интересные
              программы для двоих, большой выбор спа процедур и массажа. Приятная атмосфера, музыка, приятные фруктовые
              запахи.</p>
          </div>
          <div class="review">
            <img src="./assets/rew_user_7.jpg" alt="Фото клиента" width="210" height="210">
            <p>Олег Н.</p>
            <img src="./assets/stars.svg" alt="Рейтинг">
            <p>Безупречный салон, на мой взгляд. В первую очередь, мастера, каждая уникальна по своему, спасибо
              руководителю за их качественный отбор! К кому бы не приходил на массаж, всегда оставался очень довольным
            </p>
          </div>
        </div>
      </div>
    </section>

  </div>

  <footer>
    <div class="footer-content">
      <div class="footer-contacts">
        <img id="phone_logo" src="./assets/phone.svg" alt="Телефон">
        <p id="phone">8 (800) 000-00-00</p>
        <img id="email_logo" src="./assets/email.svg" alt="Email">
        <p id="email">info@randomspa.ru</p>
        <img id="work_logo" src="./assets/work.svg" alt="Время работы">
        <p id="work">открыты круглосуточно</p>
      </div>
      <img src="./assets/logo.svg" alt="Лого">
    </div>
  </footer>

  <?php
  if (!$auth) {
    echo '<script type="text/javascript" src="./JS/unauthorized.js"></script>';
    echo '<script type="text/javascript" src="./JS/check_credentials.js"></script>';
  } else {
    echo '<script type="text/javascript" src="./JS/authorized.js"></script>';
  }
  ?>

  <script type="text/javascript" src="./JS/main.js"></script>
  <script type="text/javascript" src="./JS/countdown.js"></script>

</body>

</html>
