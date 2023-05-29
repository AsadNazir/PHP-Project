<!-- <div class="offcanvas offcanvas-bottom show" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">Offcanvas bottom</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body small">
        ...
      </div>
    </div> -->

<!-- NavBar Ends Here -->

<div class="dashBoardBody">
      <div class="sideBar">
        <h1>Options</h1>
        <ul>
          <li ><a class="<?php  if($_SERVER["PATH_INFO"]=="/register")
            {echo "active_sidebar";}
          
          ?>" href="register">Add Animal</a></li>
          <li><a class="<?php  if($_SERVER["PATH_INFO"]=="/Notification")
            {echo "active_sidebar";}
          
          ?>"href="./Notification">Notifications</a></li>
          <li><a class="<?php  if($_SERVER["PATH_INFO"]=="/Charts")
            {echo "active_sidebar";}
          
          ?>"href="#">Charts</a></li>
          <li><a class="<?php  if($_SERVER["PATH_INFO"]=="/")
            {echo "active_sidebar";}
          
          ?>"href="#">Some Option</a></li>
        </ul>
      </div>