<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{$comment_count}</h3>
                <p>کامنت جدید</p>
            </div>
            <div class="icon">
                <i class="fa fa-comments"></i>
            </div>
            <a href="{$smarty.const.DEFAULT_PATH}/Administrator/comments" class="small-box-footer">اطلاعات بیشتر <i
                        class="fa fa-arrow-circle-left"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{$post_count}</h3>
                <p>پست جدید</p>
            </div>
            <div class="icon">
                <i class="fa fa-clone"></i>
            </div>
            <a href="{$smarty.const.DEFAULT_PATH}/Administrator/posts" class="small-box-footer">اطلاعات بیشتر <i
                        class="fa fa-arrow-circle-left"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{$candidate_count}</h3>
                <p>کاندید ثبت نام کرده</p>
            </div>
            <div class="icon">
                <i class="fa fa-user" style="top: 10px"></i>
            </div>
            <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{$news_count}</h3>
                <p>خبر ثبت شده</p>
            </div>
            <div class="icon">
                <i class="fa fa-newspaper-o"></i>
            </div>
            <a href="{$smarty.const.DEFAULT_PATH}/Administrator/newslist" class="small-box-footer">اطلاعات بیشتر <i
                        class="fa fa-arrow-circle-left"></i></a>
        </div>
    </div><!-- ./col -->
</div>

<div class="row">
    <div class="col-md-12">
        <!-- USERS LIST -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">نامزدها</h3>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
                <ul class="users-list clearfix">
                    {foreach $candidates as $candidate}
                    <li>
                        <img src="{$candidate.image}" alt="User Image">
                        <a class="users-list-name" target="_bl" href="http://www.minoo96.ir/Profile/{$candidate.profile_name}">{$candidate.name}</a>
                    </li>
                    {/foreach}
                </ul><!-- /.users-list -->
            </div><!-- /.box-body -->
        </div><!--/.box -->
    </div>
</div>

<div class="row">
    <div class="col-xs-4">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">آخرین کامنت ها</h3>
            </div>
            <div class="box-body table-responsive no-padding">{*show comments*}
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>متن</th>
                        <th>وضعیت</th>
                    </tr>
                    {foreach $comments_top as $comment}
                        <tr>
                            <td>{$comment.content}</td>
                            <td>
                                {if ($comment.approved_id == 0)}{*pending*}
                                <span class="label label-warning">انتظار</span></td>
                            {elseif (($comment.approved_id == -1))}{* deny *}
                            <span class="label label-danger">غیر قابل انتشار</span></td>
                            {elseif (($comment.approved_id > 0))}{* approved *}
                            <span class="label label-success">تایید شده</span></td>
                            {/if}
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>{*end comments*}

    <div class="col-xs-4">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">آخرین پست ها</h3>
            </div>
            <div class="box-body table-responsive no-padding">{*show posts*}
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>متن</th>
                        <th>وضعیت</th>
                    </tr>
                    {foreach $posts_top as $post}
                        <tr>
                            <td>{$post.content}</td>
                            <td>
                                {if ($post.approved_id == 0)}{*pending*}
                                <span class="label label-warning">انتظار</span></td>
                            {elseif (($post.approved_id == -1))}{* deny *}
                            <span class="label label-danger">غیر قابل انتشار</span></td>
                            {elseif (($post.approved_id > 0))}{* approved *}
                            <span class="label label-success">تایید شده</span></td>
                            {/if}
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div> {*end posts*}

    <div class="col-xs-4">
        <div class="box box-warning ">
            <div class="box-header">
                <h3 class="box-title">آخرین خبر ها</h3>
            </div>
            <div class="box-body table-responsive no-padding">{*show comments*}
                <table class="table table-hover">
                    <tbody>
                    {foreach $news_top as $news}
                        <tr>
                            <td>{$news.title}</td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>{*end news*}
</div>