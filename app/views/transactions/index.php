<?php require APPROOT . '/views/inc/header.php'; ?>
    <?php flash('transaction_added'); ?>
    

   
  <h1 class="mb-4">תנועות</h1>
  
<!-- Button Add-->
<div class="container">
  <div class="row mt-2 mb-3">
    <a href="<?php echo URLROOT; ?>/transactions/add" class="btn btn-primary btn-block btn-lg rounded-lg p-2 shadow">
        <i class="fa fa-pencil">הוסף תנועה</i>
    </a>      
  </div>
</div>

<!-- START SLIDER-->
<div class="container">
  <div id="carouselMainleControls" class="carousel slide" data-ride="carouselEnable">
    <div class="carousel-inner">
      <div class="carousel-item active">
        
      <div class="col align-self-center ">
          <div class="bg-white rounded-lg p-1  ">
            <h2 class="h4 text-center mb-3 text-muted "> סיכום חודשי</h2>
            <div class="d-flex justify-content-center">
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center  lh-condensed">
                      <span class="tbadge badge-primary badge-pill">&#8362; <?php echo  number_format($data['sum_revenues']->sum_revenue, 1);?></span>  
                      <div class="mr-5">
                        <h6 class="my-0">סה"כ הכנסות</h6>
                        <small class="text-muted"> כולל הכנסות קבועות</small>
                      </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center  lh-condensed">
                      <span class="tbadge badge-primary badge-pill">&#8362; <?php echo number_format($data['sum_expenses']->sum_expenses,1);?></span>  
                      <div class="mr-5">
                        <h6 class="my-0">סה"כ הוצאות</h6>
                        <small class="text-muted">כולל הוצאות קבועות</small>
                      </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <span  class="text-<?php echo ($data['balance']>=0)?'success' :'danger';?>" >&#8362; <?php echo number_format($data['balance'],1);?></span>  
                      <div class="text">
                        <h6 class="my-0">יתרה</h6>
                      </div>
                    </li> 
                </ul>
            </div>
          </div>
        </div>
        
      </div>

      <div class="carousel-item">
          <!--  Col Information summary -->
          <div class="col align-self-center">
              <div class="bg-white rounded-lg p-3 ">
                  <h2 class="h6 font-weight-bold text-center mb-4"> ניצול תקציב שבועי</h2>
                  <!-- Progress bar -->
                  <div class="progress mx-auto" data-value=<?php echo  number_format($data['precent_budget_this_week'], 1);?>>
                    <span class="progress-left">
                                  <span class="progress-bar border-primary"></span>
                    </span>
                    <span class="progress-right">
                                  <span class="progress-bar border-primary"></span>
                    </span>
                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                      <div class="h2 font-weight-bold"><?php echo  number_format($data['precent_budget_this_week'], 1);?><sup class="small">%</sup></div>
                    </div>
                  </div>
                 

                  <!-- Left info -->
                  <div class="row text-center mt-4">
                    <div class="col-2 border-left">
                      <div class="h4 font-weight-bold mb-0"><?php echo  number_format($data['budget_balance'], 1);?> &#8362;</div>
                      <span class="small text-gray">יתרה</span>
                    </div>  
                  </div>
                  <!-- END -->
               
              </div>   <!-- End Col Progress Bar-->
            </div><!-- End 1-->

        
      </div> 
      <!-- Start Test Carousrl item----------------------------------------------->
      

    <a class="carousel-control-prev" href="#carouselMainleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon " aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselMainleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon " aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>  

<!-- END SLIDER-->








   
    <div class="row mt-3">
     <!--New Date Chenging-->    
     <div class="btn dropright mt-3">
      <button type="button" class="btn btn-outline-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        בחר תאריך
      </button>
      <form class="dropdown-menu p-2" action="" method="GET">
        <div class="form-group">
          <label for="from_date">מתאריך</label>
          <input id="from_date" type="date" name="from_date" class="form-control" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date'];}?>">

        </div>
        <div class="form-group">
          <label for="to_date">עד תאריך</label>
          <input id="to_date" type="date" name="to_date" class="form-control" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date'];}else{echo date("d/m/Y");}?>">
        </div>
        
        <button type="submit" class="btn btn-primary">שנה תאריך</button>
      </form>
    </div>
      <!--  Table--> 
      <table id="" class="table table-striped bg-white " >
          <thead class="thead-dark">
            <tr>
              <th class=" text-center"></th>
              <th class="text-center">סכום</th>
              <th class="text-center">תאריך</th>
              <th class="text-center">סוג</th>
              <th class=" text-center">כותרת</th>
            </tr>
          </thead>
          
          <tbody>
           
           <?php foreach($data['transactions'] as $transaction): ?>
               
                <tr>
                  <!--  ניסוי עם כפתור הוספה--> 
                  <td class="text-center">
                  <a href="<?php echo URLROOT; ?>/transactions/show/<?php echo $transaction->id; ?>" class="btn btn-dark">עוד</a>
                  </td>

                  
                  
                  <td class="text-center">&#8362; <?php echo $transaction->amount; ?></td>
                  <td class="text-center"><time><?php $datetime = new DateTime($transaction->published_at);
                  echo $datetime->format("d/m/Y")."<br>".$datetime->format("G:i");?>
                  </time></td>
                  <td class="text-center"><?php echo $transaction->type; ?></td>
                  <td class="text-center"><?php echo $transaction->title; ?></td>
                  
                  
                </tr>
                <?php endforeach; ?>
          </tbody>
      </table>
      
  </div>
  <?php flash('transaction_empty'); ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>
