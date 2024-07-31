<?php
include $_SERVER['DOCUMENT_ROOT'] . "/admin/head.php";
include $_SERVER['DOCUMENT_ROOT'] . "/admin/nav.php"; 

switch(($_GET['action'] ?? "home")) {
  case ($_GET['action'] ?? "home"):
      include $_SERVER['DOCUMENT_ROOT']."/admin/".($_GET['action'] ?? "home").".php";
      break;
}

include $_SERVER['DOCUMENT_ROOT'] . "/admin/foot.php";