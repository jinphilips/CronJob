<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class RegisteredUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registered:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Registra un item en la base de datos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo ("test cron job");
        $userData = User::where('name', 'like', '%c%')->get();
        foreach ($userData as $user) {
            echo ($user->name);
        }

        $url = "https://apiv4.reallysimplesystems.com/accounts";
        $data =
        $data_array =  array(
            'name'        => 'test2',
            'addresscity' => 'testCity2',
            'addressline' => 'testLine2',
            "addresscounty/state"=> "testState2",
        );
        $make_call = $this->callAPI('POST', $url, json_encode($data_array));
        $response = json_decode($make_call, true);
        var_dump($response['metadata']);
    }

    function callAPI($method, $url, $data){

        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM1ZDAwMjYyMjhjZjMyOWIyY2VlNGZmYWY2NWQwMjFiOGQzYzdmYjJmMWM3NmJiNjFlMDE0N2Q5MmRlZmFhZGI0NzdkYWE3YmYyNDRkODhmIn0.eyJhdWQiOiI3IiwianRpIjoiMzVkMDAyNjIyOGNmMzI5YjJjZWU0ZmZhZjY1ZDAyMWI4ZDNjN2ZiMmYxYzc2YmI2MWUwMTQ3ZDkyZGVmYWFkYjQ3N2RhYTdiZjI0NGQ4OGYiLCJpYXQiOjE1NzEyMDk0NTEsIm5iZiI6MTU3MTIwOTQ1MSwiZXhwIjoxNjAyODMxODUxLCJzdWIiOiIzNjEiLCJzY29wZXMiOltdfQ.X3SYBi_IFYDmSbG9ARa_bgIWpyttehaR4E-KNl4od5kEkt0BRxu68Fgn3qjsVTVi3s71gQJpFdiuezO3ZrScVCXW6Gmm-etlGbvjkyXCrvCJw1WBTCa4aWmMsWl-tACK3dtkRT-DEyLi5bgh3rk-P2Wyk2-NFUSuGioBYzPSUQIv5MQZlfU6h34GltfVoUgcAKhSYhe9W2qEbjAoFEKpfikeHGe-52IVp_BQgsjQPTO8wxo9FmtTRDDd9ISlwx33oYUeTG9Z2kZV5PW5q6hGNPLVZ7p-B7yTcUvFXmw-BIShbTTtseVXzhac7ya-0gL_qtrPnFPergwCptrNfSI9F8XsMpsLziKfSpEqqATdDidDAhtaE1ynEgsebAb2BwJz1i4kK7MadQoUi9NxwCNdOFFnyerYOXcoYXK6L860g2in4uI0rJaxL1klU9iF9JcYzCXFArJn0j5mXBMNjsROEMlzMBlnvAvaz-QwZb8fn2PWcKSjDnqe2xa9xG38uzWb4gwz6ifQ3e1k2PHuBZFQdUw3dXgkty-BhG3lTpHloVOGcYiGhBIQ8P55dEDAhbKGCjZxkjP0E5V0FEEKjxEN9Mtona1VALrQMw4schcYDdLxA8qeqCaUhRusLw4nhkFhBiGx_hMRbME1weOgGSU6H08-mS6IUvrhrFNBm0AcWyA';

        $curl = curl_init();

        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "GET":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }
}
