<?php
 class FixTransactions extends Controller {
    public function __construct() 
    {
        if(!isLoggedIn()) {
          redirect('/users/login');  
        }
        
        $this->fixTransactionModel = $this->model('FixTransaction');
        $this->userModel = $this->model('User');
    }

    public function index() {
        
        // Get calculating saves sum's
        foreach($this->fixTransactionModel->getSaveId() as $save_id):
            $this->fixTransactionModel->calculatingSaveSum($save_id->id);
        endforeach;
        // Get fix transactions and saves 
        $weeklyBudget = $this->fixTransactionModel->getWeeklyBudget();
        $saves = $this->fixTransactionModel->getSavesAllData();
        $fixedExpenses = $this->fixTransactionModel->getFixedExpensesTransactions();
        $fixedRevenues = $this->fixTransactionModel->getFixedRevenuesTransactions();
        
       
      
        $data =[
            'fixedExpenses' => $fixedExpenses,
            'saves' => $saves,
            'fixedRevenues' => $fixedRevenues,
            'weeklyBudget' => $weeklyBudget
             
        ];

        $this->view('fixTransactions/index', $data);
        
    }

    public function addFixTransaction() {

        $saves = $this->fixTransactionModel->getSavesAllData();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
          
            $data =[
                'title' => trim($_POST['title']),
                'type' => trim($_POST['type']),
                'target_saving' => trim($_POST['target_saving']),
                'created_at' => trim($_POST['created_at']),
                'comment' => trim($_POST['comment']),
                'amount' => trim($_POST['amount']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'target_saving_err' =>'',
                'published_at_err' => '',
                'amount_arr' => '',
                'saves' => $saves
            ];

            // Validate data
            if(empty($data['title'])){
                $data['title_err'] = 'הכנס כותרת';
            }
            if(empty($data['created_at'])){
                $data['created_at_err'] = 'בחר תאריך';
            }
            if(($data['type']=='הוספה לחיסכון')){
                if(empty($data['target_saving'])){
                    $data['target_saving_err'] = 'בחר חיסכון ';
                    
                }
            }
            if(empty($data['amount'])){
                $data['amount_err'] = 'הכנס סכום';
                
            } else {
                if(!is_numeric($data['amount'])){
                    $data['amount_err'] = ' הכנס מספרים בלבד ';
                }
            }
            if($data['type'] != 'הוספה לחיסכון') {
                $data['target_saving'] = 0;
            }
            
                if(empty($data['title_err']) && empty( $data['amount_err']) && empty($data['created_at_err']) && empty($data['target_saving_err'])){
                    // Validated
                    if($this->fixTransactionModel->addFixTransaction($data)){
                        flash('transaction_added', 'תנועה קבועה נוצרה ' );
                        redirect('fixTransactions');
                    } else {
                        die('יש בעיה');
                    }
                }else {
                    // Load view with errors
                    $this->view('fixTransactions/addFixTransaction', $data);
             }
            


            // Make sure no errors
            

        } else {

            $data =[
                'created_at' => '',
                'type' => '',
                'target_saving' => '',
                'title' => '',
                'comment' => '',
                'amount' => ''
                ,'saves' => $saves
                
            ];
            
            $this->view('fixTransactions/addFixTransaction', $data);
        }// end else
    }

    public function addSave() {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
          
            $data =[
                'title' => trim($_POST['title']),
                'target_amount' => trim($_POST['target_amount']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'target_amount_err' => '',
                
            ];

            // Validate data
            if(empty($data['title'])){
                $data['title_err'] = 'הכנס כותרת';
            }    

            if(empty($data['target_amount'])){
                $data['target_amount_err'] = 'הכנס סכום יעד';
                
            } else {
                if(!is_numeric($data['target_amount'])){
                    $data['target_amount_err'] = ' הכנס מספרים בלבד ';
                }
            }
            
             if(empty($data['title_err']) && empty( $data['target_amount_err'])){
                    // Validated
                            if($this->fixTransactionModel->addNewSave($data)){
                                flash('transaction_added', 'חיסכון חדש נוצר' );
                                redirect('fixTransactions');
                            } else {
                                die('יש בעיה');
                            }
                }else {
                    // Load view with errors
                    $this->view('fixTransactions/addSave', $data);
                }

            // Make sure no errors
        } else {

            $data =[
                
                'title' => '',
                'target_amount' => ''
                
                
            ];
            
            $this->view('fixTransactions/addSave', $data);
        }// end else
    }

    public function editFixTransaction($id) {

        $saves = $this->fixTransactionModel->getSavesAllData();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
          
            $data =[
                'id' => $id, 
                'title' => trim($_POST['title']),
                'type' => trim($_POST['type']),
                'target_saving' => trim($_POST['target_saving']),
                'created_at' => trim($_POST['created_at']),
                'comment' => trim($_POST['comment']),
                'amount' => trim($_POST['amount']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'target_saving_err' =>'',
                'created_at_err' => '',
                'amount_arr' => '',
                'saves' => $saves
            ];

            // Validate data
            if(empty($data['title'])){
                $data['title_err'] = 'הכנס כותרת';
            }

            if(empty($data['published_at'])){
                $data['published_at_err'] = 'בחר תאריך';
            }

            if(($data['type']=='הוספה לחיסכון')){
                if(empty($data['target_saving'])){
                    $data['target_saving_err'] = 'בחר חיסכון ';
                    
                }
            }

            if(empty($data['amount'])){
                $data['amount_err'] = 'הכנס סכום';
                
            } else {
                if(!is_numeric($data['amount'])){
                    $data['amount_err'] = ' הכנס מספרים בלבד ';
                }
            }
            if($data['type'] != 'הוספה לחיסכון') {
                $data['target_saving'] = 0;
            }
            
        // Make sure no errors
        if(empty($data['title_err']) && empty( $data['amount_err']) && empty($data['created_at_err']) && empty($data['target_saving_err'])){
            // Validated
                if($this->fixTransactionModel->updateFixTransaction($data)){
                    flash('transaction_edited', 'עודכן בהצלחה' );
                    redirect('FixTransactions/show/'.$id);
                } else {
                    die('יש בעיה');
                }
            } else {
                // Load view with errors
                $this->view('FixTransactions/editFixTransaction', $data);
            }
              

        } else {
            // Get exiting transaction from model
            $transaction = $this->fixTransactionModel->getTransactionById($id);
            // Check for owner
            if($transaction->user_id != $_SESSION['user_id']) {
                redirect('fixTransactions/index');
            }

            $data =[
                'id' => $id,
                'title' => $transaction->title,
                'type' => $transaction->type,
                'created_at' => $transaction->created_at,
                'target_saving' => $transaction->target_saving,
                'amount' => $transaction->amount ,
                'comment' => $transaction->comment
                ,'saves' => $saves
                
            ];
            
            $this->view('fixTransactions/editFixTransaction', $data);
        }// end else
    }

    public function editSave($id) {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
          
            $data =[
                'id' => $id,
                'title' => trim($_POST['title']),
                'target_amount' => trim($_POST['target_amount']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'target_amount_err' => ''
                
            ];

            // Validate data
            if(empty($data['title'])){
                $data['title_err'] = 'הכנס כותרת';
            }    

            if(empty($data['target_amount'])){
                $data['target_amount_err'] = 'הכנס סכום ליעד';
                
            } else {
                if(!is_numeric($data['target_amount'])){
                    $data['target_amount_err'] = ' הכנס מספרים בלבד ';
                }
            }
            

            
                // Make sure no errors
            if(empty($data['title_err']) && empty( $data['target_amount_err'])){
                // Validated
                    if($this->fixTransactionModel->updateSave($data)){
                        flash('transaction_added', 'עודכן בהצלחה' );
                       redirect('fixTransactions/showSave'.$id);
                    } else {
                        die('יש בעיה');
                    }
                } else {
                    // Load view with errors
                    $this->view('fixTransactions/editSave', $data);
                }
                

        } else {
            // Get exiting transaction from model
            $save = $this->fixTransactionModel->getSavesById($id);
            // Check for owner
            if($save->user_id != $_SESSION['user_id']) {
                redirect('fixTransactions/index');
            }

            $data =[
                'id' => $id,
                'title' => $save->title,
                'target_amount' => $save->target_amount 
                
                
            ];
            
            $this->view('fixTransactions/editSave', $data);
        }// end else
    }

    public function show($id) {
       
        $transaction = $this->fixTransactionModel->getTransactionById($id);
        $user = $this->userModel->getUserById($transaction->user_id);

        if($transaction->target_saving != 0){
            $save = $this->fixTransactionModel->getSavesById($transaction->target_saving);
        } else {$save ='';}

        $data = [
            'transaction' => $transaction,
            'user' => $user,
            'save' => $save 
            
        ];
        $this->view('fixTransactions/show', $data);
       
    }

    public function showSave($id) {
        
        $save = $this->fixTransactionModel->getSaveById($id);
        $user = $this->userModel->getUserById($save->user_id);
        $data = [

            'save' => $save,
            'user' => $user 
           
        ];
        $this->view('fixTransactions/showSave', $data);
       
    }
    public function showWeeklyBudgetThreshold() {
        
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $data = [
            'id' => $user->id,
            'weekly_budget_threshold' => $user->weekly_budget_threshold,
            'weekly_budget_threshold_err' 
           
        ];
        $this->view('fixTransactions/weeklyBudgetThreshold', $data);
      
    }
    
    public function delete($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get exiting transaction from model
            $transaction = $this->fixTransactionModel->getTransactionById($id);
            // Check for owner
            if($transaction->user_id != $_SESSION['user_id']) {
                redirect('fixTransactions');
            }
            if($this->fixTransactionModel->deleteFixTransaction($id)) {
                flash('transaction_added', 'נמחק בהצלחה' );
                redirect('fixTransactions');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('fixTransactions');
        }
    }

    public function closeSave($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get exiting transaction from model
            $dateNow=date('Y-m-d G:i', strtotime('now'));
          
            $save = $this->fixTransactionModel->getSavesById($id);
            // Check for owner
            if($save->user_id != $_SESSION['user_id']) {
                redirect('fixTransactions');
            }
            if($save->current_amount==0){
            }else{$this->fixTransactionModel->addAmountSaveTransaction($save,$dateNow);}
            
            

            if($this->fixTransactionModel->deleteSave($id)) {
                //Delete all fixTransactions for that save
                $this->fixTransactionModel->deleteFixtransactionsBySaveID($id);
                flash('transaction_added', 'חיסכון נסגר והתווסף להכנסות' );
                redirect('fixTransactions');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('fixTransactions');
        }
    }


    public function weeklyBudgetThreshold($id) {
       
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
          
            $data =[
            'id' => $id,
            'weekly_budget_threshold' => trim($_POST['weekly_budget_threshold']),
            
            
            'weekly_budget_threshold_err' => ''
            
            ];

            // Validate data
         
        
               // Validate Phone number

            if($data['weekly_budget_threshold']!=0){
                if(empty($data['weekly_budget_threshold'])){
                    $data['weekly_budget_threshold_err'] = 'הכנס סכום להגבלה';
                   } elseif(!is_numeric($data['weekly_budget_threshold'])){
                    $data['weekly_budget_threshold_err'] = 'הקלד מספרים בלבד';
                   }elseif($data['weekly_budget_threshold']<100){
                    $data['weekly_budget_threshold_err'] = 'הכנס מספר גדול מ100';
                   }
            
            }
               
            

            // Make sure no errors
            if(empty($data['weekly_budget_threshold_err']) ){
            // Validated
                if($this->fixTransactionModel->setSettingWeeklyBudget($data)){
                    flash('transaction_added', 'הגבלת תקציב עודכנה בהצלחה' );
                    redirect('fixTransactions');
                } else {
                    die('יש בעיה');
                }
            } else {
                // Load view with errors
                
                $this->view('fixTransactions/weeklyBudgetThreshold', $data);
            }

        } else {
            // Get exiting transaction from model
            $user = $this->userModel->getUserById($id);
            // Check for owner
            if($user->id != $_SESSION['user_id'] ) {
                
                redirect('fixTransactions');
            }

            $data =[
                'id' => $id,
                'weekly_budget_threshold' => $user->weeklyBudgetThreshold
            ];
            
            $this->view('fixTransactions/weeklyBudgetThreshold', $data);
        }// end else
    }
/*
    public function confirmsFixedExpenses($FixedExpenseId) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get exiting transaction from model
           // $fixedExpenses = $this->fixTransactionModel->getFixedExpensesTransactions();
            // Check for owner
            $this->fixTransactionModel->addFixTransactionToTransactions($fixTransaction);
            if($this->fixTransactionModel->deleteSave($id)) {
                flash('transaction_added', 'הוצאות אושרו בהצלחה' );
                redirect('fixTransactions');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('fixTransactions');
        }
    }
*/
   

 }