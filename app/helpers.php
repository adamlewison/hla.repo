<?php

function flash($message, $level = 'success') {
    Session::flash('flash_message', $message);
    Session::flash('flash_message_level', $level);
}
