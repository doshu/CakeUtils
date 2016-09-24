<?php

    namespace App\View\Cell;


    class CountingoperationsTableCell extends TableCell
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
                    'sort_index' => 'Countingoperations.type',
                    'filter_index' => 'Countingoperations.type',
                    'type' => 'enum',
                    'enum' => [
                        '0' => 'Costo',
                        '1' => 'Ricavo'
                    ] 
            ));
            
            $this->_addColumn('date',
                array(
                    'header'=> 'Data',
                    'index' => 'date',
                    'type' => 'date'
            ));
            
            $this->_addColumn('countingype',
                array(
                    'header'=> 'Categoria',
                    'index' => 'countingtype.name',
                    'sort_index' => 'Countingypes.name',
                    'filter_index' => 'countingtype_id',
                    'type' => 'enum',
                    'options' => \Cake\ORM\TableRegistry::get('Countingtypes')->find('list')->order(['name' => 'ASC'])
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
                'url' => ['controller' => 'countingoperations', 'action' => 'view']
            ]);
            
            $this->_addAction('delete', [
                'title' => 'Elimina',
                'url' => ['controller' => 'countingoperations', 'action' => 'delete'],
                'type' => 'post',
                'options' => [
                    'confirm' => 'Sei sicure di voler eliminare l\'operazione?'
                ]
            ]);
        }
        
    }


?>
