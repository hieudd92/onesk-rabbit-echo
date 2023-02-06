# Rabbit Echo

Package description: OneSK send laravel echo event using rabbitmq worker queue

## Installation

Install via composer
```bash
composer require onesk/rabbit-echo
```

### Publish package assets

```bash
php artisan vendor:publish --provider="Onesk\RabbitEcho\ServiceProvider"
```

## Usage

$event = 'event name';
$channel = 'channel';
$type = 'public';
$message = 'new message';
$data = [];

app('rabbit-echo')->sendEvent($event, $channel, $type, $message, $data);

## Security

If you discover any security related issues, please email 
instead of using the issue tracker.
