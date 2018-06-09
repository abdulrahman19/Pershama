<?php
$app = [];

$app['config'] = require 'config.php';

require 'Router.php';
require 'Request.php';
require 'core/database/Connection.php';
require 'core/database/QueryBuilder.php';

$app['database'] = new QueryBuilder(
    Connection::make($app['config']['database'])
);