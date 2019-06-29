<form id="menu-categories" method="post" action="/restaurant/" class="needs-validation" novalidate>

<div class="card">
  <div class="card-header">Categories</div>
  <div class="card-body">

    <div class="form-group row">
      <label for="category_name" class="col-md-3 col-form-label">Category</label>
      <div class="col-md-9">
        <input class="form-control" name="category_name" name="category_name" value="<?php echo $category_name; ?>" required>
        <div class="invalid-feedback">Menu Category is required</div>
      </div>
    </div>

  </div>
</div><br/>

<!-- submit -->
<div class="card">
  <div class="card-header">Review and Submit</div>
  <div class="card-body">

    <div class="form-group">
      <input type="hidden" id="w" name="w" value="menu_c"/>
      <input type="hidden" id="event" name="event" value="<?php echo $event; ?>"/>
      <input type="hidden" id="category_id" name="category_id" value="<?php echo $category_id; ?>"/>
      <button type="submit" class="btn btn-primary">Continue</button>
    </div>

  </div>
</div>

</form>

