<?php

class Song {
    public $title;
    public $sub_title;
    public $lyrics;
    public $id;

    function set_title($title) {
        $this->title = $title;
    }

    function set_sub_title($sub_title) {
        $this->sub_title = $sub_title;
    }

    function set_lyrics($lyrics) {
        $this->lyrics = $lyrics;
    }

    function set_id($id) {
        $this->id = $id;
    }

    function get_title() {
        return $this->title;
    }

    function get_sub_title() {
        return $this->sub_title;
    }

    function get_lyrics() {
        return nl2br($this->lyrics);
    }

    function get_id() {
        return $this->id;
    }

}

?>