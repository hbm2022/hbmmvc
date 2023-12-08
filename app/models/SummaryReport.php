<?php
  class SummaryReport {
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function startDate($year,$month) {
      
      $result1 = strtotime("{$year}-{$month}-1");
      
      return date('Y-m-d H:i:s', $result1);
            
    }

    public function endDate($year,$month) {
      
      $day   = date('d', strtotime('last day of '.$year.'-'.$month));
      
      $result1 = strtotime("{$year}-{$month}-{$day}");
      $newDate = strtotime('-1 second', strtotime('+1 day', $result1));
        
      return date('Y-m-d H:i:s', $newDate);
            
    }

    



























    
    public function getFixedExpensesTransactions(){
      $this->db->query('SELECT * 
      FROM tbltransactions
      WHERE tbltransactions.user_id = :user_id AND (type = "הוספה לחיסכון" OR type ="הוצאה קבועה")');
      $this->db->bind(':user_id', $_SESSION['user_id']);
      
      return $this->db->resultSet();
    }

    public function getFixedRevenuesTransactions(){
      $this->db->query('SELECT * 
      FROM tbltransactions
      WHERE tbltransactions.user_id = :user_id AND tbltransactions.type = "הכנסה קבועה"');
      $this->db->bind(':user_id', $_SESSION['user_id']);
      
      return $this->db->resultSet();
    }

   
    public function addFixTransaction($data){
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

    public function getSaveById($id) {
      $this->db->query('SELECT * FROM tblsaves WHERE id= :id');
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

    // Saves Saves Saves

    public function addNewSave($data) {
      $this->db->query('INSERT INTO tblsaves (title, target_amount, user_id) 
      VALUES(:title, :target_amount, :user_id)');
      // Bind values
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':target_amount', $data['target_amount']);
      $this->db->bind(':user_id', $data['user_id']);
      

      // Execute
      if($this->db->execute()){
      return true;
      } else {return false;}
    }

    // Edit Save
    public function updateSave($data) {
      $this->db->query('UPDATE tblsaves 
                        SET title = :title, target_amount = :target_amount 
                        WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':target_amount', $data['target_amount']);
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }

    public function getSaves() {
      $this->db->query('SELECT * ,tblsaves.title AS nameSave FROM tblsaves WHERE tblsaves.user_id = :user_id');

      $this->db->bind(':user_id', $_SESSION['user_id']);
      
      return $this->db->resultSet();
    }
    
    public function getSavesById($id) {
      $this->db->query('SELECT * FROM tblsaves WHERE id= :id');
      $this->db->bind(':id', $id);

      $row =$this->db->single();

      return $row;
    }

    public function calculateSumForSave() {

    }
    public function deleteSave($id) {
      $this->db->query('DELETE FROM tblsaves 
                           WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $id);
      
          // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }
    public function createNewFixTransaction($data) {
      $dateForFixTransaction = new DateTime($data->published_at);
      date_add($dateForFixTransaction,date_interval_create_from_date_string("1 month"));
      echo date_format($dateForFixTransaction,"Y-m-d");

      //bool
      var_dump(checkdate(2,29,2003));
    }
  }

  