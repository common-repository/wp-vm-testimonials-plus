<?php 
$vm_t_data = '';
$name = '';
$testimonial ='';
$website = '';
$company = '';
$designation = '';

if(isset($_POST) && $_POST['addvmtest']=='addvmtest'){
 echo VM_Testimonials_plus_actions('insert',$_POST);   
    
}
if(isset($_POST) && $_POST['addvmtest']=='editvmtest' && $_POST['vmtestid']!=''){
 echo VM_Testimonials_plus_actions('update',$_POST);   
    
}
if(isset($_POST) && $_POST['vmaction']=='delete' && $_POST['vmid']!=''){
 echo VM_Testimonials_plus_actions('delete',$_POST);   
    
}
?>
<?php 
if(isset($_POST) && $_POST['vmaction']=='edit' && $_POST['vmid']!=''){
$vm_t_data =   VM_Testimonials_plus_actions('byid',$_POST);  
$vm_t_data = $vm_t_data[0];
$name = $vm_t_data['name'];
$testimonial =$vm_t_data['message'];
$website = $vm_t_data['website'];
$company = $vm_t_data['company'];
$designation = $vm_t_data['designation'];
    
}
if(isset($_POST) && $_POST['vmaction']=='addpool' && $_POST['vmid']!=''){

echo VM_Testimonials_plus_actions('addtopool',$_POST);  

    
}
if(isset($_POST) && $_POST['vmaction']=='removefrompool' && $_POST['vmid']!=''){
echo VM_Testimonials_plus_actions('removefrompool',$_POST);  

    
}
if(isset($_POST) && $_POST['vmaction']=='approvetestimonial' && $_POST['vmid']!=''){
echo VM_Testimonials_plus_actions('approvetestimonial',$_POST);  

    
}

?>
<?php echo "  <h2>" . __('Add new testimonial:', 'vm_testimonials') . "</h2>"; ?>
    <p><?php echo __('Fill in the form below to add a new testimonial.', 'vm_testimonials'); ?></p>

    <form method="post" action="" name="vmtform">
        <table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row"><label for="name"><?php echo __('Name', 'vm_testimonials'); ?><span style="color: red;">*</span></label>
                </th>
                <td>
                    <input type="text" id="vm_name" name="vm_name" class="regular-text" value="<?php echo $name;?>"/>
                </td>
            </tr>
             
            <tr valign="top">
                <th scope="row"><label for="quote"><?php echo __('Testimonial', 'vm_testimonials'); ?><span style="color: red;">*</span></label>
                </th>
                <td>
                    <textarea class="large-text code" id="vm_testimonial" cols="50" rows="3" name="vm_testimonial"><?php echo $testimonial;?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="name"><?php echo __('WebSite', 'vm_testimonials'); ?></label>
                </th>
                <td>
                    <input type="text" id="vm_website" name="vm_website" class="regular-text" value="<?php echo $website;?>"/>
                </td>
            </tr>
             <tr valign="top">
                <th scope="row"><label for="name"><?php echo __('Company', 'vm_testimonials'); ?></label>
                </th>
                <td>
                    <input type="text" id="vm_company" name="vm_company" class="regular-text" value="<?php echo $company;?>"/>
                </td>
            </tr>
              <tr valign="top">
                <th scope="row"><label for="name"><?php echo __('Designation', 'vm_testimonials'); ?></label>
                </th>
                <td>
                    <input type="text" id="vm_Designation" name="vm_Designation" class="regular-text" value="<?php echo $designation;?>"/>
                </td>
            </tr>
            <tbody>
        </table>
        <p class="submit">
            <?php 
if(isset($_POST) && $_POST['vmaction']=='edit' && $_POST['vmid']!=''){
    ?>
    <input type="hidden" value="editvmtest" name="addvmtest"/>
    <input type="hidden" value="<?=$_POST['vmid']?>" name="vmtestid"/>
           <input type="submit" value="Update Testimonial" class="button-primary" name="Submit"/>
      
<?php

}else{
?>
<input type="hidden" value="addvmtest" name="addvmtest"/>
       <input type="submit" value="Add Testimonial" class="button-primary" name="Submit"/>
     
      <?php 
      }
      ?>      
            <input type="hidden" value="A" name="vm_status" id="vm_status"/>
        </p>
    </form>
<form method="post" action="" name="vmactions">
<input type="hidden" value="" name="vmaction" id="vmaction"/>
<input type="hidden" value="" name="vmid" id="vmid"/>
</form>
<hr/>
<?php echo "  <h3>" . __('List of Testimonials:', 'vm_testimonials') . "</h3>"; ?>

    <p><?php echo __('The below are list of testimonials where you can send to A Pool to display front end.', 'vm_testimonials'); ?></p>

    <form method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <table cellspacing="0" class="widefat fixed">
            <thead>
            <tr class="thead">
                <th class="column-username" id="username" scope="col"
                    style="width: 100px;"><?php echo __('Name', 'vm_testimonials'); ?></th>
                <th class="column-name" id="name"
                    scope="col"><?php echo __('Testimonial', 'vm_testimonials'); ?></th>
            </tr>
            </thead>
            <tfoot>
            <tr class="thead">
                <th class="column-username" scope="col"
                    style="width: 100px;"><?php echo __('Name', 'vm_testimonials'); ?></th>
                <th class="column-name" scope="col"><?php echo __('Testimonial', 'vm_testimonials'); ?></th>
            </tr>
            </tfoot>
        <?php
        $alldata = VM_Testimonials_plus_actions('list','');
       
        for ($i=0;$i<count($alldata);$i++) {
           
            $data = $alldata[$i];
         
            ?>
            
                <tbody class="list:user user-list" id="users">
                <tr class="alternate" id="user-1">
                   
                    <td class="username column-username" style="width: 100px;">
                    <?php echo $data['name']; ?>
               </td>
                    <td class="name column-name">
                    <?php echo $data['message']; ?>
                    <div class="row-actions"><span class='edit'>
                    <a href="javascript:void(0);" title="Edit this testimonial" onclick="editform('<?=$data[id]?>');">Edit</a> 
                    | </span><span class='delete'>
                    <a class='submitdelete' title='Delete this testimonial'  
                    href="javascript:void(0);" 
                    onclick="deleteform('<?=$data[id]?>');">Delete</a> |</span>
                    <?php if($data['isinpool']!='yes'){?>
                    <span class='delete'>
                    <a class='submitdelete' title='Move to Pool'  
                    href="javascript:void(0);" 
                    onclick="poolform('<?=$data[id]?>');">Move to Pool</a></span>
                    <? } ?>
                        </div>
        </td>
                </tr>
                </tbody>
            <?php

        }
        if (count($alldata) < 1) {
            ?>

                <tbody class="list:user user-list" id="users">
                <tr class="alternate" id="user-1">
                    <th class="check-column" scope="row">
                    </th>
                    <td class="name column-name" colspan="2">
                    <?php echo __('There are no testimonials yet', 'vm_testimonials'); ?>
        </td>
                </tr>
                </tbody>
            <?php

        };
        ?>
          </table>
<hr />
<?php 
 $userdata = VM_Testimonials_plus_actions('listofusertestimonials','');
echo "  <h3>" . __('User Testimonials:', 'vm_testimonials') . "</h3>"; ?>

    <p><?php echo __('The below testimonials <strong>waiting for your approval</strong> to be listed of testimonitals', 'vm_testimonials'); ?></p>

        <table cellspacing="0" class="widefat fixed">
            <thead>
            <tr class="thead">
                 <th class="column-username" id="username" scope="col"
                    style="width: 100px;"><?php echo __('Name', 'vm_testimonials'); ?></th>
                <th class="column-name" id="name"
                    scope="col"><?php echo __('Testimonial', 'vm_testimonials'); ?></th>
            </tr>
            </thead>
            <tfoot>
            <tr class="thead">
                <th class="column-username" scope="col"
                    style="width: 100px;"><?php echo __('Name', 'vm_testimonials'); ?></th>
                <th class="column-name" scope="col"><?php echo __('Testimonial', 'vm_testimonials'); ?></th>
            </tr>
            </tfoot>
        <?php
       
        for ($i=0;$i<count($userdata);$i++) {
           
            $udata = $userdata[$i];
         
            ?>
            
                <tbody class="list:user user-list" id="users">
                <tr class="alternate" id="user-1">
                    <td class="username column-username" style="width: 100px;">
                    <?php echo $udata['name']; ?>


                    </td>
                    <td class="name column-name">
                    <?php echo $udata['message']; ?>
                    <div class="row-actions"><span class='edit'>
                    <a    href="javascript:void(0);" title="Edit this testimonial" onclick="editform('<?=$udata[id]?>');">Edit</a> 
                    | </span><span class='delete'>
                    <a class='submitdelete' title='Approve this testimonial'  
                    href="javascript:void(0);" 
                    onclick="approveform('<?=$udata[id]?>');">Approve</a>|</span>
                    </span><span class='delete'>
                    <a class='submitdelete' title='Delete this testimonial'  
                    href="javascript:void(0);" 
                    onclick="deleteform('<?=$udata[id]?>');">Delete</a></span>
                        </div>
        </td>
                </tr>
                </tbody>
            <?php

        }
        if (count($userdata) < 1) {
            ?>

                <tbody class="list:user user-list" id="users">
                <tr class="alternate" id="user-1">
                    <th class="check-column" scope="row">
                    </th>
                    <td class="name column-name" colspan="2">
                    <?php echo __('There are no testimonials yet', 'vm_testimonials'); ?>
        </td>
                </tr>
                </tbody>
            <?php

        };
        ?>
          </table>
          <hr />
<?php 
 $pooldata = VM_Testimonials_plus_actions('listofpool','');
echo "  <h3>" . __('Pool of Testimonials:', 'vm_testimonials') . "</h3>"; ?>

    <p><?php echo __('The below are list of testimonials ready to shown to frontend in the site', 'vm_testimonials'); ?></p>

        <table cellspacing="0" class="widefat fixed">
            <thead>
            <tr class="thead">
                <th class="column-username" id="username" scope="col"
                    style="width: 100px;"><?php echo __('Name', 'vm_testimonials'); ?></th>
                <th class="column-name" id="name"
                    scope="col"><?php echo __('Testimonial', 'vm_testimonials'); ?></th>
            </tr>
            </thead>
            <tfoot>
            <tr class="thead">
                <th class="column-username" scope="col"
                    style="width: 100px;"><?php echo __('Name', 'vm_testimonials'); ?></th>
                <th class="column-name" scope="col"><?php echo __('Testimonial', 'vm_testimonials'); ?></th>
            </tr>
            </tfoot>
        <?php
       
        for ($i=0;$i<count($pooldata);$i++) {
           
            $pool= $pooldata[$i];
         
            ?>
            
                <tbody class="list:user user-list" id="users">
                <tr class="alternate" id="user-1">
                    <td class="username column-username" style="width: 100px;">
                    <?php echo $pool['name']; ?>


                    </td>
                    <td class="name column-name">
                    <?php echo $pool['message']; ?>
                    <div class="row-actions"><span class='edit'>
                    <a    href="javascript:void(0);" title="Edit this testimonial" onclick="editform('<?=$pool[id]?>');">Edit</a> 
                    | </span><span class='delete'>
                    <a class='submitdelete' title='Delete this testimonial'  
                    href="javascript:void(0);" 
                    onclick="deletePoolform('<?=$pool[id]?>');">Remove from Pool</a></span>
                        </div>
        </td>
                </tr>
                </tbody>
            <?php

        }
        if (count($pooldata) < 1) {
            ?>

                <tbody class="list:user user-list" id="users">
                <tr class="alternate" id="user-1">
                    <th class="check-column" scope="row">
                    </th>
                    <td class="name column-name" colspan="2">
                    <?php echo __('There are no testimonials yet', 'vm_testimonials'); ?>
        </td>
                </tr>
                </tbody>
            <?php

        };
        ?>
          </table>

       
    <script>
    function deleteform(id){
    if ( confirm('You are about to delete this Testimonial \n \'Cancel\' to stop, \'OK\' to delete.') )
     {
       document.getElementById('vmaction').value = 'delete';
       document.getElementById('vmid').value = id;
       document.vmactions.submit();
       
     }
    
    }
     function editform(id){
    document.getElementById('vmaction').value = 'edit';
     document.getElementById('vmid').value = id;
     document.vmactions.submit();
    }
    function poolform(id){
       document.getElementById('vmaction').value = 'addpool';

     document.getElementById('vmid').value = id;
    
     document.vmactions.submit();
     
    }
    function deletePoolform(id){
     document.getElementById('vmaction').value = 'removefrompool';
     document.getElementById('vmid').value = id;
     document.vmactions.submit();
       
    }
    function approveform(id){
       document.getElementById('vmaction').value = 'approvetestimonial';
     document.getElementById('vmid').value = id;
     document.vmactions.submit();
        
    }
    </script>