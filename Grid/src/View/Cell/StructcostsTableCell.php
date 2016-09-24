<?php

    namespace App\View\Cell;


    class StructcostsTableCell extends TableCell
    {
    
        
        protected function  _prepareColumns() {
            
            $this->_addColumn('title',
                array(
                    'header'=> 'Titolo',
                    'index' => 'title',
            ));
            
            $this->_addColumn('created',
                array(
                    'header'=> 'Aggiunto il',
                    'index' => 'created',
                    'type' => 'date'
            ));
            
            
            $this->_addColumn('operation_start',
                array(
                    'header'=> 'Da',
                    'index' => 'operation_start',
                    'type' => 'date'
            ));
            
            $this->_addColumn('operation_end',
                array(
                    'header'=> 'Al',
                    'index' => 'operation_end',
                    'type' => 'date'
            ));
            
            $this->_addColumn('operationtype',
                array(
                    'header'=> 'Categoria',
                    'index' => 'operationtype.name',
                    'sort_index' => 'operationtype_id',
                    'filter_index' => 'operationtype.name',
                    'type' => 'enum',
                    'options' => \Cake\ORM\TableRegistry::get('Operationtypes')->find('list')->order(['name' => 'ASC'])
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
                'url' => ['prefix' => false, 'controller' => 'structcosts', 'action' => 'view']
            ]);
            
            $this->_addAction('delete', [
                'title' => 'Elimina',
                'url' => ['prefix' => false, 'controller' => 'structcosts', 'action' => 'delete'],
                'type' => 'post',
                'options' => [
                    'confirm' => 'Sei sicure di voler eliminare l\'operazione?'
                ]
            ]);
        }
        
    }


?>
