<?php
global $wpdb;
$allstudents = $wpdb->get_results(

        $wpdb->prepare(
            "SELECT * from ".my_students_table()." ORDER by id desc",""
        )
);
//print_r($allstudents);
?>

<div class="container">
     <div class="alert alert-info">
            <h5>My Student List</h5>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">My Student List</div>
            <div class="panel-body">
                <table id="my-book" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                       <?php

if(count($allstudents) > 0){
$i = 1;
foreach($allstudents as $key=>$value){
    $userdetails = get_userdata($value->user_login_id); //wp function 
?>
  <tr>
     <td><?php echo $i++; ?></td>
     <td><?php echo $value->name; ?></td>
     <td><?php echo $value->email; ?></td>
     <td><?php echo $userdetails->user_login; ?></td>
     <td><?php echo $value->created_at; ?></td>
     <td>
        <button class="btn btn-danger">Delete</button>
     </td>
  </tr>
<?php
}

}
                       ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>