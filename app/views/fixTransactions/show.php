<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('transaction_edited'); ?>
<a href="<?php echo URLROOT; ?>/fixTransactions" class="btn btn-light"><i class="fa fa-backward">חזרה</i></a>
<br>
<h1>:פירוט תנועה</h1>
<br>



<h4><?php echo $data['transaction']->title; ?></h4>
<div class="bg-secondary text-white p-2 mb-3">
&#8362;
ביצוע <?php echo $data['transaction']->type; ?> בסכום  <?php echo  number_format($data['transaction']->amount, 1);?>
<br>
תאריך פתיחת תנועה : <?php echo $data['transaction']->created_at; ?>
<br>
פעולה הבאה תרשם בתאריך:<?php echo $data['transaction']->next_published; ?>
</div>
<?php if($data['transaction']->target_saving  != 0) : ?>

<p><strong>חיסכון: </strong> <?php echo $data['save']->title; ?></p>

<hr>
<?php endif ?>
<?php if($data['transaction']->comment !='') : ?>

<p><strong>הערה: </strong> <?php echo $data['transaction']->comment; ?></p>

<hr>
<?php endif ?>
<a href="<?php echo URLROOT; ?>/fixTransactions/editFixTransaction/<?php echo $data['transaction']->id; ?>" class="btn btn-dark">עריכה</a>
 
<form class="pull-left" action="<?php echo URLROOT; ?>/fixTransactions/delete/<?php echo $data['transaction']->id; ?>" method="post">
<input type="submit" value="מחיקה" class="btn btn-danger">

</form>
        
   
<?php require APPROOT . '/views/inc/footer.php'; ?>
