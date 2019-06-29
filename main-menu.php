<?php
$sql =<<<HereDoc
select
  category_id,
  category_name
from menu_categories

HereDoc;

if ( !$sth = mysqli_query($dbh,$sql) ) { errorHandler(mysqli_error($dbh), $sql); return; }

if ( mysqli_num_rows($sth) > 0 ) {
  echo <<<HereDoc
<div class="accordion" id="categories">

HereDoc;

  while ( $row = mysqli_fetch_array($sth) ) {
    foreach ( $row as $key => $val ) {
      $$key = $val;
    }
    echo <<<HereDoc
<div class="card">
  <div class="card-header" id="item-${category_id}"><button class="btn btn-link text-decoration-none" type="button" data-toggle="collapse" data-target="#cat-${category_id}">$category_name</button></div>

  <div id="cat-${category_id}" class="collapse" data-parent="#categories">
    <div class="card-body">

HereDoc;
    menuItemsDisplay($category_id);
    echo <<<HereDoc

    </div>
  </div>
</div>

HereDoc;
  }
  echo <<<HereDoc
</div>

HereDoc;
}


function menuItemsDisplay($category_id) {
  global $dbh;

  $sql =<<<HereDoc
select
  item_id,
  category_id,
  item,
  price,
  calories,
  description
from menu_items
where category_id = $category_id

HereDoc;

  if ( !$sth = mysqli_query($dbh,$sql) ) { errorHandler(mysqli_error($dbh), $sql); return; }

  if ( mysqli_num_rows($sth) > 0 ) {

    while ( $row = mysqli_fetch_array($sth) ) {
      foreach ( $row as $key => $val ) {
        $$key = $val;
      }

      echo <<<HereDoc

      <div class="card mb-2 p-2">
        <h5>$item <span class="float-right mr-2 badge badge-success">$ $price</span></h5>

        <div class="row">
          <div class="col-3">
            <img src="/restaurant/images/menu-item.png" style="width:100px;height:auto;padding-right:10px;" alt="$item"/>
          </div>
          <div class="col-7">
            $description<br/>
            $calories Calories
          </div>
          <div class="col-2"><a class="mb-0" href="/restaurant/?w=menu_if&amp;item_id=$item_id"><i class="fas fa-pencil-alt"></i></a></div>
        </div>

      </div>

HereDoc;
    }
  } else {
    echo <<<HereDoc
<div class="alert alert-primary">No items in this category today</div>

HereDoc;
  }
}


