<div class="container">
     <div class="alert alert-info">
            <h4>Student Add Page</h4>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">Add New Student</div>
            <div class="panel-body">
              <form class="form-horizontal" action="javascript:void(0)" id="frmAddStudent">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required id="name" name="name" placeholder="Enter Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required id="email" name="email" placeholder="Enter Email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="username">Username:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required id="username" name="username" placeholder="Enter Username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="password">Password:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" required id="password" name="password" placeholder="Enter Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="conf_password">Confirm Password:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" required id="conf_password" name="conf_password" placeholder="Enter Confirm Password">
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