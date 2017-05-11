<div class="container">
    <br/><br/>
    <div class="row" style="margin: 0 auto;">
        <div class="col-md-5" style="width: 100%;">
            <h1>نظر سنجی اول</h1>
            <h3>به نظر شما کدام یک از کاندیدا های زیر می توانند به شورا راه پیدا کنند ؟
                <small>حداکثر 5 نفر را می توانید انتخاب کنید</small>
            </h3>
            <div class="colorgraph"></div>
            <br/>
            <form action="" method="post">
                {if $can_see eq '1'}
                    {foreach from=$cands item=cand}
                        <div class="checkbox">
                            <label style="font-size: 16px"><input class="checkb" type="checkbox" name="vote[]"
                                                                  value="cand{$cand.id}">{$cand.name}</label>
                        </div>
                    {/foreach}
                {/if}
                {if $voted eq '1'}
                    <p>شما قبلا رای داده اید.</p>
                {/if}
                {if $see_result eq '1'}
                    {foreach from=$result item=res}
                        <p>تعداد رای <strong>{$res.name}</strong> : {$res.votes}</p>
                    {/foreach}
                {/if}
                {if $can_see eq '1'}
                    <button type="submit" name="submit" value="submit" class="btn btn-success">ثبت رای</button>
                {/if}
                <button type="submit" name="result" value="result" class="btn btn-success">مشاهده نتایج</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $.fn.limit = function (n) {
            var self = this;
            this.click(function () {
                (self.filter(":checked").length == n) ?
                    self.not(":checked").attr("disabled", true).addClass("alt") :
                    self.not(":checked").attr("disabled", false).removeClass("alt");
            });
        };

        $("input:checkbox").limit(5);
    });
</script>