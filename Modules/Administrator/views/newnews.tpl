{if isset($msg)}
    <div class="alert alert-info" id="message">{$msg}</div>
{/if}
<form id="form" method="post" action="" class="form form-horizontal col-md-12" enctype="multipart/form-data">
    <h2>خبر جدید</h2>
    <hr class="colorgraph">
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">عنوان خبر</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" value="{$smarty.post.title}" required>
        </div>
    </div>
    <div class="form-group">
        <label for="body" class="col-sm-2 control-label">متن خبر</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="4" name="body" required >{$smarty.post.body}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="image" class="col-sm-2 control-label">تصویر ضمیمه</label>
        <div class="col-sm-10">
            <input type="file" class="form-control"  name="image">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <input id="submit" name="submit" type="submit" value="ذخیره" class="btn btn-primary">
        </div>
    </div>

</form>