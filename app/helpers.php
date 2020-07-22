<?php

function flash($message, $level = 'success') {
    Session::flash('flash_message', $message);
    Session::flash('flash_message_level', $level);
}

function get_image_url($name) {
    return "http://www.hla.co.za/images/project_images/" . $name;
}
