<?php
  class Report {
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function getReports(){
      $this->db->query('SELECT * 
                        FROM tblreports
                        ' );
      
      
      // Between dates
      
      return $this->db->resultSet();
      
      
    }

    public function addReport($data){
      $this->db->query('INSERT INTO tblreports (title, name, email, description ) 
                        VALUES(:title, :name, :email, :description)');
      // Bind values
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':description', $data['description']);
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }

   

    
    public function getReportById($id) {
      $this->db->query('SELECT * 
                        FROM tblreports 
                        WHERE id= :id');
      $this->db->bind(':id', $id);

      $row =$this->db->single();

      return $row;
    }

    public function deleteReport($id) {
      $this->db->query('DELETE FROM tblreports 
                           WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $id);
      
          // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }
  }