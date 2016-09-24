<?php

    namespace App\View\Cell;


    class OperationsTableCell extends TableCell
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
            
            $this->_addColumn('type',
                array(
                    'header'=> 'Tipo',
                    'index' => 'type',
                    'sort_index' => 'Operations.type',
                    'filter_index' => 'Operations.type',
                    'type' => 'enum',
                    'enum' => [
                        '0' => 'Costo',
                        '1' => 'Ricavo'
                    ] 
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
                    'sort_index' => 'Operationtypes.name',
                    'filter_index' => 'operationtype_id',
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
            
            $this->_addColumn('collected',
                array(
                    'header'=> 'Incassato',
                    'index' => 'collected',
                    'type' => 'bool',
            ));
            
        }
        
        
        protected function _prepareRowsAction() {
            $this->_addAction('open', [
                'title' => 'Apri',
                'url' => ['controller' => 'operations', 'action' => 'view']
            ]);
            
            $this->_addAction('delete', [
                'title' => 'Elimina',
                'url' => ['controller' => 'operations', 'action' => 'delete'],
                'type' => 'post',
                'options' => [
                    'confirm' => 'Sei sicure di voler eliminare l\'operazione?'
                ]
            ]);
        }
        
    }


?>
