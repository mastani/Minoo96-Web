<div class="container">
    <br/><br/>

    <div class="row">
        <div class="col-md-4 pull-left">
            <br/>
            <img width="300" src="{$candidate.image}">
        </div>

        <div class="col-md-6 pull-right bio">
            <h2>اطلاعات پایه</h2>
            <br/>
            <p><strong>نام و نام خانوادگی:</strong> {$candidate.name}</p>
            <p><strong>نام پدر:</strong> {$candidate.father_name}</p>
            <p><strong>سن:</strong> {$candidate.age}</p>
            <p><strong>گرایش سیاسی:</strong> {$candidate.hezb}</p>
            <p><strong>تحصیلات:</strong> {$candidate.tahsilat}</p>
            <p><strong>رشته تحصیلی:</strong> {$candidate.reshteh}</p>
            <p><strong>تاریخ ثبت نام:</strong> {$candidate.register_date}</p>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-12 bio">
            <h2>بیوگرافی</h2>
            <p class="long">{$candidate.bio}</p>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-12 bio">
            <h2>سوابق کاری</h2>
            <p class="long">{$candidate.savabegh}</p>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-12 bio">
            <h2>ایده ها برای شهری بهتر</h2>
            <p class="long">{$candidate.idea}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 bio">
            <h2>دیگر اطلاعات</h2>
            <p class="long">{$candidate.others}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 bio">
            <h2>اطلاعات تماس</h2>
            <p>&nbsp;&nbsp;&nbsp;<i class="fa fa-telegram"></i><a href="{$candidate.tchannel}">کانال تلگرام </a></p>
        </div>
    </div>
</div>