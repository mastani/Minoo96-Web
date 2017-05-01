<div class="container">
    <div class="row" id="News">
        {foreach from=$news_array item=news}
            <div class="news">
                <div class="title">
                    <span class="fa fa-newspaper-o"></span>
                    {$news.title}
                    <span class="time">{$news.time}</span>
                </div>
                <div class="separator"></div>
                <div class="content">
                    <img class="news_image" src="{$news.image}"/>
                    <br/>
                    <p>{$news.content}</p>
                </div>
            </div>
        {/foreach}
    </div>
</div>