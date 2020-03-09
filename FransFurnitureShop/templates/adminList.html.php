<main class="admin">


	

            <h2>Administrative account list </h2>
            <h3><?=$message ?? ''?></h3>
            
            <button onclick="window.location.href = '/admin/newAdmin';" >Add new Administrator account</button>

		
			<table>
		<thead>
			<tr>
			<th style="width: 3%">Name</th>
			<th style="width: 1%">Username</th>
			<th style="width: 1%">Access Level</th>
			<th style="width: 1%">Account actions</th>
			
		
			</tr>

<?php
            if($admins != false){
              
			foreach ($admins as $admin) { ?>
				<tr>
                   
				<td> <?=$admin->name ?></td>
				<td><?=$admin->username?></td>	
				<td><?=$admin->privil?></td>	
				<td><form method="POST" action="/admin/adminDelete">
                <input type="hidden" name="admin[id]" value="<?=$admin->id?>" />
                <input type="submit" name="delete" value="delete" />
                </form>
                <form method="GET" action="/admin/editAdmin">
                <input type="hidden" name="admin[id]" value="<?=$admin->id?>" />
                <input type="submit" name="edit" value="edit" />
                </form>
                </td>
				</tr>
			
                <?php
                }}
                ?>
			</thead>
			</table>	
		

	</main>