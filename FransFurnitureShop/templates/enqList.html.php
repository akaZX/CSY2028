<main class="admin">

	<section class="left">
		
	</section>


	<section class="right">
	

            <h2>User enquiry list </h2>
            <h3><?=$message ?? ''?></h3>   

		
			<table>
		<thead>
			<tr>
			<th style="width: 10%;">Name</th>
			<th style="width: 10%">Email</th>
			<th style="width: 10%">Tel no</th>
			<th style="width: 30%">Enquiry</th>
			<th style="width: 5%">Status</th>
			<th style="width: 5%">Resolved by:</th>
			
		
			</tr>

<?php
            if($enqs != false){
              
			foreach ($enqs as $enq) { ?>
				<tr>
                  
				<td> <?=$enq->name ?></td>
				<td><?=$enq->email?></td>	
                <td><?=$enq->tel?></td>	
                <td><?=$enq->enquiry?></td>	
				<td><?=$enq->status?></td>					
				<td><?=$enq->admin ?? ''?></td>	
				<td><form method="POST" action="/admin/enqlist">
                <input type="hidden" name="enq[id]" value="<?=$enq->id?>" />
                <input type="hidden" name="enq[status]" value="Completed" />
                <input type="hidden" name="enq[admin]" value="<?=$_SESSION['user']?>" />
                <input type="submit" name="delete" value="Complete" />
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