<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/fixTransactions" class="btn btn-light"><i class="fa fa-backward">חזרה</i></a>
<br>
   
    <div class="card card-body bg-light mt-5">
        
        <h2>יצירת חסכונות</h2>
        <p>חיסכון זה הרווח העתידי שלך</p>
        <form action="<?php echo URLROOT; ?>/fixTransactions/addSave " method="post">
            
            <div class="form-group">
                <label for="title"><sup>*</sup> : כותרת</label>
                <input type="text" name="title" class="form-control form-control-lg text-left 
                <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                <span class="invalid-feedback"><?php echo $data['title_err'] ; ?></span>
            </div>

            

            

            
            <div class="form-group" >
            <label for="target_amount"><sup>*</sup> : סכום יעד</label>
                <input type="text" name="target_amount" class="form-control form-control-lg text-left
                <?php echo (!empty($data['target_amount_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['target_amount']; ?>">
                <span class="invalid-feedback"><?php echo $data['target_amount_err'] ; ?></span>
              </div>  
           
            <input type="submit" class="btn btn-success" value="יצירה">
        </form>
    </div>
   
  
<?php require APPROOT . '/views/inc/footer.php'; ?>