<?php
namespace app;
use controllers\auth\AuthController;
use controllers\home\HomeController;
use controllers\pages\PageController;
use controllers\roles\RoleController;
use controllers\users\UsersController;

class Router
{
    //определяем маршруты при помощи регулярки
    private $routes = [
        '/^\/' . APP_BASE_PATH . '\/?$/' => ['controller' => 'home\\HomeController', 'action' => 'index'],
        '/^\/' . APP_BASE_PATH . '\/users(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'users\\UsersController'],
    ]; // /crud/users/edit/123

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $controller = null;
        $action = null;
        $params = null;
        //Пробегаем по маршрутам пока не найдем нужный
        foreach ($this->routes as $pattern => $route){
            //Ищем маршрут идентичный URI
            if (preg_match($pattern, $uri, $matches)){
                //Получаем имя контроллера с маршрута
                $controller = "controllers\\" . $route['controller'];
                //Получаем действие из маршрута если оно есть
                $action = $route['action'] ?? $matches['action'] ?? 'index';
                // Получаем параметры из совпавших с регуляркой
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                // Прерываем цикл если находим маршрут
                break;
            }
        }

        if(!$controller){
            http_response_code(404);
            echo "Page not fount!";
            return;
        }
        $controllerInstance = new $controller();
        if(!method_exists($controllerInstance, $action)){
            http_response_code(404);
            echo "Page not fount!";
            return;
        }
        call_user_func_array([$controllerInstance, $action], [$params]);
    }
}