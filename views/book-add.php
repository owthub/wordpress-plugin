<?php wp_enqueue_media(); ?>

<div class="container">
    <div class="row">
        <div class="alert alert-info">
            <h4>Book Add Page</h4>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">Add New Book</div>
            <div class="panel-body">
                <form class="form-horizontal" action="javascript:void(0)" id="frmAddBook">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required id="name" name="name" placeholder="Enter Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="author">Author:</label>
                        <div class="col-sm-10">
                           <select name="author" id="author" class="form-control">
                           <option value="-1"> -- choose author --</option>
                           <?php

global $wpdb;

$getallAuthors = $wpdb->get_results(

    $wpdb->prepare(
        "SELECT * from ".my_authors_table()." ORDER by id desc ",""
        )

);

foreach($getallAuthors as $index=>$author){
    ?>
<option value="<?php echo $author->id; ?>"><?php echo $author->name; ?></option>
    <?php
}
                           ?>
                              
                           </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="about">about:</label>
                        <div class="col-sm-10">
                            <textarea name="about" id="about" placeholder="Enter About" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="about">Upload Book Image:</label>
                        <div class="col-sm-10">
                            <input type="button" value="Upload Image" id="btn-upload" class="btn btn-info"/>
                            <span id="show-image"></span>
                            <input type="hidden" id="image_name" name="image_name"/>
                        </div>
                    </div>
                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>