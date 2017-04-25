<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <form id="form" method="post" action="" class="form form-horizontal col-md-10" enctype="multipart/form-data">
            <h2>
                <small>ضمن عرض سلام و آرزوی موفقیت برای شما کاندید گرامی. لطفا اطلاعات فرم زیر را به دقت
                    تکمیل نمایید.
                </small>
            </h2>
            <hr class="colorgraph">
            {if isset($success)}
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            ثبت نام شما با موفقیت انجام شد.
                        </div>
                    </div>
                </div>
            {/if}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="name" id="name" class="form-control"
                                   placeholder="نام و نام خانوادگی"
                                   required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="father_name" id="father_name" class="form-control"
                                   placeholder="نام پدر" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="birthday" id="birthday" class="form-control"
                                   placeholder="تاریخ تولد"
                                   required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="hezb" id="hezb" class="form-control"
                                   placeholder="گرایش سیاسی (حزب)"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="tahsilat" id="tahsilat" class="form-control"
                                   placeholder="آخرین مقطع تحصیلی" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="reshteh" id="reshteh" class="form-control"
                                   placeholder="رشته آخرین مدرک تحصیلی" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="re_candidate">آیا سابقه نمایندگی در شورای شهر را داشته اید ؟</label>
                            <input type="radio" name="re_candidate" id="re_candidate" value="yes"/> بله
                            <input type="radio" name="re_candidate" id="re_candidate" value="no" checked/> خیر
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="tchannel" id="tchannel" class="form-control"
                                   placeholder="آدرس کانال تلگرام خود را وارد کنید (اختیاری)"/>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea name="other_tahsilat" id="other_tahsilat" class="form-control" rows="4"
                                      placeholder="دیگر سوابق تحصیلی"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea name="savabegh_kari" id="savabegh_kari" class="form-control" rows="4"
                                      placeholder="سوابق کاری"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea name="bio" id="bio" class="form-control" rows="4"
                                      placeholder="بیوگرافی"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="image">تصویر 3*4 خود را انتخاب کنید</label>
                            <input type="file" class="form-control" name="image" required>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="col-md-4"></div>
            <div class="form-group">
                <div class="col-md-4">
                    <button type="submit" name="register" class="btn btn-info btn-block">ثبت اطلاعات</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            var elements = document.getElementsByTagName("INPUT");
            for (var i = 0; i < elements.length; i++) {
                elements[i].oninvalid = function (e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        switch (e.srcElement.id) {
                            case "name":
                                e.target.setCustomValidity("نام خود را وارد کنید.");
                                break;
                            case "father_name":
                                e.target.setCustomValidity("نام پدر خود را وارد کنید.");
                                break;
                            case "birthday":
                                e.target.setCustomValidity("تاریخ تولد خود وارد کنید.");
                                break;
                            case "tahsilat":
                                e.target.setCustomValidity("آخرین مدرک تحصیلی خود وارد کنید.");
                                break;
                            case "reshteh":
                                e.target.setCustomValidity("رشته خود را وارد کنید.");
                                break;
                        }
                    }
                };
                elements[i].oninput = function (e) {
                    e.target.setCustomValidity("");
                };
            }
        })
    </script>
</div>