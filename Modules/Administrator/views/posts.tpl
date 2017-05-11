<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">پست ها<small>(برای دیدین محتوای پست روی عنوان آن کلیک کنید)</small></h3>
                <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control input-sm pull-right"
                               placeholder="Search">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <th>نام کاندید</th>
                        <th>وضعیت</th>
                        <th>متن</th>
                        <th>تاریخ</th>
                    </tr>
                    {foreach $posts as $post}
                        <tr>
                            <td>{$post.id}</td>
                            <td>{$post.name}</td>
                            <td>
                                {if ($post.approved_id == 0)}{*pending*}
                                     <span class="label label-warning">انتظار</span></td>
                                {elseif (($post.approved_id == -1))}{* deny *}
                                     <span class="label label-danger">غیر قابل انتشار</span></td>
                                 {elseif (($post.approved_id > 0))}{* approved *}
                                     <span class="label label-success">تایید شده</span></td>
                            {/if}
                            <td><a data-toggle="modal" class="btn btn-link" id="{$post.id}">{$post.content}</a></td>
                            <td>{$post.time}</td>
                        </tr>
                    {/foreach}
                    </tbody>
                    {if ($pages>1)}
                    <tfooter>
                        <td>
                            <ul class="pagination">
                                {if ($activepage == 1)}
                                    <li class="page-item disabled"><a class="page-link" href="#">قبلی</a></li>
                                {else}
                                    <li class="page-item"><a class="page-link" href="{$smarty.const.DEFAULT_PATH}/Administrator/posts/{$activepage-1}">قبلی</a></li>
                                {/if}

                                {for $i=1 to $pages}
                                    {if ($activepage == $i)}
                                        <li class="page-item active">
                                            <a class="page-link" href="#">{$i} <span class="sr-only">(current)</span></a>
                                        </li>
                                    {else}
                                        <li class="page-item"><a class="page-link" href="{$smarty.const.DEFAULT_PATH}/Administrator/posts/{$i}">{$i}</a></li>
                                    {/if}
                                {/for}

                                {if ($activepage == $pages)}
                                    <li class="page-item disabled"><a class="page-link" href="#">قبلی</a></li>
                                {else}
                                    <li class="page-item "><a class="page-link" href="{$smarty.const.DEFAULT_PATH}/Administrator/posts/{$activepage+1}">بعدی</a></li>
                                {/if}

                            </ul>
                        </td>
                    </tfooter>
                    {/if}
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>

<script type="text/javascript">
    var postid;
    $(document).ready(function () {
        $('.btn-link').click(function() {
            postid = this.id;
            $.ajax({
                method: "POST",
                url: "{$smarty.const.DEFAULT_PATH}/Administrator/getpost",
                data: { id: this.id}
            })
                .done(function( msg ) {
                    setModal(msg);
                });
        });

        $('.modal-footer button').click(function() {
            $.ajax({
                method: "POST",
                url: "{$smarty.const.DEFAULT_PATH}/Administrator/setpostapprove",
                data: { postid: postid, approve: this.value}
            })
                .done(function (approve) {
                        if (approve == 0)
                            html = '<span class="label label-warning">انتظار</span>';
                        else if (approve == -1)
                            html = '<span class="label label-danger">غیر قابل انتشار</span>';
                        else if (approve > 0)
                            html = '<span class="label label-success">تایید شده</span>';

                    $('#'+postid).parent().prev().html(html);
                })
        });
    });
    function setModal(msg){
        post = JSON.parse(msg);
       $('#postbody').text(post.content);
       $('#myModal').modal('show');
    }

</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body" id="postbody"></div>
            <div class="modal-footer">
                <button type="button" value="1" class="btn btn-success"  data-dismiss="modal">تایید</button>
                <button type="button" value="-1" class="btn btn-danger" data-dismiss="modal">غیر قابل انتشار</button>
                <button type="button" value="0" class="btn btn-warning" data-dismiss="modal">انتظار</button>
            </div>
        </div>
    </div>
</div>