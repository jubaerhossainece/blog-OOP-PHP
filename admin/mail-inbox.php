<?php 
    include "includes/header.php";
 ?>    
 
 <?php
    /*pagination detail goes below*/ 
    $per_page = 10;

    $query = "SELECT COUNT(id) as total FROM tbl_contacts WHERE deleted_at IS null";
    $result = $db->select($query)->fetch_object();
    $total_pages = ceil($result->total/$per_page); 
    $page_url = "mail-inbox.php?";

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }

    $from = ($page-1) * $per_page;

    $mail_query = "SELECT * FROM tbl_contacts WHERE deleted_at IS null LIMIT $from, $per_page";
    $mails = $db->select($mail_query);


?>



<?php 
    include "includes/header-nav.php";
    
 ?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
        <link href="assets/css/mail.css" rel="stylesheet">

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php 
            include "includes/sidebar.php";
         ?>
         
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

<!-- mail left side bar -->
<?php 
    include"includes/mail-leftbar.php";
 ?>
 <!-- mail left bar ends -->


                                <div class="email-right-box">
                                    <div role="toolbar" class="select-all-box toolbar mb-3">
                                        <div class="select-all-checkbox">
                                            <input type="checkbox" id="select-all" >
                                            <label class="toggle" for="select-all"></label>
                                        </div>
                                        <div class="btn-group">
                                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-dark dropdown-toggle" type="button">More <span class="caret m-l-5"></span>
                                            </button>
                                            <div class="dropdown-menu"><span class="dropdown-header">More Option </span>  
                                                <a href="javascript: void(0);" onclick="mark_unread()" class="dropdown-item">Mark as Unread</a>  
                                                <a href="javascript: void(0);" onclick="mark_read()" class="dropdown-item">Mark as read</a>  
                                                <a href="javascript: void(0);" onclick="mark_star()" class="dropdown-item">Add Star</a>  
                                                <!-- <a href="javascript: void(0);" class="dropdown-item">Mute</a> -->
                                            </div>
                                            <div class="btn-group ml-2 m-b-20">
                                                <button type="button" onclick="make_trash()" class="rounded btn btn-light"><i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                if($mails){ 
                                ?>
                                    <div class="email-list m-t-15">
                            <?php
                                while($mail = $mails->fetch_object()){
                                ?>
                                        <div class="message <?php if(!$mail->is_seen){ echo 'unread'; } ?>">
                                            <div class="col-mail col-mail-1">
                                                <div class="email-checkbox" id="mail-checkbox">
                                                    <input type="checkbox" id="message-id-<?php echo $mail->id ?>" class="" value="<?php echo $mail->id?>">
                                                    <label class="toggle" for="message-id-<?php echo $mail->id ?>"></label>
                                                </div>
                                                <a href="Controllers/MailController.php?star=<?php echo $mail->id ?>"><span class="star-toggle ti-star"></span></a>
                                            </div>
                                            <a href="mail-read.php?mail_id=<?php echo $mail->id ?>">
                                                <div class="col-mail col-mail-2">
                                                    <div class="subject"><?php echo $mail->subject.' - '.$mail->message; ?></div>
                                                    <div class="date"><?php echo Format::mailDate($mail->created_at) ?></div>
                                                </div>
                                            </a>
                                        </div>
                            <?php } ?>            
                                        
                                    </div>
                            <?php
                                }else{
                                    echo "<div class='text-center text-danger'>
                                    <span>No message found!</span>
                                    </div>";
                                }
                             ?>        
                                    <!-- panel -->
                                    <div class="row mt-3">
                                        <div class="col-7">
                                            <?php 
                                                $start=$from+1;
                                                $end = $from+$per_page;
                                                if($end > $result->total){
                                                    $end = $result->total;
                                                }
                                             ?>
                                            <div class="text-left"><?php echo $start.' to '.$end.' from '; echo $result->total ?></div>
                                        </div>
                                        <div class="col-5">

                                <!-- PAGINATION LINK BELOW -->

                                            <div class="btn-group float-right">
                                                <a href="<?php echo $page_url; ?>page=<?php echo $page-1; ?>" class="<?php if($page <= 1){ echo 'disabled btn-gradient'; } ?> btn btn-dark"><i class="fa fa-angle-left"></i>
                                                </a>
                                                <a href="<?php echo $page_url; ?>page=<?php echo $page+1; ?>" class="<?php if($page >= $total_pages){ echo 'disabled btn-gradient'; } ?> btn btn-dark"><i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <form action="controllers/MailController.php" method="POST" id="action-form" class="d-none">
        <input type="hidden" name="mail_array[]" id="mail-array"></input>
        <input type="hidden" name="action_type" id="action-type">
    </form>
    <?php 
        include "includes/footer.php";
     ?>
     <script>
        $('#select-all').click(function(){
            $('#mail-checkbox input[type="checkbox"]').prop('checked', this.checked);
        })
        
     </script>
     <script src="assets/js/app.js"></script>