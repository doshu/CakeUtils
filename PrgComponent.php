<?php

    namespace App\Controller\Component;

    use Cake\Controller\Component;

    /**
     * PrgComponent
     *
     * Post Redirect Get Component per implementare il pattern "post reditect get".
     * 
     */
    class PrgComponent extends Component
    {
    
        protected $_isPrg = false;
        protected $_data = [];
        
        protected $_skip = [
            'Cake\Database\Connection'
        ];
    
        public function startup($event) {
            if($this->request->session()->consume('isPrg')) {
                $this->_isPrg = true;
                $data = $this->request->session()->consume(md5($this->request->here));
                if($data) {
                    $this->request->data = $data['postData'];
                    $this->_registry->getController()->set($data['viewVars']);
                    $this->_data = $data['customData'];
                }
            }
            return true;
        }


        public function redirect() {
            if($this->request->is(['patch', 'post', 'put'])) {
                $this->request->session()->write(
                    md5($this->request->here), 
                    [
                        'postData' => $this->request->data,
                        'viewVars' => $this->_registry->getController()->viewVars,
                        'customData' => $this->_data
                    ]
                );
                $this->request->session()->write('isPrg', true);
            }
            
            $request = \Cake\Routing\Router::parse($this->request->url);
            $pass = $request['pass']??[];
            unset($request['pass']);
            unset($request['_matchedRoute']);
            
            return $this->_registry->getController()->redirect(array_merge($request, $pass) + ['?' => $this->request->query]);
        }
        
        
        public function isPrg() {
            return $this->_isPrg;
        }
        
        
        public function restore() {
            if($this->isPrg()) {
                return $this->_data;
            }
            return [];
        }
        
        
        public function push($name = null, $value = null) {
            if(is_array($name)) {
                foreach($name as $var => $value) {
                    if(is_string($var)) {
                        if(!is_resource($value) && ((is_object($value) && !in_array(get_class($value), $this->_skip)) || !is_object($value))) {
                            $this->_data[$var] = $value;
                        }
                    }
                }
            }
            else {
                if(!is_resource($value) && ((is_object($value) && !in_array(get_class($value), $this->_skip)) || !is_object($value))) {
                    $this->_data[$name] = $value;
                }
                
            }
            return $this;
        }
        
        
    
    }

?>
