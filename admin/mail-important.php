<?php 
    include "includes/header.php";
 ?>    
 
 <?php
    /*pagination detail goes below*/ 
    $per_page = 10;

    $query = "SELECT COUNT(id) as total FROM tbl_contacts WHERE is_important=true AND deleted_at IS null";
    $result = $db->select($query)->fetch_object();
    
    $total_pages = ceil($result->total/$per_page); 
    $page_url = "mail-important.php?";

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }

    $from = ($page-1) * $per_page;

    $mail_query = "SELECT * FROM tbl_contacts WHERE is_important=true AND deleted_at Is null LIMIT $from, $per_page";
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
                                    <div role="toolbar" class="toolbar mb-3">
                                        <div class="btn-group">
                                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-dark dropdown-toggle" type="button">More <span class="caret m-l-5"></span>
                                            </button>
                                            <div class="dropdown-menu"><span class="dropdown-header">More Option </span>  <a href="javascript: void(0);" class="dropdown-item">Mark as Unread</a>  <a href="javascript: void(0);" class="dropdown-item">Add to Tasks</a>  <a href="javascript: void(0);"
                                                class="dropdown-item">Add Star</a>  <a href="javascript: void(0);" class="dropdown-item">Mute</a>
                                            </div>
                                        </div>
                                    </div>
                    <?php
                        if($mails){ 
                        ?>
                            <div class="email-list m-t-15">
                            <?php Format::isUrl('mail-trashed.php') ?>
                    <?php
                        while($mail = $mails->fetch_object()){
                        ?>
                                        <div class="message <?php if(!$mail->is_seen){ echo 'unread'; } ?>">
                                                <div class="col-mail col-mail-1">
                                                    <div class="email-checkbox">
                                                        <input type="checkbox" id="chk2">
                                                        <label class="toggle" for="chk2"></label>
                                                    </div>
                                                    <a href="controllers/MailController.php?unstar=<?php echo $mail->id ?>"><span class="star-toggle ti-star active"></span></a>
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
                                    <!-- pagination section -->
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
                                                <a href="<?php echo $page_url; ?>page=<?php echo $page-1; ?>" class="<?php if($page <= 1){ echo 'disabled btn-gradient'; } ?> btn btn-dark">
                                                    <i class="fa fa-angle-left"></i>
                                                </a>
                                                <a href="<?php echo $page_url; ?>page=<?php echo $page+1; ?>" class="<?php if($page >= $total_pages){ echo 'disabled btn-gradient'; } ?> btn btn-dark">
                                                    <i class="fa fa-angle-right"></i>
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
    <?php 
        include "includes/footer.php";
     ?>
     <script>
        $('#photo').change(function(){
            $(this).next('label').text($(this).val());
        })
     </script>