<?php

    namespace App\View\Cell;

    class ColumnRenderer {
    
        public $element = null;
        public $value = null;
        public $row = null;
        public $view = null;
        
        public function __construct($element, $value, $row, $view) {
            $this->element = $element;
            $this->value = $value;
            $this->row = $row;
            $this->view = $view;
        }
        
        public function __toString() {
            return $this->view->element('Renderer/'.$this->element, ['renderer' => $this]);
        }
    }

?>
