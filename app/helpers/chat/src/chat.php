<?php

namespace MyApp;

use Ratchet\App;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
    protected $clients;
    protected $onlineUsers;

    protected $routes;
    private $onlineUserId;


    public function __construct()
    {
        $this->routes = array();
        $this->onlineUsers = array();
    }


    public function onOpen(ConnectionInterface $conn)
    {

        // Extract user_id from the query string
        $queryString = $conn->httpRequest->getUri()->getQuery();
        parse_str($queryString, $queryParams);

        $this->onlineUserId = isset($queryParams['userId']) ? $queryParams['userId'] : null;
        $conn->userId = $this->onlineUserId;

        $route = $conn->route;

        if (!isset($this->routes[$route])) {
            $this->routes[$route] = array(
                'connections' => new \SplObjectStorage,
                'clients' => 0,
            );
        }

        echo "New connection! ({$conn->resourceId}) in route $route \n";

        $this->routes[$route]['connections']->attach($conn);
        $this->routes[$route]['clients']++;

        /////////////////////////////////////////////

        // Store user as online
        $this->onlineUsers[$conn->resourceId] = $conn;

        // Broadcast online status to other clients in the same route
        $this->broadcastOnlineStatus(true, $conn);
        /////////////////////////////////////////////

    }



    public function onClose(ConnectionInterface $conn)
    {

        $route = $conn->route;

        $this->routes[$route]['connections']->detach($conn);
        $this->routes[$route]['clients']--;

        echo "Connection {$conn->resourceId} has disconnected from route $route \n";

        /////////////////////////////////////////////
        // Remove user from onlineUsers array
        unset($this->onlineUsers[$conn->resourceId]);

        // Broadcast online status to other clients in the same route
        $this->broadcastOnlineStatus(false, $conn);

        /////////////////////////////////////////////



        if ($this->routes[$route]['clients'] == 0) {

            unset($this->routes[$route]);
            echo "Route $route has been deleted\n";
        }
        echo "open routes are " . count($this->routes) . "\n";

        // list all open routes
        foreach ($this->routes as $key => $value) {
            echo "route: $key \n";
        }
    }



    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg);

        // if (isset($data->onlineStatus)) {

        //     // echo "hi I am chat id {$data->user_id}\n";

        //     $route = $from->route;
        //     $numRecv = count($this->routes[$route]['connections']) - 1;

        //     foreach ($this->routes[$route]['connections'] as $client) {
        //         if ($from !== $client) {
        //             // The sender is not the receiver, send to each client connected 
        //             $client->send(json_encode([
        //                 'user_id' => $data->user_id,
        //                 'user' => $from->resourceId,
        //                 'chat_id' => $data->chat_id,
        //             ]));
        //         }
        //     }
        //     $this->onlineUserId = $data->user_id;
        // }

        if (isset($data->newRoute)) {

            $newRoute = $data->newRoute;

            if (!isset($this->routes[$newRoute])) {

                $this->routes[$newRoute] = array(
                    'connections' => new \SplObjectStorage,
                    'clients' => 0,
                );
                echo "New route: $newRoute\n";
            }

            $from->route = $newRoute;

            $this->routes[$newRoute]['connections']->attach($from);
            $this->routes[$newRoute]['clients']++;

            echo "Connection {$from->resourceId} has connected to route $newRoute \n";
        } else if (isset($data->typing)) {

            $route = $from->route;
            $numRecv = count($this->routes[$route]['connections']) - 1;

            echo sprintf(
                'Connection %d is typing in %s route' . "\n",
                $from->resourceId,
                $route
            );

            foreach ($this->routes[$route]['connections'] as $client) {

                if ($from !== $client) {
                    // The sender is not the receiver, send to each client connected 
                    $client->send(json_encode([
                        'typing' => 'y',
                        'user_id' => $data->user_id,
                        'chat_id' => $data->chat_id
                    ]));
                }
            }
        } else {
            $route = $from->route;
            $numRecv = count($this->routes[$route]['connections']) - 1;
            echo sprintf(
                'Connection %d sending message "%s" to %d other connection%s through %s route' . "\n",
                $from->resourceId,
                $msg,
                $numRecv,
                $numRecv == 1 ? '' : 's',
                $route
            );

            foreach ($this->routes[$route]['connections'] as $client) {
                if ($from !== $client) {
                    // The sender is not the receiver, send to each client connected 
                    $client->send(json_encode([
                        'user_id' => $data->user_id,
                        'chat_id' => $data->chat_id,
                        'date' => $data->date,
                        'time' => $data->time,
                        'msg' => $data->msg
                    ]));
                }
            }
        }
    }

    protected function broadcastOnlineStatus($isOnline, ConnectionInterface $excludeConnection)
    {
        $status = [
            'type' => 'onlineStatus',
            'online' => $isOnline,
            'user_id' => $this->onlineUserId, // assuming you set this variable on each connection
        ];

        foreach ($this->routes[$excludeConnection->route]['connections'] as $client) {
            if ($client !== $excludeConnection) {
                $client->send(json_encode($status));
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
