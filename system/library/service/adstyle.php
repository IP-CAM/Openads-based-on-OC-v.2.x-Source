<?php
/**
 * Created by PhpStorm.
 * User: zhujingxiu
 * Date: 2016/1/18
 * Time: 9:42
 */

namespace service;


class AdStyle
{
    public function __construct($registry) {
        $this->db = $registry->get('db');
        $this->ad = $registry->get('ad');
        $this->config = $registry->get('config');
        $this->language = $registry->get('language');
    }

    function getProductText($product_id){
        $product = $this->ad->getAdProduct($product_id);
        $text = empty($product['name']) ? $this->language->get('text_unknown') : $product['code'].' '.trim($product['name']);
        return  '<label class="label label-default">'.$text.'</label>';
    }

    function getPublishText($value,$tag='label')
    {
        $publish = $this->ad->getAdPublishStatus($value);
        $text = empty($publish['name']) ? $this->language->get('text_unknown') : trim($publish['name']);
        switch ((int)$value) {
            case 1:
                $class = 'default';
                break;
            case $this->config->get('ad_publish_indesign'):
            case $this->config->get('ad_publish_waiting'):
                $class = 'info';
                break;
            case $this->config->get('ad_publish_confirmed'):
            case $this->config->get('ad_publish_opening'):
                $class = 'primary';
                break;
            case $this->config->get('ad_publish_failed'):
                $class = 'warning';
                break;
            case $this->config->get('ad_publish_terminal'):
                $class = 'danger';
                break;
            default:
                $class = 'success';
                break;
        }
        switch(strtolower($tag)){
            case 'button':
                $element =  '<button type="button" class="btn btn-'.$class.'">'.$text.'</button>';
                break;
            case 'span':
                $element =  '<span class="'.$class.'">'.$text.'</span>';
                break;
            default :
                $element =  '<label class="label label-'.$class.'">'.$text.'</label>';
        }
        return $element;
    }

    function getTargetingSN($targeting_id){
        $template = $this->ad->getAdTargetingTemplate($targeting_id);

        return empty($template['targeting_sn']) ? '' : $template['targeting_sn'];
    }

    function getTargetingStatusText($value)
    {
        $targeting_status = $this->ad->getTagetingStatus($value);
        $text = empty($targeting_status['name']) ? $this->language->get('text_unknown') : trim($targeting_status['name']);
        $class = $this->getTargetingStatusStyleClass($value);
        return '<label class="label label-'.$class.'">'.$text.'</label>';
    }

    function getTargetingStatusStyleClass($value){
        switch ((int)$value) {
            case $this->config->get('ad_targeting_pending'):
                $class = 'default';
                break;
            case $this->config->get('ad_targeting_transferred'):
                $class = 'warning';
                break;
            case $this->config->get('ad_targeting_review'):
                $class = 'primary';
                break;
            case $this->config->get('ad_targeting_rejected'):
                $class = 'danger';
                break;
            default:
                $class = 'success';
                break;
        }
        return $class;
    }

    function getPostStatusText($value)
    {
        $post_status = $this->ad->getPostStatus($value);
        $text = empty($post_status['name']) ? $this->language->get('text_unknown') : trim($post_status['name']);
        $class = $this->getPostStatusStyleClass($value);
        return '<label class="label label-'.$class.'">'.$text.'</label>';
    }

    function getPostStatusStyleClass($value){
        switch ((int)$value) {
            case $this->config->get('ad_post_pending'):
                $class = 'default';
                break;
            case $this->config->get('ad_post_transferred'):
                $class = 'warning';
                break;
            case $this->config->get('ad_post_robot_review'):
            case $this->config->get('ad_post_review'):
                $class = 'primary';
                break;
            case $this->config->get('ad_post_rejected'):
                $class = 'danger';
                break;
            default:
                $class = 'success';
                break;
        }
        return $class;
    }

    function getPhotoStatusText($value)
    {
        $photo_status = $this->ad->getPhotoStatus($value);
        $text = empty($photo_status['name']) ? $this->language->get('text_unknown') : trim($photo_status['name']);
        $class = $this->getPhotoStatusStyleClass($value);
        return '<label class="label label-'.$class.'">'.$text.'</label>';
    }

    function getPhotoStatusStyleClass($value){
        switch ((int)$value) {
            case $this->config->get('ad_photo_pending'):
                $class = 'default';
                break;
            case $this->config->get('ad_photo_transferred'):
                $class = 'warning';
                break;
            case $this->config->get('ad_photo_review'):
                $class = 'primary';
                break;
            case $this->config->get('ad_photo_rejected'):
                $class = 'danger';
                break;
            default:
                $class = 'success';
                break;
        }
        return $class;
    }

    function getComponentButtonClass($status,$mode = 'targeting'){
        $btn_class = '';
        switch ($mode) {
            case 'targeting':
                switch ($status) {
                    case $this->config->get('ad_targeting_pending'):
                        $btn_class = 'btn-warning';
                        break;
                    case $this->config->get('ad_targeting_transferred'):
                        $btn_class = 'btn-info';
                        break;
                    case $this->config->get('ad_targeting_preview'):
                        $btn_class = 'btn-primary';
                        break;
                    case $this->config->get('ad_targeting_rejected'):
                        $btn_class = 'btn-danger';
                        break;
                    default :
                        $btn_class = 'btn-success';
                }
                break;
            case 'post':
                switch ($status) {
                    case $this->config->get('ad_post_pending'):
                        $btn_class = 'btn-warning';
                        break;
                    case $this->config->get('ad_post_transferred'):
                        $btn_class = 'btn-info';
                        break;
                    case  $this->config->get('ad_post_robot_review'):
                    case  $this->config->get('ad_post_preview'):
                        $btn_class = 'btn-primary';
                        break;
                    case $this->config->get('ad_post_rejected'):
                        $btn_class = 'btn-danger';
                        break;
                    default :
                        $btn_class = 'btn-success';
                }
                break;
            case 'photo':
                switch ($status) {
                    case $this->config->get('ad_photo_pending'):
                        $btn_class = 'btn-warning';
                        break;
                    case $this->config->get('ad_photo_transferred'):
                        $btn_class = 'btn-info';
                        break;
                    case $this->config->get('ad_photo_review'):
                        $btn_class = 'btn-primary';
                        break;
                    case $this->config->get('ad_photo_rejected'):
                        $btn_class = 'btn-danger';
                        break;
                    default :
                        $btn_class = 'btn-success';
                }
                break;
        }

        return $btn_class;
    }
}