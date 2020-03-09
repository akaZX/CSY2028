
	<main class="admin">

    <h1>News</h1>

<ul class="furniture">

<?php
if($news){    

foreach ($news as $new) {
   
 

    // if (file_exists('images/furniture/' . $furniture['id'] . '.jpg')) {
    //     echo '<a href="images/furniture/' . $furniture['id'] . '.jpg"><img src="images/furniture/' . $furniture['id'] . '.jpg" /></a>';
    // }
?>
  <li>
  <div class="details">
  <div>
  <img  src="./images/uploads/<?=$new->image?>" alt=""></a>
  </div>
  <h2><?=$new->title ?></h2>    
  <h4><?=$new->date ?></h4>
  <p><?=$new->description ?></p> 

  </div>
   </li>

   <?php
}}else{
    ?>
<h2>There is no updates to show!</h2>
<?php
}
?>

</ul>

</main>