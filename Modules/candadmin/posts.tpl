<script type="text/javascript" src="{$smarty.const.DEFAULT_PATH}/Theme/JS/jquery.confirm.min.js"></script>
<div class="panel panel-default panel-table">
    <div class="panel-heading">
        <div class="row">
            <div class="col col-xs-6">
                <h3 class="panel-title">پست های ارسال شده</h3>
            </div>
            <div class="col col-xs-6 text-left">
                <a class="btn btn-sm btn-primary btn-create" href="{$smarty.const.DEFAULT_PATH}/candadmin/dashboard/new">ارسال پست جدید</a>
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
            {foreach from=$posts item=v}
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
        </table>

    </div>
</div>
<form method="post" action="" id="form1">
    <input type="hidden" name="postid" id="postid" value="">
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
            $('#form1').attr('action', '{$smarty.const.DEFAULT_PATH}/candadmin/dashboard/edit');
            $('#postid').val(id);
        }
        $('#form1').submit();
    }
</script>