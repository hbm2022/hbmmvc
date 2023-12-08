<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
   
    <a class="navbar-brand" href=""><?php echo SITENAME;?></a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav ml-auto">
      <?php if(isset($_SESSION['user_id'])) : ?>
        <?php if($_SESSION['type']!= 'admin') : ?>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo URLROOT; ?>/transactions?to_date=<?php echo date('Y-m-d', strtotime('last day of this month'))?>&from_date=<?php echo date('Y-m-d', strtotime('first day of this month'))?>">תנועות</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/fixTransactions">ניהול משתמש</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/groups">ניהול קבוצה</a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="#">Welcome manager  <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/reports">ניהול דיווחים</a>
          </li>
          
        <?php endif; ?>
      <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">אודות</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo URLROOT; ?>/index">ראשי</a>
          </li>
        
      <?php endif; ?>
    </ul>
    <ul class="navbar-nav mr-auto">
    
        <?php if(isset($_SESSION['user_id'])) : ?>
          <?php if($_SESSION['type']!= 'admin') : ?>
          
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/showSettings">הגדרות</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">אודות</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">יציאה</a>
          </li>
        <?php else : ?>
          
          
          
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">אודות</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">יציאה</a>
          </li>
        <?php endif; ?>
      <?php else : ?>
        <li class="nav-item ">
          <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">הרשמה</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">כניסה</a>
        </li>
        
      <?php endif; ?>
        
      </ul> 
    
      
      
    
    
      
      
    </div>
  </div>
</nav>