<?php
class ModelCatalogProduct extends Model {
	public function getProducts(){
		$products = $this->cache->get('product');
		if(!$products){
			$data = array(
				'alias'		=> 'p',
				'field' 	=> array('p.product_id','pd.name','p.code'),
				'condition' => array('status'=>1,'language_id'=>array('alias'=>'pd','value'=>$this->config->get('config_language_id'))),
				'join'		=> array( array('table'=>'product_description','alias'=>'pd','on'=>'p.product_id = pd.product_id')),
				'sort'		=> array('`sort` ASC,`date_added` DESC')
			);
			$products =  $this->db->fetch('product',$data);
			$this->cache->set('product',$products);
		}
		return $products;
	}

	public function getProduct($product_id){
		$query = $this->db->query("SELECT p.*,pd.name FROM ".DB_PREFIX."product p LEFT JOIN ".DB_PREFIX."product_description pd ON pd.product_id = p.product_id AND pd.language_id = '".$this->config->get('config_language_id')."' WHERE p.product_id = '".(int)$product_id."' ");
		return $query->row;		
	}

	public function getTargetingsByCategory($category='location'){
		$targeting = $this->cache->get('targeting_'.$category);
		if(!$targeting){
			$data = array(
				'alias'		=> 't',
				'field' 	=> array('t.targeting_id','td.`name`','t.`default`','t.`value`'),
				'condition' => array('status'=>1,'category'=>strtolower($category),'language_id'=>array('alias'=>'td','value'=>$this->config->get('config_language_id'))),
				'join'		=> array( array('table'=>'targeting_description','alias'=>'td','on'=>'t.targeting_id = td.targeting_id')),
				'sort'		=> array('`sort` ASC,`date_added` DESC')
			);
			$targeting = $this->db->fetch('targeting',$data);
			$this->cache->set('targeting_'.$category,$targeting);
		}
		return $targeting;
	}

	public function getTargeting($targeting_id){
		$query = $this->db->query("SELECT t.*,td.name FROM ".DB_PREFIX."targeting t LEFT JOIN ".DB_PREFIX."targeting_description td ON td.targeting_id = t.targeting_id AND td.language_id = '".$this->config->get('config_language_id')."' WHERE t.targeting_id = '".(int)$targeting_id."' ");
		return $query->row;
	}
}
