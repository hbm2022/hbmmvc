<?php require APPROOT . '/views/inc/header.php'; ?>
    <?php flash('transaction_added'); ?>
    <h1>ניהול משתמש</h1>
<div class="container ">
    <div class="row mb-3">
       
        <div class="col align-self-start">
          <div class="btn-group" role="group" aria-label="First group">
              <a href="<?php echo URLROOT; ?>/summaryReports/index" class="btn btn-secondary" role="button" >
                  <i class="fa fa-pencil"> הנפקת דוחות</i>
              </a>
             
              <a href="<?php echo URLROOT; ?>/fixTransactions/addSave" class="btn btn-secondary" role="button">
                  <i class="fa fa-pencil"> יצירת חיסכון</i>
              </a>
              <a href="<?php echo URLROOT; ?>/fixTransactions/addFixTransaction" class="btn btn-secondary "role="button" >
                  <i class="fa fa-pencil"> הוספת תנועה קבועה</i>
              </a>
          </div>     
        </div>
    </div>
    
    <div class="col-md-3">
        

        <div class="card" style="width: 15rem;">
        <div class="card-body">
        <h2>  תקציב שבועי</h2>
       
        <br>
        <a href="<?php echo URLROOT; ?>/fixTransactions/showWeeklyBudgetThreshold" class="btn btn-light btn-block " role="button" data-toggle="tooltipEnable" data-placement="bottom" title="קביעת הגבלת תקציב" >
                  <i>  <?php echo ($data['weeklyBudget']->budget== 0) ? 'אין הגבלה':$data['weeklyBudget']->budget;?> </i>
              </a>
        </div>
      </div>

        </div>

<div class="row">
    <div class="col ">
      <h2>הכנסות קבועות</h2>
              <!--  Table: Revenues --> 
              <table id="" class="table table-striped text-white">
                  <thead class="thead-dark">
                    <tr>
                      <th class=" text-center"></th>
                      <th class="text-center">סכום</th>
                      <th class="text-center">רישום הבא</th>
                      <th class="text-center">סוג</th>
                      <th class=" text-center">כותרת</th>
                    </tr>
                  </thead>

                  <tbody>
                  
                  <?php foreach($data['fixedRevenues'] as $fixedRevenues): ?>
                      
                        <tr>
                          
                          <td class="text-center">
                          <a href="<?php echo URLROOT; ?>/fixTransactions/show/<?php echo $fixedRevenues->id; ?>" class="btn btn-dark">עוד</a>
                          </td>

                          <td class="text-center"><?php echo $fixedRevenues->amount; ?></td>
                          <td class="text-center">
                            <time>
                              <?php $datetime = new DateTime($fixedRevenues->next_published);
                               echo $datetime->format("d/m/Y");?>
                            </time>
                          </td>
                          <td class="text-center"><?php echo $fixedRevenues->type; ?></td>
                          <td class="text-center"><?php echo $fixedRevenues->title; ?></td>
                          
                        </tr>
                        <?php endforeach; ?>
                  </tbody>
              </table>
    </div>
    <div class="col">
    <h2>הוצאות קבועות</h2>
              <!--  Table: Expenses--> 
              <table id="" class="table table-striped text-white">
                  <thead class="thead-dark">
                    <tr>
                      <th class=" text-center"></th>
                      <th class="text-center">סכום</th>
                      <th class="text-center">רישום הבא</th>
                      <th class="text-center">סוג</th>
                      <th class=" text-center">כותרת</th>
                    </tr>
                  </thead>

                  <tbody>
                  
                  <?php foreach($data['fixedExpenses'] as $fixedExpenses): ?>
                      
                        <tr>
                          
                          <td class="text-center">
                          <a href="<?php echo URLROOT; ?>/fixTransactions/show/<?php echo $fixedExpenses->id; ?>" class="btn btn-dark">עוד</a>
                          </td>

                          <td class="text-center"><?php echo $fixedExpenses->amount; ?></td>
                          <td class="text-center">
                          <time>
                              <?php $datetime = new DateTime($fixedExpenses->next_published);
                               echo $datetime->format("d/m/Y");?>
                            </time>  
                          </td>
                          <td class="text-center"><?php echo $fixedExpenses->type; ?></td>
                          <td class="text-center"><?php echo $fixedExpenses->title; ?></td>
                          
                        </tr>
                        <?php endforeach; ?>
                  </tbody>
              </table>

    </div>

</div>    

<div class="row">
        <div class="col">
          <h2>חסכונות</h2>
          <!--  Table: Saves --> 
          <table id="" class="table table-striped text-white">
              <thead class="thead-dark">
                <tr>
                  <th class="text-center"></th>
                  <th class="text-center">יעד</th>
                  <th class="text-center">צבירה</th>
                  <th class="text-center">כותרת</th>
                </tr>
              </thead>

              <tbody>
              
              <?php foreach($data['saves'] as $save): ?>
                  
                    <tr>
                      <!--  ניסוי עם כפתור הוספה--> 
                      <td class="text-center">
                      <a href="<?php echo URLROOT; ?>/fixTransactions/showSave/<?php echo $save->id; ?>" class="btn btn-dark">עוד</a>
                      </td>

                      <td class="text-center"><?php echo $save->target_amount; ?></td>
                      <td class="text-center"><?php echo $save->current_amount; ?></td>
                      <td class="text-center"><?php echo $save->nameSave; ?></td>
                      
                    </tr>
                    <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </div>

    
      
          
        


          
        
      </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
