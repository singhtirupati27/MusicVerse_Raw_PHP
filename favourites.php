<?php
  session_start();
  require './classes/UserDb.php';
  $database = new UserDb();
  $music = $database->getFavourite($_SESSION["userId"]);
  $num_of_rows = $database->getFavouriteCount($_SESSION["userId"]);
  $_SESSION["musicList"] = $music;
  $page = "";
  if (isset($_POST["page_no"])) {
    $page = $_POST["page_no"];
  }
  else {
    $page = 1;
  }
  $total_pages = ceil($num_of_rows/8);
?>

<h2>Favourites</h2>

<?php
  if (!empty($music)) {
    foreach($music as $value) {
?>

<div class="music-box">
  <div class="music-cover-img">
    <img src="./assets/<?php echo $value['cover_img']; ?>" alt="<?php $value['name'] ?>">
    <div class="play-btn">
      <a href="./playmusic.php?id=<?php echo $value['music_id']; ?>" id="<?php echo $value['music_id']; ?>"><img src="./assets/img/play-btn.svg" alt="Play Now"></a>
    </div>
  </div>
  <div class="music-details">
    <h3><?php echo $value['name'] ?></h3>
    <h4>Singer: <?php echo $value['singer'] ?></h4>
    <p>Genre: <?php echo $value['genre'] ?></p>
  </div>
</div>

<?php
    }
  }
  else {
?>

<div class="upload">
  <h3>You have no favourite music.</h3>
</div>

<?php
  }
?>

<div class="page-num" id="user-fav">
  <?php
    for ($i = 1; $i <= $total_pages; $i++) {
      if ($i == $page) {
        $class_name = "active";
      }
      else {
        $class_name = "inactive";
      }
  ?>
  <a class='<?php echo $class_name ?>' id='<?php echo $i ?>' href=''><?php echo $i ?></a>
  <?php
    }
  ?>
</div>
