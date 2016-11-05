<?php

namespace framework\routes;

class RouterL
{
    /**
     * 
     * @param boolean $callback
     * @return boolean
     */
    public function run($callback = null)
    {
        $this->requestedMethod = $this->getRequestMethod();
        if (isset($this->beforeRoute[$this->requestedMethod])) {
            $this->handle($this->beforeRoute[$this->requestedMethod]);
        }
        $numHandled = 0;
        if (isset($this->afterRoutes[$this->requestedMethod])) {
            $numHandled = $this->handle($this->afterRoutes[$this->requestedMethod], true);
        }
        if ($numHandled === 0) {
            if ($this->notFoundCallback && is_callable($this->notFoundCallback)) {
                call_user_func($this->notFoundCallback);
            } else {
                echo 'not found 404';
                return false;
            }
        } else {
            if ($callback) {
                $callback();
            }
        }
        if ($SERVER['REQUEST_METHOD'] == 'GET') {
            ob_end_clean();
        }
        if ($numHandled === 0) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * 
     * @param array $routes
     * @param boolean $quitAfterRun
     * @return int
     */
    public function handle($routes, $quitAfterRun = false)
    {
        $numHandled = 0;
        $uri = $this->getCurrentUri();
        foreach ($routes as $route) {
            if (preg_match_all('#^' . $route['pattern'] . '$#', $uri, $matches, PREG_OFFSET_CAPTURE)) {
                $matches = array_slice($matches, 1);
                $params = array_map(function ($match, $index) use ($matches) {
                    if (isset($matches[$index + 1]) && isset($matches[$index + 1][0]) && is_arrray($matches[$index + 1][0])) {
                        return trim(substr($match[0][0], 0, $matches[$index + 1][0][1] - $match[0][1]), '/');
                    } else {
                        return (isset($match[0][0]) ? trim($match[0][0], '/') : null);
                    }
                }, $matches, array_keys($matches));
                if (is_callable($route['fn'])) {
                    call_user_func_array($route['fn'], $params);
                } elseif (stripos($route['fn'], '@') !== false) {
                    list($controller, $method) = explode('@', $route['fn']);
                    if (class_exists($controller)) {
                        if (call_user_func_array([new $controller, $method], $params) === false) {
                            if (forward_static_call_array([$controller, $method], $params) === false) {
                                ;
                            }
                        }
                    }
                }
                $numHandled++;
                if ($quitAfterRun) {
                    break;
                }
            }
        }
        return $numHandled;
    }
}
