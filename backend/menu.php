<?php
include 'db_connection.php';
$sql = "SELECT menus.id AS menu_id, menus.name AS menu_name, submenus.id AS submenu_id, submenus.name AS submenu_name
        FROM menus
        LEFT JOIN submenus ON menus.id = submenus.menu_id
        ORDER BY menus.id, submenus.id";
$result = $conn->query($sql);
$menus = array();
while ($row = $result->fetch_assoc()) {
  $menuId = $row['menu_id'];
  $submenuId = $row['submenu_id'];
  if (!isset($menus[$menuId])) {
    $menus[$menuId] = array('name' => $row['menu_name'], 'submenus' => array());
  }

  if ($submenuId !== null) {
    $menus[$menuId]['submenus'][$submenuId] = array('name' => $row['submenu_name']);
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu Example</title>
  <style>
  </style>
</head>

<body>

  <nav>
    <ul>
      <?php foreach ($menus as $menu): ?>
        <li>
          <?php $menu['name']; ?>
          <?php if (!empty($menu['submenus'])): ?>
            <ul>
              <?php foreach ($menu['submenus'] as $submenu): ?>
                <li>
                  <?= $submenu['name']; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </nav>


  </head>
  <header>
    <nav class="menu">
      <?php foreach ($menus as $menu): ?>
        <li class="sub-menu"><a href="">
            <?= $menu['name']; ?>
          </a>
          <?php if (!empty($menu['submenus'])): ?>
            <nav class="sub-menu-items">
              <?php foreach ($menu['submenus'] as $submenu): ?>
            <li><a href="">
                <?= $submenu['name']; ?>
              </a></li>
          <?php endforeach; ?>

        </nav>
      <?php endif; ?>
      </li>
    <?php endforeach; ?>

    </nav>
  </header>
  <style>
    *,
    *:before,
    *:after {
      box-sizing: border-box;
    }

    a {
      text-decoration: none;
      color: #ffffff;
      font-family: roboto;
      transition: all 0.15s linear;
    }

    body {
      /* background: #333; */
      padding: 0;
      margin: 0;
    }

    header {
      width: 100%;
      background-color: #55acee;
      padding: 2rem 10rem;
      position: relative;
    }

    .menu {
      position: relative;
    }

    .menu>li {
      list-style: none;
      display: inline-block;
    }

    .menu>li>a {
      padding: 2rem;
      position: relative;
    }

    .menu>li>a:hover {
      background-color: rgba(0, 0, 0, 0.17);
      color: #eee;
    }

    .sub-menu {
      position: relative;
    }

    .sub-menu-items {
      position: absolute;
      background-color: white;
      float: left;
      width: 0rem;
      box-shadow: 0 7px 15px rgba(0, 0, 0, 0.85);
      display: inline;
      opacity: 0;
      transition: all 0.25s linear;
      transform: translateX(-20px);
      visibility: hidden;
      top: 3.3rem;
    }

    .sub-menu:hover .sub-menu-items {
      opacity: 1;
      display: block;
      transform: translateX(0px);
      transition: all 0.25s linear;
      visibility: visible;
      width: 20rem;
    }

    .sub-menu-items>li {
      display: block;
      float: left;
      width: 100%;
      position: relative;
      border-bottom: 1px solid #eee;
    }

    .sub-menu-items>li:last-child {
      border: none;
    }

    .sub-menu-items>li>a {
      display: inline-block;
      width: 100%;
      float: left;
      padding: 1.5rem 1rem;
      border-left: 7px solid transparent;
      position: relative;
      color: #333;
      background-color: #f8f8f8;
    }

    .sub-menu-items>li>a:hover {
      background-color: white;
      border-left: 7px solid #55acee;
    }

    nav.menu li.sub-menu:hover>a {
      background-color: rgba(0, 0, 0, 0.17);
    }
  </style>

</body>

</html>