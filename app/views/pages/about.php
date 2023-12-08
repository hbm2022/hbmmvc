<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('report'); ?>







 <div class="container py-5">
 
  <header class="text-center text-white">
    <div class="row">
    <div class="col-lg-7 mx-auto">
       
      </div>
      <div class="col-lg-7 mx-auto">
        <h1 class="display-4">מערכת לניהול משק בית</h1>
        <p class="font-italic">נותנת שליטה ופיקוח על תקציבך ותקציב הסובבים אותך</p>

          <a href="http://localhost/hbmmvc/users/login" class="text-white">
            <u>Click on link for start</u></a> MVC-HBM. </p>
        <p class="font-italic">Coded and designed by
          <a  class="text-white">
            <u>E-Z & O-Z</u>
          </a>
        </p>
        <div class="col ml-auto">
          <p><strong><?php echo APPVERSION; ?></strong> :גירסה </p>
         </div>
      </div>
    </div>
  </header>

  <div class="row py-5">
    <div class="col-lg-8 mx-auto">
   
      <div class="card mb-4">
        <div class="card-body p-4">
          <h4 class="mb-4"> פירוט מקוצר</h4>
          <div class="custom-scrollbar-css p-2 " >
            <p class="font-italic ">
              האתר הינו פלטפורמה אשר תעזור לנהל ולתכנן הוצאות וחסכונות מול הכנסות של משתמש יחיד וגם מספר של משתמשים מאותה המשפחה.
                                    האתר נוצר מתוך חשיבה על 2 מטרות עיקריות והן:
                                    <ul class="font-italic">
                                      <li>ניהול חכם של התקציב החודשי ולמנוע "התפזרות" של המשתמש היחיד.</li>
                                      <li>מעקב מתקדם אחר בני המשפחה/חברי הקבוצה ומתן עזרה לצורך מניעה מחריגות באחריות של ראש המשפחה/קבוצה.</li>
                                    </ul>
                                    
                                    
            </p>
            </br>
            <p class="font-italic">האתר יתמוך במערכת חלונות ומובייל כך שתמיד לא תהיה מגבלה של ניידות.
              האתר יציג את הלוגו בכל המסכים ולאחר ההתחברות יציג גם את השם המלא של המשתמש.
            </p>
            </br>
            <p class="font-italic">לתחילת עבודה עם המערכת, המשתמש יירשם באמצעות טופס הרשמה שבו יזין סיסמה  מייל פרטים אישיים </p>
          </div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-body p-4">
          <h4 class="mb-4"> הוספת תנועות</h4>
          <div class="custom-scrollbar-css p-2">
            <p class="font-italic">באתר זה המשתמש יכול בקלות להוסיף לערוך ולמחוק  הוצאות, הכנסות, וחסכונות</p>
          </div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-body p-4">
          <h4 class="mb-4"> הוספת תנועות קבועות</h4>
          <div class="custom-scrollbar-css p-2">
            <p class="font-italic">באתר זה המשתמש יכול בקלות להוסיף לערוך ולמחוק  הוצאות, הכנסות, וחסכונות</p>
          </div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-body p-4">
          <h4 class="mb-4">תקציב חודשי</h4>
          <div class="custom-scrollbar-css p-2">
            <p class="font-italic">באתר זה המשתמש יכול בקלות להוסיף לערוך ולמחוק  הוצאות, הכנסות, וחסכונות</p>
          </div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-body p-4">
          <h4 class="mb-4">פתיחת חסכונות</h4>
          <div class="custom-scrollbar-css p-2">
            <p class="font-italic">באתר זה המשתמש יכול בקלות להוסיף לערוך ולמחוק  הוצאות, הכנסות, וחסכונות</p>
          </div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-body p-4">
          <h4 class="mb-4">ניהול קבוצות</h4>
          <div class="custom-scrollbar-css p-2">
            <p class="font-italic">•ניתן ליצור קבוצה ולהגדיר אותה כמשפחה או קבוצה ניתן להוסיף ולהסיר חברי משפחה שמבקשים להצטרף אפשר לראות  סטאטוס של כל חבר קבוצה/משפחה</p>
          </div>
        </div>
      </div>

      

      <p class="text-white text-center font-italic">More styles on
        <a href="http://manos.malihu.gr/repository/custom-scrollbar/demo/examples/scrollbar_themes_demo.html" class="text-white small">
          <u>Malihu scrollbar styles</u>
        </a>
      </p>
      <a href="<?php echo URLROOT; ?>/reports/reporting" class="btn btn-outline-light btn-bock">
                <i class="fa fa-thumbs-up">  דווח על תקלה  </i>
            </a>
    </div>
    
  </div>
  
</div>
        
<?php require APPROOT . '/views/inc/footer.php'; ?>