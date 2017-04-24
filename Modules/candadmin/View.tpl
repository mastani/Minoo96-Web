<div class="container">
  <div class="row">
    <div class="col-md-1"></div>
    <form method="post" action="" class="form form-horizontal col-md-3">
      <h2>ورود به ناحیه کاربری</h2>
      <hr class="colorgraph">
      {if isset($login_cand)}
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-info">
            {if $login_cand == 'success'}
            <h5>ورود با موفقیت انجام شد. در حال انتقال به پنل کاربری ...</h5>
            <script>setTimeout("window.location = 'candadmin/dashboard'", 2500);</script>
            {/if}
            {if $login_cand == 'fail'}
            <h5>اطلاعات وارد شده صحیح نمی باشد.</h5>
            {/if}
            {if $captcha}
            <h5>تصویر امنیتی درست وارد نشده است.</h5>
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
          <button type="submit" name="login" class="btn btn-info btn-block">ورود</button>
        </div>
      </div>
    </form>
    <div class="col-md-2"></div>
  </div>
  <script>
  $(document).ready(function () {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
      elements[i].oninvalid = function (e) {
        e.target.setCustomValidity("");
        if (!e.target.validity.valid) {
          switch (e.srcElement.id) {
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

</div>
