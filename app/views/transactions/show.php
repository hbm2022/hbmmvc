<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('transaction_edited'); ?>
<a href="<?php echo URLROOT; ?>/transactions?to_date=<?php echo date('Y-m-d', strtotime('last day of this month'))?>&from_date=<?php echo date('Y-m-d', strtotime('first day of this month'))?>" class="btn btn-light"><i class="fa fa-backward">חזרה</i></a>
<br>
<h1>:פירוט תנועה</h1>
<br>
<h4><?php echo $data['transaction']->title; ?></h4>
<div class="bg-secondary text-white p-2 mb-3">

בוצע <?php echo $data['transaction']->type; ?> בסכום <?php echo $data['transaction']->amount; ?>

בתאריך <?php echo $data['transaction']->published_at; ?>

על ידי <?php echo $data['user']->first_name; ?>
</div>

<?php if($data['transaction']->target_saving  != 0) : ?>

<p><strong>חיסכון: </strong> <?php echo $data['save']->title; ?></p>

<hr>
<?php endif ?>

<?php if($data['transaction']->comment !='') : ?>

<p><strong>הערה: </strong> <?php echo $data['transaction']->comment; ?></p>

<hr>
<?php endif ?>
<a href="<?php echo URLROOT; ?>/transactions/edit/<?php echo $data['transaction']->id; ?>" class="btn btn-dark">עריכה</a>
 
<form class="pull-left" action="<?php echo URLROOT; ?>/transactions/delete/<?php echo $data['transaction']->id; ?>" method="post">
<input type="submit" value="מחיקה" class="btn btn-danger">

</form>
        
   
<?php require APPROOT . '/views/inc/footer.php'; ?>
