<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/summaryReports" class="btn btn-light"><i class="fa fa-backward">חזרה</i></a>
<br>

<div id="invoice">
<h1 class="text-center">house budget management</h1>
<br>
<h4>סיכום  חודשי</h4>
<br>


<h4><time>
  <?php $datetime = new DateTime($data['yearAndMonth']);
        echo $datetime->format("F Y");
  ?>
</time></h4>



<hr class="mb-4">


<div class="row ml-4 mr-4">
    
      <!--  Table--> 
      <table id="" class="table table-striped">
          <thead class="thead-dark">
            <tr>
              
              <th class="text-center">יתרה</th>
              <th class="text-center">הוצאות</th>
              <th class=" text-center">הכנסות</th>
            </tr>
          </thead>
          
          <tbody>
           
                <tr>
                  <!--  ניסוי עם כפתור הוספה--> 
                  
                  <td class="text-center">&#8362; <?php echo number_format($data['balance'],1);?></td>
                  <td class="text-center">&#8362; <?php echo number_format($data['sum_expenses']->sum_expenses,1);?></td>
                  <td class="text-center">&#8362; <?php echo number_format($data['sum_revenues']->sum_revenue,1);?></td>
                  
                  
                </tr>
                
          </tbody>
      </table>
      
    </div>
    <hr class="mb-4">






</div>

<button class="btn btn-primary" id="download" > הורדה </button>
        
   
<?php require APPROOT . '/views/inc/footer.php'; ?>
