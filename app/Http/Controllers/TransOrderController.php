<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TransOrders;
use App\Models\Customers;
use App\Models\TransDetails;
use App\Models\TypeOfServices;
use Midtrans\Config;
use Midtrans\Snap;

class TransOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $title = "Transaksi Order";
        $datas = TransOrders::with('customer')->orderBy('id', 'desc')->get();
        return view('trans.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = Carbon::now()->format('dmy');
        $countDay = TransOrders::whereDate('created_at', now()->toDateString())->count() + 1;
        $runningNumber = str_pad($countDay, 3, '0', STR_PAD_LEFT);
        $title = "Tambah Transaksi";
        $orderCode = "TR" . $today . "-" . $runningNumber;
        $customers = Customers::OrderBy('id', 'desc')->get();
        $services = TypeOfServices::OrderBy('id', 'desc')->get();
        return view('trans.create', compact('title', 'orderCode', 'customers', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_end_date' => 'required'
        ]);

        $transOrder = TransOrders::create([
            'id_customer' => $request->id_customer,
            'order_code' => $request->order_code,
            'order_end_date' => $request->order_end_date,
            'total' => $request->grand_total,
        ]);

        foreach ($request->id_product as $key => $idProduct) {
            $id_trans = $transOrder->id;
            TransDetails::create([
                'id_trans' => $id_trans,
                'id_service' => $idProduct,
                'qty' => $request->qty[$key],
                'subtotal' => $request->total[$key]
            ]);
        }
        return redirect()->route('trans.index');
    }

    /**
     * Display the specified resource.
     */



    public function show(string $id)
    {
        $title = "Detail Transaksi";
        $details = TransOrders::with(['customer', 'details.service'])->where('id', $id)->first();

        // $params = [
        //     'transaction_details' => [
        //         'order_id' => rand(),
        //         'gross_amount' => 10.000,
        //     ],
        //     'customer_details' => [
        //         'first_name' => "Bambang",
        //         'last_name' => "Pamungkas",
        //         'email' => "bambang@gmail.com",
        //         'phone' => "089191919191",
        //     ],
        //     'enable_payment' => [
        //         'qris'
        //     ]
        // ];
        // $snapToken = Snap::getSnapToken($params);
        return view('trans.show', compact('title', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}

    public function printInvoice(string $id)
    {
        $details = TransOrders::with(['customer', 'details.service'])->where('id', $id)->first();
        // return $details;
        return view('trans.print', compact('details'));
    }

    public function snap(Request $request, $id)
    {
        $order = TransOrders::with('details', 'customer')->findOrFail($id);

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => 10000,
            ],
            'customer_details' => [
                'first_name' => "Bambang",
                'last_name' => "Pamungkas",
                'email' => "bambang@gmail.com",
                'phone' => "089191919191",
            ],
            'enable_payment' => [
                'qris'
            ]
        ];
        $snap = Snap::createTransaction($params);
        return response()->json(['token' => $snap->token]);
    }
}
