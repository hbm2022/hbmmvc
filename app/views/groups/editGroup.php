<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/groups" class="btn btn-light"><i class="fa fa-backward">חזרה</i></a>
<br>
   
    <div class="card card-body bg-light mt-5">
        
        <h2>עריכת קבוצה</h2>
        <p>מילת המפתח היא לפקח</p>
        <form action="<?php echo URLROOT; ?>/groups/editGroup/<?php echo $data['id'];?>" method="post">
            
            <div class="form-group">
                <label for="nickname"><sup>*</sup> : כינוי</label>
                <input type="text" name="nickname" class="form-control form-control-lg text-left 
                <?php echo (!empty($data['nickname_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['nickname']; ?>">
                <span class="invalid-feedback"><?php echo $data['nickname_err'] ; ?></span>
            </div>

            
            
            <div class="form-group">
                <label for="type">סוג</label>
                <select name="type" id="type" class="form-control text-left <?php echo (!empty($data['type_err'])) ? 'is-invalid' : ''; ?>" >   
                    
                    <option value="משפחת" <?php if ($data['type'] == 'משפחת') echo ' selected'; ?>>משפחה</option>
                    <option value="קבוצת" <?php if ($data['type'] == 'קבוצת') echo ' selected'; ?>>קבוצה</option>
                </select>
                <span class="invalid-feedback"><?php echo $data['type_err'] ; ?></span>
            </div>
            

                                                                            

           
           
            <input type="submit" class="btn btn-success" value="עדכן">
        </form>
    </div>
   
  
<?php require APPROOT . '/views/inc/footer.php'; ?>