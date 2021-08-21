<?php 
	include "includes/header.php";
    Session::init();
 ?>

<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
                <div class="banner-content content-padding">
                    <h1 class="text-white">Let's Connect with us</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde, perferendis?</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MAIN HEADER AREA END -->

  <!--  Contact START  -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-md-12">
                <div class="mb-5">
                    <h2 class="mb-2">Get in touch</h2>
                    <p>Have a project on mind,want to make an consultant. Don't hesistate to contact us.Let's have atalk together.Colaborat eyour project to done quickly</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 col-sm-12">
            <?php
                if(Session::get('msg')){
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo 
                            Session::get('msg'); 
                            Session::unsetOld();
                        ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <?php    
                } 
            ?>
                <form class="contact__form" method="post" action="admin/controllers/ContactController.php?action=insert">
                    <!-- form message -->
                    <!-- end message -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input name="name" type="text" class="form-control" placeholder="Name" value="<?php Session::old('name') ?>">
                            <div class="text-danger">
                                <strong>                                               
                                    <?php 
                                        Session::error('name')
                                    ?>
                                </strong>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <input name="email" type="email" class="form-control" placeholder="Email" value="<?php Session::old('email') ?>">
                            <div class="text-danger">
                                <strong>                                               
                                    <?php 
                                        Session::error('email')
                                    ?>
                                </strong>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <input name="subject" type="text" class="form-control" placeholder="Subject" value="<?php Session::old('subject') ?>">
                            <div class="text-danger">
                                <strong>                                               
                                    <?php 
                                        Session::error('subject')
                                    ?>
                                </strong>
                            </div>
                        </div>
                        <div class="col-12 form-group">
                            <textarea name="message" class="form-control" rows="6" placeholder="Message"><?php Session::old('message') ?></textarea>
                            <div class="text-danger">
                                <strong>                                               
                                    <?php 
                                        Session::error('message')
                                    ?>
                                </strong>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <input name="submit" type="submit" class=" btn btn-hero btn-circled" value="Send Message">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-5 pl-4 mt-4 mt-lg-0">
                <h4>Office Address</h4>
                <p class="mb-3">John lake park 9/12 street park London</p>
                <h4>Contact Info</h4>
                <p class="mb-3">+23 456 7920</p>
                <h4>Contact Mail</h4>
                <p class="mb-3">support@email.com</p>
                <h4>Website</h4>
                <p>www.companyname.com</p>
            </div>
        </div>
    </div>
</section>
<!--  CONTACT END  -->

<!--  Google Map START  -->
<section id="map" class="section-padding ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-6 col-md-3">
            </div>
        </div>
    </div>
</section>
<!--  Google Map END  -->
<?php 
    Session::unsetOld();
	include "includes/footer.php";
 ?>