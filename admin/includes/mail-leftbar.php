<?php 
    //count total important/ starred messages
    $total_important = "SELECT COUNT(id) as total FROM tbl_contacts WHERE is_important = true";
    $important = $db->select($total_important)->fetch_object();

    
    //trashed messages
    $query_trashed = "SELECT COUNT(id) as total FROM tbl_contacts WHERE deleted_at IS NOT null";
    $trashed = $db->select($query_trashed)->fetch_object();
?>
<div class="email-left-box"><a href="mail-compose.php" class="btn btn-primary btn-block">Compose</a>
    <div class="mail-list mt-4">
        <a href="mail-inbox.php" class="list-group-item border-0 text-primary p-r-0"><i class="fa fa-inbox font-18 align-middle mr-2"></i> <b>Inbox</b> 
            <?php if($inbox->total > 0){ ?>
                <span class="badge badge-primary badge-sm float-right m-t-5"><?php echo $inbox->total; ?></span>
            <?php } ?>
        </a>
        <a href="#" class="list-group-item border-0 p-r-0"><i class="fa fa-paper-plane font-18 align-middle mr-2"></i>Sent
            <?php if($important->total > 0){ ?>
                <span class="badge badge-success badge-sm float-right m-t-5"><?php echo $important->total; ?></span>
            <?php } ?>
        </a>  
        <a href="mail-important.php" class="list-group-item border-0 p-r-0"><i class="fa fa-star-o font-18 align-middle mr-2"></i>Important 
            <?php if($important->total > 0){ ?>
                <span class="badge badge-danger badge-sm float-right m-t-5"><?php echo $important->total; ?></span> 
            <?php } ?>
        </a>
            
        <a href="#" class="list-group-item border-0 p-r-0"><i class="mdi mdi-file-document-box font-18 align-middle mr-2"></i>Draft
            <?php if($inbox->total > 0){ ?>
                <span class="badge badge-warning badge-sm float-right m-t-5"><?php echo $inbox->total; ?></span>
            <?php } ?>
        </a>
        <a href="#" class="list-group-item border-0 p-r-0"><i class="fa fa-trash font-18 align-middle mr-2"></i>Trash
            <?php if($trashed->total > 0){ ?>
                <span class="badge badge-danger badge-sm float-right m-t-5"><?php echo $trashed->total; ?></span>
            <?php } ?>
        </a>
    </div>
    <h5 class="mt-5 m-b-10">Categories</h5>
    <div class="list-group mail-list">
        <a href="#" class="list-group-item border-0"><span class="fa fa-briefcase f-s-14 mr-2"></span>Work</a>  
        <a href="#" class="list-group-item border-0"><span class="fa fa-sellsy f-s-14 mr-2"></span>Private</a>  
        <a href="#" class="list-group-item border-0"><span class="fa fa-ticket f-s-14 mr-2"></span>Support</a>  
        <a href="#" class="list-group-item border-0"><span class="fa fa-tags f-s-14 mr-2"></span>Social</a>
    </div>
</div>