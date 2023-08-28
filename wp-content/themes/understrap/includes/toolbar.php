<?php
global $word;
?>

<div class="toolbar">
    <div class="row">
        <div class="col-sm-3 col-5">
            <div class="form-group">
                <select class="form-control" id="dict-list">
                    <option value="anh-viet">Anh - Việt</option>
                    <option value="viet-anh">Việt - Anh</option>
                    <option value="phap-viet">Pháp - Việt</option>
                    <option value="viet-phap">Việt - Pháp</option>
                    <option value="duc-viet">Đức - Việt</option>
                    <option value="viet-duc">Việt - Đức</option>
                    <option value="y-viet">Ý - Việt</option>
                    <option value="viet-viet">Việt - Việt</option>
                </select>
            </div>
        </div>
        <div class="col-sm-9 col-7 pl-0">
            <form id="search-form" class="form-inline">
                <div class="input-group form-group mb-2 pl-0 ml-0">
                    <!--<input type="text" class="form-control" placeholder="Nhập từ cần tra" >-->
                    <input id="tim-kiem" type="text" class="form-control" placeholder="Nhập từ cần tra" aria-describedby="button-addon2" value="<?php echo $word; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">X</button>
                    </div>
                </div>
                <!--<button type="submit" class="btn btn-primary mb-2">Tìm</button>-->
            </form>
        </div>
    </div>
</div>