<?php

    namespace App\View\Cell;


    class OperatorsTableCell extends TableCell
    {
    
        
        protected function  _prepareColumns() {
            
            $this->_addColumn('name',
                array(
                    'header'=> 'Nome',
                    'index' => 'name',
            ));
            
            
        }
        
        
        protected function _prepareRowsAction() {
            $this->_addAction('open', [
                'title' => 'Apri',
                'url' => ['prefix' => false, 'controller' => 'operators', 'action' => 'view']
            ]);
            
            $this->_addAction('edit', [
                'title' => 'Modifica',
                'url' => ['prefix' => false, 'controller' => 'operators', 'action' => 'view']
            ]);
            
            $this->_addAction('delete', [
                'title' => 'Elimina',
                'url' => ['prefix' => false, 'controller' => 'operators', 'action' => 'delete'],
            ]);
        }
        
    }


?>
