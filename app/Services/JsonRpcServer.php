<?php
namespace App\Services;
use App\Services\JsonRpcResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JsonRpcServer
    {
        /*
         * Обработка запроса и перевод его на определенный контроллер
         */
        public function handle(Request $request)
        {
            try {
                $content = json_decode($request->getContent(), true);

                if (empty($content)) {
                    throw new \Exception('Parse error', 422);
                }

                try {
                    $method = explode('.', $content['method']);
                    $controller = 'App\Http\Controllers\\'.Str::ucfirst($method[0]).'Controller';
                    $action = $method[1];
                } catch (\Exception $e){
                    abort(404, "Incorrect action name");
                }
                if($this->check($controller, $action)){
                    $result = app($controller)->{$action}(...[$content['params']]);
                    return JsonRpcResponse::success($result, $content['id']);
                }
            } catch (\Exception $e) {
                return JsonRpcResponse::error('Incorrect query');
            }
        }

        /*
         * Проверка на существование контроллера и метода
         */
        private function check($controller, $action)  {
            $aMethods = get_class_methods($controller);
            if($aMethods) {
                foreach ($aMethods as $idx => $method) {
                    if($action==$method) return true;
                }
            } else  {
                abort(404, "Controller or action not found");
            }
            abort(404, "Controller or action not found");
        }
    }
?>
