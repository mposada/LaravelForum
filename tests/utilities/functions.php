<?php
/**
 * Created by Miguel Posada.
 *
 * lets make easier implement other functions...
 */

function create($class, $attributes = []) {
    return factory($class)->create($attributes);
}

function make($class, $attributes = []) {
    return factory($class)->make($attributes);
}