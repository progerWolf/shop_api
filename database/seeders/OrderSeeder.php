<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\CustomerProduct;
use App\Models\Delivery;
use App\Models\DeliveryOption;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStartAddress;
use App\Models\PartnershipProposal;
use App\Models\Tariff;
use Database\Factories\OrderStartAddressFactory;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tariffs = Tariff::factory(3)->create();

        $customers = Customer::factory(10)->create();

        $start_addresses = OrderStartAddress::factory(10)->create();

        $deliveries = Delivery::factory(3)->create();
        $deliveries->each(function ($delivery){
            DeliveryOption::factory(3)->create(['delivery_id' => $delivery->id]);
        });

        $deliveryOptions = DeliveryOption::all();

        $customers->each(function ($customer) use ($tariffs, $deliveryOptions) {
            $tariffs->each(function ($tariff) use($deliveryOptions, $customer) {
                $deliveryOptions->each(function ($deliveryOption) use ( $tariff, $customer) {
                    Order::factory(1)->create([
                        'customer_id'=> $customer->id,
                        'delivery_option_id' => $deliveryOption->id,
                        'tariff_id' => $tariff->id
                    ]);
                });
            });
        });

        $orders = Order::all();
        $orderDetails = new OrderDetail;
        $orders->each(function ($order) use ($orderDetails, $start_addresses) {
            CustomerAddress::factory(2)->create(['order_id' => $order->id]);
            $start_addresses->each(function ($start_address) use ($order, $orderDetails) {
                $product = CustomerProduct::factory(1)->create();
                $productId = $product->pluck('id')[0];
                $orderDetails::factory(1)->create([
                    'start_address_id' => $start_address->id,
                    'order_id' => $order->id,
                    'customer_product_id' => $productId
                ]);
            });
        });


    }
}
