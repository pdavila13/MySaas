<?php

namespace App\Http\Controllers;

use DOMPDF;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use View;

class PDFController extends Controller {

    public function invoiceHtml() {

        $data = $this->getData();
        return view('receipt',$data);
    }

    public function downloadInvoice() {

        if (! defined('DOMPDF_ENABLE_AUTOLOAD')) {
            define('DOMPDF_ENABLE_AUTOLOAD', false);
        }

        if (file_exists($configPath = base_path().'/vendor/dompdf/dompdf/dompdf_config.inc.php')) {
            require_once $configPath;
        }

        $dompdf = new DOMPDF();
        $dompdf->load_html($this->view($this->getData())->render());
        $dompdf->render();

        return $this->download($dompdf->output());
    }

    /**
     * Create an invoice download response.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function download($pdf) {
        //$filename = 'prova_'.$this->date()->month.'_'.$this->date()->year.'.pdf';
        $filename = 'hola.pdf';
        return new Response($pdf, 200, [
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'filename="'.$filename.'"',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Type' => 'application/pdf',
        ]);
    }

    /**
     * Get the View instance for the invoice.
     *
     * @param  array  $data
     * @return \Illuminate\View\View
     */
     public function view(array $data) {
         return View::make('receipt', $data);
     }

    public function getData() {

        $data = [
            'vendor' => "Logo here",
            'user' => "Paolo Davila",
            'name' => "Paolo Davila",
            'email' => "info@paolodavila.com",
            'street' => "Calle las rosas",
            'location' => "Tortosa",
            'phone' => "977 44 56 28",
            'url' => "www.paolodavila.com",
            'invoice' => "Factura",
            'product' => "Tècnic informàtic",
            'tax_percent' => "15",
            'tax' => "252€",
            'total' => "1.452€",
        ];

        return $data;
    }
}
