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
    <li class="nav-item active" id="user_manage">
      <a class="nav-link" href="">
        <span class="menu-title">Upload plant</span>
        <i class="icon-cloud-upload menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>