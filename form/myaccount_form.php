<style type="text/css">
.container{
margin-top:20px;
}
.form-container{
padding:10px;
}
</style>
<div class="container">
     <div class="form-container">
        <form method="post">
            <h2>My Account</h2><hr />
            <?php
            if(isset($success_msg))
            {
                  ?>
                  <div class="alert alert-success">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $success_msg; ?> !
                  </div>
                  <?php
            }
            ?>
            <div class="form-group">
             <label>Email</label><input type="text" class="form-control" name="txt_uname_email" value="<?php echo $myaccount_result['user_email'];?>" required />
            </div>
            <div class="form-group">
             <label>Mobile No</label><input type="text" class="form-control" name="txt_mobile" placeholder="" value="<?php echo $myaccount_result['mobile_no'];?>" required />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" name="btn-account" class="btn btn-block btn-primary">
                 <i class="glyphicon glyphicon-log-in"></i>&nbsp;Update My Account
                </button>
            </div>
        </form>
       </div>
</div>
