<?php

namespace App\Integrations;
use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;
use Illuminate\Http\Request;
class PagSeguro
{

    //Error in pagseguro api
    public function generateTicket()
    {
        $client = new Client();
        $headers = [
        'Content-Type' => 'application/json',
        'Authorization' => '14C4F60D4D504C89A4860C4C0FAF3C73',
        'x-api-version' => '4.0',
        'x-idempotency-key' => ''
        ];
        // $body = '{
        //     "reference_id": "ex-00001",
        //     "description": "boleto curso",
        //     "amount": {
        //       "value": 10,
        //       "currency": "BRL"
        //     },
        //     payment_method:0,
        //     "payment_method": {
        //       "type": "BOLETO",
        //       "boleto": {
        //         "due_date": "2024-12-31",
        //         "instruction_lines": {
        //           "line_1": "Pagamento processado para DESC Fatura",
        //           "line_2": "Via PagSeguro"
        //         },
        //         "holder": {
        //           "name": "Marcelo Coellho Amorim Junior",
        //           "tax_id": "17516424706",
        //           "email": "macj.10@email.com",
        //           "address": {
        //             "street": "Avenida Brigadeiro Faria Lima",
        //             "number": "1384",
        //             "locality": "Pinheiros",
        //             "city": "Sao Paulo",
        //             "region": "Sao Paulo",
        //             "region_code": "ES",
        //             "country": "Brasil",
        //             "postal_code": "29309100"
        //           }
        //         }
        //       }
        //     }';
        $body = [ 
            "reference_id"=> "ex-00001",
            "description"=> "boleto curso",
            "amount"=>  [
                "value"=>  10,
                "currency"=>  "BRL"
            ],
            "payment_method"=>  [
                "type"=>  "BOLETO",
                "boleto"=>  [
                    "due_date"=>  "2024-12-31",
                    "instruction_lines" =>  [
                      "line_1"=>  "Pagamento processado para DESC Fatura",
                      "line_2"=>  "Via PagSeguro"
                    ],
                    "holder"=>  [
                        "name"=>  "Marcelo Coellho",
                        "tax_id"=>  "31516024706",
                        "email"=>  "macj.10@email.com",
                        "address"=>  [
                            "street"=>  "Avenida Brigadeiro Faria Lima",
                            "number"=>  "1384",
                            "locality"=>  "Pinheiros",
                            "city"=>  "Sao Paulo",
                            "region"=>  "Sao Paulo",
                            "region_code"=>  "ES",
                            "country"=>  "Brasil",
                            "postal_code"=>  "29309100"
                        ]
                    ]
                ]
            ]
        ];
        $body = \json_encode($body);
        $request = new \GuzzleHttp\Psr7\Request('POST', 'https://sandbox.api.pagseguro.com/charges', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        $res->getBody();
    }

}