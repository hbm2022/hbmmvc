<?php require APPROOT . '/views/inc/header.php'; ?>
    <?php flash('group'); ?>
    <h1>ניהול קבוצה</h1>

    <?php if($data['checkUserWithGroup']->group_id !=0 && ($data['userData']->type == 'high_user' ||$data['userData']->type == 'low_user' )) :?>
        <h3><?php echo $data['groups']->type . ' ' . $data['groups']->nickname ; ?></h3>
        
        
        <div class="row mb-3 mt-4">
            <div class="col-md-6">   
            </div>
            <div class="col-md-6">
                <a href="<?php echo URLROOT; ?>/groups/editGroup/<?php echo $data['groups']->id;?>" class="btn btn-primary pull-right <?php if ($data['userData']->type != 'high_user' )  echo ' disabled'; ?>">
                    <i class="">ערוך קבוצה</i>
                </a>
               
            </div>

        </div>
       

        
        
        <div class="row mt-4 ml-1 mr-1">
        <?php if($data['userData']->type == 'high_user') :?>
                     
                     <h5><?php echo $data['groups']->id;?> :מזהה קבוצה </h5>
                  <?php endif ;?>
                
            <!--  Main table--> 
            <table id="" class="table table-striped text-white">
                <thead class="thead-dark">
                    <tr>
                        <?php if($data['request'] == false && $data['userData']->type == 'high_user') : ?>
                        <th class="text-center"></th>
                        <?php endif; ?>

                        <th class="text-center">יתרה</th>
                        <th class="text-center">סה"כ הוצאות</th>
                        <th class="text-center">סה"כ הכנסות</th>
                        <th class="text-center">שם בן המשפחה</th>
                        
                        <?php if($data['request'] == true) : ?>
                        <th class="text-center">בקשה</th>
                        <?php endif; ?>
                       
                        
                    
                    </tr>

                </thead>

                <tbody>
                
                <?php foreach($data['usersSumData']  as $friendGroupData ) : ?>
                    
                    <tr>
                    
                    <?php if($friendGroupData->type == "low_user"):?>
                        
                        <?php if($data['request'] == false && $data['userData']->type == 'high_user') : ?>
                        <td class="text-center">
                        <div class="row justify-content-center ml-auto">
                                
                                <form class="ml-1" action="<?php echo URLROOT; ?>/groups/leavingGroup/<?php echo $friendGroupData->id; ?>" method="post">
                                <input type="submit" value="הסר" class="btn btn-danger btn-sm">
                                </form>
                             
                        </div>
                        </td>
                        <?php endif; ?>
                        <td class="text-center"><?php echo $friendGroupData->balance; ?></td>
                        <td class="text-center"><?php echo $friendGroupData->sum_expenses; ?></td>
                        <td class="text-center"><?php echo $friendGroupData->sum_revenues; ?></td>
                        <td class="text-center"><?php echo $friendGroupData->first_name." ".$friendGroupData->last_name; ?></td>
                        <?php if($data['request'] == true) : ?>
                        <td class="text-center"></td>
                        <?php endif; ?>
                       
                        
                    <?php elseif ($friendGroupData->type == "waiting_to_confirmed"): ?>
                        <?php if($data['userData']->type == 'high_user'):?>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"><?php echo $friendGroupData->first_name." ".$friendGroupData->last_name; ?></td>
                            <td class="text-center ">
                                <div class="row justify-content-center ml-auto">
                                
                                        <form class="ml-1" action="<?php echo URLROOT; ?>/groups/requestApproval/<?php echo $friendGroupData->id; ?>" method="post">
                                        <input type="submit" value="אישור" class="btn btn-success btn-sm">
                                        </form>
                                        <form class="ml-1" action="<?php echo URLROOT; ?>/groups/rejectionOfRequest/<?php echo $friendGroupData->id; ?>" method="post">
                                        <input type="submit" value="סירוב" class="btn btn-danger btn-sm">
                                        </form>
                                    
                                </div>
                            </td>
                        <?php endif;?>
                    <?php endif;?>              
                    </tr>
                    
                    <?php endforeach;  ?>
                </tbody>
            </table>
        </div>
            <?php if($data['userData']->type == 'high_user') :?>
              
                
                <form class="ml-1" action="<?php echo URLROOT; ?>/groups/deleteGroup/<?php echo $data['groups']->id;?>" method="post">
                    <input type="submit" id="deleteGroup" value="מחיקת קבוצה" class="btn btn-danger  btn-sm mb-2 " disabled >
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="confirmToDelete" onchange="confirmDelete()"  >
                        <label class="custom-control-label" for="confirmToDelete">אישור מחיקה</label>
                    </div>
                </form>
            <?php endif ;?>
            <?php if($data['userData']->type == 'low_user'):?>
                <form class="ml-1" action="<?php echo URLROOT; ?>/groups/leavingGroup/<?php echo $data['userData']->id; ?>" method="post">
                <input type="submit" value="יציאה מקבוצה" class="btn btn-danger btn-sm">
                </form>
            
            <?php endif ;?>
            
    
    
    <?php else :?>
        <?php  if($data['userData']->type == 'default_user' ) :?>
            
            
                
                
                    
                    
                    <div class="card card-body bg-light mt-5">
                        <h2>פתיחת בקשה להצטרפות</h2>
                        <p>בקש ממנהל קבוצה להצטרף </p>
                        <form action="<?php echo URLROOT; ?>/groups/joinToGroup" method="post">
                        <label for="group_id"><sup>*</sup> : הזן מזהה קבוצה</label>    
                        <div class="input-group mb-3  ">
                                
                                <input type="text"  name="group_id" class="form-control  text-left mt-4 <?php echo (!empty($data['group_id_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['group_id']; ?>"   placeholder="מזהה קבוצה">
                                <div class="input-group-prepend ">
                                <input type="submit" class="btn btn-primary mt-4" value="הוספה">   
                                </div>
                                <span class="invalid-feedback"><?php echo $data['group_id_err'] ; ?></span>
                            </div>    
                        </form>
                    </div>
                    
                
            
            <div class="row mb-3 mt-4 mr-auto ">
            <a href="<?php echo URLROOT; ?>/groups/createGroup" class="btn btn-primary pull-right">
                        <i class="fa fa-pencil">יצירת קבוצה</i>
                    </a>
            </div>
        <?php else:?>
            <h3>ממתין לאישור מנהל</h3>
            <div class="row mb-3 ml-1 mt-4 pull-right">
                <?php if($data['userData']->type == 'waiting_to_confirmed'):?>
                    <form class="ml-1" action="<?php echo URLROOT; ?>/groups/cancelRequest/<?php echo $data['userData']->id; ?>" method="post">
                    <input type="submit" value="ביטול בקשה" class="btn btn-danger btn-sm">
                    </form>
                
                <?php endif ;?>
            </div>
        <?php endif ;?>
    <?php endif ;?>
  
   
<?php require APPROOT . '/views/inc/footer.php'; ?>
