<?php 

namespace App\Http\Controllers\Almacenes;

// Controller Facturama
use App\Http\Controllers\FacturamaController;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Models\User;


class OrdersController extends Controller
{
    public $folder = "almacenes.orders";

    public function index()
    {
        $data = new Order;

        return view($this->folder.'.index', [ 
            'data' => $data->getAll(),
			'link' => 'orders/',
            
        ]); 
    }

    public function store(Request $request)
    {
        try {
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.price' => 'required|numeric|min:0'
        ]);

        $inputs = $request->all();
        $store = Auth::user();
        $user  = User::find($inputs['user_id']);
        $products = [];


        $totalPrice = array_reduce($request->products, function($total, $item) {
            return $total + ($item['price']);
        }, 0);
 
        $order = Order::create([
            'external_id' => '',
            'user_id' => 0, // Valor identificado desde el QR de la app
            'store_id' => $store->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->whatsapp_1,
            'address' => 'undefined',
            'd_charges' => $inputs['shipping'],
            'discount' => $inputs['discount'],
            'total' =>  $inputs['total'],
            'status' => 1,
            'notes' => '',
            'payment_method' => '01',
            'payment_id' => ''
        ]);

        foreach ($request->products as $product) {
            $quantity = collect($request->products)->where('id', $product['id'])->count();
            if (!OrderProduct::where('order_id', $order->id)->where('product_id', $product['id'])->exists()) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product['id'],
                    'quantity' =>  $quantity,
                    'price' => $product['price']
                ]);

                $products[] = [
                    "product" => [
                        "description" => $product['meta'],
                        "product_key" => $product['product_key'],
                        "price" => $product['price'],
                    ]
                ];
            }
        }

        $invoice = [
            'folio_number' => $order->id,
            'payment_form' => "01",
            'items' => $products
        ];
        // Call Facturama API to generate invoice
        $facturama = new FacturamaController;
        $inv = $facturama->createInvoice($invoice);

        if (isset($inv->id)) {
            $order->external_id = $inv->id;
            $order->self_invoice_url = $inv->self_invoice_url;
            $order->save();
            return response()->json(['message' => 'success','data' => $inv,'status' => 200]);
        }else {
            return response()->json(['message' => 'Error','status' => 500]);
        }

        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}