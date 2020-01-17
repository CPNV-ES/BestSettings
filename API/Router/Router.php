<?php
    
    class Router
    {
        const  ID = '([(0-9)(A-z)]+)';
        public static $route = [];
        public static function add($method, $url, $function)
        {
            array_push(self::$route,Array(
                'method' => $method,
                'url' => $url,
                'function'=> $function
            ));
            
        }
        public static function run() 
        {
            $actual_Url=parse_url($_SERVER['REQUEST_URI'])['path'];
            if(isset($actual_Url)){
                $path = $actual_Url;
            }else{
                $path = '/';
            }
            foreach(self::$route as $routes)
            {
            $regex = '^' . str_replace(array('id','/'),array(self::ID,'\/'), $routes['url']) . '$';
                if(preg_match('#'.$regex.'#',$path,$matches))
                {
                    if($routes['method']==$_SERVER['REQUEST_METHOD'])
                    {
                        self::prepare($routes['function'],$matches,$routes['url'],$routes['method']);
                        exit;
                    }              
                }             
            }
        }

        public static function prepare($function,$matches,$url,$method){
            $formated_array=self::getClassMethodAndAction($function);
            $class = $formated_array['class'];
            $functionClass = $formated_array['method'];
            $collection = $formated_array['action'];
            $parameter_array=self::assignementParameters($matches,$url);
            self::getMethodAndIncludeAction($method,$collection);
            if (!empty($parameter_array) && count($parameter_array)>=1 ){
                $object = new $class;
                $object->$functionClass($parameter_array);
            }else{
                $object = new $class();
                $object->$functionClass();
            }   
        }
        
        public static function getMethodAndIncludeAction($method,$collection){

            Switch($method){
                
                case "GET":
                    include("Model/".$collection."/Read.php");
                break;
                case "POST":
                    include("Model/".$collection."/Create.php");
                break;   
                case "PUT":
                    include("Model/".$collection."/Update.php");
                break;
                case "DELETE":
                    include("Model/".$collection."/Delete.php");
                break;
            }
        }

        public static function getClassMethodAndAction($function){
            $array_class_method=[];
            $controller=explode('@',$function);
            $actionClass=explode('/',$controller[0]);
            $array_class_method['action']= $actionClass[0];
            $array_class_method['class']= $actionClass[1];
            $array_class_method['method']= $controller[1];
            return $array_class_method;
        } 
        public static function assignementparameters($match,$url)
        {
            $parametre=[];
            //explode the url in multiple part
            $url_array_elements=explode('/',$url);
            array_shift($match);
            array_shift($url_array_elements);
            $parameter=0;
                for($index=0;$index < count($url_array_elements) ; $index++)
                {
                    //add in the array parametre the value that go with is name behind in the url
                    if($url_array_elements[$index]=='id')
                    {
                        $parametre[$url_array_elements[$index-1]]=$match[$parameter];
                        $parameter++;
                        
                    }
                }
                return $parametre;
        }
        
    }
    ?>