<?php
  
     
  class User {
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    // Register user

    public function register($data) {
      $this->db->query('INSERT INTO tblusers (first_name, last_name, phone_number, email ,password)
                        VALUES(:first_name, :last_name, :phone, :email, :password)');
      // Bind values
      $this->db->bind(':first_name', $data['first_name']);
      $this->db->bind(':last_name', $data['last_name']);
      $this->db->bind(':phone', $data['phone']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }

    // Login User
    function login($email, $password) {
      $this->db->query('SELECT * FROM tblusers WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }

    // Find User by email
    public function findUserByEmail($email){
      $this->db->query('SELECT * FROM tblusers WHERE email = :email LIMIT 1');
      // Bind value
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      // Check row 
      if($this->db->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    
    }


    // Get User by ID
    public function getUserById($id){
      $this->db->query('SELECT * FROM tblusers WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }


    public function getDate() {
      
        $this->db->query('SELECT created_at
        FROM tblusers
        WHERE id = :id  ' );
        $this->db->bind(':id', $_SESSION['user_id']);
        
         $row = $this->db->single();
         return $row;
         
        
        
      }
    

    public function settingUpdated($data) {
      $this->db->query('UPDATE tblusers 
                        SET first_name = :first_name, last_name = :last_name, phone_number = :phone
                        WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':first_name', $data['first_name']);
      $this->db->bind(':last_name', $data['last_name']);
      $this->db->bind(':phone', $data['phone']);
      
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }

    // Get Hashed Password By ID
    function GetOldPass($id, $password) {
      $this->db->query('SELECT * FROM tblusers WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }

    // Changing new password
    public function passwordUpdated($data) {
      $this->db->query('UPDATE tblusers 
                        SET `password` = :password
                        WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':password', $data['new_password']);
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }
    
    
    
    public function createToken($data,$reset_token,$date) {
      $this->db->query('UPDATE tblusers 
                        SET reset_token = :reset_token, reset_token_exp = :date
                        WHERE email = :email');
      // Bind values
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':reset_token', $reset_token);
      $this->db->bind(':date', $date);
      
      
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }

    

    // After passwor for reset 
    public function resetPasswordUpdated($data, $token) {
      $this->db->query('UPDATE tblusers 
                        SET `password` = :password
                        WHERE email = :email AND reset_token = :token
                        ');
      // Bind values
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':token', $token);
      $this->db->bind(':password', $data['new_password']);
      
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }
    public function cleanToken($data) {
      $this->db->query('UPDATE tblusers 
                        SET `reset_token` = "" ,
                         `reset_token_exp` = "" 
                        WHERE email = :email 
                        ');
      // Bind values
      $this->db->bind(':email', $data['email']);
     
      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }
  }

