<?php
global $wpdb;
$getallAuthors = $wpdb->get_results(

    $wpdb->prepare(
        "SELECT * from ".my_authors_table()." ORDER by id desc ",""
        )

);

?>

<div class="container">
     <div class="alert alert-info">
            <h5>My Author List</h5>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">My Author List</div>
            <div class="panel-body">
                <table id="my-book" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Name</th>
                            <th>Fb Link</th>
                            <th>About</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                       <?php
                          if(count($getallAuthors) > 0){
                              $i = 1;
                              foreach($getallAuthors as $key=>$value){
                                  ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo $value->fb_link; ?></td>
                                        <td><?php echo $value->about; ?></td>
                                        <td> <?php echo $value->created_at; ?></td>
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