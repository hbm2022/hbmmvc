<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/users/settingsUser/<?php echo $data['id'];?> " class="btn btn-light"><i class="fa fa-backward">חזרה</i></a>
    <br>

<br>
<h1>עידכון סיסמה</h1>
<br>

          
        <div class="card card-body bg-light mt-5">
        <form action="<?php echo URLROOT; ?>/users/changingPassword/<?php echo $data['id'];?>" method="post">
              <div class="form-group">
                <label for="old_password">סיסמה נוכחית</label>
                <input type="password" class="form-control  text-left 
                                <?php echo (!empty($data['old_password_err'])) ? 'is-invalid' : ''; ?>" name="old_password"  value="<?php echo $data['old_password']; ?>"  >
                <span class="invalid-feedback"><?php echo $data['old_password_err'] ; ?></span>
              </div>
            
              <div class="form-group">
                <label for="new_password">סיסמה חדשה</label>
                <input type="password" class="form-control  text-left
                            <?php echo (!empty($data['new_password_err'])) ? 'is-invalid' : ''; ?>" name="new_password"  value="<?php echo $data['new_password']; ?>"  >
                <span class="invalid-feedback"><?php echo $data['new_password_err'] ; ?></span>
              </div>
              <div class="form-group">
                <label for="confirm_password"> אישור סיסמה </label>
                <input type="password" class="form-control  text-left
                            <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" name="confirm_password"  value="<?php echo $data['confirm_password']; ?>"  >
                <span class="invalid-feedback"><?php echo $data['confirm_password_err'] ; ?></span>
              </div>
              
            

            <hr class="mb-4 mt-4">

            


            <div class="row">   
                <div class="col">
                    <input type="submit" value="עדכן סיסמה " class="btn btn-dark "> 
                </div>
            </div>
        </form>
       
        
        


  
<?php require APPROOT . '/views/inc/footer.php'; ?>
