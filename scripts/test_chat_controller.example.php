<?php
// (Duplicated earlier, ignore)
<?php
/**
 * Example script: test_chat_controller
 * Usage: copy to scripts/test_chat_controller.php and run
 */
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Http\Request;
use App\Http\Controllers\ChatbotController;

$req = Request::create('/chatbot/message','POST',['message'=>'Please show me the shop']);
$controller = app(ChatbotController::class);
$response = $controller->chat($req);
file_put_contents(__DIR__.'/test_chat_controller_result.json',$response->getContent());
echo $response->getContent();
