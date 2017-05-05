<div class="container" id="Candidates">

    <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3 class="gallery-title"><img src="../Theme/Images/list.png"/> لیست نامزدهای انتخاباتی شهرستان مینودشت در سال 96</h3>
    </div>

    <div align="right" style="padding-right: 15px;">
        <button class="btn btn-default filter-button active" data-filter="all">همه ی نامزد ها</button>
        <button class="btn btn-default filter-button" data-filter="gentleman">آقایان</button>
        <button class="btn btn-default filter-button" data-filter="ladies">خانم ها</button>
        <button class="btn btn-default filter-button" data-filter="recandidate">شورا های سابق</button>
    </div>

    <div class="row">
        {foreach from=$candidates_array item=candidate}
            <div class="candidate_item col-xs-6 col-sm-4 col-md-3 col-lg-2 filter {$candidate.filter}">
                <a href="Profile/{$candidate.profile_name}">
                    <img class="candidate_image" src="{$candidate.image}">
                    <br/>
                    <p class="cand-name"><strong>{$candidate.name}</strong></p>
                </a>
            </div>
        {/foreach}
    </div>
</div>

<div class="container">
    <br/><br/>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3 class="gallery-title"><img src="../Theme/Images/news.png"/> آخرین اخبار انتخابات</h3>
    </div>
    <br/><br/><br/><br/><br/>

    {foreach from=$news_array item=news}
        <div class="col-md-6 news">
            <div class="title">
                <span class="fa fa-newspaper-o"></span>
                {$news.title}
            </div>
            <div class="separator"></div>
            <div class="content">
                <img class="news_image full" src="{$news.image}"/>
                <p class="more-post">{$news.content}</p>
            </div>
                <span class="time">{$news.time}</span>
        </div>
    {/foreach}
</div>