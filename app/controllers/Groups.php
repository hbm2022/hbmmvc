<?php

class Groups extends Controller
{
    

    public function __construct()
    {
        if(!isLoggedIn()) {
            redirect('/users/login');  
          }
          
        $this->transactionModel = $this->model('FixTransaction');
        $this->transactionModel = $this->model('Transaction');
        $this->userModel = $this->model('User');
        $this->groupModel = $this->model('Group');
    }

    public function index() {
        // Get Groups
        $usersGroup = $this->groupModel->getUsersGroup();
        $checkUserWithGroup = $this->groupModel->getGroupIncluded();
        $usersSumData = $this->groupModel->getSumForGroup();
        $group = $this->groupModel->getNameGroup();
        $userData = $this->groupModel->getUserType();
        $request = $this->groupModel->chekIfHaveReq();

        $data =[
            'groups' => $group,
            'userData' => $userData,
            'usersGroup' => $usersGroup,
            'usersSumData' => $usersSumData,
            'checkUserWithGroup' => $checkUserWithGroup,
            'request' => $request,
            'group_id' => ''

            
             
        ];

        $this->view('groups/index', $data);

        
        //$this->view('groups/index');
    }
    
    public function createGroup() {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
          
            $data =[
                'nickname' => trim($_POST['nickname']),
                'type' => trim($_POST['type']),
                'user_id' => $_SESSION['user_id'],
                'nickname_err' => '',
                'type_err' => ''
                
            ];

            // Validate data
            if(empty($data['nickname'])){
                $data['nickname_err'] = 'הכנס שם קבוצה/משפחה';
            }    
            if(empty($data['type'])){
                $data['type_err'] = 'בחר סוג';
            }    
            
             if(empty($data['type_err']) && empty( $data['nickname_err'])){
                    // Validated
                            if($this->groupModel->createNewGroup($data)){
                                // Activate group manager

                                $userType='high_user';
                                // Get the new created group
                                $newGroup =$this->groupModel->getNewGroup($data); 
                                $this->groupModel->updateUserTypeAndGroup($userType,$newGroup->new_group);

                                flash('group', 'קבוצה נוצרה בהצלחה' );
                                redirect('groups');
                            } else {
                                die('Error with create group');
                            }
                }else {
                    // Load view with errors
                    $this->view('groups/createGroup', $data);
                }

            // Make sure no errors
        } else {

            $data =[
                
                'nickname' => '',
                'type' => ''
                
                
            ];
            
            $this->view('groups/createGroup', $data);
        }// end else
    }

    public function editGroup($id) {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
          
            $data =[
                'id' => $id,
                'nickname' => trim($_POST['nickname']),
                'type' => trim($_POST['type']),
                'user_id' => $_SESSION['user_id'],
                'nickname_err' => '',
                'type_err' => ''
                
            ];

            // Validate data
            if(empty($data['nickname'])){
                $data['nickname_err'] = 'הכנס שם קבוצה/משפחה';
            }    
            if(empty($data['type'])){
                $data['type_err'] = 'בחר סוג';
            }  
            

            
                // Make sure no errors
            if(empty($data['type_err']) && empty( $data['nickname_err'])){
                // Validated
                    if($this->groupModel->updateGroup($data)){
                        flash('group', 'עודכן בהצלחה' );
                        redirect('groups/index');
                    } else {
                        die('יש בעיה');
                    }
                } else {
                    // Load view with errors
                    $this->view('groups/editGroup', $data);
                }
                

        } else {
            // Get exiting transaction from model
            $group = $this->groupModel->getGroupById($id);
            // Check for owner
            if($group->manager_id != $_SESSION['user_id']) {
                redirect('groups/index');
            }

            $data =[
                'id' => $id,
                'nickname' => $group->nickname,
                'type' => $group->type 
                
                
            ];
            
            $this->view('groups/editGroup', $data);
        }// end else
    }
    
    public function requestApproval($id) {
        $userType = 'low_user';
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get exiting transaction from model
            $frinedGroup = $this->groupModel->getfrinedGroupById($id);
            // Check for owner
            if($frinedGroup->type != 'waiting_to_confirmed' ) {
                redirect('groups');
            }

            if($this->groupModel->confirmationJoiningRequest($id, $userType)) {
                flash('group', 'משתמש נוסף בהצלחה' );
                redirect('groups');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('groups');
        }
    }
    
    public function rejectionOfRequest($id) {
        $userType = 'default_user';
        $clearGroupId = 0;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get exiting transaction from model
            $frinedGroup = $this->groupModel->getfrinedGroupById($id);
            // Check for owner
            if($frinedGroup->type != 'waiting_to_confirmed' ) {
                redirect('groups');
            }

            if($this->groupModel->rejectionJoiningRequest($id, $userType, $clearGroupId)) {
                flash('group', 'בוצע סירוב בהצלחה' );
                redirect('groups');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('groups');
        }
    }

    public function leavingGroup($id) {
        $userType = 'default_user';
        $clearGroupId = 0;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get exiting transaction from model
            $frinedGroup = $this->groupModel->getfrinedGroupById($id);
            // Check for owner
            if($frinedGroup->type != 'low_user' ) {
                redirect('groups');
            }

            if($this->groupModel->rejectionJoiningRequest($id, $userType, $clearGroupId)) {
                flash('group', 'משתמש עזב את הקבוצה בהצלחה' );
                redirect('groups');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('groups');
        }
    }

    public function joinToGroup() {
        $userType = 'waiting_to_confirmed';
        $usersGroup = $this->groupModel->getUsersGroup();
        $checkUserWithGroup = $this->groupModel->getGroupIncluded();
        $usersSumData = $this->groupModel->getSumForGroup();
        $group = $this->groupModel->getNameGroup();
        $userData = $this->groupModel->getUserType();
        $request = $this->groupModel->chekIfHaveReq();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
          
            $data =[
            'groups' => $group,
            'userData' => $userData,
            'usersGroup' => $usersGroup,
            'usersSumData' => $usersSumData,
            'checkUserWithGroup' => $checkUserWithGroup,
            'request' => $request,
            'group_id' => trim($_POST['group_id']),
            'group_id_err' => ''
                
            ];

            // Validate data
            if(empty($data['group_id'])){
                $data['group_id_err'] = 'הכנס מזהה קבוצה/משפחה';
            }
            if($this->groupModel->CheckIfGroupExist($data)){

            }  else{$data['group_id_err'] = 'קבוצה/משפחה לא קיימת';}  
            
               
                // Make sure no errors
            if(empty($data['group_id_err']) ){
                // Validated
                    if($this->groupModel->updateJoinToGroup($userType, $data)){
                        flash('group', 'נשלחה בקשת הצטרפות בהצלחה' );
                        redirect('groups/index');
                    } else {
                        die('יש בעיה');
                    }
                } else {
                    // Load view with errors
                    $this->view('groups/index', $data);
                }
                

        } else {
            // Make sure no errors    

            $data =[
                'group_id' => ''
                 
                
                
            ];
            
            $this->view('groups/index', $data);
        }// end else
    }

    public function deleteGroup($id) {
        $userType = 'default_user';
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get exiting transaction from model
            $group = $this->groupModel->getGroupIdById($id);
            // Check for owner
            if($group->id != $_SESSION['group_id']) {
                redirect('groups');
            }
            if($this->groupModel->deleteExistGroup($id)) {
                $this->groupModel->updateAllUsers($id,$userType);
                flash('group', 'קבוצה נמחקה בהצלחה' );
                redirect('groups');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('groups');
        }
    }
    
    public function cancelRequest($id) {
        $userType = 'default_user';
        $clearGroupId = 0;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get exiting transaction from model
            $frinedGroup = $this->groupModel->getfrinedGroupById($id);
            // Check for owner
            if($frinedGroup->type != 'low_user' ) {
                redirect('groups');
            }

            if($this->groupModel->rejectionJoiningRequest($id, $userType, $clearGroupId)) {
                flash('group', ' בקשת הצטרפות בוטלה בהצלחה' );
                redirect('groups');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('groups');
        }
    }
    
}

