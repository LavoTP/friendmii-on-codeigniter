
<div class="col-md-9">        
          <div class="panel-body">
              <div class="card">
          <div class="card-body">
            <h3>Online Users</h3>
          </div>
        </div>
           
            <div class="table-responsive">  
                <br/>  
                <table class="table table-bordered table-striped">  
                     <thead>
                      <tr><td colspan="4"></td><td colspan="2"><input id="search" type="text" name="search" class="form-control"></td></tr>
                          <tr>  
                               <th width="15%">First Name</th>  
                               <th width="15%">Last Name</th>  
                               <th width="15">User Name</th>  
                               <th width="15">Email</th>  
                               <th width="20%">Action</th>
                          </tr>  
                     </thead>
                   <tbody id="user_data">
                       
                   </tbody>
                </table>  
           </div>  


          </div>
   </div>

<script>
  $(document).ready(function(){
    get_online_users();
   });
    function get_online_users(){
       $.ajax({
        url: '<?php echo site_url('admin/fetch_online_users'); ?>',
        success: function(data){
          $('#user_data').html(data);
        }
      });
    };

      $('#search').on('keyup', function(){
           $.ajax({
            url: '<?php echo site_url('admin/search_online_users'); ?>',
            method: 'post',
            data: {search: $('#search').val()},
            success: function(data){
              $('#user_data').html(data);
                /*setTimeout(function(){
                  location.reload();
                });*/
            }
            
          });
      });

      $('body').delegate('.block', 'click', function(){
       if(confirm('Are you sure you want to block this user?')){
           var id = $(this).attr('delete_user_id');
            $.ajax({
                url: '<?php echo site_url('admin/block_online_user'); ?>',
                method: 'post',
                data: {id: id},
                success: function(data){
                  if(data == 'success'){
                    alert('User blocked');
                    get_online_users();
                  }else{
                    alert('User not blocked');
                  }
                  
                }
              });
       }
      });
 
</script>

