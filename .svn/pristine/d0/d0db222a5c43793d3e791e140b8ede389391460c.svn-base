<?php
class ControllerCommonDownload extends Controller {
    public function index(){
        $file_path=$file_name='';
        if(!empty($this->request->get['je'])){
            $decrypt_je = JEncrypt($this->request->get['je'],'D');
            $params = json_decode($decrypt_je,TRUE);
            if(is_array($params)){
                if(isset($params['path'])){
                    $file_path = trim($params['path']);
                }
                if(isset($params['name'])){
                    $file_name = trim($params['name']);
                }else{
                    $file_name = basename($file_path);
                }
            }
        }else if(!empty($this->request->get['path'])){
            $file_path=$this->request->get['path'];
            $file_name= !empty($this->request->get['name']) ? $this->request->get['name'] :basename($file_path);            
        }

        $absPath=APP_PATH.substr($file_path,strpos($file_path,'/')+1);

        if(!empty($file_path) && !file_exists($absPath)){
            die('file '.$file_name.' not found');
        }else{
            $file = fopen($absPath,"r");
            
            $this->response->addheader("Content-type: application/octet-stream");
            $this->response->addheader("Accept-Ranges: bytes");
            $this->response->addheader("Accept-Length: ".filesize($absPath));
            $this->response->addheader("Content-Disposition: attachment; filename=".$file_name);
            
            $out =  fread($file,filesize($absPath));
            fclose($file);
            $this->response->setOutput($out);
        }
    }
}