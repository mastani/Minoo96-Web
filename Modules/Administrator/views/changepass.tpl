
{if (isset($msg))}
    <div class="alert alert-info">{$msg}</div>
{/if}
<div class="alert alert-danger" style="visibility: hidden;"  id="error_msg"></div>

<form id="form" method="post" action="" class="form form-horizontal col-md-12">
    <h2>تغییر کلمه عبور</h2>
    <hr class="colorgraph">
    <div class="form-group">
        <label for="oldpass" class="col-sm-3 control-label">کلمه عبور فعلی</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" id="oldpass" name="oldpass" required>
        </div>
    </div>
    <div class="form-group">
        <label for="newpass1" class="col-sm-3 control-label">کلمه عبور جدید</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" id="newpass1" name="newpass1" required>
        </div>
    </div>
    <div class="form-group">
        <label for="newpass" class="col-sm-3 control-label">تکرار کلمه عبور جدید</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" id="newpass2" name="newpass2" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
            <input id="submit" name="submit" type="submit" value="ذخیره" class="btn btn-primary">
        </div>
    </div>
    <div class="form-group">
        <label for="newpass" class="col-sm-8 control-label">        کلمه عبور باید شامل حروف بزرگ وکوچک و اعداد باشد و طول آن نیز از 4 کاراکتر بیشتر باشد</label>
    </div>
</form>

<script type="text/javascript">

    function checkPassword(str)
    {
        // at least one number, one lowercase and one uppercase letter
        // at least six characters
        var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
        return  re.test(str);
    }

    $('#form').submit(function (event) {

        if(!checkPassword($('#newpass1').val())){
            $('#error_msg').css('visibility','visible').text('کلمه عبور باید شامل حروف بزرگ وکوچک و اعداد باشد و طول آن نیز از 4 کاراکتر بیشتر باشد');
            event.preventDefault();
        }
        else if ($('#newpass1').val() != $('#newpass2').val()) {
            $('#error_msg').css('visibility','visible').text('کلمه عبور جدید و تکرار آن یکسان نیستند !');
            event.preventDefault();
        }

    });

</script>