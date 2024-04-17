<?php

function render_html($content)
{
    include($_SERVER['DOCUMENT_ROOT'] . '/templates/head.php');
    echo $content;
    include($_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php');
}

function display_trees(): string
{
    $h = $_SESSION['h'];
    $l = $_SESSION['l'];
    $total = $h * $l;
    $trees = $_SESSION['trees'];

    $content = "<div style=\"display: grid; grid-template-columns: repeat($l, 0fr); justify-content: center;\">";

    for ($i = 0; $i < $total; $i++) 
    {
        $content .= $trees[$i]->display();
    }

    $content .= '</div>';
    return $content;
}

function display_buttons(int $burning_trees_count = 1): string
{
    if ($burning_trees_count == 0)
    {
        return '<button href="/?next" class="button" disabled>next</button>
        <a href="/" class="button" disabled>reset</a>';
    }
    else
    {
        return '<a href="/?next" class="button" disabled>next</a>';
    }
}