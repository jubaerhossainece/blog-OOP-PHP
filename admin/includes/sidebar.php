<div class="nk-sidebar">           
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>
            <li>
                <a href="index.php">
                    <i class="fas fa-home"></i>
                    <span class="nav-text <?php if(Format::current_page('index.php')){ echo 'active'; } ?>">Home</span> 
                </a>
            </li>
            
            <li>
                <a href="users.php">
                    <i class="fas fa-users"></i>
                    <span class="nav-text <?php if(Format::current_page('users.php')){ echo 'active'; } ?>">Users</span>
                </a>
            </li>

            <li>
                <a href="categories.php">
                    <i class="fas fa-layer-group"></i>
                    <span class="nav-text <?php if(Format::current_page('categories.php')){ echo 'active'; } ?>">Categories</span>
                </a>
            </li>

            <li>
                <a href="posts.php">
                    <i class="fas fa-clone"></i>
                    <span class="nav-text">Posts</span>
                </a>
            </li>

            <li class="nav-label">Settings</li>
            <li>
                <a href="others.php">
                    <i class="fas fa-blog"></i>
                    <span class="nav-text">Others</span>
                </a>
            </li>

            <li>
                <a href="pages.php">
                    <i class="fas fa-pager"></i>
                    <span class="nav-text">Pages</span>
                </a>
            </li>

            <li>
                <a href="verify-user.php">
                    <i class="fas fa-pager"></i>
                    <span class="nav-text">Change Password</span>
                </a>
            </li>
            
            <li>
            
            <li class="nav-label">Apps</li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-envelope menu-icon"></i> <span class="nav-text">Email</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="./email-inbox.html">Inbox</a></li>
                    <li><a href="./email-read.html">Read</a></li>
                    <li><a href="./email-compose.html">Compose</a></li>
                </ul>
            </li>

            <li>
                <a href="widgets.html" aria-expanded="false">
                    <i class="icon-badge menu-icon"></i><span class="nav-text">Widget</span>
                </a>
            </li>
            <li class="nav-label">Forms</li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-note menu-icon"></i><span class="nav-text">Forms</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="./form-basic.html">Basic Form</a></li>
                    <li><a href="./form-validation.html">Form Validation</a></li>
                    <li><a href="./form-step.html">Step Form</a></li>
                    <li><a href="./form-editor.html">Editor</a></li>
                    <li><a href="./form-picker.html">Picker</a></li>
                </ul>
            </li>
            
            <li class="nav-label">Pages</li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-notebook menu-icon"></i><span class="nav-text">Pages</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="./page-login.html">Login</a></li>
                    <li><a href="./page-register.html">Register</a></li>
                    <li><a href="./page-lock.html">Lock Screen</a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                        <ul aria-expanded="false">
                            <li><a href="./page-error-404.html">Error 404</a></li>
                            <li><a href="./page-error-403.html">Error 403</a></li>
                            <li><a href="./page-error-400.html">Error 400</a></li>
                            <li><a href="./page-error-500.html">Error 500</a></li>
                            <li><a href="./page-error-503.html">Error 503</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>