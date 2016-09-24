<?php

    namespace App\View\Cell;


    class WorkersTableCell extends TableCell
    {
    
        
        protected function  _prepareColumns() {
            
            $this->_addColumn('name',
                array(
                    'header'=> 'Nome',
                    'index' => 'name',
            ));
            
            
            $this->_addColumn('surname',
                array(
                    'header'=> 'Cognome',
                    'index' => 'surname',
            ));
            
        }
        
        
        protected function _prepareRowsAction() {
            $this->_addAction('open', [
                'title' => 'Apri',
                'url' => ['prefix' => false, 'controller' => 'workers', 'action' => 'view']
            ]);
            
            $this->_addAction('edit', [
                'title' => 'Modifica',
                'url' => ['prefix' => false, 'controller' => 'workers', 'action' => 'view']
            ]);
            
            $this->_addAction('delete', [
                'title' => 'Elimina',
                'url' => ['prefix' => false, 'controller' => 'workers', 'action' => 'delete'],
            ]);
        }
        
    }


?>
