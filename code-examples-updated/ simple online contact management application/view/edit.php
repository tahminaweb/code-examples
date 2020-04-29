<h2> Edit Contact # <?= @$message['data']['id']?> </h2>
<form action="/contacts/<?= @$message['data']['id']?>" method="post">

<div class="form-group row">
    <label for="name" class="col-xs-2 col-form-label">Name (*)</label>
    <div class="col-xs-10">
        <input class="form-control" type="text" name="name" value="<?= @$message['data']['name']?>" >
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-xs-2 col-form-label">Email (*)</label>
    <div class="col-xs-10">
        <input class="form-control" type="email"  id="email" name="email" value="<?= @$message['data']['email']?>">
    </div>
</div>
<div class="form-group row">
    <label for="url" class="col-xs-2 col-form-label">URL</label>
    <div class="col-xs-10">
        <input class="form-control" type="url" id="url" name="url" value="<?= @$message['data']['www']?>">
    </div>
</div>
<div class="form-group row">
    <label for="work_phone" class="col-xs-2 col-form-label">Work Phone</label>
    <div class="col-xs-10">
        <input class="form-control" type="tel"  id="work_phone" name="work_phone" value="<?= @$message['data']['work_phone']?>">
    </div>
</div>

<div class="form-group row">
    <label for="Mobile" class="col-xs-2 col-form-label">Mobile</label>
    <div class="col-xs-10">
        <input class="form-control" type="tel"  id="mobile" name="mobile" value="<?= @$message['data']['mobile']?>">
    </div>
</div>

<div class="form-group row">
    <label for="address" class="col-xs-2 col-form-label">Address (*)</label>
    <div class="col-xs-10">
        <textarea name="address" rows="5" cols="70"><?= @$message['data']['address']?></textarea>
    </div>
</div>


    <div class="form-group row">
        <label for="address" class="col-xs-2 col-form-label">Category</label>
        <div class="col-xs-10">
            <select name="category">
                <option value="Friend" <?=$message['data']['category'] == 'Friend'? 'selected':''; ?>>Friend</option>
                <option value="Family" <?=$message['data']['category'] == 'Family'? 'selected':''; ?> >Family</option>
                <option value="Colleague" <?=$message['data']['category'] == 'Colleague'? 'selected':''; ?> >Colleague</option>
            </select>
        </div>
    </div>


    <div class="form-group row">
        <div class="col-xs-10">
            <input name="submit" type="submit" value="Submit" />
        </div>
    </div>

</form>