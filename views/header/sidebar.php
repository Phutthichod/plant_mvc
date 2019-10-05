<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="profile-image">
          <img class="img-xs rounded-circle" src="<?php echo URL; ?>images/faces/face8.jpg" alt="profile image">
          <div class="dot-indicator bg-success"></div>
        </div>
        <div class="text-wrapper">
          <p class="profile-name"><?php echo Session::get('member')['username']; ?></p>
          <p class="designation"><?php echo Session::get("member")["permission"]; ?></p>
        </div>
        <div class="icon-container">
          <i class="icon-bubbles"></i>
          <div class="dot-indicator bg-danger"></div>
        </div>
      </a>
    </li>
    <li class="nav-item" id="user_manage">
      <a class="nav-link" href="<?php echo URL; ?>/user_manage">
        <span class="menu-title">User manage</span>
        <i class="icon-people menu-icon"></i>
      </a>
    </li>
    <li class="nav-item" id="plant_manage">
      <a class="nav-link" href="<?php echo URL; ?>/plant_manage">
        <span class="menu-title">Plant manage</span>
        <i class=" icon-fire menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- active nav-item -->
<?php
  class template{
       private $pinto;
     public function __construct(){
         $this->pinto = explode("/",$_SERVER["SCRIPT_NAME"]);
         echo $this->getSidebar();
         
     }
     public function getNavbar(){
         
     }
     public function getSidebar(){
         switch(end($this->pinto)){
             case 'user_manage':
                 return '<script>
                //  document.getElementById("user_manage").classList.add("active");
                 document.getElementById("plant_manage").classList.remove("active");
             </script>';
             break;
             case 'plant_manage':
                 return '<script>
                         document.getElementById("plant_manage").classList.add("active");
                         document.getElementById("user_manage").classList.remove("active");
                     </script>';
             break;
             default:
                 return '<script>
                        document.getElementById("user_manage").classList.add("active");
                         document.getElementById("plant_manage").classList.remove("active");
                         
                     </script>';
         }
     }    
    
     
    
 }
 
  $setActive = new template();
?>