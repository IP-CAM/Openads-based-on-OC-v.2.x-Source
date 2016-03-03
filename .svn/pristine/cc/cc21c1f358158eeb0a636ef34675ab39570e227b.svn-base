<?php
class ControllerSnsStatistics extends Controller {

	public function index(){
		$this->language->load('report/statistics');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('report/statistics');

		$this->getList();

	}

    protected function getList() {
        if (isset($this->request->get['filter_product_type'])) {
            $filter_product_type = (int)$this->request->get['filter_product_type'];
        } else {
            $filter_product_type = null;
        }

        if (isset($this->request->get['filter_post_type'])) {
            $filter_post_type = (int)$this->request->get['filter_post_type'];
        } else {
            $filter_post_type = null;
        }

        if (isset($this->request->get['filter_product_config_id'])) {
            $filter_product_config_id = (int)$this->request->get['filter_product_config_id'];
        } else {
            $filter_product_config_id = null;
        }

        if (isset($this->request->get['filter_entry'])) {
            $filter_entry = trim($this->request->get['filter_entry']);
        } else {
            $filter_entry = null;
        }

        if (isset($this->request->get['filter_customer_id'])) {
            $filter_customer_id = (int)$this->request->get['filter_customer_id'];
        } else {
            $filter_customer_id = null;
        }

        if (isset($this->request->get['filter_user_id'])) {
            $filter_user_id = (int)$this->request->get['filter_user_id'];
        } else {
            $filter_user_id = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = (int)$this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['filter_time_range'])) {
            $filter_time_range = (int)$this->request->get['filter_time_range'];
        } else {
            $filter_time_range = null;
        }

        if (isset($this->request->get['filter_date_start'])) {
            $filter_date_start = trim($this->request->get['filter_date_start']);
        } else {
            $filter_date_start = null;
        }

        if (isset($this->request->get['filter_date_end'])) {
            $filter_date_end = trim($this->request->get['filter_date_end']);
        } else {
            $filter_date_end = null;
        }
        
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'posts';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';
        if (isset($this->request->get['filter_product_type'])) {
            $url .= '&filter_product_type=' . (int)$this->request->get['filter_product_type'];
        }

        if (isset($this->request->get['filter_post_type'])) {
            $url .= '&filter_post_type=' . (int)$this->request->get['filter_post_type'];
        }

        if (isset($this->request->get['filter_product_config_id'])) {
            $url .= '&filter_product_config_id=' . (int)$this->request->get['filter_product_config_id'];
        }

        if (isset($this->request->get['filter_entry'])) {
            $url .= '&filter_entry=' . urlencode(html_entity_decode(trim($this->request->get['filter_entry']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_customer_id'])) {
            $url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
        }

        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_time_range'])) {
            $url .= '&filter_time_range=' . (int)$this->request->get['filter_time_range'];
        }

        if (isset($this->request->get['filter_date_start'])) {
            $url .= '&filter_date_start=' . urlencode(html_entity_decode(trim($this->request->get['filter_date_start']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_end'])) {
            $url .= '&filter_date_end=' . urlencode(html_entity_decode(trim($this->request->get['filter_date_end']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('report/statistics', 'token=' . $this->session->data['token'] , 'SSL'),
            'separator' => ' :: '
        );

        $this->data['records'] = array();

        $data = array(
            'filter_product_type'       => $filter_product_type,           
            'filter_post_type'          => $filter_post_type,
            'filter_product_config_id'	=> $filter_product_config_id,
            'filter_entry'         => $filter_entry,
            'filter_customer_id'        => $filter_customer_id,           
            'filter_user_id'            => $filter_user_id,
            'filter_status'      		=> $filter_status,
            'filter_time_range'         => $filter_time_range,
            'filter_date_start'      	=> $filter_date_start,
            'filter_date_end'           => $filter_date_end,
            'sort'      				=> $sort,
            'order'     				=> $order,
            'start'                     => ($page - 1) * 20,
            'limit'                     => 20
        );
        $total = $this->model_report_statistics->getTotalBalances($data);
        $results = $this->model_report_statistics->getBalances($data);
        $this->data['total_results'] = $this->model_report_statistics->getTotalResult($data);

        foreach ($results as $result) {
            switch ((int)$result['post_type']) {
                case 1:
                    $post_type = $this->language->get('entry_withphoto');
                    break;
                case 2:
                    $post_type = $this->language->get('entry_withoutphoto');
                    break;
                case 3:
                    $post_type = $this->language->get('entry_message');
                    break;
                case 4:
                    $post_type = $this->language->get('entry_ads');
                    break;
            }
            $this->data['records'][] = array(
                'product_type'  => $result['product_type'] == 1 ? $this->language->get('entry_outsource') : $this->language->get('entry_isclickbank'),
                'post_type'   	=> $post_type,
                'product'       => $result['product'],
                'entry_sn'      => $result['entry_sn'],
                'entry_name'    => $result['entry_name'],
                'author'        => $result['author'],
                'status_text'   => empty($result['status_text'])? '<b style="color:red;">Exception</b>' :$result['status_text'],
                'auditor'       => $result['auditor'],
                'posts'        	=> $result['posts'],
                'amount'       	=> $result['amount']
            );
        }
        
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_yes'] = $this->language->get('text_yes');
        $this->data['text_no'] = $this->language->get('text_no');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['entry_product_type'] = $this->language->get('entry_product_type');
        $this->data['entry_isclickbank'] = $this->language->get('entry_isclickbank');
        $this->data['entry_outsource'] = $this->language->get('entry_outsource');
        $this->data['entry_post_type'] = $this->language->get('entry_post_type');
        $this->data['entry_withphoto'] = $this->language->get('entry_withphoto');
        $this->data['entry_message'] = $this->language->get('entry_message');
        $this->data['entry_ads'] = $this->language->get('entry_ads');
        $this->data['entry_withoutphoto'] = $this->language->get('entry_withoutphoto');
        $this->data['entry_product'] = $this->language->get('entry_product');
        $this->data['entry_entry_name'] = $this->language->get('entry_entry_name');
        $this->data['entry_author'] = $this->language->get('entry_author');
        $this->data['entry_auditor'] = $this->language->get('entry_auditor');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_time_range'] = $this->language->get('entry_time_range');
        $this->data['entry_yesterday'] = $this->language->get('entry_yesterday');
        $this->data['entry_thisweek'] = $this->language->get('entry_thisweek');
        $this->data['entry_lastweek'] = $this->language->get('entry_lastweek');
        $this->data['entry_thismonth'] = $this->language->get('entry_thismonth');
        $this->data['entry_lastmonth'] = $this->language->get('entry_lastmonth');
        $this->data['entry_thisyear'] = $this->language->get('entry_thisyear');
        $this->data['entry_lastyear'] = $this->language->get('entry_lastyear');
        $this->data['entry_custom'] = $this->language->get('entry_custom');
        $this->data['entry_date_start'] = $this->language->get('entry_date_start');
        $this->data['entry_date_end'] = $this->language->get('entry_date_end');

        $this->data['column_product_type'] = $this->language->get('column_product_type');
        $this->data['column_post_type'] = $this->language->get('column_post_type');
        $this->data['column_product'] = $this->language->get('column_product');
        $this->data['column_entry'] = $this->language->get('column_entry');
        $this->data['column_auditor'] = $this->language->get('column_auditor');
        $this->data['column_author'] = $this->language->get('column_author');
        $this->data['column_status'] = $this->language->get('column_status');
        $this->data['column_posts'] = $this->language->get('column_posts');
        $this->data['column_amount'] = $this->language->get('column_amount');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['button_filter'] = $this->language->get('button_filter');
        $this->data['button_reset'] = $this->language->get('button_reset');

        $this->data['reset'] = $this->url->link('report/statistics', 'token='.$this->session->data['token'],'SSL');

        $this->data['token'] = $this->session->data['token'];

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        if (isset($this->session->data['warning'])) {
            $this->data['error_warning'] = $this->session->data['warning'];

            unset($this->session->data['warning']);
        } else {
            $this->data['error_warning'] = '';
        }

        $url = '';
        if (isset($this->request->get['filter_product_type'])) {
            $url .= '&filter_product_type=' . (int)$this->request->get['filter_product_type'];
        }

        if (isset($this->request->get['filter_post_type'])) {
            $url .= '&filter_post_type=' . (int)$this->request->get['filter_post_type'];
        }

        if (isset($this->request->get['filter_product_config_id'])) {
            $url .= '&filter_product_config_id=' . (int)$this->request->get['filter_product_config_id'];
        }

        if (isset($this->request->get['filter_entry'])) {
            $url .= '&filter_entry=' . urlencode(html_entity_decode(trim($this->request->get['filter_entry']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_customer_id'])) {
            $url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
        }

        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_time_range'])) {
            $url .= '&filter_time_range=' . (int)$this->request->get['filter_time_range'];
        }

        if (isset($this->request->get['filter_date_start'])) {
            $url .= '&filter_date_start=' . urlencode(html_entity_decode(trim($this->request->get['filter_date_start']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_end'])) {
            $url .= '&filter_date_end=' . urlencode(html_entity_decode(trim($this->request->get['filter_date_end']), ENT_QUOTES, 'UTF-8'));
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $this->data['sort_product_type'] = $this->url->link('report/statistics', 'token=' . $this->session->data['token'] . '&sort=vp.product_type' . $url, 'SSL');
        $this->data['sort_post_type'] = $this->url->link('report/statistics', 'token=' . $this->session->data['token'] . '&sort=vp.post_type' . $url, 'SSL');
        $this->data['sort_status'] = $this->url->link('report/statistics', 'token=' . $this->session->data['token'] . '&sort=vp.status' . $url, 'SSL');
        $this->data['sort_entry'] = $this->url->link('report/statistics', 'token=' . $this->session->data['token'] . '&sort=vp.entry_sn' . $url, 'SSL');
        $this->data['sort_posts'] = $this->url->link('report/statistics', 'token=' . $this->session->data['token'] . '&sort=posts' . $url, 'SSL');
        $this->data['sort_amount'] = $this->url->link('report/statistics', 'token=' . $this->session->data['token'] . '&sort=amount' . $url, 'SSL');
        $this->data['sort_contribute_sn'] = $this->url->link('report/statistics', 'token=' . $this->session->data['token'] . '&sort=vb.contribute_sn' . $url, 'SSL');
        $this->data['sort_auditor'] = $this->url->link('report/statistics', 'token=' . $this->session->data['token'] . '&sort=auditor' . $url, 'SSL');
        $this->data['sort_product'] = $this->url->link('report/statistics', 'token=' . $this->session->data['token'] . '&sort=product' . $url, 'SSL');
        $this->data['sort_author'] = $this->url->link('report/statistics', 'token=' . $this->session->data['token'] . '&sort=author' . $url, 'SSL');
        $url = '';
        if (isset($this->request->get['filter_product_type'])) {
            $url .= '&filter_product_type=' . (int)$this->request->get['filter_product_type'];
        }

        if (isset($this->request->get['filter_post_type'])) {
            $url .= '&filter_post_type=' . (int)$this->request->get['filter_post_type'];
        }

        if (isset($this->request->get['filter_product_config_id'])) {
            $url .= '&filter_product_config_id=' . (int)$this->request->get['filter_product_config_id'];
        }

        if (isset($this->request->get['filter_entry'])) {
            $url .= '&filter_entry=' . urlencode(html_entity_decode(trim($this->request->get['filter_entry']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_customer_id'])) {
            $url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
        }

        if (isset($this->request->get['filter_user_id'])) {
            $url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . (int)$this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_time_range'])) {
            $url .= '&filter_time_range=' . (int)$this->request->get['filter_time_range'];
        }

        if (isset($this->request->get['filter_date_start'])) {
            $url .= '&filter_date_start=' . urlencode(html_entity_decode(trim($this->request->get['filter_date_start']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_date_end'])) {
            $url .= '&filter_date_end=' . urlencode(html_entity_decode(trim($this->request->get['filter_date_end']), ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = 20;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('report/statistics', 'token=' . $this->session->data['token']. $url . '&page={page}', 'SSL');
         
        $this->data['pagination'] = $pagination->render();

    	$this->data['filter_product_type']= $filter_product_type;
        $this->data['filter_post_type']= $filter_post_type;
        $this->data['filter_product_config_id']= $filter_product_config_id;
        $this->data['filter_entry']= $filter_entry;
        $this->data['filter_customer_id']= $filter_customer_id;
        $this->data['filter_user_id']= $filter_user_id;
        $this->data['filter_status']= $filter_status;
        $this->data['filter_time_range']= $filter_time_range;
        $this->data['filter_date_start']= $filter_date_start;
        $this->data['filter_date_end']= $filter_date_end;
        $this->data['filter_customer']= '';
        $this->data['sort'] = $sort;
        $this->data['order'] = $order;

        if($filter_customer_id){
            $this->load->model('sale/customer');
            $_customer = $this->model_sale_customer->getCustomer($filter_customer_id);
            if($_customer){
                $this->data['filter_customer'] = $_customer['firstname'].$_customer['lastname'];
            }
        }
		
		$this->load->model('product/config');
  		$this->data['all_products'] = $this->model_product_config->getConfigsByType('product');

        $this->load->model('user/user');
        $this->data['all_users'] = $this->model_user_user->getUsers(array('filter_status' => 1));

        $this->load->model('localisation/photo_contribute_status');
        $this->data['photo_post_statuses'] = $this->model_localisation_photo_contribute_status->getContributeStatuses();

        $this->load->model('localisation/contribute_status');
        $this->data['post_statuses'] = $this->model_localisation_contribute_status->getContributeStatuses();

        $this->load->model('localisation/message_status');
        $this->data['message_statuses'] = $this->model_localisation_message_status->getMessageStatuses();
        $this->load->model('localisation/ads_status');
        $this->data['ads_statuses'] = $this->model_localisation_ads_status->getAdsStatuses();
        $this->template = 'report/statistics.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

	public function detail(){
		$this->language->load('report/detail');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('report/statistics');

		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => false
   		);
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('report/statistics', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['token'] = $this->session->data['token'];
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_all_users'] = $this->language->get('text_all_users');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		
		$this->data['tab_status'] = $this->language->get('tab_status');
		$this->data['tab_publish'] = $this->language->get('tab_publish');
		$this->data['tab_auditor'] = $this->language->get('tab_auditor');
		$this->data['tab_product'] = $this->language->get('tab_product');
		$this->data['tab_author'] = $this->language->get('tab_author');

		$this->data['title_photo_fbaccount'] = $this->language->get('title_photo_fbaccount');
		$this->data['title_fbaccount'] = $this->language->get('title_fbaccount');
		$this->data['title_fbpage'] = $this->language->get('title_fbpage');
        $this->data['title_message'] = $this->language->get('title_message');
        $this->data['title_ads'] = $this->language->get('title_ads');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_posts'] = $this->language->get('column_posts');
		$this->data['column_publish'] = $this->language->get('column_publish');
		$this->data['column_product'] = $this->language->get('column_product');
		$this->data['column_auditor'] = $this->language->get('column_auditor');
		$this->data['column_author'] = $this->language->get('column_author');
		$this->data['column_photo_fbaccount'] = $this->language->get('column_photo_fbaccount');
		$this->data['column_fbaccount'] = $this->language->get('column_fbaccount');
		$this->data['column_fbpage'] = $this->language->get('column_fbpage');
		$this->data['column_total'] = $this->language->get('column_total');

		$this->data['button_filter'] = $this->language->get('button_filter');

   		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		//pane status
		$this->data['photo_fbaccount_status'] = $this->model_report_statistics->postStatistics('status_fbaccount_photo');
		$this->data['fbaccount_status'] = $this->model_report_statistics->postStatistics('status_fbaccount');
		$this->data['fbpage_status'] = $this->model_report_statistics->postStatistics('status_fbpage');

		//pane publish
		$this->data['photo_fbaccount_publish'] = $this->model_report_statistics->postStatistics('publish_fbaccount_photo');
		$this->data['fbaccount_publish'] = $this->model_report_statistics->postStatistics('publish_fbaccount');
		$this->data['fbpage_publish'] = $this->model_report_statistics->postStatistics('publish_fbpage');

		// pane products
		$this->data['post_product'] =  $this->model_report_statistics->postStatistics('product');
		
		//pane auditor
		$this->data['post_auditor'] = $this->model_report_statistics->postStatistics('auditor');

		//pane author
		$this->data['post_author'] = $this->model_report_statistics->postStatistics('author');

		$this->template = 'report/detail.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		$this->response->setOutput($this->render());
	}

    public function similar(){
        $this->language->load('report/similar');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('report/statistics');

        if (isset($this->request->get['filter_sn'])) {
            $filter_sn = trim($this->request->get['filter_sn']);
        } else {
            $filter_sn = null;
        }

        if (isset($this->request->get['filter_id'])) {
            $filter_id = (int)($this->request->get['filter_id']);
        } else {
            $filter_id = null;
        }

        if (isset($this->request->get['filter_customer_id'])) {
            $filter_customer_id = (int)$this->request->get['filter_customer_id'];
        } else {
            $filter_customer_id = null;
        }

        if (isset($this->request->get['filter_product_config_id'])) {
            $filter_product_config_id = (int)$this->request->get['filter_product_config_id'];
        } else {
            $filter_product_config_id = null;
        }

        if (isset($this->request->get['filter_publish'])) {
            $filter_publish = (int)$this->request->get['filter_publish'];
        } else {
            $filter_publish = null;
        }

        if (isset($this->request->get['filter_start_value'])) {
            $filter_start_value = (int)$this->request->get['filter_start_value'];
        } else {
            $filter_start_value = null;
        }
        if (isset($this->request->get['filter_end_value'])) {
            $filter_end_value = (int)$this->request->get['filter_end_value'];
        } else {
            $filter_end_value = null;
        }

        if (isset($this->request->get['tab'])) {
            $tab = $this->request->get['tab'];
        } else {
            $tab = 'photo_fbaccount';
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'mc.contribute_id';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),            
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('report/statistics/similar', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['token'] = $this->session->data['token'];
        $this->data['heading_title'] = $this->language->get('heading_title');
        
        $this->data['text_all_users'] = $this->language->get('text_all_users');
        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_no_results'] = $this->language->get('text_no_results');
        
        $this->data['tab_title_photo'] = $this->language->get('tab_title_photo');
        $this->data['tab_title_fbaccount'] = $this->language->get('tab_title_fbaccount');
        $this->data['tab_title_fbpage'] = $this->language->get('tab_title_fbpage');
        $this->data['tab_title_message'] = $this->language->get('tab_title_message');
        $this->data['tab_title_ads'] = $this->language->get('tab_title_ads');

        $this->data['tab_photo_fbaccount'] = $this->url->link('report/statistics/similar', 'tab=photo_fbaccount&token=' . $this->session->data['token'], 'SSL');
        $this->data['tab_fbaccount'] = $this->url->link('report/statistics/similar', 'tab=fbaccount&token=' . $this->session->data['token'], 'SSL');
        $this->data['tab_fbpage'] = $this->url->link('report/statistics/similar', 'tab=fbpage&token=' . $this->session->data['token'], 'SSL');
        $this->data['tab_message'] = $this->url->link('report/statistics/similar', 'tab=message&token=' . $this->session->data['token'], 'SSL');
        $this->data['tab_ads'] = $this->url->link('report/statistics/similar', 'tab=ads&token=' . $this->session->data['token'], 'SSL');

        $this->data['column_base_post_id'] = $this->language->get('column_base_post_id');
        $this->data['column_other_post_id'] = $this->language->get('column_other_post_id');
        $this->data['column_base_sn'] = $this->language->get('column_base_sn');
        $this->data['column_other_sn'] = $this->language->get('column_other_sn');
        $this->data['column_base_author'] = $this->language->get('column_base_author');
        $this->data['column_other_author'] = $this->language->get('column_other_author');
        $this->data['column_base_publish'] = $this->language->get('column_base_publish');
        $this->data['column_other_publish'] = $this->language->get('column_other_publish');
        $this->data['column_base_product'] = $this->language->get('column_base_product');
        $this->data['column_other_product'] = $this->language->get('column_other_product');
        $this->data['column_similar_value'] = $this->language->get('column_similar_value');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['entry_sn'] = $this->language->get('entry_sn');
        $this->data['entry_id'] = $this->language->get('entry_id');
        $this->data['entry_author'] = $this->language->get('entry_author');
        $this->data['entry_product'] = $this->language->get('entry_product');
        $this->data['entry_start_value'] = $this->language->get('entry_start_value');
        $this->data['entry_end_value'] = $this->language->get('entry_end_value');
        $this->data['entry_publish'] = $this->language->get('entry_publish');

        $this->data['button_filter'] = $this->language->get('button_filter');
        $this->data['button_statistics'] = $this->language->get('button_statistics');
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }
        
        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];
        
            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $this->data['contributes'] = array();

        $data = array(
            'filter_sn'        => $filter_sn,       
            'filter_id'        => $filter_id,    
            'filter_customer_id'    => $filter_customer_id,
            'filter_product_config_id'    => $filter_product_config_id,
            'filter_publish'   => $filter_publish,
            'filter_start_value'    => $filter_start_value,
            'filter_end_value'      => $filter_end_value,
            'tab'       => $tab,            
            'sort'      => $sort,
            'order'     => $order,
            'start'     => ($page - 1) * 20,
            'limit'     => 20
        );

        $total = $this->model_report_statistics->getTotalSimilarRecord($data);

        $results = $this->model_report_statistics->getSimilarRecords($data);

        foreach ($results as $result) {
            $action = array();
            $action[] = array(
                'text' => $this->language->get('text_view'),
                'href' => 'javascript:similar_view(' . $result['base_post_id'] .','.$result['other_post_id'].(empty($result['mode']) ? '' : ",'".$result['mode']."'").')'
            );
            $this->data['contributes'][] = array(
                'base_post_id'      => $result['base_post_id'],                
                'other_post_id'     => $result['other_post_id'],
                'value'             => $result['value'],
                'base_sn'           => !empty($result['base_sn']) ? $result['base_sn'] : false,
                'other_sn'          => !empty($result['other_sn']) ? $result['other_sn'] : false,
                'base_author'       => $result['bfirstname'].$result['blastname'],
                'other_author'      => $result['ofirstname'].$result['olastname'],
                'base_publish'      => $result['base_publish'],
                'other_publish'     => $result['other_publish'],
                'base_product'      => $result['base_product'],
                'other_product'     => $result['other_product'],
                'mode'              => empty($result['mode']) ? '' : $result['mode'],
                'selected'          => isset($this->request->post['selected']) && in_array($result['base_post_id'], $this->request->post['selected']),
                'action'            => $action
            );
        }

        $url = '';
        if (isset($this->request->get['filter_sn'])) {
            $url .= '&filter_sn=' . urlencode(html_entity_decode(trim($this->request->get['filter_sn']), ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_id'])) {
            $url .= '&filter_id=' . (int)$this->request->get['filter_id'];
        }
        if (isset($this->request->get['filter_customer_id'])) {
            $url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
        }
        if (isset($this->request->get['filter_product_config_id'])) {
            $url .= '&filter_product_config_id=' . (int)$this->request->get['filter_product_config_id'];
        }
        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
        }
        if (isset($this->request->get['filter_start_value'])) {
            $url .= '&filter_start_value=' . (int)$this->request->get['filter_start_value'];
        }
        if (isset($this->request->get['filter_end_value'])) {
            $url .= '&filter_end_value=' . (int)$this->request->get['filter_end_value'];
        }
        if (isset($this->request->get['tab'])) {
            $url .= '&tab=' . $this->request->get['tab'];
        }else{
             $url .= '&tab=photo_fbaccount';
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $this->data['sort_base_sn'] = $this->url->link('report/statistics/similar', 'token=' . $this->session->data['token'] . '&sort=bp.contribute_sn' . $url, 'SSL');
        $this->data['sort_other_sn'] = $this->url->link('report/statistics/similar', 'token=' . $this->session->data['token'] . '&sort=sp.contribute_sn' . $url, 'SSL');
        $this->data['sort_base_author'] = $this->url->link('report/statistics/similar', 'token=' . $this->session->data['token'] . '&sort=bfirstname' . $url, 'SSL');
        $this->data['sort_other_author'] = $this->url->link('report/statistics/similar', 'token=' . $this->session->data['token'] . '&sort=ofirstname' . $url, 'SSL');
        $this->data['sort_base_publish'] = $this->url->link('report/statistics/similar', 'token=' . $this->session->data['token'] . '&sort=base_publish' . $url, 'SSL');
        $this->data['sort_other_publish'] = $this->url->link('report/statistics/similar', 'token=' . $this->session->data['token'] . '&sort=other_publish' . $url, 'SSL');
        $this->data['sort_base_product'] = $this->url->link('report/statistics/similar', 'token=' . $this->session->data['token'] . '&sort=base_product' . $url, 'SSL');
        $this->data['sort_other_product'] = $this->url->link('report/statistics/similar', 'token=' . $this->session->data['token'] . '&sort=other_product' . $url, 'SSL');
        $this->data['sort_value'] = $this->url->link('report/statistics/similar', 'token=' . $this->session->data['token'] . '&sort=sp.value' . $url, 'SSL');
        $url = '';
        if (isset($this->request->get['filter_sn'])) {
            $url .= '&filter_sn=' . urlencode(html_entity_decode(trim($this->request->get['filter_sn']), ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_id'])) {
            $url .= '&filter_id=' . (int)$this->request->get['filter_id'];
        }
        if (isset($this->request->get['filter_customer_id'])) {
            $url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
        }
        if (isset($this->request->get['filter_product_config_id'])) {
            $url .= '&filter_product_config_id=' . (int)$this->request->get['filter_product_config_id'];
        }
        if (isset($this->request->get['filter_publish'])) {
            $url .= '&filter_publish=' . (int)$this->request->get['filter_publish'];
        }
        if (isset($this->request->get['filter_start_value'])) {
            $url .= '&filter_start_value=' . (int)$this->request->get['filter_start_value'];
        }
        if (isset($this->request->get['filter_end_value'])) {
            $url .= '&filter_end_value=' . (int)$this->request->get['filter_end_value'];
        }
        if (isset($this->request->get['tab'])) {
            $url .= '&tab=' . $this->request->get['tab'];
        }else{
             $url .= '&tab=photo_fbaccount';
        }
        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = 20;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('report/statistics/similar', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
         
        $this->data['pagination'] = $pagination->render();

        $this->data['filter_sn']        = $filter_sn;
        $this->data['filter_id']        = $filter_id;
        $this->data['filter_customer_id']    = $filter_customer_id;
        $this->data['filter_product_config_id']    = $filter_product_config_id;
        $this->data['filter_publish']    = $filter_publish;
        $this->data['filter_start_value']    = $filter_start_value;
        $this->data['filter_end_value']      = $filter_end_value;
        $this->data['tab']       = $tab;         
        $this->data['sort']      = $sort;
        $this->data['order']     = $order;
        $this->load->model('localisation/photo_contribute_publish');
        $this->data['photo_post_publishes'] = $this->model_localisation_photo_contribute_publish->getContributePublishes();
        $this->load->model('localisation/contribute_publish');
        $this->data['post_publishes'] = $this->model_localisation_contribute_publish->getContributePublishes();
        $this->load->model('localisation/message_publish');
        $this->data['message_publishes'] = $this->model_localisation_message_publish->getMessagePublishes();
        $this->load->model('localisation/ads_publish');
        $this->data['ads_publishes'] = $this->model_localisation_ads_publish->getAdsPublishes();
        $this->data['filter_author']    = '';
        if($filter_customer_id){
            $this->load->model('sale/customer');
            $_customer = $this->model_sale_customer->getCustomer($filter_customer_id);
            if($_customer){
                $this->data['filter_author'] = $_customer['firstname'].$_customer['lastname'];
            }
        }
        if(in_array($this->user->getId(), array_merge($this->config->get('group_admin'),$this->config->get('group_promotion')))){
            $this->data['redo'] = true;
        }else{
            $this->data['redo'] = false;
        }

        $this->load->model('product/config');
        $this->data['all_products'] = $this->model_product_config->getConfigsByType('product');

        $this->template = 'report/similar.tpl';
        $this->children = array(
            'common/header',    
            'common/footer' 
        );
        $this->response->setOutput($this->render());

    }

    public function ajax_data(){
        $this->language->load('report/statistics');
        $action = isset($this->request->post['action']) ? strtolower(trim($this->request->post['action'])) : 'get';
        $this->load->model('report/statistics');
        switch ($action) {
            case 'similar':
                $mode = isset($this->request->post['mode']) ? strtolower(trim($this->request->post['mode'])) : 'photo_fbaccount';
                $second = $this->model_report_statistics->do_similar($mode);
                die(json_encode(array('status'=>1,'msg'=>'Statistics Success','times'=>' In '.date('i:s',$second))));
                break;
            case 'compare':
                $mode = isset($this->request->post['mode']) ? strtolower(trim($this->request->post['mode'])) : 'photo_fbaccount';
                $type = isset($this->request->post['type']) ? strtolower(trim($this->request->post['type'])) : 'text';
                $base_id = isset($this->request->post['base_id']) ? (int)$this->request->post['base_id'] : false;
                $other_id = isset($this->request->post['other_id']) ? (int)$this->request->post['other_id'] : false;
                $base_text = $this->model_report_statistics->getPostText(array('mode'=>$mode,'type'=>$type,'contribute_id'=>$base_id));
                $other_text = $this->model_report_statistics->getPostText(array('mode'=>$mode,'type'=>$type,'contribute_id'=>$other_id));
                $similarity_pst = 0;
                similar_text($base_text, $other_text, $similarity_pst);
                $msg = '<b>'.number_format($similarity_pst,4).'% Matched</b>';
                die(json_encode(array('status'=>1,'base'=>$base_text,'other'=>$other_text,'msg'=>$msg)));
                break;
            case 'statistics':
                $result = $this->model_report_statistics->do_statistics();
                die(json_encode(array('status'=>1,'msg'=>$result)));
        }
    }
}