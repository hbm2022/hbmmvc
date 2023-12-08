<?php
  class FixTransaction {
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

//fixtransactionsforusers
    public function getFixedExpensesTransactions(){
      $this->db->query('SELECT * 
      FROM tblfixedtransactions
      WHERE tblfixedtransactions.user_id = :user_id AND (type = "הוספה לחיסכון" OR type ="הוצאה קבועה")');
      $this->db->bind(':user_id', $_SESSION['user_id']);
      
      return $this->db->resultSet();
    }

    public function getFixedRevenuesTransactions(){
      $this->db->query('SELECT * 
      FROM tblfixedtransactions
      WHERE tblfixedtransactions.user_id = :user_id AND tblfixedtransactions.type = "הכנסה קבועה"');
      $this->db->bind(':user_id', $_SESSION['user_id']);
      
      return $this->db->resultSet();
    }

    public function getAllFixedTransactions($start_current_month,$end_current_month){
      $this->db->query('SELECT * 
      FROM tblfixedtransactions
      WHERE tblfixedtransactions.user_id = :user_id AND next_published BETWEEN :from_date AND :to_date');
      
      $this->db->bind(':from_date', $start_current_month);
      $this->db->bind(':to_date', $end_current_month);
      $this->db->bind(':user_id', $_SESSION['user_id']);
      
      return $this->db->resultSet();
    }
   
    public function addFixTransaction($data){
      $this->db->query('INSERT INTO tblfixedtransactions (title, type, created_at, comment ,amount, user_id, target_saving ,next_published) 
                        VALUES(:title, :type, :created_at, :comment, :amount, :user_id, :target_saving ,:created_at )');
      // Bind values
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':type', $data['type']);
      $this->db->bind(':created_at', $data['created_at']);
      $this->db->bind(':comment', $data['comment']);
      $this->db->bind(':amount', $data['amount']);
      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':target_saving', $data['target_saving']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }
    
    public function addFixTransactionToTransactions($fixTransaction){
      $this->db->query('INSERT INTO tbltransactions (title, type, published_at, comment ,amount, user_id, target_saving, fixtransaction_id ) 
                        VALUES(:title, :type, :published_at, :comment, :amount, :user_id, :target_saving, :fix_transaction_id )');
      // Bind values
      $this->db->bind(':title', $fixTransaction->title);
      $this->db->bind(':type', $fixTransaction->type);
      $this->db->bind(':published_at', $fixTransaction->next_published);
      $this->db->bind(':comment', $fixTransaction->comment);
      $this->db->bind(':amount', $fixTransaction->amount);
      $this->db->bind(':user_id', $fixTransaction->user_id);
      $this->db->bind(':target_saving', $fixTransaction->target_saving);

      $this->db->bind(':fix_transaction_id', $fixTransaction->id);


      // Execute 
      if($this->db->execute()){
        return true;
      } else {return false;}
    
    }
    
    // After added FixTransaction To Transactions table 
    // change the date of next published to next month 
    public function markFixTransactionAsExisting($id, $next_month){
      $this->db->query('UPDATE tblfixedtransactions 
                        SET 
                             next_published = :next_published
                        WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);
      
      $this->db->bind(':next_published', $next_month);
      
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }

    public function updateFixTransaction($data){
      $this->db->query('UPDATE tblfixedtransactions 
                        SET title = :title, comment = :comment, amount = :amount,
                            type = :type, next_published = :next_published, target_saving = :target_saving
                        WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':type', $data['type']);
      $this->db->bind(':next_published', $data['next_published']);
      $this->db->bind(':comment', $data['comment']);
      $this->db->bind(':amount', $data['amount']);
      $this->db->bind(':target_saving', $data['target_saving']);

      

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }

    public function getTransactionById($id) {
      $this->db->query('SELECT * FROM tblfixedtransactions WHERE id= :id');
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

    public function getSaveId(){
      $this->db->query('SELECT id 
      FROM tblsaves
      WHERE tblsaves.user_id = :user_id ');
      
      $this->db->bind(':user_id', $_SESSION['user_id']);
      
      return $this->db->resultSet();
    }
    public function deleteFixTransaction($id) {
      $this->db->query('DELETE FROM tblfixedtransactions 
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

    public function getSavesAllData() {
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

    public function calculatingSaveSum($save_id) {
      $this->db->query('UPDATE tblsaves 
                        SET tblsaves.current_amount =(SELECT SUM(transactions.amount) as sumSave
                        FROM tbltransactions as transactions
                        WHERE  transactions.target_saving= :save_id
                        )
                        WHERE id = :save_id');
      // Bind values
      $this->db->bind(':save_id', $save_id);
      //$this->db->bind(':user_id',$_SESSION['user_id'] );
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }
    public function addAmountSaveTransaction($save,$dateNow){
      $this->db->query('INSERT INTO tbltransactions (title, type, published_at, comment ,amount, user_id ) 
                        VALUES(:title, :type, :published_at, :comment, :amount, :user_id )');
      // Bind values
      $this->db->bind(':title', $save->title);
      $this->db->bind(':type', 'קיפול חיסכון');
      $this->db->bind(':published_at',$dateNow);
      $this->db->bind(':comment', $save->target_amount.' יעד');
      $this->db->bind(':amount', $save->current_amount);
      $this->db->bind(':user_id', $save->user_id);
      

      


      // Execute 
      if($this->db->execute()){
        return true;
      } else {return false;}
    
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
    
    public function deleteFixtransactionsBySaveID($id) {
      $this->db->query('DELETE FROM tblfixedtransactions 
                           WHERE target_saving  = :target_save_id');
      // Bind value
      $this->db->bind(':target_save_id', $id);
      
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

    public function setSettingWeeklyBudget($data)
    {
      $this->db->query('UPDATE tblusers 
                        SET weekly_budget_threshold =:weekly_budget_threshold
                        WHERE id = :user_id');
      // Bind values
      $this->db->bind(':weekly_budget_threshold',$data['weekly_budget_threshold'] );
      $this->db->bind(':user_id',$data['id'] );
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }

    public function getWeeklyBudget() {
      $this->db->query('SELECT weekly_budget_threshold as budget FROM tblusers WHERE id= :user_id');
      $this->db->bind(':user_id',$_SESSION['user_id'] );

      $row =$this->db->single();

      return $row;
    }
    
  }

  