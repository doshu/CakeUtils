<?php

    namespace App\View\Cell;


    class OperatordepositsTableCell extends TableCell
    {
    
        
        protected function  _prepareColumns() {
            
            $this->_addColumn('title',
                array(
                    'header'=> 'Titolo',
                    'index' => 'title',
            ));
            
            
            $this->_addColumn('date',
                array(
                    'header'=> 'Data',
                    'index' => 'date',
                    'type' => 'date'
            ));
            
            $this->_addColumn('price',
                array(
                    'header'=> 'Prezzo',
                    'index' => 'price',
                    'type' => 'currency'
            ));
            
        }
        
        
        protected function _prepareRowsAction() {
            $this->_addAction('open', [
                'title' => 'Apri',
                'url' => ['prefix' => false, 'controller' => 'operatordeposits', 'action' => 'view']
            ]);
            
            $this->_addAction('delete', [
                'title' => 'Elimina',
                'url' => ['prefix' => false, 'controller' => 'operatordeposits', 'action' => 'delete'],
                'type' => 'post',
                'options' => [
                    'confirm' => 'Sei sicuro di voler eliminare l\'acconto?'
                ]
            ]);
        }
        
    }


?>
