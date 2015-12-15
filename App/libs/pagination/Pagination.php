<?php

namespace App\libs\pagination;

class Pagination
{
    public $current_page;
    public $per_page;
    public $total_count;

    public function __construct($page = 1, $per_page = 20, $total_count = 0)
    {
        $this->current_page = (int) $page;
        $this->per_page = (int) $per_page;
        $this->total_count = (int) $total_count;
    }

    public function offset()
    {
        return ($this->current_page - 1) * $this->per_page;
    }

    public function total_pages()
    {
        return ceil($this->total_count / $this->per_page);
    }

    public function previous_page()
    {
        return $this->current_page - 1;
    }

    public function next_page()
    {
        return $this->current_page + 1;
    }

    public function has_previous_page()
    {
        return $this->previous_page() >= 1 ? true : false;
    }

    public function has_next_page()
    {
        return $this->next_page() <= $this->total_pages() ? true : false;
    }

    public function pagination_links($output_page = 'index.php')
    {
        $output = '<ul class="pagination">';
        if ($this->total_pages() > 1) {

            if ($this->has_previous_page()) {
                $output .= "<li><a href=\"{$output_page}?page={$this->previous_page()}\">";
                $output .= "&laquo;</a></li>";
            }

            for ($i = 1; $i <= $this->total_pages(); $i++) {
                if ($i == $this->current_page) {
                    $output .= "<li class=\"active\"><a href=\"#\">{$i}</a></li>";
                } else {
                    $output .= "<li><a href=\"{$output_page}?page={$i}\">{$i}</a></li>";
                }

            }

            if ($this->has_next_page()) {
                $output .= "<li><a href=\"{$output_page}?page={$this->next_page()}\">";
                $output .= "&raquo;</a></li>";
            }
        }
        $output .= '</ul>';
        return $output;
    }

}
