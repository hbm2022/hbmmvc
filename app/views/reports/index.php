<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('report_updated'); ?>
    <h1>מנהל מערכת </h1>
    
            
    
    


    <!-- View Saves Table-->
    <div class="row">
    
    <!--  Table--> 
    <table id="" class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th class=" text-center"></th>
            <th class="text-center">סטאטוס</th>
            <th class=" text-center">כותרת</th>
            <th class="text-center">תאריך</th>
          </tr>
        </thead>
        
        <tbody>
         
         <?php foreach($data['reports'] as $report): ?>
             
              <tr>
                <!--  ניסוי עם כפתור הוספה--> 
                <td class="text-center">
                <a href="<?php echo URLROOT; ?>/reports/showReport/<?php echo $report->id; ?>" class="btn btn-dark">הצגה</a>
                </td>

                
                <td class="text-center"><?php echo $report->status; ?></td>
                <td class="text-center"><?php echo $report->title; ?></td>
                <td class="text-center"><time><?php $datetime = new DateTime($report->created_at);
                echo $datetime->format("d/m/Y")."<br>".$datetime->format("G:i");?>
                </time></td>
                
               
                
                
              </tr>
              <?php endforeach; ?>
        </tbody>
    </table>
    
</div>
    


<?php require APPROOT . '/views/inc/footer.php'; ?>
