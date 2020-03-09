<main class = "home">


<h2><?=$message ?? 'Create new admin account'?></h2>

<form action="" method="POST" >

    <label>Admin name</label>
    <input type="text" name="admin[name]" value= "<?=$administrator->name ?? ''?>"/>
    <label>Username</label>
    <input type="text" name="admin[username]" value= "<?=$administrator->username ?? ''?>" />
    <input type="hidden" name="admin[id]" value= "<?=$administrator->id ?? ''?>" />
    
    <label>Select account privilegies</label>
<select name="admin[privil]">
    <option value="1" <?=isset($administrator->privil) && $administrator->privil == 1 ? 'selected':''?>>Administrator</option>
    <option value="5" <?=isset($administrator->privil) && $administrator->privil == 5 ? 'selected':''?>>Super user</option>
</select>

    <label>Password </label>
    <input type="input" name="admin[password]" value = "<?=$administrator->password ?? ''?>"/>   

    <input type="submit" name="create" />


</form>


</main>