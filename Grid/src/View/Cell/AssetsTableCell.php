<?php

    namespace App\View\Cell;


    class AssetsTableCell extends TableCell
    {
    
        
        protected function  _prepareColumns() {
            
            $this->_addColumn('name',
                array(
                    'header'=> 'Nome',
                    'index' => 'name',
                    'filter_index' => 'Assets.name'
            ));
            
            
            $this->_addColumn('date_start',
                array(
                    'header'=> 'Data Inizio',
                    'index' => 'date_start',
                    'type' => 'date'
            ));
            
            $this->_addColumn('date_end',
                array(
                    'header'=> 'Data Fine',
                    'index' => 'date_end',
                    'type' => 'date'
            ));
            
            
        }
        
        
        protected function _prepareRowsAction() {
            $this->_addAction('open', [
                'title' => 'Apri',
                'url' => ['controller' => 'assets', 'action' => 'view']
            ]);
            
            $this->_addAction('edit', [
                'title' => 'Modifica',
                'url' => ['controller' => 'assets', 'action' => 'edit']
            ]);
            
            $this->_addAction('delete', [
                'title' => 'Elimina',
                'url' => ['controller' => 'assets', 'action' => 'delete'],
            ]);
        }
        
    }


?>
