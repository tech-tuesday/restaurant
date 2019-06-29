<form id="menu-items" method="post" action="/restaurant/" class="needs-validation" novalidate>

<div class="card">
  <div class="card-header">Menu Item</div>
  <div class="card-body">

    <div class="form-group row">
      <label for="category_id" class="col-md-3 col-form-label">Category</label>
      <div class="col-md-9">
        <?php categoryList($category_id); ?>
        <div class="invalid-feedback">Menu Category is required</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="item" class="col-md-3 col-form-label">Item</label>
      <div class="col-md-9">
        <input type="text" class="form-control" id="item" name="item" value="<?php echo $item; ?>" required>
        <div class="invalid-feedback">Menu Item is required</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="price" class="col-md-3 col-form-label">Price</label>
      <div class="col-md-9 input-group">
        <div class="input-group-prepend"><span class="input-group-text">US $</span></div>
        <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>" required>
        <div class="invalid-feedback">Item price is required</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="calories" class="col-md-3 col-form-label">Calories</label>
      <div class="col-md-9">
        <input type="number" class="form-control" id="calories" name="calories" value="<?php echo $calories; ?>" required>
        <div class="invalid-feedback">Calory count is required</div>
      </div>
    </div>

    <div class="form-group row">
      <label for="description" class="col-md-3 col-form-label">Description</label>
      <div class="col-md-9">
        <textarea class="form-control" id="desription" name="description" required><?php echo $description; ?></textarea>
        <div class="invalid-feedback">Item Description is required</div>
      </div>
    </div>

  </div>
</div><br/>

<!-- submit -->
<div class="card">
  <div class="card-header">Review and Submit</div>
  <div class="card-body">

    <div class="form-group">
      <input type="hidden" id="w" name="w" value="menu_i"/>
      <input type="hidden" id="event" name="event" value="<?php echo $event; ?>"/>
      <input type="hidden" id="item_id" name="item_id" value="<?php echo $item_id; ?>"/>
      <button type="submit" class="btn btn-primary col-md-3">Continue</button>
    </div>

  </div>
</div>

</form>

<?php
function categoryList($category_id_sel=null) {
  global $dbh;

  $sql =<<<HereDoc
select
  category_id,
  category_name
from menu_categories

HereDoc;

  if ( !$sth = mysqli_query($dbh, $sql) ) { errorHandler(mysqli_error($dbh), $sql); return; }

echo <<<HereDoc
<select class="form-control" id="category_id" name="category_id" required>
<option value="">Select..</option>

HereDoc;

  $selected  = null;

  while ( $row = mysqli_fetch_array($sth) ) {
    foreach ( $row as $key => $val ) {
      $$key = $val;
    }

    $selected  = ($category_id == $category_id_sel) ? ' selected' : null;
    echo <<<HereDoc
<option value="$category_id"$selected>$category_name</option>

HereDoc;
  }

  echo <<<HereDoc
</select>

HereDoc;
}

