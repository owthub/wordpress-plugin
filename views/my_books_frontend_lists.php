<?php    
   global $wpdb;
   global $user_ID;
   $getallbooks = $wpdb->get_results(
       $wpdb->prepare(
           "SELECT * from ".my_book_table()." ORDER BY id desc ",""
       )
   );
  // print_r($getallbooks);
?>
<?php 
  if(count($getallbooks) > 0){
      foreach($getallbooks as $key=>$value){
        ?>
        <div class="col-sm-4 owt-layout">
        <p><img src="<?php echo $value->book_image; ?>" style="height:100px;width:100px;"/></p>
        <p><?php echo $value->name; ?></p>
        <p><?php echo get_author_details($value->author)['name']; ?></p>
        <p>
        <?php 
              if($user_ID > 0){
//login state
?>
<a class="btn btn-success owt-enrol-btn" href="javascript:void(0)">Enrol Now </a>
<?php
              }else{
//logout state

?>
<a class="btn btn-success" href="<?php echo wp_login_url(); ?>">Login to Enrol</a>
<?php              }
        ?>
        </p>
        </div>
        <?php
      }
  }
?>
