<?php
 class SummaryReports extends Controller {
    public function __construct() 
    {
        if(!isLoggedIn()) {
          redirect('/users/login');  
        }
        
        $this->transactionModel = $this->model('transaction');
        $this->userModel = $this->model('User');
        $this->summaryReportsModel = $this->model('SummaryReport');
    }

    public function index() {

        $this->view('summaryReports/index');
    }
    
    // Get Summary Reports
    public function getSummaryReports() {

        

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
          

            $data =[
                'year' => trim($_POST['year']),
                'month' => trim($_POST['month']),
                'year_err' => '',
                'month_err' => ''
            ];

            if(empty($data['year'])){
                $data['year_err'] = 'בחר שנה';
            }
            if(empty($data['month'])){
                $data['month_err'] = 'בחר חודש';
            }

            
            if(empty($data['year_err']) && empty($data['month_err'])){
                $year =trim($_POST['year']);
                $month = trim($_POST['month']);
                $from_date =$this->summaryReportsModel->startDate($year,$month);
                $to_date = $this->summaryReportsModel->endDate($year,$month);
                
                $sum_expenses = $this->transactionModel->getSumExpenses($from_date,$to_date);
                $sum_revenues = $this->transactionModel->getSumRevenue($from_date,$to_date);
                $balance = $sum_revenues->sum_revenue-$sum_expenses->sum_expenses;

                $data =[
            
                     'sum_expenses'=> $sum_expenses,
                     'sum_revenues' => $sum_revenues,
                     'balance' => $balance,
                    'yearAndMonth' => $from_date,
                    'from_date' => $from_date,
                    'to_date' => $to_date
                    
                ];
               
                $this->view('summaryReports/showSummaryReports', $data);
            } else {

                $this->view('summaryReports/index', $data);
            }
        // Make sure no errors
        
                
            
              

        } else {
            // Get exiting transaction from model
            $data =[
                'year' => '',
                'month' => '',
                'year_err' => '',
                'month_err' => ''
            ];
           
            
            $this->view('summaryReports/index', $data);
        }// end else

  

    }
   
    // Show Summery By Date
    public function show($month, $year,$id) {
        //$fixTransaction = $this->fixTransactionModel->getTransactionById($id);
        
        
        
        $transaction = $this->transactionModel->getTransactionById($id);
      //  $user = $this->summaryReportsModel->;
        $data = [

            'transaction' => $transaction
            //,'fixTransaction' =>$fixTransaction
        ];
        $this->view('transactions/show', $data);
        //$this->view('fixes_and_saves/index', $data);
    }
 }