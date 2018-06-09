<?php

use BEAR\Package\Bootstrap;
use BEAR\Resource\ResourceObject;
use BEAR\Sunday\Extension\Router\RouterMatch;
use BEAR\Sunday\Extension\Transfer\TransferInterface;
use BEAR\Sunday\Provide\Error\VndError;
use Swoole\Http\Request;
use Swoole\Http\Response;

require dirname(__DIR__) . '/vendor/autoload.php';

$app = (new Bootstrap)->getApp('MyVendor\Swoole', 'prod-swoole-app');
$http = new swoole_http_server("127.0.0.1", 8080);
$http->on("start", function ($server) {
    echo "Swoole http server is started at http://127.0.0.1:8080\n";
});
$http->on("request", function (Request $request, Response $response) use ($app) {
    /** @var Response $response */
    $method = strtolower($request->server['request_method']);
    $query = $method === 'get' ? $request->get : $request->post;
    $path = 'page://self'. $request->server['request_uri'];
    $responder = new class($response) implements TransferInterface
    {
        private $response;

        public function __construct(Response $response)
        {
            $this->response = $response;
        }

        public function __invoke(ResourceObject $ro, array $server)
        {
            $ro->toString();
            foreach ($ro->headers as $key => $value) {
                $this->response->header($key, $value);
            }
            $this->response->status($ro->code);
            $this->response->end($ro->view);
        }
    };
    try {
        /** @var $page ResourceObject */
        $page = $app->resource->{$method}->uri($path)($query);
        $page->transfer($responder, $_SERVER);
    } catch (\Exception $e) {
        echo $e; // on server screen, not to client
        $match = new RouterMatch;
        [$match->method, $match->path, $match->query] = [$method, $path, $query];
        (new VndError($responder))->handle($e, $match)->transfer();
    }
});
$http->start();
