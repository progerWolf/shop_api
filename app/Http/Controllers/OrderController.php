<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\CheckNumberRequest;
use App\Http\Requests\ConfirmOrderCodeRequest;
use App\Http\Requests\SendOrderConfirmCodeRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\CustomerProduct;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStartAddress;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $builder = Order::query();

        if (Auth::user()->hasRole('admin')) {
            $builder->with(['details', 'addresses', 'deliveryOption']);
        }

        if (Auth::user()->hasRole('employer')) {
            $builder->with(['details', 'addresses', 'deliveryOption', 'customer'])
                ->where('confirmed', '=', true)
                ->whereHas('details', function ($query) {
                    return $query->where('status', 'new');
                });
        }

        $orders = $builder->paginate(10);

        return OrderResource::collection($orders);
    }

    public function myOrders(): AnonymousResourceCollection
    {
        $builder = Order::query();

        if (Auth::user()->hasRole('user') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('employer')) {
            $builder->with(['details', 'addresses', 'deliveryOption', 'customer'])
                ->whereHas('customer', function ($query) {
                    return $query->where('user_id', Auth::user()->id);
                });
        }

        $orders = $builder->paginate(10);

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     * @return OrderResource|JsonResponse
     */
    public function store(StoreOrderRequest $request): OrderResource|JsonResponse
    {
        $checkCountry = checkAndFormatNumberCountry($request);

        if ($checkCountry !== true) {
            return $checkCountry;
        }

        $customerProduct = new CustomerProduct;
        $order = new Order();
        $orderDetails = new OrderDetail();
        $customerAddress = new CustomerAddress();

        $customer = Customer::query()
            ->firstOrCreate(
                ['phone' => $request->phone],
                ['country_code_id' => $request->country_code_id]
            );

        $customerProduct->title = $request->product_title;
        $customerProduct->save();

        $startAddress = OrderStartAddress::query()->firstOrCreate([
            'title' => $request->address_title,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        $order->customer_id = $customer->id;
        $order->tariff_id = (int)$request->tariff_id;
        $order->delivery_option_id = (int)$request->delivery_option_id;
        $order->save();

        $orderDetails->order_id = $order->id;
        $orderDetails->start_address_id = $startAddress->id;
        $orderDetails->customer_product_id = $customerProduct->id;
        $orderDetails->first_phone = $request->first_phone;
        $orderDetails->country_code_id = $request->first_phone_country_code_id;
        $orderDetails->worth = $request->worth;
        $orderDetails->weight = $request->weight;
        $orderDetails->status = 'new';
        $orderDetails->save();

        $customerAddress->order_id = $order->id;
        $customerAddress->title = $request->customer_address;
        $customerAddress->latitude = $request->customer_latitude;
        $customerAddress->longitude = $request->customer_longitude;
        $customerAddress->save();

        return new OrderResource($order);
    }

    /**
     * @param ConfirmOrderCodeRequest $request
     * @return bool|JsonResponse
     */
    public function confirmOrder(ConfirmOrderCodeRequest $request): JsonResponse|bool
    {
        $checkCountry = checkAndFormatNumberCountry($request);

        if ($checkCountry !== true) {
            return $checkCountry;
        }

        $phone = $request->phone;
        $customerId = $request->customer_id;
        $order = Order::with('customer')
            ->whereHas('customer', function ($query) use ($customerId, $phone) {
                return $query->where('id', $customerId)->where('phone', $phone);
            })
            ->where('confirm_code', $request->confirm_code)
            ->where('id', $request->order_id)
            ->first();

        if ($order->count() < 1) {
            return response()->json([
                'message' => 'Введен неправильный код.',
            ], 403);
        }

        $order->update([
            'confirmed' => true,
        ]);

        return response()->json([
            'confirmed' => true,
        ]);
    }

    /**
     * @param SendOrderConfirmCodeRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function sendConfirmCode(SendOrderConfirmCodeRequest $request): JsonResponse
    {
        $checkCountry = checkAndFormatNumberCountry($request);

        if ($checkCountry !== true) {
            return $checkCountry;
        }

        $phone = $request->phone;
        $customerId = $request->customer_id;
        $order = Order::with('customer')
            ->whereHas('customer', function ($query) use ($customerId, $phone) {
                return $query->where('id', $customerId)->where('phone', $phone);
            })
            ->where('id', $request->order_id)
            ->first();

        $confirm_code = random_int(1000, 9999);

        $order->update([
            'confirm_code' => $confirm_code
        ]);

        // $txn_id = uniqid();
        // $result = SMSGateway::Send($request->phone, 'Ваш код: ' . $confirm_code, $txn_id);

        // $smsResponse = sendSMS($request->phone, $confirm_code);

        // if (isset($smsResponse['transactions']['response'][0]['code'])) {
        //     return response()->json([
        //         'status'=> true
        //     ]);
        // }

        return response()->json([
            'confirm_code' => $confirm_code
            // 'status'=> false
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return OrderResource
     */
    public function show(Request $request,int $id): OrderResource
    {
        $order = Order::with('customer', 'details', 'addresses', 'deliveryOption')->where('id', $id)->first();
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
