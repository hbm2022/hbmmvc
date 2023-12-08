<?php
  class Transaction {
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTransactions($from_date,$to_date){
      $this->db->query('SELECT * 
                        FROM tbltransactions
                        WHERE tbltransactions.user_id = :user_id 
                        AND published_at >= :from_date AND published_at <=:to_date 
                        
                        ORDER BY published_at DESC
                        ' );
      $this->db->bind(':user_id', $_SESSION['user_id']);
      
      // Between dates
      $this->db->bind(':from_date', $from_date);
      $this->db->bind(':to_date', $to_date);

      return $this->db->resultSet();
      
      
    }

    public function addTransaction($data){
      $this->db->query('INSERT INTO tbltransactions (title, type, published_at, comment ,amount, user_id, target_saving) 
                        VALUES(:title, :type, :published_at, :comment, :amount, :user_id, :target_saving)');
      // Bind values
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':type', $data['type']);
      $this->db->bind(':published_at', $data['published_at']);
      $this->db->bind(':comment', $data['comment']);
      $this->db->bind(':amount', $data['amount']);
      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':target_saving', $data['target_saving']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }

   

    public function getSumExpenses($from_date,$to_date) {
      $this->db->query('SELECT  IFNULL(SUM(amount), 0) AS sum_expenses
                        FROM tbltransactions 
                        WHERE tbltransactions.user_id = :user_id 
                        AND tbltransactions.type IN ("הוצאה קבועה" , "הוספה לחיסכון" ,"הוצאה")
                        AND published_at BETWEEN :from_date AND :to_date
      
      ');
      $this->db->bind(':from_date', $from_date);
      $this->db->bind(':to_date', $to_date);
      $row = $this->db->bind(':user_id', $_SESSION['user_id']);
      $row = $this->db->single();
      
      
        return $row ;
          
      
    }

    public function getSumRevenue($from_date,$to_date) {
      $this->db->query('SELECT  IFNULL(SUM(amount), 0) AS sum_revenue
                        FROM tbltransactions
                        WHERE tbltransactions.user_id = :user_id 
                        AND tbltransactions.type IN ("הכנסה קבועה" , "הכנסה", "קיפול חיסכון")
                        AND published_at BETWEEN :from_date AND :to_date 
      
      ');
      $this->db->bind(':from_date', $from_date);
      $this->db->bind(':to_date', $to_date);
      $this->db->bind(':user_id', $_SESSION['user_id']);
      
      
      return $this->db->single();
    }

   

    // Update table the all sum calculated
    public function setCalculateSum($revenues,$expenses, $balance) {
     
      $this->db->query('UPDATE tblusers 
      SET balance = :balance, sum_revenues = :revenues, sum_expenses = :expenses
      WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $_SESSION['user_id']);
      $this->db->bind(':balance', $balance);
      $this->db->bind(':revenues', $revenues);
      $this->db->bind(':expenses', $expenses);


      
      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
          
    }
    
    

    public function updateTransaction($data){
      $this->db->query('UPDATE tbltransactions 
                        SET title = :title, comment = :comment, amount = :amount,
                             type = :type, published_at = :published_at, target_saving = :target_saving
                        WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':type', $data['type']);
      $this->db->bind(':published_at', $data['published_at']);
      $this->db->bind(':comment', $data['comment']);
      $this->db->bind(':amount', $data['amount']);
      $this->db->bind(':target_saving', $data['target_saving']);
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }

    public function getTransactionById($id) {
      $this->db->query('SELECT * FROM tbltransactions WHERE id= :id');
      $this->db->bind(':id', $id);

      $row =$this->db->single();

      return $row;
    }

    public function deleteTransaction($id) {
      $this->db->query('DELETE FROM tbltransactions 
                           WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $id);
      
          // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }


    public function fullEndDate($date) {
      
      $day   = date('d', strtotime($date));
      $month  = date('m', strtotime($date));
      $year   = date('Y', strtotime($date));
      $result1 = strtotime("{$year}-{$month}-{$day}");
      $newDate = strtotime('-1 second', strtotime('+1 day', $result1));
        
      return date('Y-m-d H:i:s', $newDate);
            
    }
   
    // Check Budget By Week
    public function checkBudgetByWeek($from_date, $to_date) {
      $this->db->query('SELECT  IFNULL(SUM(amount), 0) AS sum_expenses
                        FROM tbltransactions 
                        WHERE tbltransactions.user_id = :user_id 
                        AND tbltransactions.type IN ("הוצאה")
                        AND published_at BETWEEN :from_date AND :to_date
      
      ');
      $this->db->bind(':from_date', $from_date);
      $this->db->bind(':to_date', $to_date);

     
      $row = $this->db->bind(':user_id', $_SESSION['user_id']);
      $row = $this->db->single();
      
      
        return $row ;
    }
  }