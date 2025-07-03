<?php
// Error reporting untuk development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session management
session_start();

require_once __DIR__ . '/../app/core/Autoloader.php';
require_once __DIR__ . '/../app/config/Database.php';

use Core\Autoloader;
use Core\App;

spl_autoload_register([Autoloader::class, 'load']);

try {
    // Redirect root URL to landing page controller
    if (!isset($_GET['url']) || $_GET['url'] === '' || $_GET['url'] === 'landing') {
        if (isset($_SESSION['user_id'])) {
            // If user is logged in, redirect to dashboard
            header('Location: /elektronik/public/home');
        } else {
            // Otherwise, show landing page
            $landing = new \Controllers\LandingController();
            $landing->index();
        }
        exit;
    }
    $app = new App();
} catch (Exception $e) {
    error_log($e->getMessage());
    die('Terjadi kesalahan sistem. Silakan coba lagi nanti.');
}
?>
