<!-- additional menu for admins  -->
			

            <li><a href="/admin/furniturelist">Stock</a></li> 
            <li><a href="/admin/managenews">News</a></li> 
            <li><a href="/admin/enqlist">Enquiries</a></li> 
            <li><a href="/admin/catlist">Categories</a></li> 

            <?php if( $_SESSION['privil'] > 3){?> 
                <li><a href="/admin/admin_list">Manage administration accounts</a></li>
            <?php  }  ?>

            <li><a href="/logout">Logout</a></li>