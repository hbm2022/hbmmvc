<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      
        <div class="card card-body bg-light mt-5">
          
            <?php flash('register_success'); ?>
            <h2>התחברות</h2>
            <p>בבקשה מלא את הפרטים שלך על מנת להתחבר</p>
            <form action="<?php echo URLROOT; ?>/users/login " method="post">
                
                <div class="form-group">
                    <label for="email"><sup>*</sup> : מייל</label>
                    <input type="email" name="email" class="form-control form-control-lg 
                    <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err'] ; ?></span>
                </div>
                <div class="form-group">
                    <label for="password"><sup>*</sup> : סיסמה</label>
                    <input type="password" name="password" class="form-control form-control-lg 
                    <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err'] ; ?></span>
                </div>

               <div class="row">
                    <div class="col">
                        <a href="<?php echo URLROOT;?>/users/register" class="btn btn-light btn-block">  עוד לא רשום? הירשם עכשיו </a>
                    </div>
                    <div class="col">
                       <input type="submit" value="התחברות" class="btn btn-success btn-block"> 
                       
                       <button type="button" class="btn btn-light btn-sm mt-2" data-toggle="modal" data-target=".bd-example-modal-lg">שכחתי סיסמה</button>
                    </div>
               </div>
                
            </form>
        </div>
    </div>
    <!-- Large modal -->

  </div>
  
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="row">
      
      <div class="col-md-6 mx-auto">
        <div class="modal-content">
        <div class="card-header">
        <h4>איפוס סיסמה</h4>
        </div>
          <form action="<?php echo URLROOT; ?>/users/forgetPassword " method="post">  
              <div class="form-group ml-3 mr-3">
                  <label for="email"><sup>*</sup> : הזן מייל</label>
                  <input type="email" name="email" class="form-control form-control-lg 
                  <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                  <span class="invalid-feedback"><?php echo $data['email_err'] ; ?></span>
              </div>
                  <div class="col">
                    <input type="submit" value="שלח" class="btn btn-primary btn-block mb-3"> 
                    
                    
                  </div>
            </div>
          </form>
        </div>
      </div>        
    </div>
    </div>
  </div>


  
<?php require APPROOT . '/views/inc/footer.php'; ?>