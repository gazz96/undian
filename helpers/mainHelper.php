<?php 

function blade()
{
    return new \Jenssegers\Blade\Blade('views', 'cache');
}

function view(string $path, array $data = [])
{
    echo blade()->render($path, $data);
}

function url($path = "")
{
    $path = trim($path, "/");
    return "https://bagistudio.com/eden/" . $path;
}

function flash($name = null)
{
    if(isset($_SESSION[$name]))
    {
        $name = $_SESSION[$name];
        unset($_SESSION[$name]);
        return $name;
    }
    return '';
}

function old($name, $default = "")
{
    if(isset($_SESSION['oldInputs']) && isset($_SESSION['oldInputs'][$name]))
    {
        $input = $_SESSION['oldInputs'][$name];
        return $input;
    }

    return $default;
}

function error($name)
{
    if(isset($_SESSION['errors']) && isset($_SESSION['errors'][$name]))
    {
        $input = $_SESSION['errors'][$name];
        return $input;
    }

    return '';
}

function database()
{
    $capsule = new Illuminate\Database\Capsule\Manager;

    $capsule->addConnection([
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'undian',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]);

    // Set the event dispatcher used by Eloquent models... (optional)
    $capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher(new \Illuminate\Container\Container));

    // Make this Capsule instance available globally via static methods... (optional)
    $capsule->setAsGlobal();

    // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
    $capsule->bootEloquent();
}

