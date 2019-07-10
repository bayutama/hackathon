<div class="side-bar-wrapper collapse navbar-collapse navbar-ex1-collapse">
  <a href="http://hack.id" class="logo hidden-sm hidden-xs">
	<img src="/assets/images/logov3.png" style="width:100%;"/>
    <?/*<span>Member Hack.id</span>*/?>
  </a>
  <?/*<div class="search-box">
    <input type="text" placeholder="SEARCH" class="form-control">
  </div>
  <ul class="side-menu side-menu-green-sea">
    <li>
      <a href="notifications.html">
        <span class="badge badge-notifications pull-right alert-animated">5</span>
        <i class="icon-flag"></i> Notifications
      </a>
    </li>
  </ul>*/?>
  <div class="relative-w">
    <ul class="side-menu side-menu-green-sea">
      <?/*<li class='current'>
        <a class='current' href="index.html">
          <span class="badge pull-right">17</span>
          <i class="icon-dashboard"></i> Dashboard
        </a>
      </li>*/?>
	   <li <?=($currmenu=="home" ? "class='current'":'' )?>>
		<a href="/member/mainpage" class="is-dropdown-menu">
		  <span class="badge pull-right"></span>
		  <i class="icon-home"></i> Home
		</a>
      </li>
      <li <?=($currmenu=="event" ? "class='current'":'' )?>>
		<a href="/member/event" class="is-dropdown-menu">
		  <span class="badge pull-right"></span>
		  <i class="icon-calendar"></i> My Hackathons
		</a>
      </li>
	   <li <?=($currmenu=="project" ? "class='current'":'' )?>>
		<a href="/member/project" class="is-dropdown-menu">
		  <span class="badge pull-right"></span>
		  <i class="icon-trophy"></i> My Projects
		</a>
      </li>
    </ul>
  </div>
</div>
    