<?php

namespace App\Listeners;

use App\Events\NewOrderEvent;

class NewOrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewOrderEvent  $event
     * @return void
     */
    public function handle(NewOrderEvent $event)
    {
        $order = $event->order;

        $data_string = $this->formatMessageData($order);

        $this->sendMessageToSlack($data_string);
    }

    /**
     * Curl request to Slack hoook
     *
     * @param $data_string
     */
    public function sendMessageToSlack($data_string){
        $ch = curl_init(env('SLACK_HOOK_URL'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            )
        );

        if(curl_exec($ch) === false)
        {
            echo 'Curl error: ' . curl_error($ch);
        }
    }

    /**
     * Format data to JSON
     *
     * @param $order
     * @return string
     */
    public function formatMessageData($order){
        $products = [];

        foreach($order['products'] as $product){
            $pr = [];

            $pr['fallback'] = "Required plain-text summary of the attachment.";
            $pr['color'] = "#36a64f";
            $pr['fields'][0]['title'] = "Product Name";
            $pr['fields'][0]['value'] = json_decode($product['title'])->en;
            $pr['fields'][0]['short'] = true;
            $pr['fields'][1]['title'] = "Count";
            $pr['fields'][1]['value'] = $product['pivot']['count'];
            $pr['fields'][1]['short'] = true;

            array_push($products, $pr);
        }

        $phone = str_replace([')', '(', ' ', '-'], '', $order['customer_phone']);

        $data_string = '{
            "text": "*New Order* | <!date^'.time().'^{time_secs} | 00:00 AM> \n *Tel:* <tel:'.$phone.'|'.$phone.'> \n *Name:* '.$order['customer_name'].' \n *Addr:* '.$order['customer_address'].'\n *More Info:* '.$order['additional_info'].' \n *Sum:* '.($order['amount']+$order['shipping']).' AMD",
             "attachments":
                '.json_encode($products).'
         }';

        return $data_string;

    }
}
