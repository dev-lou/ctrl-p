<?php
/**
 * Example script: test_chat_limits
 * Usage: copy to scripts/test_chat_limits.php and run to check rate limits
 */
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Http\Request;
use App\Http\Controllers\ChatbotController;

for ($i=0; $i<3; $i++) {
    $req = Request::create('/chatbot/message','POST',['message'=>'How are you?']);
    $controller = app(ChatbotController::class);
    $response = $controller->chat($req);
    echo "Response {$i}: " . $response->getContent() . PHP_EOL;
}
