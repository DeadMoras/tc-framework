<?php

namespace Framework\Controllers;

class Router
{

    public static $halts = false;
    public static $routes = [];
    public static $methods = [];
    public static $callbacks = [];
    public static $patterns = [
        ':any' => '[^/]+',
        ':num' => '[0-9]+',
        ':all' => '.*'
    ];
    public static $error_callback;

    public static function __callstatic($method, $params)
    {
        $uri = dirname($_SERVER['PHP_SELF']) . '/' . $params[0];
        $callback = $params[1];

        array_push(self::$routes, $uri);
        array_push(self::$methods, strtoupper($method));
        array_push(self::$callbacks, $callback);
    }

    public static function error($callback)
    {
        self::$error_callback = $callback;
    }

    public static function halt($flag = true)
    {
        self::$halts = $flag;
    }

    public static function start()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $patternsKeys = array_keys(self::$patterns);
        $patternsReplace = array_values(self::$patterns);

        $found_route = false;

        self::$routes = preg_replace('/\/+/', '/', self::$routes);

        /*
          start routes without regex
         */
        if (in_array($uri, self::$routes)) {
            $validRoutes = array_keys(self::$routes, $uri);

            foreach ($validRoutes as $route) {
                if (self::$methods[$route] == $method || self::$methods[$route] == 'ANY') {
                    $found_route = true;

                    if (!is_object(self::$callbacks[$route])) {
                        $parts = explode('/', self::$callbacks[$route]);

                        $last = end($parts);

                        $segments = explode('@', $last);

                        $controller = new $segments[0]();

                        $controller->{$segments[1]}();

                        if (self::$halts) {
                            return self::$hats;
                        }
                    } else {
                        call_user_func(self::$callbacks[$route]);

                        if (self::$halts) {
                            return self::$hats;
                        }              
                }
            }
        } else {
            /*
              start routes with regex
             */

            $pos = 0;

            foreach (self::$routes as $route) {
                if (strpos($route, ':') !== false) {
                    $route = str_replace($patternsKeys, $patternsReplace, $route);
                }
                if (preg_match('#^' . $route . '$#', $uri, $matched)) {
                    if (self::$methods[$pos] == $method || self::$methods[$post] == 'ANY') {
                        $found_route = true;

                        array_shift($matched);
                        if (!is_object(self::$callbacks[$pos])) {
                            $parts = explode('/', self::$callbacks[$pos]);
                            $last = end($parts);
                            $segments = explode('@', $last);
                            $controller = new $segments[0]();

                            if (!method_exists($controller, $segments[1])) {
                                echo 'controller and action not found';
                            } else {
                                call_user_func_array([
                                    $controller, $segments[1]
                                        ], $matched);
                            }
                            if (self::$halts)
                                return;
                        } else {
                            call_user_func_array(self::$callbacks[$pos], $matched);

                            if (self::$halts)
                                return;
                        }
                    }
                }
                $pos++;
            }
        }

        if ($found_route == false) {
            if (!self::$error_callback) {
                self::$error_callback = function() {
                    header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found");
                    echo '404';
                    //use controller..
                };
            } else {
                if (is_string(self::$error_callback)) {
                    self::get($_SERVER['REQUEST_URI'], self::$error_callback);
                    self::$error_callback = null;
                    self::dispatch();
                    return;
                }
            }
            call_user_func(self::$error_callback);
        }
    }

}
