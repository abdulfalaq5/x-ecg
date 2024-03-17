<?php

namespace App\Http\Repositories;

use App\Http\Controllers\Controller;
use Modules\Client\Entities\TrxModel;
use Modules\Client\Entities\PoliceModel;
use App\Models\TagihanModal;
use App\Models\MidtransModal;

class GeneretedPaymentRepository extends Controller
{
    public $client_key;
    public $server_key;
    public $isProduction;

    public function __construct()
    {
        $midtransConfig = config('midtrans');

        $this->client_key = $midtransConfig['client_key'];
        $this->server_key = $midtransConfig['server_key'];
        $this->isProduction = $midtransConfig['is_production'] == '1' ? true : false;
    }

    public function oAuthinitialToken()
    {
        $headers = [
            'Authorization' => 'Basic ' . base64_encode(ENV('CLIENT_ID') . ':' . ENV('CLIENT_SECRET')),
            'Content-Type'  => 'application/x-www-form-urlencoded',
        ];

        $client = new \GuzzleHttp\Client(['headers' => $headers]);
        $res    = $client->request('POST', config('app.payment_service_api') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
            'http_errors' => false,

        ]);
        $result = json_decode($res->getBody()->getContents(), true);

        $resultHeaders = [
            'Authorization' => 'Bearer ' . $result['access_token']
        ];

        return $resultHeaders;
    }

    public function paymentCc($request)
    {
        try {
            $client = new \GuzzleHttp\Client(['headers' => $this->oAuthinitialToken()]);
            $res    = $client->request('POST', config('app.payment_service_api') . '/v1/payments', [
                'form_params' => [
                    'promo' => $request['promo'],
                    'card_number' => $request['cc_number'],
                    'card_exp_month' => $request['exp_month'],
                    'card_exp_year' => $request['exp_year'],
                    'card_cvv' => $request['cvv'],
                    'customer_name' => $request['customer_name'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                    'plan_id' => $request['plan_id'],
                    'plan_name' => $request['plan_name'],
                    'amount' => $request['amount'],
                    'insured_id' => $request['insured_id'],
                    'product' => $request['product'],
                    'coverage' => $request['coverage'],
                    'beneficiaries' => $request['beneficiaries'],
                    'termin' => $request['termin']
                ],
                'http_errors' => false,
                'verify' => false
            ]);
            $result = json_decode($res->getBody()->getContents(), true);
            if ($result['result']) {
                if ($result['data']['transaction_status'] != 'deny') {
                    $datas = [
                        'order_id' => $result['data']['order_id'],
                        'redirect_url' => $result['data']['redirect_url']
                    ];
                    return json_encode($datas);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return false;
        }
    }

    public function getSnapToken($req, $getCourseById, $getDataPeserta)
    {
        try {
            \Midtrans\Config::$serverKey = $this->server_key;
            \Midtrans\Config::$isProduction = $this->isProduction;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $order_id = 'PYM' . $getCourseById->id . date('YmdHis');
            $product_id  = $getCourseById->id;
            $gross_amount  = $getCourseById->harga;
            $product_name  = $getCourseById->title;
            $customer_name = $getDataPeserta->name;
            $customer_email = $getDataPeserta->email;
            $customer_mobile_phone = $getDataPeserta->phone_number;
            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $gross_amount,
                ],
                'credit_card' => [
                    'secure' => true
                ],
                'item_details' => [
                    [
                        'id' => $product_id,
                        'price' => $gross_amount,
                        'quantity' => 1,
                        'name' => $product_name,
                    ]
                ],
                'customer_details' => [
                    'first_name' => $customer_name,
                    'email' => $customer_email,
                    'phone' => $customer_mobile_phone,
                ]
            ];
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            //$this->simpanTagihan($snapToken, $getCourseById, $getDataPeserta);
            $data = [];
            $data = [
                'token' => $snapToken,
                //'redirect_url' => config("base_url_web") . '/payment-status/' . $order_id,
            ];
            return $data;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return false;
        }
    }

   /* public function simpanTagihan($getCourseById, $getDataPeserta)
    {
        //simpan ke midtrans
        $save_midtrans = new MidtransModal;
        $save_midtrans->no_order = $order_id;
        $save_midtrans->pengguna_id = 
        $save_midtrans->tagihan_id = 
        $save_midtrans->total = 
        $save_midtrans->midtrans_statement = 
        $save_midtrans->transaction_status = 
        $save_midtrans->fraud_status = 
        $save_midtrans->payment_method = 
        $save_midtrans->payment_bank = 
        $save_midtrans->payment_va = 
        $save_midtrans->transaction_id = 
        $save_midtrans->response = 
        $save_midtrans->expired_at = 
        $save_midtrans->expired_at = 
    }*/

    public function getPaymentStatus($order_id)
    {
        try {
            $client = new \GuzzleHttp\Client(['headers' => $this->oAuthinitialToken()]);
            $res    = $client->request('GET', config('app.payment_service_api') . '/v1/payments/getstatus/' . $order_id, [
                'form_params' => [],
                'http_errors' => false,
            ]);
            $result = json_decode($res->getBody()->getContents());
            return $result;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return false;
        }
    }

    public function changeGetSnapToken($request)
    {
        try {
            $client = new \GuzzleHttp\Client(['headers' => $this->oAuthinitialToken()]);
            $res    = $client->request('POST', config('app.payment_service_api') . '/v1/payments/change-get-token-snap', [
                'form_params' => [
                    'customer_name' => $request['customer_name'],
                    'customer_email' => $request['customer_email'],
                    'customer_phone' => $request['customer_phone'],
                    'insured_id' => $request['insured_id'],
                    'total_premium' => $request['total_premium'],
                    'plan_id' => $request['plan_id'],
                    'plan_name' => $request['plan_name'],
                    'product' => $request['product_name_cover'],
                    'trx_id' => $request['trx_id'],
                    'is_recurring' => $request['is_recurring'],
                    'is_update' => $request['is_update']
                ],
                'http_errors' => false,
                'verify' => false
            ]);
            $result = json_decode($res->getBody()->getContents(), true);
            return $result;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return false;
        }
    }

    public function changePaymentCc($request)
    {
        try {
            $client = new \GuzzleHttp\Client(['headers' => $this->oAuthinitialToken()]);
            $res    = $client->request('POST', config('app.payment_service_api') . '/v1/payments/change-method-payment-cc', [
                'form_params' => [
                    'card_number' => $request['cc_number'],
                    'card_exp_month' => $request['exp_month'],
                    'card_exp_year' => $request['exp_year'],
                    'card_cvv' => $request['cvv'],
                    'customer_name' => $request['customer_name'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                    'plan_id' => $request['plan_id'],
                    'plan_name' => $request['plan_name'],
                    'amount' => $request['amount'],
                    'insured_id' => $request['insured_id'],
                    'product' => $request['product'],
                    'trx_id' => $request['trx_id'],
                    'is_recurring' => 0,
                    'is_update' => 1
                ],
                'http_errors' => false,
                'verify' => false
            ]);
            $result = json_decode($res->getBody()->getContents(), true);
            if ($result['result']) {
                if ($result['data']['transaction_status'] != 'deny') {
                    $datas = [
                        'order_id' => $result['data']['order_id'],
                        'redirect_url' => $result['data']['redirect_url']
                    ];
                    return json_encode($datas);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return false;
        }
    }

    public function getInquiry($police_no, $insured_product_id, $insured_id)
    {
        try {
            $client = new \GuzzleHttp\Client(['headers' => $this->oAuthinitialToken()]);
            $res    = $client->request('GET', config('app.payment_service_api') . '/v1/get-inquiry?police_no=' . $police_no . '&insured_product_id=' . $insured_product_id . '&insured_id=' . $insured_id, [
                'http_errors' => false,
                'verify' => false
            ]);
            $result = json_decode($res->getBody()->getContents(), true);
            return $result;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return false;
        }
    }

    public function getAlteration($insured_product_id)
    {
        try {
            $getTrx = TrxModel::where('insured_product_id', $insured_product_id)->first();
            $idPolice = PoliceModel::select('police_no')->where('insured_product_id', $insured_product_id)->first();
            $client = new \GuzzleHttp\Client(['headers' => $this->oAuthinitialToken()]);
            $res    = $client->request('GET', config('app.payment_service_api') . '/v1/get-alteration?orderId=' . $getTrx->trx_id . '&policyNo=' . $idPolice->police_no . '&oldPaymentMethod=C&newPaymentMethod=T', [
                'http_errors' => false,
                'verify' => false
            ]);
            $result = json_decode($res->getBody()->getContents(), true);
            return $result;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return false;
        }
    }

    public function sendMailFailed($insured_id)
    {
        try {
            $client = new \GuzzleHttp\Client(['headers' => $this->oAuthinitialToken()]);
            $client->request('GET', config('app.payment_service_api') . '/v1/payments/send-failed-firs-payment?insured_id=' . $insured_id, [
                'http_errors' => false,
                'verify' => false
            ]);
            return true;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return false;
        }
    }

    public function sendSuccessChangePayment($insured_id, $insured_product_id)
    {
        try {
            $idPolice = PoliceModel::select('police_no')->where('insured_product_id', $insured_product_id)->first();
            $client = new \GuzzleHttp\Client(['headers' => $this->oAuthinitialToken()]);
            $client->request('GET', config('app.payment_service_api') . '/v1/payments/send-success-change-payment?insured_id=' . $insured_id . '&police_no=' . $idPolice->police_no, [
                'http_errors' => false,
                'verify' => false
            ]);
            return true;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return false;
        }
    }
}
