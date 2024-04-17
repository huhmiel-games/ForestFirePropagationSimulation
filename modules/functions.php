<?php

function init(): void
{
    $str = file_get_contents('./config/config.json');
    $json = json_decode($str, true);

    $h = $json['h'];
    $l = $json['l'];
    $_SESSION['h'] = $h;
    $_SESSION['l'] = $l;
    $_SESSION['propagation'] = $json['propagation'];
    $total = $h * $l;
    $start_positions = $json['start_positions'];
    $trees = array();

    // create trees
    for ($i = 0; $i < $total; $i++) 
    {
        $pos_y = floor($i / $h);
        $pos_x = $i % $l;

        $tree = new Tree($pos_y, $pos_x);

        // add starting burning trees
        if (in_array($i, $start_positions)) 
        {
            $tree->set_is_burning();
        }

        array_push($trees, $tree);
    }

    $_SESSION['trees'] = $trees;
}

function must_burn(): bool
{
    return rand(0, 100) < $_SESSION['propagation'];
}

function propagate_fire(): string
{
    $trees = $_SESSION['trees'];
    $burning_trees_count = 0;

    // retrieve adjacent trees
    $arbres_update_needed = search_adjacent_trees();

    // update trees
    for ($i = 0; $i < count($arbres_update_needed); $i++)
    {
        $must_burn = must_burn();

        if ($must_burn == true)
        {
            $index = $arbres_update_needed[$i];
            $trees[$index]->set_is_burning();
            $burning_trees_count += 1;
        }
    }

    return display_buttons($burning_trees_count);
}

function search_adjacent_trees(): array
{
    $trees = $_SESSION['trees'];
    $length = count($trees);

    $adjacent_trees_index = array();

    // search burning trees
    for ($i = 0; $i < $length; $i++) {
        if ($trees[$i]->state != State::IS_BURNING)
        {
            continue;
        }

        $trees[$i]->set_has_burn();

        // retrieve index of adjacent trees 
        for ($j = 0; $j < $length; $j++) {
            if ($trees[$j]->state != State::IS_SAFE)
            {
                continue;
            }

            if (
                ($trees[$j]->pos_x == $trees[$i]->pos_x + 1 && $trees[$j]->pos_y == $trees[$i]->pos_y) ||
                ($trees[$j]->pos_x == $trees[$i]->pos_x - 1 && $trees[$j]->pos_y == $trees[$i]->pos_y) ||
                ($trees[$j]->pos_y == $trees[$i]->pos_y + 1 && $trees[$j]->pos_x == $trees[$i]->pos_x) ||
                ($trees[$j]->pos_y == $trees[$i]->pos_y - 1 && $trees[$j]->pos_x == $trees[$i]->pos_x)
            )
            {
                array_push($adjacent_trees_index, $j);
            }
        }
    }

    return $adjacent_trees_index;
}