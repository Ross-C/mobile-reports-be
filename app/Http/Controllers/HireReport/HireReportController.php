<?php
namespace App\Http\Controllers\HireReport;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Services\ResponseService;
use Validator;
use Config;
use Exception;
use DB;

class HireReportController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function hireSent(Request $request){
        $client = new Client();

        try {
            $res = $client->request('POST', config('app.mal_api').'/api/casetypes/hireSent', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . config('app.mal_api_token')
                ],
                'body' => json_encode($request->all()),
            ]);
        } catch (RequestException $e) {
            $e->getResponse()->getBody()->getContent();
        }
        return json_decode($res->getBody());
    }

    public function fetch(Request $request){
        $client = new Client();

        try {
            $res = $client->request('POST', config('app.mal_api').'/api/agentReports/fetch', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . config('app.mal_api_token')
                ],
                'body' => json_encode($request->all()),
            ]);
        } catch (RequestException $e) {
            $e->getResponse()->getBody()->getContent();
        }
        return json_decode($res->getBody());
    }
}