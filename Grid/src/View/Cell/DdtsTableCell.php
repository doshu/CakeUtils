<?php

    namespace App\View\Cell;


    class DdtsTableCell extends TableCell
    {
    
        
        protected function  _prepareColumns() {
            
            $this->_addColumn('code',
                array(
                    'header'=> 'Codice',
                    'index' => 'code',
            ));
            
            $this->_addColumn('created',
                array(
                    'header'=> 'Aggiunto il',
                    'index' => 'date',
                    'type' => 'date'
            ));
            
            $this->_addColumn('title',
                array(
                    'header'=> 'Titolo',
                    'index' => 'title',
            ));
            
            $this->_addColumn('qty',
                array(
                    'header'=> 'Quantità',
                    'index' => 'qty',
                    'type' => 'number'
            ));
            
            $this->_addColumn('to_assign_qty',
                array(
                    'header'=> 'Quantità da Assegnare',
                    'index' => 'to_assign_qty',
                    'type' => 'number'
            ));
            
            
            $this->_addColumn('price',
                array(
                    'header'=> 'Prezzo',
                    'index' => 'price',
                    'type' => 'currency',
                    'renderer' => 'pretty_currency_by_type'
            ));
            
        }
        
        
        protected function _prepareRowsAction() {
            $this->_addAction('open', [
                'title' => 'Apri',
                'url' => ['controller' => 'ddts', 'action' => 'view']
            ]);
            
            if($this->_options['user']['role_id'] == 'admin' || $this->_options['user']['role_id'] == 'warehouseman') {
                $this->_addAction('edit', [
                    'title' => 'Modifica',
                    'url' => ['controller' => 'ddts', 'action' => 'edit'],
                ]);
                
                $this->_addAction('delete', [
                    'title' => 'Elimina',
                    'url' => ['controller' => 'ddts', 'action' => 'delete'],
                    'type' => 'post',
                    'options' => [
                        'confirm' => 'Sei sicure di voler eliminare il ddt?'
                    ]
                ]);
            }
        }
        
    }


?>
