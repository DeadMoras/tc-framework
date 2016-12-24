<?php

namespace framework\routes;

class RouterB extends RouterL
{
    /**
     *
     * @var array
     */
    protected $afterRoutes;

    /**
     *
     * @var array
     */
    protected $beforeRoutes;

    /**
     *
     * @var object
     */
    protected $notFoundCallback;

    /**
     *
     * @var string
     */
    protected $baseRoute = '';

    /**
     *
     * @var string
     */
    protected $requestedMethod = '';

    /**
     *
     * @var string
     */
    protected $serverBasePath;

    /**
     *
     * @param object $pattern
     * @param string $fn
     */
    public function all($pattern, $fn)
    {
        $this->match('GET|POST|PUT|DELETE|OPTIONS|PATCH|HEAD', $pattern, $fn);
    }

    /**
     *
     * @param object $pattern
     * @param string $fn
     */
    public function get($pattern, $fn)
    {
        $this->match('GET', $pattern, $fn);
    }

    /**
     *
     * @param object $pattern
     * @param string $fn
     */
    public function post($pattern, $fn)
    {
        $this->match('POST', $pattern, $fn);
    }

    /**
     *
     * @param object $pattern
     * @param string $fn
     */
    public function put($pattern, $fn)
    {
        $this->match('PUT', $pattern, $fn);
    }

    /**
     *
     * @param object $pattern
     * @param string $fn
     */
    public function patch($pattern, $fn)
    {
        $this->match('PATCH', $pattern, $fn);
    }

    /**
     *
     * @param object $pattern
     * @param string $fn
     */
    public function delete($pattern, $fn)
    {
        $this->match('DELETE', $pattern, $fn);
    }

    /**
     *
     * @param object $pattern
     * @param string $fn
     */
    public function options($pattern, $fn)
    {
        $this->match('OPTIONS', $pattern, $fn);
    }

    /**
     *
     * @param string $methods
     * @param string $pattern
     * @param object $fn
     */
    public function match($methods, $pattern, $fn)
    {
        $pattern = $this->baseRoute . '/' . trim($pattern, '/');
        $pattern = $this->baseRoute ? rtrim($pattern, '/') : $pattern;
        $method = explode('|', $methods);
        $this->matchParse($method, $pattern, $fn);
    }

    /**
     *
     * @param string $baseRoute
     * @param callable $fn
     */
    public function mount($baseRoute, $fn)
    {
        $curBaseRoute = $this->baseRoute;
        $this->baseRoute .= $baseRoute;
        call_user_func($fn);
        $this->baseRoute = $curBaseRoute;
    }

    /**
     *
     * @return array
     */
    public function getRequestHeader()
    {
        if ( function_exists('getallheaders') ) {
            return getallheaders();
        }
        $headers = [];
        foreach ( $_SERVER as $name => $value ) {
            if ( (substr($name, 0, 5) == 'HTTP_') || ($name = 'CONTENT_TYPE') || ($name = 'CONTENT_LENGTH') ) {
                $headers[str_replace(['Http'], ['-', 'HTTP'], ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }

        return $headers;
    }

    /**
     *
     * @return string
     */
    public function getRequestMethod()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ( $_SERVER['REQUEST_METHOD'] == 'HEAD' ) {
            ob_start();
            $method = 'GET';
        } elseif ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            $headers = $this->getRequestHeader();
            if ( isset($headers['X-HTTP-Method-Override']) && in_array($headers, ['X-HTTP-Method-Override'], ['PUT', 'DELETE', 'PATCH']) ) {
                $method = $headers['X-HTTP-Method-Override'];
            }
        }

        return $method;
    }

    /**
     *
     * @param object $fn
     */
    public function default404($fn)
    {
        $this->notFoundCallback = $fn;
    }

    /**
     *
     * @return string
     */
    protected function getCurrentUri()
    {
        $uri = substr($_SERVER['REQUEST_URI'], strlen($this->getBasePath()));
        if ( strstr($uri, '?') ) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        return '/' . trim($uri, '/');
    }

    /**
     *
     * @return string
     */
    public function getBasePath()
    {
        if ( null === $this->serverBasePath ) {
            $this->serverBasePath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        }

        return $this->serverBasePath;
    }

    public function matchParse($method, $pattern, $fn)
    {
        foreach ( $method as $m ) {
            $this->afterRoutes[$m][] = ['pattern' => $pattern, 'fn' => $fn];
        }
    }

}
