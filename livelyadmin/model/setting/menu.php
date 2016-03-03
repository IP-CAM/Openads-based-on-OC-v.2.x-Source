<?php
class ModelSettingMenu extends Model {

    protected $_nodes = array();

    public function saveNode($data) {
        if(!empty($data['node_id'])){
            $where['node_id'] = $node_id = (int)$data['node_id'];
            if(isset($data['drag']) && $data['drag'] ==1){
                $fields = array();
                $fields['parent_id'] = (int)$data['parent'];
                $fields['sort'] = (int)$data['position'];
                $fields['level'] = 1;
                if($data['parent']){
                   $_p = $this->getNode($data['parent']);
                   if(!isset($_p['level'])){
                        $_p['level'] = 0;
                   }
                   $fields['level'] = ($_p['level']+1);
                }
                return $this->db->update("menu",$where,$fields);
            }else{
                $menu = $this->getNode((int)$data['node_id']);
                if(isset($menu['key'])){
                    if(isset($data['note_node'])){
                        $this->db->update("menu",$where,array('note' => $data['note']));
                    }else{
                        $fields = array(
                            'parent_id' => (int)$data['parent_id'],
                            'key'       => $data['key'],
                            'title'     => is_array($data['title']) ? json_encode($data['title']) : '',
                            'path'      => trim($data['path'],"/"),
                            'auth'      => (int)$data['auth'],
                            'status'    => (int)$data['status'],
                            'note'      => $data['note'],
                            'sort'      => (int)$data['sort']
                        );

                        $this->db->update("menu",$where,$fields);
                    }
                }
            }
        }else{
            $fields = array(
                'parent_id' => (int)$data['parent_id'],
                'key'       => $data['key'],
                'title'     => is_array($data['title']) ? json_encode($data['title']) : '',
                'path'      => trim($data['path'],"/"),
                'auth'      => (int)$data['auth'],
                'status'    => (int)$data['status'],
                'note'      => $data['note'],
                'sort'      => (int)$data['sort']
            );
            $node_id = $this->db->insert("menu",$fields);
        }

        return $node_id;
    }

    function getAllChildrenNodesByRecursion($parent_id){
        $children_node= array();
        $nodes = $this->getNodesByParentId($parent_id);
        if($nodes){
            foreach ($nodes as $item) {
                if($item['node_id']){
                    $tmp = $this->getAllChildrenNodesByRecursion($item['node_id']);
                    $tmp[] = $item['node_id'];
                    $children_node = array_merge($tmp,$children_node);
                }
            }
        }
        return $children_node;
    }
    
    function getAllParentNodesByRecursion($node_id){
        $parent_nodes = array();
        $node =$this->getNode((int)$node_id);
        if(isset($node['parent_id'])){          
            $tmp = $this->getAllParentNodesByRecursion($node['parent_id']);
            $parent_nodes[] = $node;
            $parent_nodes= array_merge($tmp,$parent_nodes);
        }
        return $parent_nodes;
    }

    public function getParentNodes($node_id){
        $result=array('key'=>'','value'=>'');
        $parent_nodes = $this->getAllParentNodesByRecursion($node_id);
        unset($parent_nodes[count($parent_nodes)-1]);
        if(count($parent_nodes)){
            foreach ($parent_nodes as $item) {
                $title = $item['title'];

                $languages = json_decode($title,true);
                if (is_array($languages) && !empty($languages[$this->config->get('config_language')])) {
                    $title = $languages[$this->config->get('config_language')];
                }
                $result['key'] = $item['key'];
                $result['value'] .= "/".$title;
            }
        }
        return $result;
    }

    public function deleteNode($node_id) {
        $all_nodes = $this->getAllChildrenNodesByRecursion($node_id);
        $all_nodes[] = $node_id;
        
        $this->db->delete("menu",array('node_id' => array('logic'=> 'in', 'value'=>implode(',', $all_nodes))));
        return count($all_nodes);
    }

    function getFileNodeInfo($data){
        $where = array();
        if(isset($data['path'])){
            $where['path'] = $data['path'];
        }
        if(isset($data['key'])){
            $where['key'] = $data['key'];
        }
        if(isset($data['parent_id'])){
            $where['parent_id'] = (int)$data['parent_id'];
        }
        if(isset($data['level'])){
            $where['level'] = (int)$data['level'];
        }
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."menu WHERE ".implode(" AND ", $where));
        return $query->row;
    }

    function getNode($node_id){
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."menu WHERE node_id = '".(int)$node_id."' ");
        return $query->row;
    }

    function getNodesByParentId($parent_id){
        $menu_node_query = $this->db->query("SELECT * FROM ".DB_PREFIX."menu WHERE parent_id = '".(int)$parent_id."' ORDER BY sort ASC ,node_id ASC");
        return $menu_node_query->rows;
    }

    private function getChildren($node_id=null){
        $sql = "SELECT pn.* FROM ".DB_PREFIX."menu pn ";
        if( $node_id != null ) {           
            $sql .= ' WHERE pn.parent_id='.(int)$node_id;
        }
        $sql .= ' ORDER BY pn.`parent_id` ,pn.`sort` ';
        $query = $this->db->query( $sql );            
        return $query->rows;
    }

    private function hasChildren($node_id){
        return isset($this->_nodes[$node_id]);
    } 
    
    private function getNodes($node_id){
        return $this->_nodes[$node_id];
    }

    private function nodesFormat($parent_id=0){
        $nodes = array(); 
        if($this->hasChildren($parent_id)){
            $results = $this->getNodes($parent_id);                     
            foreach( $results as $result ){
                $parent_nodes = $this->getParentNodes($result['node_id']);
                $title = $result['title'];

                $languages = json_decode($title,true);
                if (is_array($languages) && !empty($languages[$this->config->get('config_language')])) {
                    $title = $languages[$this->config->get('config_language')];
                }else{
                    $languages = array($this->config->get('config_language')=>$title);
                }
                $tmp = array(
                    'node_id'   => $result['node_id'],
                    'level'     => $result['level'],
                    'p_id'      => $result['parent_id'],
                    'p_key'     => (isset($parent_nodes['key']) ? $parent_nodes['key'] : ''),
                    'p_path'    => (!empty($parent_nodes['value']) ? $parent_nodes['value'] : ''),
                    'key'       => $result['key'],    
                    'path'      => !empty($result['path']) ? trim($result['path']) : '',
                    'name'      => $title,
                    'lang'      => $languages ,
                    'status'    => $result['status'],
                    'role'      => $result['role'],
                    'auth'      => $result['auth'],
                    'sort'      => isset($result['sort']) ? (int)$result['sort'] : 0,
                    'note'      => $result['note']
                );
                if($this->hasChildren($result['node_id'])){
                    $tmp['is_parent'] = 1;
                    $tmp['children'] = $this->nodesFormat( $result['node_id'] );
                } 
                $nodes[] = ($tmp);           
            }           
            return $nodes;
        }
        return ;
    }

    public function getNodeTree($node_id=null ){
        $children = $this->getChildren( $node_id );
        foreach($children as $child ){
            $this->_nodes[$child['parent_id']][] = $child;
        }
        return $this->nodesFormat(0);
    }

    public function setRoleNodes($role,$nodes){
        $query = $this->db->query("SELECT node_id,role FROM ".DB_PREFIX."menu WHERE FIND_IN_SET('".$role."',role)");
        if($query->num_rows){
            foreach($query->rows as $row){
                $new_role = '';
                $_roles =explode(",",$row['role']);
                if(is_array($_roles)){
                    $tmp = array_flip($_roles);
                    unset($tmp[$role]);
                    $new_role = implode(",",array_keys($tmp));
                }
                $this->db->update("menu",array('node_id'=>$row['node_id']),array('role'=>$new_role));

            }
        }
        if(is_array($nodes)){
            foreach($nodes as $node){
                $role_array = array();
                $role_array[] = $role;
                $node_info = $this->getNode($node);
                if(!empty($node_info['role'])){
                    $tmp = explode(",",$node_info['role']);
                    if(is_array($tmp)){
                        $role_array = array_merge($tmp,$role_array);
                    }
                }
                $this->db->update("menu",array('node_id'=>$node),array('role'=>implode(",",$role_array)));
            }
        }
    }

}