<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('report_updated'); ?>
<a href="<?php echo URLROOT; ?>/reports" class="btn btn-light"><i class="fa fa-backward">חזרה</i></a>
<br>
<h1>הצגת הדיווח בהרחבה</h1>
<br>
<h4>נושא: <?php echo $data['report']->title; ?></h4>
<div class="bg-secondary text-white p-2 mb-3 text-left">

 מצב דיווח : <?php echo $data['report']->status; ?>  
 <br>
פורסם בתאריך : <?php echo $data['report']->created_at; ?> על ידי <?php echo $data['report']->name; ?>
<br>
<?php echo $data['report']->email; ?> : מייל ליצירת קשר  
</div>


<p><strong>תיאור : </strong> <?php echo $data['report']->description; ?></p>

<hr>


 
<form class="pull-left" action="<?php echo URLROOT; ?>/reports/delete/<?php echo $data['report']->id; ?>" method="post">
<input type="submit" value="מחיקה" class="btn btn-danger">

</form>
        
   
<?php require APPROOT . '/views/inc/footer.php'; ?>
