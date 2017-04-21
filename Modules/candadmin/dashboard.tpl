<link rel="stylesheet" href="/Theme/CSS/bootstrap_table.css">

{include file="./sidebar.tpl"}
<div class="col-md-9">
  <div class="profile-content">
    <div class="col-md-12">

      <div class="panel panel-default panel-table">
        <div class="panel-heading">
          <div class="row">
            <div class="col col-xs-6">
              <h3 class="panel-title">پست های ارسال شده</h3>
            </div>
            <div class="col col-xs-6 text-left">
              <button type="button" class="btn btn-sm btn-primary btn-create">ارسال پست جدید</button>
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
                <td align="center">
                  <a class="btn btn-default"><em class="fa fa-pencil"></em></a>
                  <a class="btn btn-danger"><em class="fa fa-trash"></em></a>
                </td>
              </tr>
             {/foreach}
            </tbody>
          </table>

        </div>
        <div class="panel-footer">
          <!-- <div class="row">
            <div class="col col-xs-4">Page 1 of 5
            </div>
            <div class="col col-xs-8">
              <ul class="pagination hidden-xs pull-right">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
              </ul>
              <ul class="pagination visible-xs pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>
          </div> -->
        </div>
      </div>

<!-- below tags for sidebar -->
    </div>
  </div>
</div>
</div>