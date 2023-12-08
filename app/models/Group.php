<?php
  class Group {
    private $db;


    public function __construct()
    {
        $this->db = new Database;
        
    }

    public function getNameGroup() {
      $this->db->query('SELECT tblgroups.nickname ,tblgroups.type , tblgroups.id
      FROM tblgroups
      INNER JOIN tblusers on tblgroups.id = tblusers.group_id 
      WHERE tblusers.id = :user_id ');
      // Bind value
      $this->db->bind(':user_id', $_SESSION['user_id']);
      

      //return $this->db->resultSet();
      return $this->db->single();
    } 
    
    // Get group included from user
    public function getGroupIncluded() {
      $this->db->query('SELECT group_id 
      FROM tblusers
      WHERE id = :user_id ');
      // Bind value
      $this->db->bind(':user_id', $_SESSION['user_id']);

      

      return $this->db->single();
    
    }
    
    // Get Data Users
    public function getSumForGroup() {//דרשו צמצום ודיוק
      $this->db->query('SELECT  *      
      FROM tblusers 
      WHERE tblusers.group_id=:group_id   
      ');
     
    
    
      //$this->db->bind(':user_id', $_SESSION['user_id']);
      $this->db->bind(':group_id', $_SESSION['group_id']);
      return $this->db->resultSet();
    

    } 

    // Get users for group
    public function getUsersGroup() {
      $this->db->query('SELECT * ,  tblusers.id as user_data_id
      FROM tblgroups
      INNER JOIN tblusers on tblgroups.manager_id = tblusers.group_id
      WHERE tblusers.group_id = :group_id
      GROUP BY user_data_id ');
      // Bind value
      $this->db->bind(':group_id', $_SESSION['group_id']);

      return $this->db->resultSet();
    }
    
    // Get Expenses for GROUP
    public function getExpensesForGroup() {
      $this->db->query('SELECT  SUM(tbltransactions.amount) AS expenses ,`first_name`,tblusers.`id`
      FROM tblusers 
      INNER JOIN tbltransactions on tblusers.id = tbltransactions.user_id
      WHERE tbltransactions.type IN ("הוצאה קבועה" , "הוספה לחיסכון" ,"הוצאה") AND tblusers.group_id=:group_id 
      
      GROUP BY tblusers.id;
       
      ');
      
      
      $this->db->bind(':group_id', $_SESSION['group_id']);
      return $this->db->resultSet();
      
     
    } 
    
    // Create Group
    public function createNewGroup($data) {
      $this->db->query('INSERT INTO tblgroups (nickname, type, manager_id) 
      VALUES(:nickname, :type, :manager_id)');
      // Bind values
      $this->db->bind(':nickname', $data['nickname']);
      $this->db->bind(':type', $data['type']);
      $this->db->bind(':manager_id', $data['user_id']);
      

      // Execute
      if($this->db->execute()){
      return true;
      } else {return false;}
    }

    // Edit Group
    public function updateGroup($data) {
      $this->db->query('UPDATE tblgroups 
                        SET nickname = :nickname, type = :type
                        WHERE id = :id');
      // Bind values
      $this->db->bind(':nickname', $data['nickname']);
      $this->db->bind(':type', $data['type']);
      $this->db->bind(':id', $data['id']);

      // Execute
      if($this->db->execute()){
      return true;
      } else {return false;}
    }
      // Activate group manager and change th type of user
    public function updateUserTypeAndGroup($userType,$newGroup) {
      $this->db->query('UPDATE tblusers 
                          SET type = :type , group_id = :new_group
                          WHERE id = :user_id');
        // Bind values
        
        $this->db->bind(':type', $userType);
        $this->db->bind(':new_group', $newGroup);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        

        

        // Execute
        if($this->db->execute()){
          return true;
        } else {return false;}
    }

    public function getGroupById($id) {
      $this->db->query('SELECT * FROM tblgroups WHERE id= :id');
      $this->db->bind(':id', $id);

      $row =$this->db->single();

      return $row;
    }
    // Activate group manager 
    public function getNewGroup($data) {
      $this->db->query('SELECT tblgroups.id AS new_group
      FROM tblusers AS user
      INNER JOIN tblgroups ON user.id = tblgroups.manager_id
      WHERE user.id = :user_id ');

      $this->db->bind(':user_id', $data['user_id']);

      $row = $this->db->single();
      
      return $row;

    }
     // Change User Type
     public function changUserType($userType) {
      $this->db->query('UPDATE tblusers 
                          SET type = :type
                          WHERE id = :user_id');
        // Bind values
        
        $this->db->bind(':type', $userType);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        
        // Execute
        if($this->db->execute()){
          return true;
        } else {return false;}

     }

     // Get User Type
     public function getUserType() {
      $this->db->query('SELECT `type` , id
                        FROM tblusers
                        WHERE id = :user_id ');

      $this->db->bind(':user_id', $_SESSION['user_id']);

      $row = $this->db->single();
      
      return $row;
     }
     // Find if have a request 
     public function chekIfHaveReq() {
      $t='waiting_to_confirmed';
      $this->db->query('SELECT *, tblusers.id as user_data_id ,tblusers.type
      FROM tblgroups
      right JOIN tblusers on tblgroups.manager_id = tblusers.group_id
      WHERE tblusers.group_id = :group_id AND tblusers.type = :type
      GROUP BY user_data_id ');
      // Bind value
      $this->db->bind(':type', $t);
      $this->db->bind(':group_id', $_SESSION['group_id']);
      
      $row = $this->db->resultSet();
      // Check row 
      if($this->db->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
     } 
     // // Find user in group by ID
     public function getfrinedGroupById($id) {
      $this->db->query('SELECT * FROM tblusers WHERE id= :id');
      $this->db->bind(':id', $id);

      $row =$this->db->single();

      return $row;
     }

     // Confirmation Joining Request
     public function confirmationJoiningRequest($id,$userType) {
      $this->db->query('UPDATE tblusers 
      SET type = :type
      WHERE id = :user_id');
      // Bind values

      $this->db->bind(':type', $userType);
      $this->db->bind(':user_id', $id);

      // Execute
      if($this->db->execute()){
      return true;
      } else {return false;}
     }

     // Rejection Joining Request and Leaving group
     public function rejectionJoiningRequest($id, $userType, $clearGroupId) {
      $this->db->query('UPDATE tblusers 
      SET type = :type , group_id = :clear_group_id
      WHERE id = :user_id');
      // Bind values
      $this->db->bind(':clear_group_id', $clearGroupId);
      $this->db->bind(':type', $userType);
      $this->db->bind(':user_id', $id);

      // Execute
      if($this->db->execute()){
      return true;
      } else {return false;}
     }
     // Insert to group
     public function updateJoinToGroup($userType, $data) {
      $this->db->query('UPDATE tblusers 
                          SET type = :type , group_id = :new_group
                          WHERE id = :user_id');
        // Bind values
        
        $this->db->bind(':type', $userType);
        $this->db->bind(':new_group', $data['group_id']);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        

        

        // Execute
        if($this->db->execute()){
          return true;
        } else {return false;}
     }

     // Find if the group exist by id
     public function CheckIfGroupExist($data){
      $this->db->query('SELECT * FROM tblgroups WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $data['group_id']);

      $row = $this->db->single();

      // Check row 
      if($this->db->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
     }
     
     public function getGroupIdById($group) {
      $this->db->query('SELECT id
                          FROM tblgroups
                          WHERE id = :group_id');
        // Bind values
        
        $this->db->bind(':group_id', $group);

        $row =$this->db->single();

        return $row;
    }
    public function deleteExistGroup($id) {
      $this->db->query('DELETE FROM tblgroups 
                           WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $id);
      
          // Execute
      if($this->db->execute()){
        return true;
      } else {return false;}
    }
     // Kick User from group
     public function updateAllUsers($id, $userType) {
      $this->db->query('UPDATE tblusers 
      SET type = :type , group_id = 0
      WHERE group_id = :group_id');
      // Bind values

      $this->db->bind(':type', $userType);
      $this->db->bind(':group_id', $id);

      // Execute
      if($this->db->execute()){
      return true;
      } else {return false;}
     }
     public function kickUser() {}

    // Confirmation of request to join the group
    
  }