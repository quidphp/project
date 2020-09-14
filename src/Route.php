<?php
declare(strict_types=1);
namespace Project;
use Quid\Site;

// route
// abstract class for a route, all routes will extend this class
abstract class Route extends Site\Route
{
    // config
    protected static array $config = [];
}
?>