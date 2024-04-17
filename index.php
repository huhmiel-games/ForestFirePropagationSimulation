<?php
require_once (dirname(__FILE__) . "/modules/Tree.php");

session_start();

require_once (dirname(__FILE__) . "/modules/functions.php");
require_once (dirname(__FILE__) . "/modules/render.php");

$page_content = "";

// force reload on refresh page
$refreshButtonPressed = isset($_SERVER['HTTP_CACHE_CONTROL']) &&
    $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

if ($refreshButtonPressed)
{
    $_SESSION['trees'] = array();
    echo "<script>location.href='/';</script>";
    exit(0);
}

switch ($_SERVER['REQUEST_URI'])
{
    case '/':
        // start simulation
        init();
        $page_content .= display_buttons();
        $page_content .= display_trees();
        break;

    case '/?next':
        // avance simulation
        $page_content .= propagate_fire();
        $page_content .= display_trees();
        break;

    default:
        $page_content = 'nothing here ...';
}

render_html($page_content);
