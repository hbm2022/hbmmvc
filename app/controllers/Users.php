<?php
 require 'vendor/PHPMailer/src/Exception.php';
 require 'vendor/PHPMailer/src/PHPMailer.php';
 require 'vendor/PHPMailer/src/SMTP.php';
 
         use PHPMailer\PHPMailer\PHPMailer;
         use PHPMailer\PHPMailer\Exception;
         use PHPMailer\PHPMailer\SMTP;
class Users extends Controller
{
    

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register(){
        //Check for post
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {
        //Process form
                
        // Sanitize POST data
        //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
       
        //Init data
       $data = [
        'first_name' => trim($_POST['first_name']),
        'last_name' => trim($_POST['last_name']),
        'phone' => trim($_POST['phone']),
        'email' => trim($_POST['email']),      
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),

        'first_name_err' => '',
        'last_name_err' => '',
        'phone_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
       ];

       // Validate Email
       if(empty($data['email'])){
        $data['email_err'] = 'הכנס בבקשה מייל';
       } else {
        // Check Email
        if($this->userModel->findUserByEmail($data['email'])){
          $data['email_err'] = 'המייל נמצא כבר בשימוש';  
        }
       }

       // Validate Name
       if(empty($data['first_name'])){
        $data['first_name_err'] = 'הכנס בבקשה שם פרטי';
       }
       if(empty($data['last_name'])){
        $data['last_name_err'] = 'הכנס בבקשה שם משפחה';
       }

       // Validate Phone number
       if(empty($data['phone'])){
        $data['phone_err'] = 'הכנס בבקשה מספר טלפון';
       } elseif(!is_numeric($data['phone'])){
        $data['phone_err'] = 'מספר טלפון חייב להכיל ספרות בלבד';
       }elseif(strlen($data['phone']) < 9){
        $data['phone_err'] = 'מספר טלפון חייב להכיל לפחות 9 ספרות';
       }

       // Validate Password
       if(empty($data['password'])){
        $data['password_err'] = 'הכנס בבקשה סיסמה';
       } elseif(strlen($data['password']) < 6){
        $data['password_err'] = 'הסיסמה חייבת להכיל לפחות 6 תווים';
       }

       // Validate Confirm Password
       if(empty($data['confirm_password'])){
        $data['confirm_password_err'] = 'הכנס בבקשה אישור סיסמה';
       } else{
        if ($data['password'] !=  $data['confirm_password'])
        {
        $data['confirm_password_err'] = 'סיסמה לא תואמת';
        }
       }

       // Make sure errors are empty
       if((empty($data['first_name_err'])) && (empty($data['last_name_err'])) && (empty($data['email_err'])) &&
       (empty($data['phone_err'])) && (empty($data['password_err'])) && (empty($data['confirm_password_err'])))
       {
        // Validate
        
        // Hash Password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Register User
        if($this->userModel->register($data))
        {
            flash('register_success', 'נרשמת בהצלחה,הגיע הזמן להתחיל');
            redirect('users/login');
        } else {die('משהו לא היה בסדר');}

       } else {
        // Load view with errors
        $this->view('users/register',$data);
       }


        } else{
           // echo "Load Form";
        //Init data
       $data = [
        'first_name' => '',
        'last_name' => '',
        'phone' => '',
        'email' => '',      
        'password' => '',
        'confirm_password' => '',

        'first_name_err' => '',
        'last_name_err' => '',
        'phone_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
       ];

       //Load view
       $this->view('users/register', $data);
        }
    }

    public function login(){
        // Check for post
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
       
        //Init data
        $data = [
           
            'email' => trim($_POST['email']),      
            'password' => trim($_POST['password']),
            
            'email_err' => '',
            'password_err' => ''
        ];

        // Validate Email
       if(empty($data['email'])){
        $data['email_err'] = 'הכנס בבקשה מייל';
       }

       // Validate Password
       if(empty($data['password'])){
        $data['password_err'] = 'הכנס בבקשה סיסמה';
       }
        
       // Check for user/email
       if($this->userModel->findUserByEmail($data['email'])){
       // User found  
      } else {
       // User not found
        $data['email_err'] = 'משתמש לא קיים';
       }

       // Make sure errors are empty
       if((empty($data['password_err'])) && (empty($data['email_err']))){
         // Validate
         // Check and set logged in user
         $loggedInUser = $this->userModel->login($data['email'], $data['password']);

         if($loggedInUser){
            // Create Session
            $this->createUserSession($loggedInUser);
         } else {
            $data['password_err'] = 'סיסמה שגויה';

            $this->view('users/login', $data);
         }

        } else {
         // Load view with errors
         $this->view('users/login',$data);
        }
        } else{
           // echo "Load Form";
        //Init data
        $data = [
            
            'email' => '',      
            'password' => '',
            
            'email_err' => '',
            'password_err' => '',
        
        ];

       //Load view
       $this->view('users/login', $data);
        }
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;  
        $_SESSION['group_id'] = $user->group_id;  
        $_SESSION['first_name'] = $user->first_name;
        $_SESSION['last_name'] = $user->last_name;
        $_SESSION['type'] = $user->type;

       if($_SESSION['type'] = $user->type=='admin') {
            redirect('reports');
       } else{
        redirect('transactions?to_date='.date('Y-m-d', strtotime('last day of this month')).'&from_date='.date('Y-m-d', strtotime('first day of this month')));
       }
        
        
        //redirect('transactions');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['last_name']);
        unset($_SESSION['first_name']);
        unset($_SESSION['type']);

        session_destroy();
        redirect('users/login');
    }

    // Display data user before performs edit
    public function showSettings() {
        
        
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $data = [

            
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone_number,
                  
            

            'first_name_err' => '',
            'last_name_err' => '',
            'phone_err' => ''
            
             
            
        ];
        $this->view('settings/settingsUser', $data);
       
    }
    
    public function settingsUser($id) {
       
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
          
            $data =[
            'id' => $id,
            'first_name' => trim($_POST['first_name']),
            'last_name' => trim($_POST['last_name']),
            'phone' => trim($_POST['phone']),
            
            'first_name_err' => '',
            'last_name_err' => '',
            'phone_err' => ''
            
            ];

            // Validate data
            if(empty($data['first_name'])){
                $data['first_name_err'] = 'הכנס בבקשה שם פרטי';
               }
               if(empty($data['last_name'])){
                $data['last_name_err'] = 'הכנס בבקשה שם משפחה';
               }
        
               // Validate Phone number
               if(empty($data['phone'])){
                $data['phone_err'] = 'הכנס בבקשה מספר טלפון';
               } elseif(!is_numeric($data['phone'])){
                $data['phone_err'] = 'מספר טלפון חייב להכיל ספרות בלבד';
               }elseif(strlen($data['phone']) < 9){
                $data['phone_err'] = 'מספר טלפון חייב להכיל לפחות 9 ספרות';
               }
            

            // Make sure no errors
            if(empty($data['first_name_err']) && empty( $data['last_name_err']) && empty($data['phone_err'])){
            // Validated
                if($this->userModel->settingUpdated($data)){
                    flash('updated_msg', 'הגדרות משתמש עודכנו בהצלחה' );
                    redirect('users/showSettings/'.$id);
                } else {
                    die('יש בעיה');
                }
            } else {
                // Load view with errors
                
                $this->view('settings/settingsUser', $data);
            }

        } else {
            // Get exiting transaction from model
            $user = $this->userModel->getUserById($id);
            // Check for owner
            if($user->id != $_SESSION['user_id'] ) {
                
                redirect('users');
            }

            $data =[
                'id' => $id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'phone' => $user->phone_number
            ];
            
            $this->view('settings/settingsUser', $data);
        }// end else
    }

    public function changingPassword($id) {
       
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            
            $data =[
            'id' => $id,
            'old_password' => trim($_POST['old_password']),
            'new_password' => trim($_POST['new_password']),
            'confirm_password' => trim($_POST['confirm_password']),
            
            'old_password_err' => '',
            'new_password_err' => '',
            'confirm_password_err' => ''
            
            ];

            // Validate Old Password
            $correctPass = $this->userModel->GetOldPass($data['id'], $data['old_password']);

            if($correctPass){
               // Create Session
              
            } else {
               $data['old_password_err'] = 'סיסמה שגויה';
            }

            // Validate New Password
            if(empty($data['new_password'])){
                $data['new_password_err'] = 'הכנס בבקשה סיסמה';
            } elseif(strlen($data['new_password']) < 6){
                $data['new_password_err'] = 'הסיסמה חייבת להכיל לפחות 6 תווים';
            }    
            // Validate Confirm Password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'הכנס בבקשה אישור סיסמה';
            } else{
                if ($data['new_password'] !=  $data['confirm_password'])
                {
                $data['confirm_password_err'] = 'סיסמה לא תואמת';
                }
            }
            
            // Make sure no errors
            if((empty($data['new_password_err'])) && (empty($data['confirm_password_err'])) && (empty($data['old_password_err'])) )
            {
                // Hash Password
                  $data['new_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
            // Validated
                if($this->userModel->passwordUpdated($data)){

                   

                    flash('register_success', 'שינוי סיסמה בוצע בהצלחה' );
                    redirect('users/login');
                } else {
                    die('יש בעיה');
                }
            } else {
                // Load view with errors
                
                $this->view('settings/changingPassword', $data);
            }

        } else {
            // Get exiting transaction from model
            $user = $this->userModel->getUserById($id);
            // Check for owner
            if($user->id != $_SESSION['user_id'] ) {
                
                redirect('users');
            }

            $data =[
                'id' => $id,
                'old_password' => '',
                'new_password' => '',
                'confirm_password' => ''
            ];
            
            $this->view('settings/changingPassword', $data);
        }// end else
    }

    public function forgetPassword(){
     
        // Check for post
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
       
        //Init data
        $data = [
           
            'email' => trim($_POST['email']),
            'email_err' => ''
        ];

        // Validate Email
       if(empty($data['email'])){
        flash('register_success', 'מייל לא תקין');
        redirect('users/login');
       }

        
       // Check for user/email
       if($this->userModel->findUserByEmail($data['email'])){
       // User found  
      } else {
       // User not found
       // $data['email_err'] = 'משתמש לא קיים';
        flash('register_success', 'משתמש לא קיים');
            redirect('users/login');
       }

       // Make sure errors are empty
       if((empty($data['email_err']))){
         // Validate
         // Check and set logged in use
         $email = $data['email'];
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = 'smtp.gmail.com';
	     $mail->SMTPAuth = 'true';
	     $mail->SMTPSecure = 'tls';
    
	     $mail->Port = '587';
	     $mail->Username = 'hbm.soft2022@gmail.com';
	     $mail->Password = 'ikihlxepvabtzfka';
	     $mail->Subject = 'Reset Password';
	     $mail->setFrom('hbm.soft2022@gmail.com');
   
	     $mail->isHTML(true);
          //Add recipient
    	$mail->addAddress($email);
        // ****************the message*******************************
        $reset_token = bin2hex(random_bytes(16));
       
        date_default_timezone_set('Asia/Jerusalem');
        $date = date("Y-m-d");
        $this->userModel->createToken($data,$reset_token,$date);
        $url = 'http://localhost/hbmmvc/users/forgetPasswordIndex?email='. $email . '&reset_token=' . $reset_token . '&new_password=' . $new_password ;
        

        
        $mail_templte="<h1>Hello,</h1>
                       </br>
                       
                       </br></br>
                       </br>
                       <h2>press on link for reset your password </h2>
                       <a href=$url'>reset password</a>
                       </br>
                       
                        ";
	    $mail->Body = $mail_templte;
   
        if ( $mail->send() ) {

            flash('register_success', 'המייל נשלח בהצלחה');
                redirect('users/login');
        }else{
            flash('register_success', 'עקב תקלה,לא נשלח מייל, אנא פנה לתמיכה');
                redirect('users/login');
        }

        $mail->smtpClose();
         
        
        
        

        } else {
         // Load view with errors
         $this->view('users/login',$data);
        }
        } else{
           // echo "Load Form";
        //Init data
        $data = [
            
            'email' => '',      
            'password' => '',
            
            'email_err' => '',
            'password_err' => '',
        
        ];

       //Load view
       $this->view('users/login', $data);
        }
    }
    public function forgetPasswordIndex() {
        
        if(isset($_GET['email']) && isset($_GET['reset_token'])) {
                
                
            $email = $_GET['email'];
            $reset_token = $_GET['reset_token'];
           
            }
       
            $data = [

                'token' => $reset_token,
                'email' =>$email,      
                'new_password' => '',                
                'confirm_password'=> '',
                'new_password_err' => ''
               
            ];
        $this->view('users/forgetPasswordIndex', $data);
       
    }
   

    public function resetPassword($token) {
      
           // Check if the email and token has exist 
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
            $data =[
                'token' => $token,
                'email' => trim($_POST['email']),      
                'new_password' => trim($_POST['new_password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'new_password_err' => '',
                'confirm_password_err' => ''
            ];
        
            // Validate Password
            if(empty($data['new_password'])){
                $data['new_password_err'] = 'הכנס בבקשה סיסמה';
            } elseif(strlen($data['new_password']) < 6){
                $data['new_password_err'] = 'הסיסמה חייבת להכיל לפחות 6 תווים';
            }    
            // Validate Confirm Password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'הכנס בבקשה אישור סיסמה';
            } else{
                if ($data['new_password'] !=  $data['confirm_password'])
                {
                $data['confirm_password_err'] = 'סיסמה לא תואמת';
                }
            }
            
        
            // Make sure no errors
            if((empty($data['new_password_err'])) && (empty($data['confirm_password_err']))) {
                // Hash Password
                $data['new_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
            // Validated
                    if($this->userModel->resetPasswordUpdated($data,$token)){
                        $this->userModel->cleanToken($data);
                    
                     flash('register_success', 'שינוי סיסמה בוצע בהצלחה' );
                     redirect('users/login');
                    } else {die('משהו לא היה בסדר');}
                } else {
                    // Load view with errors
                    
                    
                   // redirect('users/forgetPasswordIndex?email='.$email.'&reset_token='.$data['token']);
                    $this->view('users/forgetPasswordIndex', $data);
                }
            } else {
                $data =[
                    'token' => $token,
                    'email' =>'',      
                    'new_password' => '',
                    'new_password_err' => '',
                    'confirm_password' => '',
                    'confirm_password_err' =>''
                ];

               $this->view('users/forgetPasswordIndex', $data);
        }
    
    } 
    
}