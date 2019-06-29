<?php
error_reporting(E_ALL);
$page_title = "Restaurant Menu";
include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/lib/db.php';


# this line captures the requested "action", it tells us what to do..
$action = (isset($_REQUEST['w']) ? $_REQUEST['w'] : null);

$options = array(
  'menu'    => 'mainMenu',
  'menu_cf' => 'menuCategoryForm',
  'menu_c'  => 'menuCategoryAPI',
  'menu_if' => 'menuItemForm',
  'menu_i'  => 'menuItemAPI',
);

# check whether we have configured a function for each action we are expecting..

if (array_key_exists($action, $options)) {
  $function = $options[$action];
  call_user_func($function);
} else {
  mainMenu();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/web-assets/tpl/app_footer.php';

function mainMenu() {
  global $dbh;
  include_once __DIR__ . '/main-menu.php';
}

function menuCategoryForm() {
  global $dbh,
    $category_id,
    $category_name,
    $event;
  include_once __DIR__ . '/forms/menu-categories-form.php';
}

function menuCategoryAPI() {
  global $dbh;
  include_once __DIR__ . '/menu-category-api.php';
}

function menuItemForm() {
  global $dbh,
    $category_id,
    $item,
    $price,
    $calories,
    $description,
    $event;

  $item_id = ( isset($_REQUEST['item_id']) ) ? preg_replace("/\D/",null,$_REQUEST['item_id']) : null;
  $event = (isset($_REQUEST['event']) && !empty($_REQUEST['event'])) ? $_REQUEST['event'] : 'new';

  if ($item_id) {
    $sql =<<<HereDoc
select
  item_id,
  category_id,
  item,
  price,
  calories,
  description,
  'update' as event
from menu_items
where item_id = $item_id

HereDoc;

     if ( !$sth = mysqli_query($dbh,$sql) ) { errorHandler(mysqli_error($dbh), $sql); return; }

     while ( $row = mysqli_fetch_array($sth) ) {
      foreach ( $row as $key => $val ) {
        $$key = $val;
      }
    }
  }
  include_once __DIR__ . '/forms/menu-items-form.php';
}

function menuItemAPI() {
  global $dbh;
  include_once __DIR__ . '/menu-item-api.php';
}

