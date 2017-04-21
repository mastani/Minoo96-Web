<div class="container">
    <br/><br/>

    <div class="row">
        <div class="col-md-4 pull-left">
            <img width="200" src="{$candidate.image}">

            <h2>اطلاعات پایه</h2>
            <br/>
            <p><strong>نام و نام خانوادگی:</strong> {$candidate.name}</p>
            <p><strong>نام پدر:</strong> {$candidate.father_name}</p>
            <p><strong>سن:</strong> {$candidate.age}</p>
            <p><strong>گرایش سیاسی:</strong> {$candidate.hezb}</p>
            <p><strong>تحصیلات:</strong> {$candidate.tahsilat}</p>
            <p><strong>رشته تحصیلی:</strong> {$candidate.reshteh}</p>
            <p><strong>تاریخ ثبت نام:</strong> {$candidate.register_date}</p>

            <hr/>
            <h2>بیوگرافی</h2>
            <p class="long">{$candidate.bio}</p>
            <hr/>
            <p><a class="show">مشاهده سوابق کاری و ایده های کاندید برای مینودشت</a></p>
            <div class="hidden">
                <h2>سوابق کاری</h2>
                <p class="long">{$candidate.savabegh}</p>
                <hr/>
                <h2>ایده ها برای شهری بهتر</h2>
                <p class="long">{$candidate.idea}</p>
                <hr/>
                <h2>دیگر اطلاعات</h2>
                <p class="long">{$candidate.others}</p>
                <hr/>
                <h2>اطلاعات تماس</h2>
                <p>&nbsp;&nbsp;&nbsp;<i class="fa fa-telegram"></i><a href="{$candidate.tchannel}">کانال تلگرام </a></p>
            </div>
        </div>

        <div class="col-md-8">
            <h3>آخرین پست های <b>{$candidate.name}</b></h3>
            <br/>

            {foreach from=$posts item=post}
                <div class="post">
                    <div class="separator"></div>
                    <div class="content">
                        <img class="news_image" src="{$post.image}"/>
                        <p>{$post.content}</p>
                        <br/>
                        <p><a class="like-comment" data-id="{$post.id}">{$post.likes} لایک و {$post.comments} کامنت</a>
                        </p>
                        <p class="comments-area-{$post.id}"></p>
                        <p>ارسال شده در {$post.time}</p>
                    </div>
                </div>
                <br/>
            {/foreach}
        </div>
    </div>
</div>

<script type="application/javascript">
    $(".like-comment").click(function () {
        var pid = $(this).data("id");
        $.post("{$default_path}/Ajax/loadComments.php",
                {
                    id: pid
                },
                function (data, status) {
                    var html = "";

                    var json = JSON.parse(data);
                    var comments = json.comments;
                    $.each(comments, function (i, item) {
                        html += "<p>نظر " + item.name +
                                " ثبت شده در " + item.time +
                                "<br/>" + item.content +
                                "</p>";
                    });
                    $(".comments-area-" + pid).html(html);
                });
    });
    $(".show").click(function () {
        $(".hidden").css("display", "block");
    });
</script>