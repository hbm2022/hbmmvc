<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('transaction_added'); ?>
<a href="<?php echo URLROOT; ?>/fixTransactions" class="btn btn-light"><i class="fa fa-backward">חזרה</i></a>
<br>
<h1>:פירוט חיסכון</h1>
<br>



<h4><?php echo $data['save']->title; ?></h4>
<div class="bg-secondary text-white p-2 mb-3">

עד כה ניצבר הסכום <?php echo $data['save']->current_amount; ?> מתוך <?php echo $data['save']->target_amount; ?>


</div>

<a href="<?php echo URLROOT; ?>/fixTransactions/editSave/<?php echo $data['save']->id; ?>" class="btn btn-dark">עריכה</a>
 
<form class="pull-left" action="<?php echo URLROOT; ?>/fixTransactions/closeSave/<?php echo $data['save']->id; ?>" method="post">
<input type="submit" value="קפל וסגור" class="btn btn-success">

</form>
        
   
<?php require APPROOT . '/views/inc/footer.php'; ?>
