<?php
class ModelServiceWebsite extends Model {

    public function addWebsite($data){
        // Website
        $fields = array(
            'auto_num'      => $this->getWebsiteNum(),
            'website_sn'    => $this->customer->getUsername().zeroFull($this->getWebsiteNum(),3),
            'from'          => 'member',
            'product_id'    => $data['product_id'],
            'domain'        => $data['domain'],
            'note'          => $data['note'],
            'alias'         => isset($data['alias']) ? trim($data['alias']) : '',
            'customer_id'   => $this->customer->getId(),
            'in_charge'     => $this->customer->getInCharge(),
            'status'        => 1,
            'date_added'    => date('Y-m-d H:i:s'),
            'date_modified' => date('Y-m-d H:i:s')
        );
        $website_id = $this->db->insert('website',$fields);
        $this->addWebsiteHistory($website_id,array('status'=>1,'note'=>''));
        return $website_id;
    }

    private function getWebsiteNum(){
        $sql ="SELECT MAX(auto_num) max FROM ".DB_PREFIX."website WHERE customer_id = '".$this->customer->getId()."'";
        $query = $this->db->query($sql);
        return empty($query->row['max']) ? 1 : (int)$query->row['max']+1;
    }

    public function editWebsite($website_id,$data){
        $this->db->update('website',array('website_id' => $website_id),$data);
    }

    public function toggleWebsite($website_id,$value=1){
        $this->db->update('website',array('website_id' => $website_id),array('show'=>$value));
        return true;
    }

    public function getWebsite($website_id,$simple=false){
        if($simple){
            $filter = array(
                'one'   => true,
                'condition' => array(
                    'customer_id' => (int)$this->customer->getId(),
                    'website_id'=> $website_id
                )
            );
        }else{
            $filter = array(
                'one'   => true,
                'alias' => 'w',
                'field' => 'w.*,u.lastname,u.firstname,u.username,pd.name product',
                'join'  => array(
                    array(
                        'mode'  => 'left join',
                        'table' => 'product',
                        'alias' => 'p',
                        'on'    => 'p.product_id = w.product_id'
                    ),
                    array(
                        'mode'  => 'left join',
                        'table' => 'product_description',
                        'alias' => 'pd',
                        'on'    => 'pd.product_id = p.product_id'
                    ),
                    array(
                        'mode'  => 'left join',
                        'table' => 'user',
                        'alias' => 'u',
                        'on'    => 'u.user_id = w.in_charge'
                    )
                ),
                'condition' => array(
                    'customer_id' => (int)$this->customer->getId(),
                    'website_id'=> $website_id,
                    'language_id' => array(
                        'alias' => 'pd',
                        'value' => $this->config->get('config_language_id')
                    )
                )
            );
        }
        return $this->db->fetch('website',$filter);
    }

    public function getWebsites($data=array()){

        $filter = array();
        $filter['alias'] = 'w';
        $filter['field'] = 'w.*,u.lastname,u.firstname,u.username,pd.name product,(SELECT COUNT(`advertise_id`) ads FROM `'.DB_PREFIX.'advertise` a WHERE a.website_id = w.website_id AND a.customer_id = w.customer_id ) AS ads';
        $filter['join'] = array(
            array(
                'mode' => 'left join',
                'table' => 'product',
                'alias' => 'p',
                'on' => 'p.product_id = w.product_id'
            ),
            array(
                'mode'  => 'left join',
                'table' => 'product_description',
                'alias' => 'pd',
                'on'    => 'pd.product_id = p.product_id'
            ),
            array(
                'mode' => 'left join',
                'table' => 'user',
                'alias' => 'u',
                'on' => 'u.user_id = w.in_charge'
            )
        );
        $condition = array(
            'customer_id' => (int)$this->customer->getId(),
            'language_id' => array(
                'alias' => 'pd',
                'value' => $this->config->get('config_language_id')
            )
        );
        if(isset($data['hide']) && $data['hide'] !=1){
            $condition['show'] = 1;
        }
        if(isset($data['filter_status'])){
            $condition['status'] = $data['filter_status'];
        }
        if(isset($data['filter_website'])){
            $condition['website_id'] = $data['filter_website'];
        }
        if(isset($data['filter_product_id'])){
            $condition['product_id'] = $data['filter_product_id'];
        }
        if(isset($data['filter_domain'])){
            $condition['domain'] = array(
                'logic' => 'like',
                'value' => $data['filter_domain']
            );
        }

        if(isset($data['filter_domain'])){
            $condition['domain'] = array(
                'logic' => 'like',
                'value' => $data['filter_domain']
            );
        }
        if(isset($data['filter_modified_start']) || isset($data['filter_modified_end'])){

            if(isset($data['filter_modified_start']) && isset($data['filter_modified_end'])){
                $condition['date_modified'] = array(
                    'logic' => 'noparse',
                    'value' => "DATE(w.`date_modified`) >= '".$this->db->escape($data['filter_modified_start']) ."' AND DATE(w.`date_modified`) <='".$data['filter_modified_end']."'"
                );
            }else if(isset($data['filter_modified_start'])){
                $condition['date_modified'] = array(
                    'logic' => 'gte',
                    'value' => $data['filter_modified_start']
                );
            }else if(isset($data['filter_modified_end'])){
                $condition['date_modified'] = array(
                    'logic' => 'lte',
                    'value' => $data['filter_modified_end']
                );
            }
        }
        

        $filter['condition'] = $condition;

        $sort_data = array(
            'w.product_id',
            'w.domain',
            'w.date_added',
        );
        $sort = '';
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sort .= $data['sort'];
        } else {
            $sort .= "website_id";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sort .= " DESC";
        } else {
            $sort .= " ASC";
        }
        $filter['sort'] = $sort;

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $filter['start'] = 0;
            }
            if ($data['limit'] < 1) {
                $filter['limit'] = 20;
            }           
        }

        return $this->db->fetch('website',$filter);
    }

    public function getTotalWebsites($data=array()){
        $filter = array();
        $filter['field'] = array('COUNT(website_id) AS total');

        $condition = array(
            'customer_id' => (int)$this->customer->getId(),
        );
        if(isset($data['hide']) && $data['hide'] !=1){

            $condition['show'] = 1;
        }
        if(isset($data['filter_website'])){
            $condition['website_id'] = $data['filter_website'];
        }
        if(isset($data['filter_status'])){
            $condition['status'] = $data['filter_status'];
        }
        if(isset($data['filter_product_id'])){
            $condition['product_id'] = $data['filter_product_id'];
        }
        if(isset($data['filter_domain'])){
            $condition['domain'] = array(
                'logic' => 'like',
                'value' => $data['filter_domain']
            );
        }
        if(isset($data['filter_domain'])){
            $condition['domain'] = array(
                'logic' => 'like',
                'value' => $data['filter_domain']
            );
        }
        if(isset($data['filter_modified_start']) || isset($data['filter_modified_end'])){

            if(isset($data['filter_modified_start']) && isset($data['filter_modified_end'])){
                $condition['date_modified'] = array(
                    'logic' => 'noparse',
                    'value' => "DATE(`date_modified`) >= '".$this->db->escape($data['filter_modified_start']) ."' AND DATE(`date_modified`) <='".$data['filter_modified_end']."'"
                );
            }else if(isset($data['filter_modified_start'])){
                $condition['date_modified'] = array(
                    'logic' => 'gte',
                    'value' => $data['filter_modified_start']
                );
            }else if(isset($data['filter_modified_end'])){
                $condition['date_modified'] = array(
                    'logic' => 'lte',
                    'value' => $data['filter_modified_end']
                );
            }
        }
        $filter['condition'] = $condition;

        $filter['one'] = true;
        $result = $this->db->fetch('website',$filter);
        return isset($result['total']) ? $result['total'] : 0;
    }

    function addWebsiteTracking($website_id,$data){
        $fields = array(
            'website_id'  => $website_id,
            'text'          => $data['text'],
            'attach'        => htmlspecialchars_decode($data['attach']),
            'from'          => 'member',
            'customer_id'   => $this->customer->getId(),
            'read'          => 0,
            'date_added'    => date('Y-m-d H:i:s'),
        );

        return $this->db->insert('website_tracking',$fields);
    }

    function getWebsiteTrackings($website_id){

        $filter = array(
            'alias'=> 'at',
            'field'=> "at.*,CONCAT(c.firstname,' ',c.lastname) customer,c.company,CONCAT(u.lastname,' ',u.firstname) charger",
            'join' => array(
                array(
                    'table' =>  'website',
                    'alias' => 'a',
                    'on'    => 'w.website_id = at.website_id'
                ),
                array(
                    'table' =>  'customer',
                    'alias' => 'c',
                    'on'    => 'c.customer_id = w.customer_id'
                ),
                array(
                    'table' => 'user',
                    'alias' => 'u',
                    'on'    => 'u.user_id = at.user_id'
                ),
            ),
            'condition'=> array(
                'website_id' => $website_id,
                'customer_id'  => array(
                    'alias' => 'a',
                    'value' => $this->customer->getId()
                )
            ),
            'sort'  => 'at.date_added DESC'
        );

        return $this->db->fetch('website_tracking',$filter);
    }

    public function addWebsiteHistory($website_id,$data){
        $ws_info = $this->getWebsite($website_id,true);
        if($ws_info){
            $fields = array(
                'status'       => $data['status'],
                'note'          => isset($data['note']) ? strip_tags($data['note']) : '',
                'date_modified' => date('Y-m-d H:i:s')
            );
            $this->db->update('website',array('website_id'=>$website_id),$fields);
            $history = array(
                'website_id'  => $website_id,
                'status'       => $data['status'],
                'from'          => 'member',
                'note'          => isset($data['note']) ? strip_tags($data['note']) : '',
                'customer_id'   => $this->customer->getId(),
                'date_added'    => date('Y-m-d H:i:s')
            );
            return $this->db->insert('website_history',$history);
        }
    }
    public function getWebsiteHistories($website_id,$start=0,$limit=10){
        $filter = array(
            'field' => 'wh.*',
            'alias' => 'wh',
            'condition' => array(
                'website_id'=> $website_id
            )
        );
        $sort = '';
        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sort .= $data['sort'];
        } else {
            $sort .= "date_added";
        }

        if (isset($data['order']) && ($data['order'] == 'ASC')) {
            $sort .= " ASC";
        } else {
            $sort .= " DESC";
        }
        $filter['sort'] = $sort;

        if ($start < 0) {
            $filter['start'] = 0;
        }else{
            $filter['start'] = $start;
        }
        if ($limit < 1) {
            $filter['limit'] = 20;
        }else{
            $filter['limit'] = $limit;
        }
        return $this->db->fetch('website_history',$filter);
    }

    public function getTotalWebsiteHistories($website_id){
        $filter = array(
            'one'       => true,
            'field'     => 'COUNT(history_id) total',
            'condition' => array(
                'website_id'=> $website_id
            )
        );
        $result = $this->db->fetch('website_history',$filter);
        return isset($result['total']) ? $result['total'] : 0;
    }
   public function isHasHide(){
   	 $sql="SELECT * FROM " . DB_PREFIX . "website WHERE `show`='0' AND `customer_id`='".(int)$this->customer->getId()."'";
   	 $query = $this->db->query($sql);
   	 if($query->num_rows){
   	 	return true;
   	 }else{
   	 	return false;
   	 }
   }
}
