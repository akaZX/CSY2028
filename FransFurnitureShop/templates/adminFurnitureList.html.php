<main class="admin">

	<section class="right">
	

            <h2>Furniture management </h2>
            <h3><?=$message ?? ''?></h3>
            
            <button onclick="window.location.href = '/admin/furnitureEdit';" >Add new Furniture item</button>

		
			<table>
		<thead>
			<tr>
			<th style="width: 6%">Name</th>
			<th style="width: 35%">Description</th>
			<th style="width: 8%">Price</th>
			<th style="width: 1%">Status</th>
			<th style="width: 1%">Condition</th>
			<th style="width: 1%">Category</th>
			<th style="width: 1%">Operations</th>
			
		
			</tr>

<?php
            if($stock != false){
              
			foreach ($stock as $item) { ?>
				<tr>
                   
				<td> <?=$item->name ?></td>
				<td><?=$item->description?></td>	
				<td>£ <?=$item->price?></td>	
				<td><?=$item->status?></td>	
				<td><?=$item->cond?></td>	
				<td><?=$item->getCategory()->name?></td>	

				<td><form method="POST" action="/admin/deleteItem">
                <input type="hidden" name="item[id]" value="<?=$item->id?>" />
                <input type="submit" name="delete" value="Delete" />
				</form>
				
                <form method="POST" action="/admin/furnitureEdit">
                <input type="hidden" name="item[id]" value="<?=$item->id?>" />
                <input type="submit" name="edit" value="  Edit   " />
                </form>
                <form method="POST" action="/admin/hideUnhide">
                <input type="hidden" name="item[id]" value="<?=$item->id?>" />
                <input type="submit" name="edit" value="Hide/Unhide" />
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