<?php

namespace Onesk\RabbitEcho\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQ
{	
	private $connection;

	public function __construct()
	{
		$host = config('rabbitmq.connections.rabbitmq.host');
        $port = config('rabbitmq.connections.rabbitmq.port');
        $user = config('rabbitmq.connections.rabbitmq.login');
        $password = config('rabbitmq.connections.rabbitmq.password');
        $vhost = config('rabbitmq.connections.rabbitmq.vhost');

        $this->connection = new AMQPStreamConnection($host, $port, $user, $password, $vhost);
	}

    /**
     * Work queue call
     * @param  [json] $request
     * @return mixed
     */
    public function declareWorkerQueueClient($queue, $request)
    {
        $channel = $this->connection->channel();
        $channel->queue_declare($queue, false, true, false, false);

        $message = new AMQPMessage(json_encode($request));
        $channel->basic_publish($message, '', $queue);

        $channel->close();
        $this->connection->close();
    }

	/**
     * @param $request
     * @param string $string
     */
    public static function replyTo($request, $string = "[]")
    {
        $msg = new AMQPMessage(
            $string,
            array('correlation_id' => $request->get('correlation_id'))
        );
        $request->delivery_info['channel']->basic_publish(
            $msg,
            '',
            $request->get('reply_to')
        );
        // $request->ack();
    }

	/**
     * [declareAck description]
     * @param $request
     * @return void
     */
    public static function declareAck($request)
    {
        $request->delivery_info['channel']->basic_ack($request->delivery_info['delivery_tag']);
    }
}