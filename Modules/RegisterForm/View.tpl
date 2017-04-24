<div class="container">
    {if isset($logged_in) && $logged_in}
        <br/>
        <br/>
        <br/>
        <br/>
        <div class="row" style="margin: 0 auto; text-align: center;">
            <div class="col-md-8" style="width: 100%;">
                <div class="alert alert-success">
                    <br/>
                    <h1>در حال انتقال به پنل کاربری ...</h1>
                    <br/>
                </div>
            </div>
        </div>
        <script>setTimeout("window.location = 'Me'", 2500);</script>
    {else}
        <div class="row">
            <div class="col-md-1"></div>
            <form method="post" action="" class="form form-horizontal col-md-3">
                <h2>ورود به ناحیه کاربری</h2>
                <hr class="colorgraph">
                {if isset($login_result)}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                {if $login_result == 'success'}
                                    <h5>ورود با موفقیت انجام شد. در حال انتقال به پنل کاربری ...</h5>
                                    <script>setTimeout("window.location = 'Me'", 2500);</script>
                                {/if}
                                {if $login_result == 'fail'}
                                    <h5>اطلاعات وارد شده صحیح نمی باشد.</h5>
                                {/if}
                            </div>
                        </div>
                    </div>
                {/if}
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="mobile-email" id="mobile-email"
                               placeholder="شماره موبایل یا ایمیل"
                               required/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" class="form-control" name="password" id="password" placeholder="کلمه عبور"
                               required/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" name="login" class="btn btn-info btn-block">ورود</button>
                    </div>
                </div>
            </form>
            <div class="col-md-2"></div>
            <form id="form" method="post" action="" class="form form-horizontal col-md-4">
                <h2>ثبت نام
                    <small>لطفا اطلاعات را به صورت دقیق وارد کنید</small>
                </h2>
                <hr class="colorgraph">
                {if isset($result) || isset($captcha)}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                {if $result == 'exist_mobile'}
                                    <h5>این شماره موبایل قبلا ثبت شده است.</h5>
                                {/if}
                                {if $result == 'exist_email'}
                                    <h5>این ایمیل قبلا ثبت شده است.</h5>
                                {/if}
                                {if isset($captcha) && $captcha eq true}
                                    <h5>کد امنیتی وارد شده صحیح نیست.</h5>
                                {/if}
                            </div>
                        </div>
                    </div>
                {/if}
                {if isset($success)}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                ثبت نام شما با موفقیت انجام شد. در حال انتقال به پنل کاربری ...
                            </div>
                        </div>
                    </div>
                    <script>setTimeout("window.location = 'Me'", 2500);</script>
                {/if}
                <div class="form-group">
                    <div class="col-md-6 col-xs-6">
                        <input type="text" name="name" id="name" class="form-control" placeholder="نام" required/>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <input type="text" name="last_name" id="last_name" class="form-control"
                               placeholder="نام خانوادگی"
                               required/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="email" class="form-control" name="email" id="email" placeholder="ایمیل" required/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="mobile" id="mobile"
                               placeholder="شماره موبایل: 09xxxxxxxxx"
                               onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="11" required/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-xs-6">
                        <input type="password" class="form-control" name="password" id="password" placeholder="کلمه عبور"
                               required/>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <input type="password" class="form-control" name="confirm-password" id="confirm-password"
                               placeholder="تایید کلمه عبور" required/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control" name="captcha" id="captcha"
                               placeholder="کد روبرو را وارد کنید" required/>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <img alt="captcha" style="width: 100%;" src="Libraries/Captcha/Captcha.php"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" name="register" class="btn btn-info btn-block">ثبت نام</button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            $(document).ready(function () {
                var elements = document.getElementsByTagName("INPUT");
                for (var i = 0; i < elements.length; i++) {
                    elements[i].oninvalid = function (e) {
                        e.target.setCustomValidity("");
                        if (!e.target.validity.valid) {
                            switch (e.srcElement.id) {
                                case "name":
                                    e.target.setCustomValidity("نام خود را وارد کنید.");
                                    break;
                                case "last_name":
                                    e.target.setCustomValidity("نام خانوادگی خود را وارد کنید.");
                                    break;
                                case "email":
                                    e.target.setCustomValidity("ایمیل خود را به صورت صحیح وارد کنید.");
                                    break;
                                case "mobile":
                                    e.target.setCustomValidity("شماره موبایل خود را به صورت صحیح وارد کنید.");
                                    break;
                                case "password":
                                    e.target.setCustomValidity("پسورد را وارد کنید.");
                                    break;
                                case "mobile-email":
                                    e.target.setCustomValidity("شماره موبایل یا ایمیل خود را وارد کنید.");
                                    break;
                            }
                        }
                    };
                    elements[i].oninput = function (e) {
                        e.target.setCustomValidity("");
                    };
                }
            })
        </script>
        <script>
            $('#form').submit(function (event) {
                var val1 = $('#form').find('#password').val();
                var val2 = $('#form').find('#confirm-password').val();
                if (val1 != val2) {
                    $('#form').find('#password').after('<div class="error" style="color: #333; font-size: 14px; margin-top: 8px;">پسورد ها تطابق ندارند !</div>');
                    $('#form').find('#confirm-password').prev().remove();
                    event.preventDefault();
                } else {
                    $('#error').remove();
                }
            });
        </script>
    {/if}
</div>