<?php
# get submitted values from the form..

$item_id = isset($_REQUEST['item_id']) ? preg_replace("/\D/",null,$_REQUEST['item_id']) : null;
$category_id = isset($_REQUEST['category_id']) ? preg_replace("/\D/",null,$_REQUEST['category_id']) : null;
$item = isset($_REQUEST['item']) ? prettyStr($_REQUEST['item']) : null;
$price = isset($_REQUEST['price']) ? preg_replace("/[^0-9\.]/",null,$_REQUEST['price']) : null;
$calories = isset($_REQUEST['calories']) ? preg_replace("/\D/",null,$_REQUEST['calories']) : null;
$description = isset($_REQUEST['description']) ? $_REQUEST['description'] : null;
$event = (isset($_REQUEST['event']) && !empty($_REQUEST['event'])) ? $_REQUEST['event'] : 'new';

# sanity check..
$errors = array();

if ( empty($category_id) ) { $errors[] = "Category is required"; }
if ( empty($item) ) { $errors[] = "Item is required"; }
if ( empty($price) ) { $errors[] = "Price is required"; }
if ( empty($calories) ) { $errors[] = "Calories count is required"; }
if ( empty($description) ) { $errors[] = "Description is required"; }

# now check whether we have errors..
if (count($errors)) {

  echo <<<HereDoc
<div class="card">
  <div class="card-header bg-warning text-white">Please review the following:</div>
  <div class="card-body">
  <ol>

HereDoc;

  foreach ($errors as $error_item) {
    echo "<li>$error_item</li>";
  }
  echo <<<HereDoc
  </ol>
  </div>
</div><br/>

HereDoc;

  include_once __DIR__ . '/forms/menu-items-form.php';
  
  return;
}

# we are adding this section to enhance the security of submitted form
# notice that we are explicitly stripping out unsafe characters
# setting null to variables that are empty

$item_id = empty($item_id) ? 'NULL' : $item_id;
$category_id = empty($category_id) ? 'NULL' : $category_id;
$item = empty($item) ? 'NULL' : "\"$item\"";
$price = empty($price) ? 'NULL' : $price;
$calories = empty($calories) ? 'NULL' : $calories;
$description = empty($description) ? 'NULL' : "\"$description\"";

# this section defines the SQL that is used to insert data to the database

$add_sql =<<<HereDoc
insert into menu_items (
  item_id,
  category_id,
  item,
  price,
  calories,
  description
) values (
  $item_id,
  $category_id,
  $item,
  $price,
  $calories,
  $description
)

HereDoc;

$update_sql =<<<HereDoc
update menu_items
set
  item_id = $item_id,
  category_id = $category_id,
  item = $item,
  price = $price,
  calories = $calories,
  description = $description
where item_id = $item_id
limit 1

HereDoc;

# here we're checking whether this is an update or new record so we can use the appropriate SQL
$sql = ($event == 'new') ? $add_sql : $update_sql;

if ( !mysqli_query($dbh, $sql) ) {
  errorHandler(mysqli_error($dbh), $sql);
  return;
} else {
   echo <<<HereDoc
<div class="alert alert-success alert-dismissible fade show">
  Menu item saved successfully!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

HereDoc;
  mainMenu();
}
