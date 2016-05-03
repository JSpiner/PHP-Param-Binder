# PHP-Param-Binder
Simple php http parameter binder (GET/POST)

# Example
##GET-METHOD

    include 'core.php';
    
    new HttpParam(HTTP_GET, $name); //auto binding to $name as $_GET['name']
    new HttpParam(HTTP_GET, $user_id); //auto binding to $user_id as $_GET['user_id']

##POST-METHOD

    include 'core.php';
    
    new HttpParam(HTTP_POST, $user_id); //auto binding to $user_id as $_POST['user_id']
    new HttpParam(HTTP_POST, $user_pw); //auto binding to $user_pw as $_POST['user_pw']

##Check Parameter

    include 'core.php';
    
    check_param(array(
          new HttpParam(HTTP_GET, $name), //auto binding to $name as $_GET['name']
          new HttpParam(HTTP_GET, $user_id)); //auto binding to $user_id as $_GET['user_id']
    
    // if it isn't exist, echo {"code : 2", "message" : "RESULT_PARAM_NEED : name"}
