<?php require APPROOT . '/views/inc/header.php'; ?>


<br>
<h1>איפוס סיסמה</h1>
<br>

          
        <div class="card card-body bg-light mt-5">
        <form action="<?php echo URLROOT; ?>/users/resetPassword/<?php echo $data['token'] ;?>" method="POST">
             
              <div class="form-group">
                
                <input type="hidden" class="form-control text-left"  name="email"  value="<?php echo $data['email']; ?>"  >
              
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
                    <input type="submit" value="אשר סיסמה" class="btn btn-dark "> 
                </div>
            </div>
        </form>
       
        
        


  
<?php require APPROOT . '/views/inc/footer.php'; ?>
