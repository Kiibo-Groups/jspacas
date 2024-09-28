<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Filesystem\Filesystem;
use Twilio\Rest\Client;
use App\Models\Admin;
use App\Models\User;
use App\Models\AppUser;
use Storage;
use Facturapi\Facturapi;

class FacturamaController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const APIKEYFACT = "sk_test_g3keQzw6MNGdArpK203aqekGZxbRlnovL7EZOaXBmq";
    private $facturapi;

    public function __construct()
    {
        // Inicializamos objeto
        $this->facturapi = new Facturapi(self::APIKEYFACT);
    }

    /**
     * PRODUCTOS
     */
    function getProducts()
    {
        try {
            $searchResult = $this->facturapi->Products->all([
                "page" => 1
            ]);

            return $searchResult;

        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    function addProduct($data)
    {
        try {
            $product = $this->facturapi->Products->create([ 
                "description" => $data['meta'],
                "product_key" => $data['product_key'],
                "unit_key"    => $data['unit_key'],
                "price" => floatval($data['price']),
                "sku" => $data['barcode'],
                'taxes' => [
                    [
                        "type" => "IVA",
                        "rate" => floatval($data['taxes']),
                    ]
                ]
            ]);

            return $product;

        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    function editProduct($data)
    {
        try {
            $product = $this->facturapi->Products->update($data['id_sat'], [
                "description" => $data['meta'],
                "product_key" => $data['product_key'],
                "unit_key"    => $data['unit_key'],
                "price" => floatval($data['price']),
                "sku" => $data['barcode'],
                'taxes' => [
                    [
                        "type" => "IVA",
                        "rate" => floatval($data['taxes']),
                    ]
                ]
            ]);
            return $product;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
    function deleteProduct($id)
    {
        try {
            $this->facturapi->Products->delete($id);
            return true;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    function searchProductById($id)
    {
        try {
            $product = $this->facturapi->Products->retrieve($id);
            return $product;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * CLIENTES
     */
    function addClient($data, $type)
    {
        try {
            if ($type == 'new') {
                $customer = $this->facturapi->Customers->create($data);
            } else {
                $customer = $this->facturapi->Customers->update($type, $data);
            }

            return $customer;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    function getClients()
    {
        try {
            $searchResult = $this->facturapi->Customers->all([
                "page" => 1
            ]);
            return $searchResult;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    function searchClientById($id)
    {
        try {
            $customer = $this->facturapi->Customers->retrieve($id);
            return $customer;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    function DeleteClient($id)
    {
        try {
            $this->facturapi->Customers->delete($id);
            return true;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Recibos
     */
    function getInvoices()
    {
        // Todos los recibos de la organización
        $searchResult = $this->facturapi->Receipts->all();
        return $searchResult;
    }

    function createInvoice($invoice)
    {
        $receipt = $this->facturapi->Receipts->create([
            "folio_number" => $invoice['folio_number'],
            "payment_form" => $invoice['payment_form'],
            "items" =>  $invoice['items'] 
        ]);

        return $receipt;
    }

    /**
     * FACTURAS
     */
    function getCFDIS()
    {
        try {
            // Todos los recibos de la organización
            $searchResult = $this->facturapi->Invoices->all();
            return $searchResult;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    function GenerateBill($data)
    {
        try {
            $client = $this->searchClientById($data['clientId']);

            // Enlistamos los productos
            $listProds = [];
            for ($i=0; $i < count($data['item']); $i++) { 
           
                $product = $this->searchProductById($data['item'][$i]);

                $listProds[] = [
                    "quantity" => $data['qty'][$i],
                    "product" => [
                        "description" => $product->description,
                        "product_key" => $product->product_key,
                        "price" => $product->price,
                        "sku" => $product->sku
                    ]
                ];
            }

            // Formamos la Factura
            $data_invoice = [
                "customer" => $data['clientId'],
                "items" => $listProds,
                "use" => $data['use'],
                "type" => "I",
                "payment_form" => $data['payment_form'], 
                "payment_method" => $data['payment_method'], 
                "currency" => "MXN",
                "series" => "F"
            ];
            
            // Creamos...
            $invoice = $this->facturapi->Invoices->create($data_invoice);
            return $invoice;

        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    function DownloadBill($id, $type)
    {
        try {
            $stream = [];
            $nameFile = "Invoice_".$id;

            switch ($type) {
                case 'xml':
                    $stream = $this->facturapi->Invoices->download_xml($id);
                    Storage::disk('public')->put($nameFile.'.xml', $stream);
                    break;
                case 'pdf':
                    $stream = $this->facturapi->Invoices->download_pdf($id); 
                    Storage::disk('public')->put($nameFile.'.pdf', $stream);
                    break;
                case 'zip':
                    $stream = $this->facturapi->Invoices->download_zip($id);
                    Storage::disk('public')->put($nameFile.'.zip', $stream);
                    break; 
            }
                   
            return response()->download(storage_path('/app/public/'. $nameFile.".".$type));
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    function SendMail($id)
    {
        try {
           $send = $this->facturapi->Invoices->send_by_email($id);
            return $send;

        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    function CancelBill($data)
    {
        try {
            $canceled_invoice = $this->facturapi->Invoices->cancel($data['id'],
                [
                  "motive" => $data['motive']
                ]
            );

            return $canceled_invoice;
         } catch (\Exception $th) {
             return $th->getMessage();
         }
    }
    
}