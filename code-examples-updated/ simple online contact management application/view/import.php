<h2> Import Contacts from CSV File </h2>

<form enctype="multipart/form-data"  action="/import/csv" method="POST" >

<div class="form-group row">
    <label for="name" class="col-xs-2 col-form-label">Select File</label>
    <div class="col-xs-10">
        <input class="form-control" type="file" name="csvfile" >
    </div>
</div>


<div class="form-group row">
    <div class="col-xs-10">
        <input name="submit" type="submit" value="Submit" />
    </div>
</div>

</form>