<main class="admin">

	<section class="left">
		
	</section>


	<section class="right">
	

            <h2>Categories list </h2>
            <h3><?=$message ?? ''?></h3>
            <button onclick="window.location.href = '/admin/editcat';" >Add new category</button>
            
            <!-- <button onclick="window.location.href = '/admin/newAdmin';" >Add new Administrator account</button> -->

		
			<table>
		<thead>
			<tr>
			<th style="width: 3%">Name</th>
            <th style="width: 1%">Category actions</th>
			
		
			</tr>

<?php
        
        if($categories){

			foreach ($categories as $category) { ?>
				<tr>
                   
				<td> <?=$category->name ?></td>
				
				<td><form method="POST" action="/admin/catdelete">
                <input type="hidden" name="category[id]" value="<?=$category->id?>" />
                <input type="submit" name="delete" value="Delete" />
                </form>
                <form method="POST" action="/admin/editcat">
                <input type="hidden" name="category[id]" value="<?=$category->id?>" />
                <input type="submit" name="edit" value="  Edit  " />
                </form>
                </td>
				</tr>
			
                <?php
                }
            }
                ?>
			</thead>
			</table>	
		
</section>
	</main>