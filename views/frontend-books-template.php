<?php
/*
Template Name: Front end book page layout
*/
get_header(); // header.php
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success" style="background-color: #d3f582; !important">
               <h3>Online Web Tutor Courses</h3>
            </div>

            <?php
               echo do_shortcode("[book_page]");
               // this function runs the shortcode function
            ?>
            
        </div>
    </div>
</div>

<?php 
   get_footer();  //footer.php
?>