<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('updated_msg'); ?>

<br>
<h1>הגדרות משתמש</h1>
<br>

          
        
       
        <form action="<?php echo URLROOT; ?>/users/settingsUser/<?php echo $data['id'];?> " method="post">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="last_name">שם משפחה </label>
                <input id="last_name" type="text" class="form-control  text-left
                                <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>" name="last_name"  value="<?php echo $data['last_name']; ?>" disabled >
                <span class="invalid-feedback"><?php echo $data['last_name_err'] ; ?></span>
              </div>
              <div class="col-md-6 mb-3">
                <label for="first_name">שם פרטי </label>
                <input id="first_name" type="text" class="form-control  text-left
                            <?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>" name="first_name"  value="<?php echo $data['first_name']; ?>" disabled >
                <span class="invalid-feedback"><?php echo $data['first_name_err'] ; ?></span>
              </div>
            </div>

       


            <hr class="mb-4">
            <div class="row">
              <div class="col mb-3  ">
                <label for="phone">פלאפון</label>
                <input id="phone" type="text" class="form-control text-left
                                <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" name="phone"  value="<?php echo $data['phone']; ?>" disabled >
                <span class="invalid-feedback"><?php echo $data['phone_err'] ; ?></span>
              </div>
              
            </div>

            
                    
            <div class="row">
                    <div class="col">
                       <input id="submit" type="submit" value="עדכן " class="btn btn-dark btn-block mt-2 " disabled> 
                    </div>
            </div>
            
        <hr class="mb-4">
               <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="confirmToUpdate" onchange="confirmUpdate()"  >
                        <label class="custom-control-label" for="confirmToUpdate">לעדכן פרטים</label>
               </div>
        </form>

        
        
        <div class="row">
                    <div class="col">
                    <a href="<?php echo URLROOT; ?>/users/changingPassword/<?php echo $data['id'];?>" class="btn btn-dark mt-2">שנה סיסמה </a>
    
                    </div>
            </div>

  
<?php require APPROOT . '/views/inc/footer.php'; ?>
