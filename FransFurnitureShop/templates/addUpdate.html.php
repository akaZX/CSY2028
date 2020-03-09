<main class = "home">



<h2><?=$message ?? 'Post new update'?></h2>
<form action="/admin/managenews" method="POST" enctype="multipart/form-data" >

    <label>Add picture: </label>
    <input type="file" name="myfile" id="fileToUpload">
    <label>Title: </label>
    <input type="text" name="new[title]" value= "<?=$new->title ?? ''?>"/>
    <label>Description</label>
    <textarea name = "new[description]"><?=$new->description ?? ''?></textarea>
    
    <input type="hidden" name="new[date]" value = "<?=date("Y-m-d");?>"/>   
    <input type="hidden" name="new[id]" value = "<?=$new->id ?? ''?>"/>   

    <input type="submit" name="create" value="Post"/>


</form>


</main>