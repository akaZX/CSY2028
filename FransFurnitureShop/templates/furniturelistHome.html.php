
<main class="admin">

<section class="left">

    <ul>
        <li>  
        <div>
            <form  class= "left" action="" method="GET" style=" color: white">
            <p>Sort by condition:</p>  
             <label>Second hand</label> <input type="radio" name="condition" value="Used"/>     
            <label>New</label><input type="radio" name="condition" value="New"/>
            <label>All</label><input type="radio" name="condition" value="all"/>
            <input type = "hidden" name = "id" value = "<?=$selectedCat->id ?? '' ?>"/>
            <input type = "submit" value = "Sort"/></li>
    </div>
        </form>
        </li>
    <!-- <br> 
    <hr>
    <br>  -->


    <!-- displays all categories from category list -->
    <?php foreach($category as $cat){ ?>
    
        <li><a href="/furniture/category?id=<?=$cat->id?>"><?=$cat->name?></a></li>        
    <?php } ?>
    </ul>
</section>

<section class="right">    
    <br>
<!-- updates page content panel name if category is selcted -->
    <h1><?=$selectedCat->name ?? 'Furniture' ?> </h1>




<ul class="furniture">

<?php
foreach ($furnitures as $furniture) {   
    // if all is selected it changes all furniture condition to all so it does not reqire additional  actions to show all furniture
    if(strcasecmp($cond, 'all') == 0){
        // stores real condition in temp var
        $realCondition = $furniture->cond;
        $furniture->cond = 'all';
    }
  
   //shows only live items
    if($furniture->status == 'Live' && strcasecmp(($furniture->cond) , $cond ) == 0){


    // if (file_exists('images/furniture/' . $furniture['id'] . '.jpg')) {
    //     echo '<a href="images/furniture/' . $furniture['id'] . '.jpg"><img src="images/furniture/' . $furniture['id'] . '.jpg" /></a>';
    // }

    ?>
    <li>
    <div class="details">
    <div>
        <img  src="/images/uploads/<?=$furniture->image?>" alt=""></a>
    </div>
    <h2><?=$furniture->name ?></h2>
    <h3><?= $furniture->getCategory()->name ?? 'No category assigned'?></h3>
    <h4><?=$realCondition ?? $furniture->cond?></h4>
    <h4>£ <?=$furniture->price ?></h4>
    <p><?=$furniture->description ?></p> 
  
    </div>
     </li>
  
     <?php
    }
}
?>

</ul>

</section>
</main>
