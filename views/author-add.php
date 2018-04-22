<div class="container">
    <div class="alert alert-info">
            <h4>Author Add Page</h4>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">Add New Author</div>
            <div class="panel-body">
               <form class="form-horizontal" action="javascript:void(0)" id="frmAddAuthor">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required id="name" name="name" placeholder="Enter Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="author">Fb Link:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required id="fb_link" name="fb_link" placeholder="Enter Facebook URL">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="about">about:</label>
                        <div class="col-sm-10">
                            <textarea name="about" id="about" placeholder="Enter About" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>