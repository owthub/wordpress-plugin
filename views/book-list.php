<?php
global $wpdb;
$all_books = $wpdb->get_results(
        $wpdb->prepare(
                "SELECT * from " . my_book_table() . " ORDER by id DESC", ""
        ), ARRAY_A
);
?>

<div class="container">
    <div class="row">
        <div class="alert alert-info">
            <h5>My book List</h5>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">My Book List</div>
            <div class="panel-body">
                <table id="my-book" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>About</th>
                            <th>Book Image</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (count($all_books) > 0) {
                            $i = 1;
                            foreach ($all_books as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $value['name']; ?></td>
                                    <td><?php echo $value['author']; ?></td>
                                    <td><?php echo $value['about']; ?></td>
                                    <td><img src="<?php echo $value['book_image']; ?>" style="height:80px;width:80px"/></td>
                                    <td><?php echo $value['created_at']; ?></td>
                                    <td>
                                        <a class="btn btn-info" href="admin.php?page=book-edit&edit=<?php echo $value['id']; ?>">Edit</a>
                                        <a class="btn btn-danger btnbookdelete" href="javascript:void(0)" data-id="<?php echo $value['id']; ?>">Delete</a>
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
</div>