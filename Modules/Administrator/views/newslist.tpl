<script type="text/javascript" src="{$smarty.const.DEFAULT_PATH}/Theme/JS/jquery.confirm.min.js"></script>
{if isset($msg)}
    <div class="alert alert-info" id="message">{$msg}</div>
{/if}
<div class="panel panel-default panel-table">
    <div class="panel-heading">
        <div class="row">
            <div class="col col-xs-6">
                <h3 class="panel-title">خبر های ارسال شده</h3>
            </div>
            <div class="col col-xs-6 text-left">
                <a class="btn btn-sm btn-primary btn-create" href="{$smarty.const.DEFAULT_PATH}/Administrator/newnews">ارسال خبر جدید</a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-list">
            <thead>
            <tr>
                <th>عنوان</th>
                <th>تاریخ ارسال</th>
                <th><em class="fa fa-cog"></em></th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$news item=v}
                <tr>
                    <td>{$v.title}</td>
                    <td>{$v.time}</td>
                    <td align="center" id="{$v.id}" onclick="setid(this.id)">
                        <a class="btn btn-default"  onclick="sendpostid('edit',this.parentNode.id)"><em class="fa fa-pencil"></em></a>
                        <a class="btn btn-danger confirm"><em class="fa fa-trash"></em></a>
                    </td>
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
                            <li class="page-item"><a class="page-link" href="{$smarty.const.DEFAULT_PATH}/Administrator/newslist/{$activepage-1}">قبلی</a></li>
                        {/if}

                        {for $i=1 to $pages}
                            {if ($activepage == $i)}
                                <li class="page-item active">
                                    <a class="page-link" href="#">{$i} <span class="sr-only">(current)</span></a>
                                </li>
                            {else}
                                <li class="page-item"><a class="page-link" href="{$smarty.const.DEFAULT_PATH}/Administrator/newslist/{$i}">{$i}</a></li>
                            {/if}
                        {/for}

                        {if ($activepage == $pages)}
                            <li class="page-item disabled"><a class="page-link" href="#">قبلی</a></li>
                        {else}
                            <li class="page-item"><a class="page-link" href="{$smarty.const.DEFAULT_PATH}/Administrator/newslist/{$activepage+1}">بعدی</a></li>
                        {/if}
                    </ul>
                </td>
            </tfooter>
            {/if}
        </table>

    </div>
</div>
<form method="post" action="" id="form1">
    <input type="hidden" name="newsid" id="postid" value="">
</form>
<script type="text/javascript">
    $(".confirm").confirm({
        text: "برای حذف این مطلب مطمئن هستید؟",
        title: "حذف مطلب",
        confirm: function() {
            sendpostid('delete')
        },
        cancel: function() {
            // nothing to do
        },
        confirmButton: "بله پاک کن",
        cancelButton: "نه",
        post: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-default",
        dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
    });
    function setid(id) {
        $('#postid').val(id);
    }

    function sendpostid(operation, id) {

        if(operation == 'edit') {
            $('#form1').attr('action', '{$smarty.const.DEFAULT_PATH}/Administrator/editnews');
            $('#postid').val(id);
        }
        $('#form1').submit();
    }

</script>