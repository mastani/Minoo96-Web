<?php
defined('ACCESS') or die(header('HTTP/1.1 403 Forbidden'));
?>
<!--
<div id="sidebar">

    <?php if ( $controller->hasPermission('guest') ) { ?>
    <div class="login-box">
        <span>ورود به اکانت</span>
        <form class="login" action="<?php echo getAddress(); ?>/Login" method="post" align="center">
            <input type="text" class="field" name="username" id="username" placeholder="نام کاربری">
            <br/>
            <input type="password" class="field" name="password" id="password" placeholder="کلمه عبور">
            <br/>
            <input type="submit" class="button" name="submit" value="ورود">
        </form>
        <a href="ForgotPassword">فراموشی رمز عبور</a>
    </div>
    <?php } ?>

    <ul class="right-menu">
        <li class="right-menu-item"><a <?php if($page == 'Home')echo 'class="right-menu-active"'; ?>href="<?php echo getAddress(); ?>/Home"><span class="fa fa-home"></span>صفحه اصلی</a></li>
        <li class="right-menu-item"><a <?php if($page == 'Register')echo 'class="right-menu-active"'; ?>href="<?php echo getAddress(); ?>/Register"><span class="fa fa-user-plus"></span>ثبت نام</a></li>
        <li class="right-menu-item"><a <?php if($page == 'UCP')echo 'class="right-menu-active"'; ?>href="<?php echo getAddress(); ?>/UCP"><span class="fa fa-sign-in"></span>ناحیه کاربری</a></li>
        <li class="right-menu-item"><a <?php if($page == 'GameCard')echo 'class="right-menu-active"'; ?>href="<?php echo getAddress(); ?>/GameCard"><span class="fa fa-credit-card"></span>خرید گیم کارت</a></li>
        <li class="right-menu-item"><a <?php if($page == 'Store')echo 'class="right-menu-active"'; ?>href="<?php echo getAddress(); ?>/Store"><span class="fa fa-shopping-cart"></span>فروشگاه سرور</a></li>
        <li class="right-menu-item"><a <?php if($page == 'Armory')echo 'class="right-menu-active"'; ?>href="<?php echo getAddress(); ?>/Armory"><span class="fa fa-search"></span>آرموری</a></li>
        <li class="right-menu-item"><a <?php if($page == 'TermsOfServices')echo 'class="right-menu-active"'; ?>href="<?php echo getAddress(); ?>/TermsOfServices"><span class="fa fa-gavel"></span>قوانین سرور</a></li>
        <li class="right-menu-item"><a <?php if($page == 'Contact')echo 'class="right-menu-active"'; ?>href="<?php echo getAddress(); ?>/Contact"><span class="fa fa-phone"></span>تماس با مدیریت</a></li>
    </ul>
</div>
-->