<div class="container">
    <br/><br/>

    <div class="row">
        <div class="col-md-4 pull-left sid-left">

            <h2 class="sid-left-h">اطلاعات نامزد</h2>
            <br/>
            <img width="180" src="{$candidate.image}" class="sid-left-img">
            <p class="sid-left-pa"><strong>نام و نام خانوادگی:</strong> {$candidate.name}</p>
            <p class="sid-left-pa"><strong>نام پدر:</strong> {$candidate.father_name}</p>
            <p class="sid-left-pa"><strong>سن:</strong> {$candidate.age}</p>
            <p class="sid-left-pa"><strong>گرایش سیاسی:</strong> {$candidate.hezb}</p>
            <p class="sid-left-pa"><strong>تحصیلات:</strong> {$candidate.tahsilat}</p>
            <p class="sid-left-pa"><strong>رشته تحصیلی:</strong> {$candidate.reshteh}</p>
            <p class="sid-left-pa"><strong>تاریخ ثبت نام:</strong> {$candidate.register_date}</p>

            <h2 class="sid-left-h">بیوگرافی</h2>
            <p class="long">{$candidate.bio}</p>
            <hr/>
            <p><a class="show-content">مشاهده سوابق کاری و ایده های کاندید برای مینودشت</a></p>
            <div class="hidden-content">
                <h2>سوابق کاری</h2>
                <p class="long">{$candidate.savabegh}</p>
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
            <h3 class="sid-right-h">آخرین پست های <b>{$candidate.name}</b></h3>
            <br/>

            {foreach from=$posts item=post}
                <div class="post">
                    <div class="separator"></div>
                    <div class="content c-shadow pad-bot">
                        <img class="news_image" src="{$post.image}"/>
                        <p class="st-cont">{$post.content}</p>
                        <br/>
                        <p><a class="like-comment" data-id="{$post.id}"><img src="../Theme/Images/like.png" class="like-post"/>{$post.likes} لایک<img src="../Theme/Images/comment.png" class="cm-post"/> {$post.comments} کامنت</a>
                        </p>
                        <p class="comments-area-{$post.id}"></p>
                        <p class="time-back"><img src="../Theme/Images/time.png" class="time-post"/>ارسال شده در {$post.time}</p>
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
                        html += "<div class='cm-back'><p>نظر " + item.name +
                                " ثبت شده در " + item.time +
                                "<br/>" + item.content +
                                "</p></div>";
                    });
                    $(".comments-area-" + pid).html(html);
                });
    });
    $(".show-content").click(function () {
        $(".hidden-content").css("display", "block");
        $(".show-content").css("display", "none");
    });
</script>