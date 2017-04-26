<link rel="stylesheet" href="{$smarty.const.DEFAULT_PATH}/Theme/CSS/cand_dashboard.css">
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
				 <div class="profile-userbuttons">
				<!--	<button type="button" class="btn btn-success btn-sm">Follow</button>-->
					<a type="button" class="btn btn-danger btn-sm" href="{$smarty.const.DEFAULT_PATH}/?logout">خروج</a>
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li {if $url == 'posts'} class="active"{/if}>
							<a href="{$smarty.const.DEFAULT_PATH}/candadmin/dashboard">
							<i class="glyphicon glyphicon-th"></i>
							پیشخوان </a>
						</li>
						<li {if $url == 'new'} class="active"{/if}>
							<a href="{$smarty.const.DEFAULT_PATH}/candadmin/dashboard/new">
							<i class="glyphicon glyphicon-pencil"></i>
							ارسال پست </a>
						</li>
						{*<li {if $url == 'bio'} class="active"{/if}>*}
							{*<a href="{$smarty.const.DEFAULT_PATH}/candadmin/dashboard/bio">*}
							{*<i class="glyphicon glyphicon-user"></i>*}
							{*بیوگرافی و سوابق </a>*}
						{*</li>*}
						<li {if $url == 'setting'} class="active"{/if}>
							<a href="{$smarty.const.DEFAULT_PATH}/candadmin/dashboard/setting">
							<i class="glyphicon glyphicon-list-alt"></i>
							تنظیمات </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
