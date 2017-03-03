<?php

    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), ['twig.path' => __DIR__."/../views"]);

    $server = "mysql:host=localhost:8889;dbname=shoes";
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->post('/add_store', function() use ($app) {
        $name = $_POST['name'];
        $new_store = new Store($name);
        $new_store->save();
        return $app['twig']->render('stores.html.twig', ['stores' => Store::getAll()]);
    });

    $app->get('/stores', function() use ($app) {
        return $app['twig']->render('stores.html.twig', ['stores' => Store::getAll()]);
    });

    $app->get('/store/{id}', function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', ['store' => $store, 'all_brands' => Brand::getAll(), 'brands' => $store->getBrands()]);
    });

    $app->patch('/edit_store/{id}', function($id) use ($app) {
        $store = Store::find($id);
        $new_name = $_POST['name'];
        $store->update($new_name);
        return $app->redirect("/store/".$id);
    });

    $app->delete('/delete_store/{id}', function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app->redirect("/stores");
    });

    $app->post('/assign_brand/{id}', function($id) use ($app) {
        $store = Store::find($id);
        $store->addBrand($_POST['assign-brand']);
        return $app->redirect("/store/".$id);
    });

    $app->get('/brands', function() use ($app) {
        return $app['twig']->render('brands.html.twig', ['brands' => Brand::getAll()]);
    });

    $app->post('/add_brand', function() use ($app) {
        $name = $_POST['name'];
        $new_brand = new Brand($name);
        $new_brand->save();
        return $app['twig']->render('brands.html.twig', ['brands' => Brand::getAll()]);
    });

    $app->get('/brand/{id}', function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render('brand.html.twig', ['brand' => $brand, 'all_stores' => Store::getAll(), 'stores' => $brand->getStores()]);
    });

    $app->post('/assign_store/{id}', function($id) use ($app) {
        $brand = Brand::find($id);
        $brand->addStore($_POST['assign-store']);
        return $app->redirect("/brand/".$id);
    });

    $app->post('/delete_all', function() use ($app) {
        Store::deleteAll();
        return $app->redirect("/stores");
    });

return $app;

?>
