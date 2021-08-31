
<?php 

    class PageUrl{
        
        /**
        *set current page url
        *
        * @param  string  $uri
        * @return bool
        */
        public static function current_url(){
            $path = $_SERVER['SCRIPT_NAME'];
            
            Session::set('curUrl', $path);
        }
    
    
        /**
        *set previous url
        *
        * @param  string  $uri
        */
        public static function previous(){
            $path = $_SERVER['SCRIPT_NAME'];

            $cur_url = Session::get('curUrl');
            if($cur_url !== $path){
                Session::set('prevUrl', $cur_url);
            }else{
                Session::set('prevUrl', $path);
            }
        }

        /**
        *get previous url
        *
        * @return string
        */
        public static function back(){
            if(isset($_SESSION['prevUrl'])){
                $back = Session::get('prevUrl');
                return header("Location: ".$back);
                ob_end_flush();
                exit;
            }
        }

        /**
        *get current url
        *
        * @return string
        */
        public static function url(){
            return Session::get('curUrl');
        }

        /**
        *check whether current url matches with the $uri argument
        *
        * @param  string  $uri
        * @return bool
        */
        public static function isUrl($uri){
            $path = $_SERVER['SCRIPT_NAME'];
            $path = basename($path,".php");
            $path = str_replace('/', '', $path);
            $cur_url = strtolower($path);
            
            if($uri === $cur_url){
                return true;
            }else{
                return false;
            }
        }
    
    }
 ?>