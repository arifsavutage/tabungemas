 <!-- top bar navigation -->
 <div class="headerbar">

     <!-- LOGO -->
     <div class="headerbar-left">
         <a href="<?= base_url(); ?>" class="logo"><img alt="logo" src="<?= base_url(); ?>assets/images/logo-transparent-thumb.png" /></a>
     </div>

     <nav class="navbar-custom">

         <ul class="list-inline float-right mb-0">

             <li class="list-inline-item dropdown notif">
                 <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                     <img src="<?= base_url() . "assets/images/avatars/" . $this->session->userdata('foto'); ?>" alt="Profile image" class="avatar-rounded">
                 </a>
                 <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                     <!-- item-->
                     <div class="dropdown-item noti-title">
                         <h5 class="text-overflow"><small>Hello, <?= $this->session->userdata('nama'); ?></small> </h5>
                     </div>

                     <!-- item-->
                     <a href="<?= base_url(); ?>index.php/auth/logout" class="dropdown-item notify-item">
                         <i class="fa fa-power-off"></i> <span>Logout</span>
                     </a>
                 </div>
             </li>

         </ul>

         <ul class="list-inline menu-left mb-0">
             <li class="float-left">
                 <button class="button-menu-mobile open-left">
                     <i class="fa fa-fw fa-bars"></i>
                 </button>
             </li>
         </ul>

     </nav>

 </div>
 <!-- End Navigation -->