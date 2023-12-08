<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>רישום משתמש חדש</h2>
            <p>בבקשה תמלא את השדות של הטופס לצורך ההרשמה</p>
            <form action="<?php echo URLROOT; ?>/users/register " method="post">
                <div class="form-group">
                    <label for="first_name"><sup>*</sup> : שם פרטי</label>
                    <input type="text" name="first_name" class="form-control form-control-lg text-left
                    <?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['first_name']; ?>">
                    <span class="invalid-feedback"><?php echo $data['first_name_err'] ; ?></span>
                </div>
                <div class="form-group">
                    <label for="last_name"><sup>*</sup> : שם משפחה</label>
                    <input type="text" name="last_name" class="form-control form-control-lg text-left
                    <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['last_name']; ?>">
                    <span class="invalid-feedback"><?php echo $data['last_name_err'] ; ?></span>
                </div>
                <div class="form-group">
                    <label for="phone"><sup>*</sup> : טלפון ליצירת קשר</label>
                    <input type="phone" name="phone" class="form-control form-control-lg text-left
                    <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone']; ?>">
                    <span class="invalid-feedback"><?php echo $data['phone_err'] ; ?></span>
                </div>
                <div class="form-group">
                    <label for="email"><sup>*</sup> : מייל</label>
                    <input type="email" name="email" class="form-control form-control-lg text-left
                    <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err'] ; ?></span>
                </div>
                <div class="form-group">
                    <label for="password"><sup>*</sup> : סיסמה</label>
                    <input type="password" name="password" class="form-control form-control-lg text-left
                    <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err'] ; ?></span>
                </div>
                <div class="form-group">
                    <label for="confirm_password"><sup>*</sup> : אישור סיסמה</label>
                    <input type="password" name="confirm_password" class="form-control form-control-lg text-left
                    <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['confirm_password_err'] ; ?></span>
                </div>

               <div class="row">
                    
                    <div class="col">
                       <input type="submit" value="הרשמה" class="btn btn-success btn-block"> 
                    </div>
               </div>
                
            </form>
        </div>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>