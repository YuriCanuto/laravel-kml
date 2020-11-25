<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\SimpleXMLExtended;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KmlController extends Controller
{
    public function index()
    {
        return view('kml.index');
    }

    public function store(Request $request)
    {
        $kml = simplexml_load_file($request->file);

        $array = [
            'name' => $this->regex($kml->Placemark->name),
            // 'description' => (string) $kml->Placemark->description,
            'coordinates' => $this->regex($kml->Placemark->Polygon->outerBoundaryIs->LinearRing->coordinates),
        ];

        dd($array);
    }

    public function makeFile()
    {
        $kml = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><kml></kml>');
        $kml->addAttribute('xmlns:xmlns', 'http://www.opengis.net/kml/2.2');
        $kml->addAttribute('xmlns:gx', 'http://www.google.com/kml/ext/2.2');
        $kml->addAttribute('xmlns:kml', 'http://www.opengis.net/kml/2.2');
        $kml->addAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');

        $Placemark = $kml->addChild('Placemark');
        $Placemark->addAttribute('id', 'PE-0388-00');
        $Placemark->addChild('name', 'Nome Qualquer');
        $Placemark->addCData('description', 'qualquer coisa CDATA');

        $Placemark->addChild('styleUrl', '#tipo_style_1');
        $Placemark->addChild('gx:gx:balloonVisibility', '1');

        $Polygon = $Placemark->addChild('Polygon');
        $outerBoundaryIs = $Polygon->addChild('outerBoundaryIs');
        $LinearRing = $outerBoundaryIs->addChild('LinearRing');
        $LinearRing->addChild('coordinates', 'AQUI FICA AS COORDENADAS');

        $now = Carbon::now()->format('d-m-y');
        $kml->asXML(Storage::path("kml-{$now}.xml"));
    }

    private function regex($string)
    {
        $regex = '/(\s|\\\\[rntv]{1})/';
        return preg_replace($regex, "", (string) $string);
    }
}
