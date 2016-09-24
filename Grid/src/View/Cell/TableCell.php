<?php

    namespace App\View\Cell;

    use Cake\View\Cell;

    /**
     * TableCell
     *
     *  usage:
     * $structcosts = $this->Operations->find()->contain(['Operationtypes'])->where([
     *       'asset_id' => $asset_id,
     *       'parent_id IS' => null
     *   ]);
     *   $table = $this->cell('StructcostsTable', [['user' => $this->Auth->user()]]);
     *   $table->setCollection($structcosts);
     *   $table->prepareCollection($structcosts);
     *   $this->paginate($structcosts);
     */
    class TableCell extends Cell
    {
    
        protected $_defaultPages = [5, 10, 20, 50, 100];
        protected $_collection = [];
        protected $_columns = [];
        protected $_actions = [];
        protected $_entityId = 'id';
        protected $_paginate = true;
        protected $_options = [];
        
        public function display($options = [])
        {
            $this->_options  = $options;
            $this->_prepareRowsAction();
            $this->template = '/Cell/Table/display';
            $this->set('table', $this);
            
            /*
            $this->set('headers', $options['headers']);
            $this->set('data', $options['data']);
            $this->set('actions', $options['actions']);
            $pages = isset($options['pages'])?$options['pages']:$this->_defaultPages;
            $this->set('pages', $pages);
            $this->set('table', $this); 
            $this->set('enableSearch', isset($options['enableSearch'])?$options['enableSearch']:false);
            */
        }
        
        
        /**
         * _prepareColumns
         * 
         * aggiunge colonne alla tabella
         * Possibili opzioni:
         * 
         * header => nome della colonna
         * index => property dell'entity da visualizzare
         * type => tipo di valore, utilizzato per il render
         * enum => enum in caso di type enum
         * options => opzioni per un filtro a select
         * sortable => indica se una colonna deve essere ordinabile
         * filterable => indica se una colonna deve essere filtrabile
         * sort_index => proprietà su cui effetuare il sort
         * filter_index => proprietà su cui effetuare il filtro
         * renderer => element da utilizzare per il render
         *
         * @return void
         */
        protected function  _prepareColumns() {
            
        }
        
        /**
         * _prepareRowsAction
         * 
         * aggiunge azioni alle righe
         * Possibili opzioni
         * title => nome dell'azione
         * url => url dell'azione
         * type => get o post
         * confirm => richiesta di conferma
         *
         * @return void
         */
        protected function _prepareRowsAction() {
            
        }
        
        
        protected function _addColumn($name, $options) {
            $this->_columns[$name] = $options;
        } 
        
        protected function _addAction($name, $options) {
            $this->_actions[$name] = $options;
        }
        
        public function getColumns() {
            return $this->_columns;
        }
        
        public function hasActions() {
            return !empty($this->_actions);
        }
        
        public function getActions() {
            return $this->_actions;
        }
        
        public function getColumnHeader($column) {
            return $this->_columns[$column]['header'];
        }
        
        public function getColumnIndex($column) {
            return isset($this->_columns[$column]['index'])?$this->_columns[$column]['index']:$column;
        }
        
        public function getColumnSortIndex($column) {
            return isset($this->_columns[$column]['sort_index'])?$this->_columns[$column]['sort_index']:$this->getColumnIndex($column);
        }
        
        public function getColumnFilterIndex($column) {
            return isset($this->_columns[$column]['filter_index'])?$this->_columns[$column]['filter_index']:$this->getColumnIndex($column);
        }
        
        public function getColumnType($column) {
            return isset($this->_columns[$column]['type'])?$this->_columns[$column]['type']:'text';
        }
        
        public function getColumnSortable($column) {
            return isset($this->_columns[$column]['sortable'])?$this->_columns[$column]['sortable']:true;
        }
        
        public function getColumnFilterable($column) {
            return isset($this->_columns[$column]['filterable'])?$this->_columns[$column]['filterable']:true;
        }
        
        public function getColumnEnum($column) {
            return isset($this->_columns[$column]['enum'])?$this->_columns[$column]['enum']:false;
        }
        
        public function getColumnOptions($column) {
            if($this->getColumnType($column) == 'bool') {
                return [1 => 'Sì', 0 => 'No'];
            }
            return isset($this->_columns[$column]['options'])?$this->_columns[$column]['options']:$this->getColumnEnum($column);
        }
        
        public function getColumnRenderer($column) {
            return isset($this->_columns[$column]['renderer'])?$this->_columns[$column]['renderer']:false;
        }
        
        public function getColumnFilterType($column) {
            $type = $this->getColumnType($column);
            switch($type) {
                case 'date':
                case 'datetime':
                case 'number':
                case 'currency':
                    return 'range';
                break;
                case 'enum':
                case 'bool':
                    return 'select';
                break;
                default:
                    return 'single';
            }
        }
        
        public function getActionType($action) {
            return isset($this->_actions[$action]['type'])?$this->_actions[$action]['type']:'get';
        }
        
        public function getActionTitle($action) {
            return isset($this->_actions[$action]['title'])?$this->_actions[$action]['title']:$action;
        }
        
        public function getActionUrl($action, $row) {
            $url = $this->_actions[$action]['url'];
            $url[] = $row->{$this->getEntityId()};
            return $url;
        }
        
        public function getActionOptions($action) {
            return isset($this->_actions[$action]['options'])?$this->_actions[$action]['options']:[];
        }
        
        public function getFormattedColumn($column, $row, $view) {
        
            $type = $this->getColumnType($column);
            $renderer = $this->getColumnRenderer($column);
            $value = \Cake\Utility\Hash::get($row, $this->getColumnIndex($column));
            
            if($type == 'bool' && ($value === '' || $value === null)) {
                $value = false;
            }
            
            if($value !== '' && $value !== null) {
                if($renderer) {
                    return new ColumnRenderer($renderer, $value, $row, $view);
                }
            
                $method = '_format'.ucfirst($type);
                if(method_exists($this, $method)) {
                    return $this->$method($value, $column);
                } 
            }
            else {
                return null;
            }
            return $value;
        }   
        
        protected function _setEntityId($id) {
            $this->_entityId = $id;
        }
        
        public function getEntityId() {
            return $this->_entityId;
        }
        
        public function setCollection($collection) {
            $this->_collection = $collection; 
        }
        
        public function getCollection() {
            return $this->_collection; 
        }
        
        public function prepareCollection() {
            $this->_prepareColumns();
            if(isset($this->request->query['filter'])) {
                foreach($this->request->query['filter'] as $column => $value) {
                    if($value !== '' && $value !== null) {
                        $type = $this->getColumnType($column);
                        $index = $this->getColumnFilterIndex($column);
                        switch($type) {
                            case 'date':
                            case 'datetime':
                            case 'number':
                            case 'currency':
                                if(isset($value['from']) && !empty($value['from'])) {
                                    $this->_collection->andWhere([$index.' >=' => $value['from']]);
                                }
                                if(isset($value['to']) && !empty($value['to'])) {
                                    $this->_collection->andWhere([$index.' <=' => $value['to']]);
                                }
                            break;
                            case 'enum':
                                $this->_collection->andWhere([$index => $value]);
                            break;
                            case 'bool':
                                $this->_collection->andWhere([$index => (bool)$value]);
                            break;
                            default:
                                $this->_collection->andWhere([$index.' LIKE' => $value.'%']);
                        }
                    }
                }
            }
        }
        
        public function paginate($paginate = null) {
            if($paginate !== null) {
                $this->_paginate = $paginate;
            }
            return $this->_paginate;
        }
        
        
        public function _formatDatetime($value, $column) {
            //use i18n format
            return $value;
        }
        
        public function _formatDate($value, $column) {
            return new \Cake\I18n\FrozenDate($value->format('Y-m-d'));
        }
        
        public function _formatBool($value, $column) {
            return $value?'Sì':'No';
        }   
        
        public function _formatEnum($value, $column) {
            $enum = $this->getColumnEnum($column);
            if($enum && isset($enum[(string)$value])) {
                return $enum[(string)$value];
            }
            return $value;
        }
        
        public function _formatCurrency($value, $column) {
            return \Cake\I18n\Number::currency($value, 'EUR');
        }
        
        public function _formatText($value, $column) {
            return h($value);
        }

    }


?>
