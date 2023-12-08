<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/pages/about" class="btn btn-light"><i class="fa fa-backward">חזרה</i></a>
<br>
   
    <div class="card card-body bg-light mt-5">
        
        <h2> דיווח על תקלה</h2>
        <p>מודים לך על שיתוף הפעולה</p>
        <form action="<?php echo URLROOT; ?>/reports/reporting " method="post">
            
            <div class="form-group">
                <label for="title"><sup>*</sup> : כותרת</label>
                <input type="text" name="title" class="form-control form-control-lg text-left 
                <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                <span class="invalid-feedback"><?php echo $data['title_err'] ; ?></span>
            </div>

            <div class="form-group">
                <label for="name"><sup>*</sup> : שם המדווח</label>
                <input type="text" name="name" class="form-control form-control-lg text-left
                <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                <span class="invalid-feedback"><?php echo $data['name_err'] ; ?></span>
            </div> 

            <div class="form-group">
                <label for="email"><sup>*</sup> : מייל ליצירת קשר</label>
                <input type="email" name="email" class="form-control form-control-lg text-left
                <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                <span class="invalid-feedback"><?php echo $data['email_err'] ; ?></span>
            </div>  

            

            <div class="form-group">
                <label for="description"> : תיאור הדיווח</label>
                <textarea name="description" class="form-control form-control-lg text-left <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" ><?php echo $data['description'] ?></textarea>                
                <span class="invalid-feedback"><?php echo $data['description_err'] ; ?></span>
            </div> 

            
            <input type="submit" class="btn btn-success" value="שליחה">
        </form>
    </div>
   
  
<?php require APPROOT . '/views/inc/footer.php'; ?>