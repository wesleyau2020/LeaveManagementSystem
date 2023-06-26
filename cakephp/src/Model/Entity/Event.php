<?php
class Fruit {
    public $title;
    // public $description;
    public $start_date;
    // public $end_date;

  function set_title($title) {
    $this->title = $title;
  }
  function get_title() {
    return $this->title;
  }
  function set_start_date($start_date) {
    $this->start_date = $start_date;
  }
  function get_start_date() {
    return $this->start_date;
  }
}
?>