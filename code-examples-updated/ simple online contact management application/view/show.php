<h2> Contact # <?= @$message['data']['id']?> </h2>


<div class="form-group row">
    <label for="name" class="col-xs-2 col-form-label">Name (*)</label>
    <div class="col-xs-10">
        <?= @$message['data']['name']?>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-xs-2 col-form-label">Email (*)</label>
    <div class="col-xs-10">
        <?= @$message['data']['email']?>
    </div>
</div>
<div class="form-group row">
    <label for="url" class="col-xs-2 col-form-label">URL</label>
    <div class="col-xs-10">
        <?= @$message['data']['www']?>
    </div>
</div>
<div class="form-group row">
    <label for="work_phone" class="col-xs-2 col-form-label">Work Phone</label>
    <div class="col-xs-10">
        <?= @$message['data']['work_phone']?>
    </div>
</div>

<div class="form-group row">
    <label for="Mobile" class="col-xs-2 col-form-label">Mobile</label>
    <div class="col-xs-10">
        <?= @$message['data']['mobile']?>
    </div>
</div>

<div class="form-group row">
    <label for="address" class="col-xs-2 col-form-label">Address (*)</label>
    <div class="col-xs-10">
        <?= @$message['data']['address']?>
    </div>
</div>


    <div class="form-group row">
        <label for="address" class="col-xs-2 col-form-label">Category</label>
        <div class="col-xs-10">
            <?= @$message['data']['category']?>
        </div>
    </div>


    <div class="form-group row">
        <div class="col-xs-10">
            <a href="<?=  $this->app->getUrl('/contacts/'.$message['data']['id'].'/edit/') ?>" class="btn btn-default">Edit</a> &nbsp;
            <a href="<?= $this->app->getUrl('/contacts/'.$message['data']['id'].'/delete/') ?>" class="btn btn-default">Delete</a>
        </div>
    </div>

