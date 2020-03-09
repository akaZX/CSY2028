<main class = "home">


<h2><?=$message ?? 'Create new category'?></h2>

<form action="/admin/savecat" method="POST" >

    <label>Category name </label>
    <input type="text" name="category[name]" value= "<?=$category->name ?? ''?>"/>
    <input type="hidden" name="category[id]" value= "<?=$category->id ?? ''?>" />
    <input type="submit" name="create" />


</form>


</main>