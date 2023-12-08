<?php

class Reports extends Controller
{
    

    public function __construct()
    {
        if(!isLoggedIn()) {
            redirect('/users/login');  
          }
          $this->reportModel = $this->model('Report');
       
       
        
    }

    public function index() {

        $reports = $this->reportModel->getReports();

        $data =[
            
            'reports' => $reports


        ];

        $this->view('reports/index', $data);
        
        
       
    }

    public function reporting() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

            $data =[
                'title' => trim($_POST['title']),
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'description' => trim($_POST['description']),
                'title_err' => '',
                'name_err' =>'',
                'email_err' => '',
                'description_err' => ''
            ];

            // Validate data
            if(empty($data['title'])){
                $data['title_err'] = 'הכנס כותרת';
            }

            if(empty($data['name'])){
                $data['name_err'] = 'הזן שם ';
            }

            if(empty($data['email'])){
                $data['email_err'] = 'הזן מייל ';
            }
            
            if(empty($data['description'])){
                $data['description_err'] = 'הזן מלל ';
            }
            
            // Make sure no errors
            if(empty($data['title_err']) && empty( $data['name_err']) && empty($data['email_err']) && empty($data['description_err'])){
            // Validated
                if($this->reportModel->addReport($data)){

                    flash('report', 'דיווח נישלח בהצלחה' );
                    redirect('pages/about');
                } else {
                    die('יש בעיה');
                }
            } else {
                // Load view with errors
                $this->view('reports/reporting', $data);
            }

        } else {

            $data =[
                
                'title' => '',
                'name' => '',
                'email' => '',
                'description' =>''
            ];
            
            $this->view('reports/reporting', $data);
        }// end else
    }

    public function showReport($id) {
        
        $report = $this->reportModel->getReportById($id);
        
        $data = [

            'report' => $report
        ];
        $this->view('reports/showReport', $data);
        
    }
    
    public function delete($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Check for owner
            
            if($this->reportModel->deleteReport($id)) {
                
                flash('report_updated', 'דיווח נמחק בהצלחה' );
                redirect('reports');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('reports');
        }
    }
}













