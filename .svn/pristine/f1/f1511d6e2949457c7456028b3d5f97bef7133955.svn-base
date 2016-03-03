<?php
/**
 * Created by PhpStorm.
 * User: zhujingxiu
 * Date: 2016/1/18
 * Time: 9:42
 */

namespace service;


class Advertise
{
    private $advertise_id;

    public function __construct($registry) {
        $this->db = $registry->get('db');
        $this->user = $registry->get('user');
        $this->config = $registry->get('config');
        $this->request = $registry->get('request');
        $this->language = $registry->get('language');
    }


    function getAdTargetingTemplate($targeting_id){
        return $this->db->fetch('advertise_targeting',
            array(
                'one' => true,
                'alias' => 'at',
                'field' => 'att.*',
                'join' => array(
                    array(
                        'table' => 'advertise_targeting_template',
                        'alias' => 'att',
                        'on' => 'at.template_id = att.template_id'
                    )
                ),
                'condition' => array(
                    'targeting_id' => $targeting_id
                )
            )
        );
    }

    function getAdProduct($product_id){
        $product = $this->db->fetch('product',
            array(
                'one'=> true,
                'alias' => 'p',
                'field' => 'p.*,pd.name ',
                'join' => array(
                    array(
                        'table' => 'product_description',
                        'alias' => 'pd',
                        'on' => 'p.product_id = pd.product_id AND pd.language_id = "'.$this->config->get('config_language_id').'" '
                    )
                ),
                'condition'=> array(
                    'product_id' => (int)$product_id
                )
            ));
        return $product;
    }

    function getAdPublishStatus($value){
        return $value == 1
            ? array('status'=>1,'name'=>$this->language->get('text_queuing'))
            : $this->db->fetch('advertise_publish',
                array(
                    'one'=>true,
                    'condition'=>array(
                        'publish_id' => (int)$value,
                        'language_id' => (int)$this->config->get('config_language_id')
                    )
                )
            );
    }


    function getTagetingStatus($value){
        return $this->db->fetch('advertise_targeting_status',
            array(
                'one'=>true,
                'condition'=>array(
                    'status_id' => (int)$value,
                    'language_id' => (int)$this->config->get('config_language_id')
                )
            ));
    }

    function getPostStatus($value){
        return $this->db->fetch('advertise_post_status',
            array(
                'one'=>true,
                'condition'=>array(
                    'status_id' => (int)$value,
                    'language_id' => (int)$this->config->get('config_language_id')
                )
            ));
    }


    function getPhotoStatus($value){
        return $this->db->fetch('advertise_photo_status',
            array(
                'one'=>true,
                'condition'=>array(
                    'status_id' => (int)$value,
                    'language_id' => (int)$this->config->get('config_language_id')
                )
            ));
    }

}