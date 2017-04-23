<div class="container">
    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6">
            {if isset($result)}
                {if $result}
                    <div class="alert alert-success">
                        پیام شما با موفقیت ثبت شد.
                    </div>
                {else}
                    <div class="alert alert-danger">
                        هنگام ثبت پیام شما مشکلی بوجود آمده است. لطفا بررسی کنید همه ی فیلد های مورد نیاز را تکمیل کرده اید.
                    </div>
                {/if}
            {/if}

            <h4>فرم ارسال نظرات
                <small>در اولین فرصت پاسخگوی شما هستیم.</small>
            </h4>
            <hr class="colorgraph">

            <form role="form" action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="نام و نام خانوادگی" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="ایمیل شما (اختیاری)">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="mobile"
                           placeholder="شماره موبایل شما (اختیاری)">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" rows="10" placeholder="متن پیام شما"
                              required></textarea>
                </div>
                <button name="submit" type="submit" class="btn btn-success btn-block">ارسال</button>
            </form>
        </div>

        <div class="col-md-3"></div>
    </div>
</div>