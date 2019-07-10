<div class="col-md-9">
	<div class="content-wrapper">
        <div class="content-inner content-inner-grey">
			<div class="page-header page-header-green">
				<div class="header-links hidden-xs">
					<?/*<a href="notifications.html"><i class="icon-comments"></i> User Alerts</a>
					<a href="#"><i class="icon-cog"></i> Settings</a>*/?>
					<a href="/member/logout"><i class="icon-signout"></i> Logout</a>
				</div>
				<h1><?/*<i class="icon-bar-chart"></i>*/?> <?=$subtitle?></h1>
			</div>
			
			<?/*<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li><a href="#">Bread</a></li>
			  <li><a href="#">Crumbs</a></li>
			  <li class="active">Example</li>
			</ol>*/?>
          
			<div class="main-content">
				@component('member.content.'.$viewnya)
				<strong>Whoops!</strong> Something went wrong!
				@endcomponent
			</div>
        </div>
      </div>

</div>