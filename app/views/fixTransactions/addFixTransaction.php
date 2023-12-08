<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/fixTransactions" class="btn btn-light"><i class="fa fa-backward">חזרה</i></a>
<br>
   
    <div class="card card-body bg-light mt-5">
        
        <h2>הוספת תנועות קבועות</h2>
        <p>כל תיעוד התנועות שלך יחסוך ממך הפתעות</p>
        <form action="<?php echo URLROOT; ?>/fixTransactions/addFixTransaction " method="post">
            
            <div class="form-group">
                <label for="title"><sup>*</sup> : כותרת</label>
                <input type="text" name="title" class="form-control form-control-lg text-left 
                <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                <span class="invalid-feedback"><?php echo $data['title_err'] ; ?></span>
            </div>

            <div class="form-group">
                <label for="type">סוג</label>
                <select name="type" id="type" class="form-control text-left <?php echo (!empty($data['target_saving_err'])) ? 'is-invalid' : ''; ?>" onchange="showSaves(this.value)">   
                    <option value="הוצאה קבועה" <?php if ($data['type'] == 'הוצאה קבועה') echo ' selected'; ?>>הוצאה קבועה</option>
                    <option value="הכנסה קבועה" <?php if ($data['type'] == 'הכנסה קבועה') echo ' selected'; ?>>הכנסה קבועה</option>
                    <option value="הוספה לחיסכון" <?php if ($data['type'] == 'הוספה לחיסכון') echo ' selected'; ?>>הוספה לחיסכון</option>
                    
                </select>
                <span class="invalid-feedback"><?php echo $data['target_saving_err'] ; ?></span>
            </div>

            <div class="form-group" id="saves" style=" display:none;">
                    <label for="saves"><sup>*</sup> : חסכונות קיימים</label>
                    
                    <select name="target_saving"  class="form-control text-left ">
                    <?php if(!empty($data['saves'])){
                    foreach($data['saves'] as $save): ?>

                        <option value="<?php echo $save->id ?>"  ><?php echo $save->nameSave ?></option>
                        <?php endforeach;}
                        else{ ?>
                            <option value="">לא קיים חיסכון</option>
                        <?php }?>
                    </select>
            </div>

            <div class="form-group" >
                <label for="created_at" ><sup>*</sup> : תאריך ביצוע</label>
                <input type="datetime-local" name="created_at"  
                class="form-control <?php echo (!empty($data['created_at_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['created_at']; ?>">
                <span class="invalid-feedback"><?php echo $data['created_at_err'] ; ?></span>
            </div>

            <div class="form-group" id="comment">
                <label for="comment"> : הערה</label>
                <textarea name="comment" class="form-control form-control-lg text-left" ><?php echo $data['comment'] ?></textarea>                
            </div>  
            
            
            <div class="form-group" >
                <label for="amount"><sup>*</sup> : סכום</label>
                <input type="text" name="amount" class="form-control form-control-lg text-left
                <?php echo (!empty($data['amount_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['amount']; ?>">
                <span class="invalid-feedback"><?php echo $data['amount_err'] ; ?></span>
            </div>  
            <input type="submit" class="btn btn-success" value="הוספה">
        </form>
    </div>
   
  
<?php require APPROOT . '/views/inc/footer.php'; ?>