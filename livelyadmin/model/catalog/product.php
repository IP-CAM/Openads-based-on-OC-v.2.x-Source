<?php
class ModelCatalogProduct extends Model {
    public function addProduct($data) {

        $fields = array(
            'code' => $data['code'], 
            'sort' => (int)$data['sort'] ,
            'status' => (int)$data['status'],
            'user_id' => $this->user->getId(),
            'date_added' => date('Y-m-d H:i:s')
        );

        $product_id = $this->db->insert("product",$fields);

        foreach ($data['description'] as $language_id => $value) {
            $this->db->insert("product_description",array('product_id' => (int)$product_id , 'language_id' => (int)$language_id ,'name' => $value['name']));
        }
        $this->cache->delete('product');

        return $product_id;
    }

    public function editProduct($product_id, $data) {
        $fields = array(
            'code' => $data['code'], 
            'sort' => (int)$data['sort'] ,
            'status' => (int)$data['status'],
            'user_id' => $this->user->getId(),
            'date_added' => date('Y-m-d H:i:s')
        );
        $this->db->update("product",array('product_id'=>$product_id),$fields);

        $this->db->delete('product_description',array('product_id'=>$product_id));

        foreach ($data['description'] as $language_id => $value) {
            $this->db->insert("product_description",array('product_id' => (int)$product_id , 'language_id' => (int)$language_id ,'name' => $value['name']));
        }
        $this->cache->delete('product');
    }

    public function deleteProduct($product_id) {
        $this->db->delete("product",array('product_id'=>$product_id));
        $this->db->delete("product_description",array('product_id'=>$product_id));
    }

    public function getProduct($product_id) {
        $query = $this->db->query("SELECT DISTINCT p.*,pd.name FROM " . DB_PREFIX . "product p LEFT JOIN ".DB_PREFIX."product_description pd ON p.product_id = pd.product_id WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '".$this->config->get('config_language_id')."'");

        return $query->row;
    }

    public function getProductCode($product_id){
        $query = $this->db->query("SELECT code FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "' ");
        return $query->row['code'];
    }

    public function getProducts($data = array()) {
        $sql = "SELECT p.*,pd.name,u.nickname operator FROM " . DB_PREFIX . "product p LEFT JOIN ".DB_PREFIX."product_description pd ON ( p.product_id = pd.product_id AND pd.language_id = '".$this->config->get('config_language_id')."' ) LEFT JOIN ".DB_PREFIX."user u ON u.user_id = p.user_id WHERE 1";

        $sort_data = array(
            'name',
            'p.code',
            'p.status',
            'p.user_id',
            'p.date_added'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY p.code,date_added";
        }

        if (isset($data['order']) && ($data['order'] == 'ASC')) {
            $sql .= " ASC";
        } else {
            $sql .= " DESC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalProducts() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product");

        return $query->row['total'];
    }

    public function getProductDescriptions($product_id) {
        $description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");

        foreach ($query->rows as $result) {
            $description_data[$result['language_id']] = array(
                'name'            => $result['name'],
            );
        }

        return $description_data;
    }

}