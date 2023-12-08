<?php
  class Pages extends Controller {
    public function __construct(){
      //$this->transactionModel = $this->model('Transaction');
    }
    
    public function index(){
      //$transactions  = $this->transactionModel->getTransactions();
      if(isLoggedIn()){
        redirect('transactions?to_date='.date('Y-m-d', strtotime('last day of this month')).'&from_date='.date('Y-m-d', strtotime('first day of this month')));
      }

      $data = [
        'title' => 'ברוכים הבאים למערכת ניהול משק הבית' ,
        'description' => 'simple social network built on the MVC'
        
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us' ,
        'description' => 'אפליקציה לניהול משק בית חכם'
      ];

      $this->view('pages/about', $data);
    }
  }