<?php

namespace App\Http\Controllers\Almacenes;

// Controller Facturama
use App\Http\Controllers\FacturamaController;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Banner;
use App\Models\City;
use App\Models\User;
use App\Models\Admin;
use App\Models\BannerStore;
use DB;
use Validator;
use Redirect;
use IMS;

class BillController extends Controller
{
    public $folder  = "restaurantes/bills.";

    public function index()
    {
        $res = new FacturamaController;

        // return response()->json([
        //     'data' => (object)$res->getCFDIS(),
        // ]);

        return View($this->folder.'index',[
            'data' => (object)$res->getCFDIS(),
            'link' => '/bill_clients/'
        ]);
    }
 
    /**
     * 
     * Listado de productos
     * 
     */
    public function get_products()
    {
        $res = new FacturamaController;
        return View($this->folder.'list_products',[
            'data' => $res->getProducts(),
            'link' => '/bill_products/'
        ]);
    }

    public function addProduct()
    {
        return View($this->folder.'addProducts',[
            'data' 		=> [],
            'form_url' 	=> '/addProduct'
        ]);
    }

    public function _addProduct(Request $request)
    {
        try {
            $newClient = new FacturamaController;
            $req = $newClient->addProduct($request->all());
            if (isset($req->id)) {
                return redirect('/bill_products')->with('message','Nuevo Producto agregado.');
            }else {
                return redirect('/bill_products')->with('error','Ha ocurrido un problema.');
            }
        } catch (\Exception $th) {
            return redirect('/add_product')->with('error','Error : ',$th->getMessage());
        }

    }

    public function deleteProduct($id)
    {
        $req = new FacturamaController;

        if ($req->deleteProduct($id)) {
            return redirect('/bill_products')->with('message','Producto eliminado.');
        } else {
            return redirect('/bill_products')->with('error','Ha ocurrido un problema.');
        }
    }

    public function getClients()
    {
        $res = new FacturamaController;

        return View($this->folder.'list_clients',[
            'data' => $res->getClients(),
            'link' => '/bill_clients/'
        ]);
    }

    public function addClient()
    {
        return View($this->folder.'addClient',[
            'data' 		=> [],
            'form_url' 	=> '/addClient'
        ]);
    }

    public function editClient($id)
    {
        $req = new FacturamaController;
        
        // return response()->json($req->searchClientById($id));
        
        return View($this->folder.'editClient',[
            'data' 		=> $req->searchClientById($id),
            'form_url' 	=> '/updateClient'
        ]);
    }
    
    public function _addClient(Request $request)
    {
        try {
            $newClient = new FacturamaController;
            $req = $newClient->addClient($request->all(),'new');
            if (isset($req->id)) {
                return redirect('/bill_clients')->with('message','Nuevo cliente agregado.');
            }else {
                return redirect('/bill_clients')->with('error','Ha ocurrido un problema.');
            }
           
        } catch (\Exception $th) {
            return redirect('/add_client')->with('error','Error : ',$th->getMessage());
        }

    }

    public function updateClient(Request $request)
    {
        try {
            $newClient = new FacturamaController;
            $req = $newClient->addClient($request->all(),'update');
            if (isset($req->id)) {
                return redirect('/bill_clients')->with('message','Nuevo cliente agregado.');
            }else {
                return redirect('/bill_clients')->with('error','Ha ocurrido un problema.');
            }
        } catch (\Exception $th) {
            return redirect('/add_client')->with('error','Error : ',$th->getMessage());
        }
    }

    public function deleteClient($id)
    {
        try {
            $req = new FacturamaController;
            $req->DeleteClient($id);
            return redirect('/bill_clients')->with('message','Cliente eliminado con éxito.');
        } catch (\Exception $th) {
            return redirect('/bill_clients')->with('error','Error : ',$th->getMessage());
        }
    }

    public function generate_bill()
    {
        $req = new FacturamaController;

        return View($this->folder.'generateBill',[
            'data' 	=> [],
            'products' => $req->getProducts(),
            'form_url' 	=> '/generate_bill'
        ]);
    }
    
    public function generate_bill_client($id)
    {
        $req = new FacturamaController;

        return View($this->folder.'generateBill',[
            'data' 	=> $req->searchClientById($id),
            'products' => $req->getProducts(),
            'form_url' 	=> '/generate_bill'
        ]);
    }

    public function _generate_bill(Request $request)
    {

       try {
            $newBill = new FacturamaController;
            $req = $newBill->GenerateBill($request->all());
 
            if (isset($req->id)) {
                return redirect('/bill')->with('message','Nueva factura generada.');
            }else {
                return redirect('/bill')->with('error','Ha ocurrido un problema.');
            }
           
        } catch (\Exception $th) {
            return redirect('/add_client')->with('error','Error : ',$th->getMessage());
        }
    }

    public function download_bill($id, $type)
    {
        try {
            $downBill = new FacturamaController;
            $req = $downBill->DownloadBill($id, $type);

            return $req;
            
        } catch (\Exception $th) {
            return redirect('/bill')->with('error','Error : '.$th->getMessage());
        }
    }

    public function send_bill_email($id)
    {
        try {
            $sendMail = new FacturamaController;
            $req = $sendMail->SendMail($id);

            if (isset($req->ok)) {
                return redirect('/bill')->with('message','Factura Enviada con éxito.');
            }else {
                return redirect('/bill')->with('error','Ha ocurrido un problema.');
            }
            
        } catch (\Exception $th) {
            return redirect('/bill')->with('error','Error : '.$th->getMessage());
        }
    }

    public function cancel_bill($id)
    {
        return View($this->folder.'CancelBill',[
            'id' 	=> $id,
            'form_url' 	=> '/cancel_bill'
        ]);
    }

    public function _cancel_bill(Request $request)
    {
        try {
            $cancelBill = new FacturamaController;
            $req = $cancelBill->CancelBill($request->all());
 
            if (isset($req->id)) {
                return redirect('/bill')->with('message','Factura cancelada con éxito.');
            }else {
                return redirect('/bill')->with('error','Ha ocurrido un problema.');
            }
           
        } catch (\Exception $th) {
            return redirect('/bill')->with('error','Error : '.$th->getMessage());
        }
    }
}