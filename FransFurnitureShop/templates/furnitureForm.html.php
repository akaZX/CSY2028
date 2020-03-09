<main class = "home">


<h2><?=$message ?? 'Create new furniture item'?></h2>

<form  method="POST" action="/admin/saveItem" enctype="multipart/form-data">

    <label>Add image: </label>
    <input type="file" name="myfile" id="fileToUpload" value ="<?=$item->image ?? ''?>">
    <label>Item name</label>
    <input type="text" name="item[name]" value= "<?=$item->name ?? ''?>"/>
    <label>Price £</label>
    <input type="text" name="item[price]" value= "<?=$item->price ?? ''?>" />
    <input type="hidden" name="item[id]" value= "<?=$item->id ?? ''?>" />
    <input type="hidden" name="item[status]" value= "<?=$item->status ?? 'Live'?>" />
    
    <label>Select item condition</label>
<select name="item[cond]">
    <option value="New" <?=isset($item->cond) && $item->cond === 'New' ? 'selected':''?>>New</option>
    <option value="Used" <?=isset($item->cond) && $item->cond === 'Used' ? 'selected':''?>>Second hand</option>
</select>

<label>Select item category</label>
<select name="item[categoryId]">    

    <?php
  
    var_dump($category);
    foreach($cat as $category){ ?>
    <option value="<?=$category->id?>" <?=( $item != null && $item->id == $category->id ) ? 'selected':''?> ><?=$category->name?></option>
          
<?php } ?>
    
</select>




<label>Description: </label>
        <textarea name = "item[description]"><?=$item->description ?? ''?></textarea>

    

    <input type="submit" name="create" value = " Submit"/>


</form>


</main>