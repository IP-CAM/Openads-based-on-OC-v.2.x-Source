<?php
final class Loader {
	private $registry;

	public function __construct($registry) {
		$this->registry = $registry;
	}

	public function controller($route, $args = array()) {
		$action = new Action($route, $args);

		return $action->execute($this->registry);
	}

	public function model($model) {
		$file = DIR_APPLICATION . 'model/' . $model . '.php';
		$class = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', $model);

		if (file_exists($file)) {
			include_once($file);

			$this->registry->set('model_' . str_replace('/', '_', $model), new $class($this->registry));
		} else {
			trigger_error('Error: Could not load model ' . $file . '!');
			exit();
		}
	}

	public function view($template, $data = array(),$defaultFramework = false) {
		$_tpl_file = DIR_TEMPLATE . $template;

		if (file_exists($_tpl_file)) {
			if($defaultFramework){
				$data = array_merge($data,$this->_loadDefaultFramework());
			}
			extract($data);

			ob_start();

			require($_tpl_file);

			$output = ob_get_contents();

			ob_end_clean();

			return $output;
		} else {
			trigger_error('Error: Could not load template ' . $_tpl_file . '!');
			exit();
		}
	}

	public function library($library) {
		$_lib_file = DIR_SYSTEM . 'library/' . $library . '.php';

		if (file_exists($_lib_file)) {
			include_once($_lib_file);
		} else {
			trigger_error('Error: Could not load library ' . $_lib_file . '!');
			exit();
		}
	}

	public function helper($helper) {
		$_help_file = DIR_SYSTEM . 'helper/' . $helper . '.php';

		if (file_exists($_help_file)) {
			include_once($_help_file);
		} else {
			trigger_error('Error: Could not load helper ' . $_help_file . '!');
			exit();
		}
	}

	public function config($config) {
		$this->registry->get('config')->load($config);
	}

	public function language($language) {
		return $this->registry->get('language')->load($language);
	}

	private function _loadDefaultFramework(){
		return array(
			'header' => $this->controller('common/header'),
			'column_left' => $this->controller('common/column_left'),
			'footer' => $this->controller('common/footer'),
		);
	}
}