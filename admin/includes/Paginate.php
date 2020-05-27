<?php 


class Paginate {

    public $current_page;
    public $items_per_page;
    public $total_items_count;

    public function __construct($current_page = 1,$items_per_page = 4,$total_items_count = 40) {
        $this->current_page = $current_page;
        $this->items_per_page = $items_per_page;
        $this->total_items_count = $total_items_count;
    }

    // method to make next page 

    public function next() {
          return $this->current_page + 1;
    }

    // method to make previous page 

    public function previous() {
            return $this->current_page - 1;
      }

    //   method to find out the total pages 

    public function total_pages() {
        return ceil($this->total_items_count / $this->items_per_page);
    }

    // method to check if we has previous page 

    public function has_previous() {
        return $this->previous() >= 1 ? true : false;
    }

     // method to check if we has next page 

     public function has_next() {
        return $this->next() <= $this->total_pages() ? true : false;
    }

    // method to set the offset that we will skip 

    public function offset() {
        return ($this->current_page - 1) * $this->items_per_page;
    }

}



