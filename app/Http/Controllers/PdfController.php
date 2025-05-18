<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animales;
use App\Models\Tipos_Animales;
use App\Models\Refugios;

class PdfController extends Controller
{
    // Mostrar la vista con los enlaces y formulario para los reportes
    public function genera_pdf()
    {
        $refugios = Refugios::where('status', 1)->orderBy('nombre')->get();
        $tipos_animales = Tipos_Animales::where('status', 1)->orderBy('nombre')->get();
        $animales = Animales::where('status', '!=', 0)->orderBy('nombre')->get();

        return view("Pdf.listado_reportes")
            ->with('refugios', $refugios)
            ->with('tipos_animales', $tipos_animales)
            ->with('animales', $animales);
    }

    // Función genérica para crear un PDF
    public function crearPDF($datos, $vistaurl, $tipo)
    {
        $data = $datos;
        $date = date('Y-m-d');
        $view = \View::make($vistaurl, compact('data', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        if ($tipo == 1) {
            return $pdf->stream('reporte');
        }
        if ($tipo == 2) {
            return $pdf->download('reporte.pdf');
        }
    }

    // Función genérica para crear un PDF con más de un conjunto de datos (para el certificado)
    public function crearPDFdetallado($animal, $refugio, $municipio, $vistaurl, $tipo)
    {
        $data_animal = $animal;
        $data_refugio = $refugio;
        $data_municipio = $municipio;
        $date = date('Y-m-d');
        $view = \View::make($vistaurl, compact('data_animal', 'data_refugio', 'data_municipio', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        if ($tipo == 1) {
            return $pdf->stream('reporte');
        }
        if ($tipo == 2) {
            return $pdf->download('reporte.pdf');
        }
    }

    // Reporte 1: Lista de animales por refugio y tipo (con filtros dinámicos)
    public function animales_por_refugio_y_tipo($tipo, $id_refugio, $id_tipo_animal)
    {
        $vistaurl = "Pdf.reporte_animales";
        $animales = Animales::where('status', '!=', 0)
            ->where('id_refugio', $id_refugio)
            ->when($id_tipo_animal > 0, function ($query) use ($id_tipo_animal) {
                return $query->where('id_tipo_animal', $id_tipo_animal);
            })
            ->orderBy('nombre')
            ->get();
        return $this->crearPDF($animales, $vistaurl, $tipo);
    }

    // Reporte 2: Certificado de adopción para un animal específico
    public function certificado_adopcion($tipo, $id_animal)
    {
        $vistaurl = "Pdf.certificado_adopcion";
        $animal = Animales::where('status', '!=', 0)
            ->where('id', $id_animal)
            ->first();
        if (!$animal) {
            abort(404, 'Animal no encontrado');
        }
        $refugio = Refugios::find($animal->id_refugio);
        $municipio = $refugio->municipios;
        return $this->crearPDFdetallado($animal, $refugio, $municipio, $vistaurl, $tipo);
    }
}