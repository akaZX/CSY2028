<main class="main">

	<section class="left">		
	</section>


	<section class="right">
	

            <h2>News list </h2>
            <h3><?=$message ?? ''?></h3>   

            <button onclick="window.location.href = '/admin/postform';" >Add new post to main page</button>
			<table>
		<thead>
			<tr>
			<th style="width: 10%;">Title</th>
			<th style="width: 50%">Description</th>
			<th style="width: 7%">Date posted</th>
			<th style="width: 5%">Manage</th>
		
			
		
			</tr>

<?php
            if($news != false){
              
			foreach ($news as $new) { ?>
				<tr>
                  
				<td> <?=$new->title ?></td>
				<td><?=$new->description?></td>	
                <td><?=$new->date?></td>	                
				<td><form method="POST" action="/admin/postform">
                <input type="hidden" name="new[id]" value="<?=$new->id?>"/>                
                <input type="submit" name="edit" value=" Edit   " />
                </form>                
                <form method="POST" action="/admin/deletepost">
                <input type="hidden" name="new[id]" value="<?=$new->id?>"/>                
                <input type="submit" name="delete" value="Delete" />
                </form>                
                </td>
				</tr>
			
                <?php
                }}
                ?>
			</thead>
			</table>	
		
</section>
	</main>