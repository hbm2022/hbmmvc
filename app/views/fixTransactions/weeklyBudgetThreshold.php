<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/fixTransactions" class="btn btn-light"><i class="fa fa-backward">חזרה</i></a>
    
<br>
<h1>קביעת תקציב  שבועי</h1>
<br>

          
<div class="card card-body bg-light mt-5">
       
        <form action="<?php echo URLROOT; ?>/fixTransactions/weeklyBudgetThreshold/<?php echo $data['id'];?> " method="post">
            
        <div class="form-group">
            <label for="weekly_budget_threshold">תקציב לשבוע</label>
            <input  type="text" name="weekly_budget_threshold" class="form-control form-control-lg text-left
            <?php echo (!empty($data['weekly_budget_threshold_err'])) ? 'is-invalid' : ''; ?>"   value="<?php echo $data['weekly_budget_threshold']; ?>"  data-toggle="tooltipEnable" data-placement="bottom" title="רשום 0 למניעת הגבלה" >
            <span class="invalid-feedback"><?php echo $data['weekly_budget_threshold_err'] ; ?></span>
        </div>

              
           
                       <input id="submit" type="submit" value="עדכן תקציב " class="btn btn-dark " > 
                   
      
        </form>
        
</div>
        




  
<?php require APPROOT . '/views/inc/footer.php'; ?>
