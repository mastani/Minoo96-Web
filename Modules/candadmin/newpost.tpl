<form id="form" method="post" action="" class="form form-horizontal col-md-12" enctype="multipart/form-data">
    <h2>پست جدید</h2>
    <hr class="colorgraph">
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">عنوان پست</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" value="{$smarty.post.title}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="body" class="col-sm-2 control-label">متن پست</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="4" name="body" value="{$smarty.post.body}" required ></textarea>
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