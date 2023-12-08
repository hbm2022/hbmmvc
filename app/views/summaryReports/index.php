<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2> הנפקת דוחות </h2>
            <p>סיכום חודשי-שנתי</p>
            <form action="<?php echo URLROOT; ?>/summaryReports/getSummaryReports " method="post">
                <div class="form-group">
                <label for="year">: שנה</label>
                <select name="year" id="year" class="form-control text-left <?php echo (!empty($data['year_err'])) ? 'is-invalid' : ''; ?>"  >
                <option value="" >בחר שנה</option>
                    <?php for($i=2020; $i<=2050; $i++):?>
                        <option value="<?php echo $i;?>" ><?php echo $i;?></option>
                    <?php endfor;?>

                </select>
                <span class="invalid-feedback"><?php echo $data['year_err'] ; ?></span>
                 </div>
                 <div class="form-group">
                    <label for="month">: חודש</label>
                    <select name="month" id="month" class="form-control text-left <?php echo (!empty($data['month_err'])) ? 'is-invalid' : ''; ?>"  >
                    <option value="" >בחר חודש</option>
                        <?php for($i=1; $i<=12; $i++):
                        
                        if($i==1)
                        $m='ינואר';
                        if($i==2)
                        $m='פברואר';
                        if($i==3)
                        $m='מרץ';
                        if($i==4)
                        $m='אפריל';
                        if($i==5)
                        $m='מאי';
                        if($i==6)
                        $m='יוני';
                        if($i==7)
                        $m='יולי';
                        if($i==8)
                        $m='אוגוסט';
                        if($i==9)
                        $m='ספטמבר';
                        if($i==10)
                        $m='אוקטובר';
                        if($i==11)
                        $m='נובמבר';
                        if($i==12)
                        $m='דצמבר';
                            
                        ?>
                            <option value="<?php echo $i;?>" ><?php echo $m;?></option>
                        <?php endfor;?>

                    </select>
                    <span class="invalid-feedback"><?php echo $data['month_err'] ; ?></span>
                 </div>
               <div class="row">
                    
                    <div class="col">
                       <input type="submit" value="אישור" class="btn btn-success btn-block"> 
                    </div>
               </div>
                
            </form>
        </div>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>