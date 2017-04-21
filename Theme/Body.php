<?php
defined('ACCESS') or die(header('HTTP/1.1 403 Forbidden'));
?>

<!--
<img class="header-images" src="<?php echo getAddress(); ?>/Theme/Images/header2.jpg" width="1250">
-->

<div class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="header-image" href="<?php echo getAddress(); ?>/Home"><img
                alt="logo" src="<?php echo getAddress(); ?>/Theme/Images/Logo.png"/></a>
    </div>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li><a href="<?php echo getAddress(); ?>/Home">صفحه اصلی</a></li>
            <li><a href="<?php echo getAddress(); ?>/Home#Candidates">لیست نامزدها</a></li>
            <li><a href="<?php echo getAddress(); ?>/Home#News">جدیدترین اخبار</a></li>
            <li><a href="<?php echo getAddress(); ?>/Register">ثبت نام</a></li>
            <li><a href="<?php echo getAddress(); ?>/App">دانلود اپلیکیشن</a></li>
        </ul>

        <div class="search-form col-sm-3 col-md-3 pull-left">
            <form role="search" method="get" class="search-form">
                <label>
                    <input type="search" class="search-field" placeholder="جست و جو" value="" name="s"
                           title="جست و جو برای">
                </label>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <?php
    include 'Sidebar.php';
    ?>

    <div id="content">
        <?php
          $controller->$command();
        ?>
    </div>

</div>
