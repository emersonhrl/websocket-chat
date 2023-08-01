<?php
    use Swoole\WebSocket\Server as Server;
    use Swoole\WebSocket\Frame as Frame;

    $app = new Server("0.0.0.0", 8099);

    $app->on("message", function (Server $app, Frame $message) {
        $connections = $app->connections;
        $origin = $message->fd;

        foreach($connections as $connection) {
            if ($connection === $origin) continue;
            $app->push(
                $connection,
                json_encode(['type' => 'chat', 'text' => $message->data])
            );
        }
    });

    $app->start();