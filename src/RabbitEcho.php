<?php

namespace Onesk\RabbitEcho;

use Onesk\RabbitEcho\Services\RabbitMQ;

class RabbitEcho
{
	private $rabbitmq;

	public function __construct()
	{
		$this->rabbitmq = new RabbitMQ();
	}

	/**
	 * [send event to laravel echo server using rabbit worker queue]
	 * @param  [String] $eventName [event name]
	 * @param  [String] $channel   [channel name]
	 * @param  [String] $type      [public/private]
	 * @param  [String] $message   [message send]
	 * @param  array  $data      [data optional]
	 * @return mixed
	 */
	public function sendEvent($eventName, $channel, $type, $message, $data=[])
	{
		$data = [
            'event' => $eventName,
            'channel' => $channel,
            'type' => $type,
            'message' => $message,
            'data' => $data
        ];
        $this->rabbitmq->declareWorkerQueueClient(config('rabbit-echo.echo_socket_queue'), $data);
	}
}
