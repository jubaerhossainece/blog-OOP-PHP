<?php 
    include "includes/header.php";
 ?>        
 <?php 
    $req = $obj->inputValidate($_GET);
    if(isset($req->mail_id) && $req->mail_id !== '' && $req->mail_id > 0){
        $mail_id = $req->mail_id;
        $query = "SELECT * FROM tbl_contacts WHERE id=$mail_id";
        $mails = $db->select($query);

        if($mails){
            $mail = $mails->fetch_object();

            //check as read
            if(!$mail->is_seen){
                $query = "UPDATE tbl_contacts
                          SET 
                          is_seen=true
                          WHERE 
                          id=$mail->id";
                $update = $db->update($query);          
            }

            //find total number of unread mail            
            $total_unread = "SELECT COUNT(id) as inbox FROM tbl_contacts WHERE is_seen = false";
            $count = $db->select($total_unread)->fetch_object();
        }else{
            echo "<script> location.href='mail-inbox.php'; </script>";
            exit;
        }

    }else{
        echo "<script> location.href='mail-inbox.php'; </script>";
        exit;
    }
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
            <?php
                include "includes/mail-leftbar.php";
             ?>
                                <div class="email-right-box">
                                    <div class="toolbar" role="toolbar">
                                        <div class="btn-group m-b-20">
                                            <button type="button" class="btn btn-light"><i class="fa fa-archive"></i>
                                            </button>
                                            <button type="button" class="btn btn-light"><i class="fa fa-exclamation-circle"></i>
                                            </button>
                                            <button type="button" class="btn btn-light"><i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                        <div class="btn-group m-b-20">
                                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="fa fa-folder"></i>  <b class="caret m-l-5"></b>
                                            </button>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="javascript: void(0);">Social</a>  <a class="dropdown-item" href="javascript: void(0);">Promotions</a>  <a class="dropdown-item" href="javascript: void(0);">Updates</a> 
                                                <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                            </div>
                                        </div>
                                        <div class="btn-group m-b-20">
                                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tag"></i>  <b class="caret m-l-5"></b>
                                            </button>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="javascript: void(0);">Updates</a>  <a class="dropdown-item" href="javascript: void(0);">Promotions</a> 
                                                <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                            </div>
                                        </div>
                                        <div class="btn-group m-b-20">
                                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">More <span class="caret m-l-5"></span>
                                            </button>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="javascript: void(0);">Mark as Unread</a>  <a class="dropdown-item" href="javascript: void(0);">Add to Tasks</a>  <a class="dropdown-item"
                                                href="javascript: void(0);">Add Star</a>  <a class="dropdown-item" href="javascript: void(0);">Mute</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="read-content">
                                        <div class="media pt-5">
                                            <img class="mr-3 rounded-circle" src="images/users/avatar.png">
                                            <div class="media-body">
                                                <h5 class="m-b-3"><?php echo $mail->name ?></h5>
                                                <p class="m-b-2"><?php echo Format::formatDate($mail->created_at) ?></p>
                                            </div>
                                            
                                        </div>
                                        <hr>
                                        <div class="media mb-4 mt-1">
                                            <div class="media-body">
                                                <h4 class="m-0 text-primary"><?php echo $mail->subject ?></h4><small class="text-muted">To:Me,<?php echo' '. Session::get('auth-email'); ?></small>
                                            </div>
                                        </div>
                                        <div><?php echo $mail->message ?></div>
                                        <hr>
                                        <h6 class="p-t-15"><i class="fa fa-download mb-2"></i> Attachments <span>(3)</span></h6>
                                        <div class="row m-b-30">
                                            <div class="col-auto"><a href="#" class="text-muted">My-Photo.png</a>
                                            </div>
                                            <div class="col-auto"><a href="#" class="text-muted">My-File.docx</a>
                                            </div>
                                            <div class="col-auto"><a href="#" class="text-muted">My-Resume.pdf</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group p-t-15">
                                            <textarea class="w-100 p-20 l-border-1" name="" id="" cols="30" rows="5" placeholder="It's really an amazing.I want to know more about it..!"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primaryw-md m-b-30" type="button">Send</button>
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
    <?php 
        include "includes/footer.php";
     ?>
     <script>
        $('#photo').change(function(){
            $(this).next('label').text($(this).val());
        })
     </script>