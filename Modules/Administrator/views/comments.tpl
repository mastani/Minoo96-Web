<link rel="stylesheet" href="{$smarty.const.DEFAULT_PATH}/Modules/Administrator/plugins/iCheck/all.css">

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">کامنت ها</h3>
                <span class="label label-success">تایید شده</span>
                <span class="label label-warning"> انتظار</span>
                <span class="label label-danger">غیر قابل انتشار </span>
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
                <form action="" method="post">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>متن</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                            <th>تغییر وضعیت</th>
                        </tr>
                        {foreach $comments as $comment}
                            <tr>
                                <td>{$comment.id}</td>
                                <td>{$comment.content}</td>
                                <td>
                                    {if ($comment.approved_id == 0)}{*pending*}
                                    <span class="label label-warning">انتظار</span></td>
                                {elseif (($comment.approved_id == -1))}{* deny *}
                                <span class="label label-danger">غیر قابل انتشار</span></td>
                                {elseif (($comment.approved_id > 0))}{* approved *}
                                <span class="label label-success">تایید شده</span></td>
                                {/if}
                                <td>{$comment.time}</td>
                                <td onclick="setstatus(this.parentNode)">
                                    <input onclick="alert(1)" type="radio" id="red{$comment.id}" name="{$comment.id}"
                                           {if ($comment.approved_id == -1)}checked{/if} value="-1">
                                    <input type="radio" id="yellow{$comment.id}" name="{$comment.id}"
                                           {if ($comment.approved_id == 0)}checked{/if}  value="0">
                                    <input type="radio" id="green{$comment.id}" name="{$comment.id}"
                                           {if ($comment.approved_id > 0)}checked{/if} value="{$userid}">
                                </td>
                            </tr>
                        {/foreach}
                        </tbody>
                        <tfooter>
                            <td>
                                   <ul class="pagination">
                                       {if ($activepage == 1)}
                                           <li class="page-item disabled"><a class="page-link" href="#">قبلی</a></li>
                                       {else}
                                           <li class="page-item"><a class="page-link" href="{$smarty.const.DEFAULT_PATH}/Administrator/comments/{$activepage-1}">قبلی</a></li>
                                       {/if}

                                       {for $i=1 to $pages}
                                           {if ($activepage == $i)}
                                               <li class="page-item active">
                                                   <a class="page-link" href="#">{$i} <span class="sr-only">(current)</span></a>
                                               </li>
                                           {else}
                                               <li class="page-item"><a class="page-link" href="{$smarty.const.DEFAULT_PATH}/Administrator/comments/{$i}">{$i}</a></li>
                                           {/if}
                                       {/for}

                                       {if ($activepage == $pages)}
                                           <li class="page-item disabled"><a class="page-link" href="#">قبلی</a></li>
                                       {else}
                                           <li class="page-item"><a class="page-link" href="{$smarty.const.DEFAULT_PATH}/Administrator/comments/{$activepage+1}">بعدی</a></li>
                                       {/if}


                                   </ul>
                            </td>
                            <td>
                                <input style="margin-top: 20px" name="submit" type="submit" value="ذخیره تغییرات" class="btn btn-block btn-primary">
                            </td>
                        </tfooter>
                    </table>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>

{if isset($msg)}
    <div id="msg" class="alert alert-success col-md-3" style="position: fixed;bottom: 20px;z-index: 9999;left: 10px;"  role="alert">{$msg}</div>
{/if}
<script type="text/javascript"
        src="{$smarty.const.DEFAULT_PATH}/Modules/Administrator/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function () {
        $('[id^=red]').iCheck({
            checkboxClass: 'icheckbox_square-red',
            radioClass: 'iradio_square-red',
            increaseArea: '20%' // optional
        });
        $('[id^=yellow]').iCheck({
            checkboxClass: 'icheckbox_square-yellow',
            radioClass: 'iradio_square-yellow',
            increaseArea: '20%' // optional
        });
        $('[id^=green]').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '20%' // optional
        });

        if($('#msg'))
            $('#msg').delay(2500).fadeOut();


    });

</script>