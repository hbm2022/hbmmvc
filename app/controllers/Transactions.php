<?php
 class Transactions extends Controller {
    public function __construct() 
    {
        if(!isLoggedIn()) {
          redirect('/users/login');  
        }
        
        $this->transactionModel = $this->model('Transaction');
        $this->userModel = $this->model('User');
        $this->fixTransactionModel = $this->model('FixTransaction');
        
    }

    public function index() {
        // Get transactions by date
        
        if(isset($_GET['from_date']) && isset($_GET['to_date'])) {
            
            $from_date = $_GET['from_date'];
            $to_date = $this->transactionModel->fullEndDate($_GET['to_date']);
           

        } 
        // Checked fixTransactions if has existing in transaction table
           
          $start_current_month = date('Y-m-d', strtotime('first day of this month'));
          $end_current_month = $this->transactionModel->fullEndDate(date('Y-m-d', strtotime('last day of this month')));
            foreach($this->fixTransactionModel->getAllFixedTransactions($start_current_month,$end_current_month) as $fixTransaction ):
               
                foreach($this->transactionModel->getTransactions($start_current_month,$end_current_month) as $check_transaction) :
                  
                    if($check_transaction->fixtransaction_id == $fixTransaction->id ) { 
                       
                        break;
                     }
                     else {
                        
                        $this->fixTransactionModel->addFixTransactionToTransactions($fixTransaction);
                        $newDate = strtotime( "+1 month", strtotime( $fixTransaction->next_published ) );
                        flash('transaction_added', 'תנועה נוצרה' );
                        $newPublished= date('Y-m-d H:i:s', $newDate).'<br>';
                        $this->fixTransactionModel->markFixTransactionAsExisting($fixTransaction->id,$newPublished);
                        break;
                     }
                    
                endforeach;
             
             endforeach;
        // END
        
        // Get Budget between this week

        $day = date('w');
        $week_start = date('Y-m-d 00:00:00', strtotime('-'.$day.' days'));
        $week_end = $this->transactionModel->fullEndDate(date('Y-m-d H:i:s', strtotime('+'.(6-$day).' days')));
            $thisWeek =[$week_end,$week_start]; 
         $weekly_budget = $this->fixTransactionModel->getWeeklyBudget();
         if($weekly_budget->budget==0) {
            $precent_budget_this_week=0;
            $budget_balance=0;
         }else {
            $budgetThisWeek = $this->transactionModel->checkBudgetByWeek($week_start, $week_end);
         
            $precent_budget_this_week = ($budgetThisWeek->sum_expenses*100)/$weekly_budget->budget;
            $budget_balance = $weekly_budget->budget-$budgetThisWeek->sum_expenses;

         }

        

        //END
        $transactions = $this->transactionModel->getTransactions($from_date,$to_date);
       

        $sum_expenses = $this->transactionModel->getSumExpenses($from_date,$to_date);
        $sum_revenues = $this->transactionModel->getSumRevenue($from_date,$to_date);
        $balance = $sum_revenues->sum_revenue-$sum_expenses->sum_expenses;
        $this->transactionModel->setCalculateSum($sum_revenues->sum_revenue,$sum_expenses->sum_expenses,$balance);
        

        $date = $this->userModel->getDate();
       
        
        $data =[
            'budget_balance' => $budget_balance,
            'precent_budget_this_week' => $precent_budget_this_week,
          
            'transactions' => $transactions,
            'sum_expenses'=> $sum_expenses,
            'sum_revenues' => $sum_revenues,
            'balance' => $balance,
            'date' => $date


        ];


        
        if( !(empty($data['transactions']))){
                   
            $this->view('transactions/index', $data);
            
        } else {
            flash('transaction_empty', ' אין תנועות רשומות' );
            $this->view('transactions/index', $data);
          
           
        }
       


        
    }

    public function add() {
       
        
        $saves = $this->fixTransactionModel->getSavesAllData();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

            $data =[
                'title' => trim($_POST['title']),
                'type' => trim($_POST['type']),
                'target_saving' => trim($_POST['target_saving']),
                'published_at' => trim($_POST['published_at']),
                'comment' => trim($_POST['comment']),
                'amount' => trim($_POST['amount']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'target_saving_err' =>'',
                'published_at_err' => '',
                'amount_err' => '',
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
            
            // Make sure no errors
            if(empty($data['title_err']) && empty( $data['amount_err']) && empty($data['published_at_err']) && empty($data['target_saving_err'])){
            // Validated
                if($this->transactionModel->addTransaction($data)){

                    flash('transaction_added', 'תנועה נוצרה' );
                   
                    redirect('transactions?to_date='.date('Y-m-d', strtotime('last day of this month')).'&from_date='.date('Y-m-d', strtotime('first day of this month')));
                 
                } else {
                    die('יש בעיה');
                }
            } else {
                // Load view with errors
                $this->view('transactions/add', $data);
            }

        } else {

            $data =[
                'published_at' => '',
                'type' => '',
                'target_saving' => '',
                'title' => '',
                'comment' => '',
                'amount' => ''
                ,'saves' => $saves
            ];
            
            $this->view('transactions/add', $data);
        }// end else
    }

    public function edit($id) {
        $saves = $this->fixTransactionModel->getSavesAllData();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
          
            $data =[
                'id' => $id,
                'title' => trim($_POST['title']), 
                'type' => trim($_POST['type']),
                'target_saving' => trim($_POST['target_saving']),
                'published_at' => trim($_POST['published_at']),
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
            

            // Make sure no errors
            if(empty($data['title_err']) && empty( $data['amount_err']) && empty($data['published_at_err']) && empty($data['target_saving_err'])){
            // Validated
                if($this->transactionModel->updateTransaction($data)){
                    flash('transaction_edited', 'עודכן בהצלחה' );
                    redirect('transactions/show/'.$id);
                } else {
                    die('יש בעיה');
                }
            } else {
                // Load view with errors
                $this->view('transactions/edit', $data);
            }

        } else {
            // Get exiting transaction from model
            $transaction = $this->transactionModel->getTransactionById($id);
            // Check for owner
            if($transaction->user_id != $_SESSION['user_id']) {
                redirect('transactions');
            }

            $data =[
                'id' => $id,
                'title' => $transaction->title,
                'type' => $transaction->type,
                'published_at' => $transaction->published_at,
                'target_saving' => $transaction->target_saving,
                'amount' => $transaction->amount ,
                'comment' => $transaction->comment
                ,'saves' => $saves
            ];
            
            $this->view('transactions/edit', $data);
        }// end else
    }

    public function show($id) {
        
        $transaction = $this->transactionModel->getTransactionById($id);
        $user = $this->userModel->getUserById($transaction->user_id);

        if($transaction->target_saving != 0){
            $save = $this->fixTransactionModel->getSavesById($transaction->target_saving);
        } else {$save ='';}

        $data = [
            'transaction' => $transaction,
            'user' => $user,
            'save' => $save  
        ];
        $this->view('transactions/show', $data);
    }
    
    public function delete($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get exiting transaction from model
            $transaction = $this->transactionModel->getTransactionById($id);
            // Check for owner
            if($transaction->user_id != $_SESSION['user_id']) {
                redirect('transactions');
            }
            if($this->transactionModel->deleteTransaction($id)) {
                
                flash('transaction_added', 'נמחק בהצלחה' );
                redirect('transactions?to_date='.date('Y-m-d', strtotime('last day of this month')).'&from_date='.date('Y-m-d', strtotime('first day of this month')));
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('transactions?to_date='.date('Y-m-d', strtotime('last day of this month')).'&from_date='.date('Y-m-d', strtotime('first day of this month')));
        }
    }
 }