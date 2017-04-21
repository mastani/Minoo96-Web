<link rel="stylesheet" href="/Theme/CSS/cand_dashboard.css">
<div class="container">
    <div class="row profile">
		<div class="col-md-2">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="{$candidate.image}" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{$candidate.name}
					</div>
					<div class="profile-usertitle-job">
					  {$candidate.profile_name}
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<!-- <div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm">Message</button>
				</div> -->
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="#">
							<i class="glyphicon glyphicon-th"></i>
							پیشخوان </a>
						</li>
						<li>
							<a href="#">
							<i class="glyphicon glyphicon-pencil"></i>
							ارسال پست </a>
						</li>
						<li>
							<a href="#" target="_blank">
							<i class="glyphicon glyphicon-user"></i>
							بیوگرافی و سوابق </a>
						</li>
						<li>
							<a href="#">
							<i class="glyphicon glyphicon-list-alt"></i>
							تنظیمات </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
