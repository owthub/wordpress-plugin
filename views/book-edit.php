<?php wp_enqueue_media(); ?>
<?php
$book_id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;
global $wpdb;
$book_detail = $wpdb->get_row(
          $wpdb->prepare(
                    "SELECT * from ".my_book_table()." WHERE id = %d ",$book_id
                  ),ARRAY_A
        );
?>
<div class="container">
    <div class="row">
        <div class="alert alert-info">
            <h4>Book Update Page</h4>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">Update Book</div>
            <div class="panel-body">
                <form class="form-horizontal" action="javascript:void(0)" id="frmEditBook">
                    <input type="hidden" name="book_id" value="<?php echo isset($_GET['edit']) ? intval($_GET['edit']) : 0; ?>"/>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?php echo $book_detail['name'] ?>" class="form-control" required id="name" name="name" placeholder="Enter Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="author">Author:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $book_detail['author']; ?>" required id="author" name="author" placeholder="Enter Author">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="about">about:</label>
                        <div class="col-sm-10">
                            <textarea name="about" id="about" placeholder="Enter About" class="form-control"><?php echo $book_detail['about'] ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="about">Upload Book Image:</label>
                        <div class="col-sm-10">
                            <input type="button" value="Upload Image" id="btn-upload" class="btn btn-info"/>
                            <span id="show-image">
                                <img src="<?php echo $book_detail['book_image'] ?>" style="height:80px;width:80px;"/>
                            </span>
                            <input type="hidden" id="image_name" name="image_name" value="<?php echo $book_detail['book_image'] ?>"/>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>