<div class="container">
    <div class="row" id="News">
        {foreach from=$news_array item=news}
            <div class="news">
                <div class="title">
                    <span class="fa fa-newspaper-o"></span>
                    {$news.title}
                    <span class="time1">{$news.time}</span>
                </div>
                <div class="separator"></div>
                <div class="content1">
                    <img class="news_image1" src="{$news.image}"/>
                    <p class="full-post">{$news.content}</p>
                </div>
            </div>
        {/foreach}
    </div>
</div>