<?php

    header('Content-Type: application/json');
    /*
    상수 정의    
    */ 
    //HTTP METHOD 
    define("HTTP_GET", 1, true);
    define("HTTP_POST", 2, true);
    //Parameter result
    define("PARAM_OK", 1, true);
    define("PARAM_NEED",2, true);
    define("PARAM_TYPE_ERROR",3,true);
    define("PARAM_METHOD_ERROR",4,true);
    //Result code
    define("RESULT_OK", 1, true);
    define("RESULT_PARAM_NEED", 2, true);
    define("RESULT_PARAM_METHOD_ERROR", 3, true);
    define("RESULT_PARAM_TYPE_ERROR", 4, true);
    
    //http 파라미터를 담는 클래스 
    class HttpParam {
        
        public $RESULT_CODE;
        public $METHOD_TYPE;
        public $VAR_NAME;
        
        function __construct($method, &$var){
            $vname = variable_name($var);
            
            $this->VAR_NAME = $vname;
            $this->METHOD_TYPE = $method;
            
            //http get
            if($method == HTTP_GET){
                if(isset($_GET[$vname])){
                    $this->RESULT_CODE = PARAM_OK;
                    $var = $_GET[$vname];
                }
                else{
                    //param not found
                    $this->RESULT_CODE = PARAM_NEED;
                }
            }
            
            //http post
            else if($method == HTTP_POST){
                if(isset($_POST[$vname])){
                    $this->RESULT_CODE = PARAM_OK;
                    $var = $_POST[$vname];
                }
                else{
                    //param not found
                    $this->RESULT_CODE = PARAM_NEED;
                }
            }
            else{
                //method not found
                $this->RESULT_CODE = PARAM_METHOD_ERROR;
            }
        }
        
    }
    
    //변수명 가져오기 
    function variable_name( &$var, $scope=false, $prefix='UNIQUE', $suffix='VARIABLE' ){
        if($scope) {
            $vals = $scope;
        } else {
            $vals = $GLOBALS;
        }
        $old = $var;
        $var = $new = $prefix.rand().$suffix;
        $vname = FALSE;
        foreach($vals as $key => $val) {
            if($val === $new) $vname = $key;
        }
        $var = $old;
        return $vname;
    }

    //파라미터들 확인 
    function check_param($arr){
        $json = array();
        foreach($arr as $object){
            switch($object->RESULT_CODE){
                case PARAM_OK:
                break;
                case PARAM_NEED:
                    $json['code'] = RESULT_PARAM_NEED;
                    $json['message'] = "RESULT_PARAM_NEED : ".$object->VAR_NAME;
                    echo json_encode($json);
                    die();
                break;
                case PARAM_TYPE_ERROR:
                    $json['code'] = RESULT_PARAM_TYPE_ERROR;
                    $json['message'] = "RESULT_PARAM_TYPE_ERROR";
                    echo json_encode($json);
                    die();
                break;
                case PARAM_METHOD_ERROR:
                    $json['code'] = RESULT_PARAM_METHOD_ERROR;
                    $json['message'] = "RESULT_PARAM_METHOD_ERROR";
                    echo json_encode($json);
                    die();
                break;
            }
        }        
    }
    
    //에러시 결과 출력
    function print_error(){
        $json = array();
        
        echo json_encode($json);
        die();
    }
?>