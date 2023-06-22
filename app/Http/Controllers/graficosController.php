<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyWorker;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//SOlo es ir al apache ini.php y habilitar la extension gd

class graficosController extends Controller
{

    //gráfico de barras utilizando la biblioteca GD
    public function stock_barras($company_id)
    {
        $productos = Product::where('company_id', $company_id)->get();
        //return response()->json([ 'data' => $productos]);
        $n = 2; // hasta 8 barras en la imagen
        $data = array();
        foreach ($productos as $producto) {
            array_push($data, ['product' => $producto->name, 'total' => $producto->amount]);
        }

        $width = 600;
        $height = 400;
        $padding = 40;
        $barSpacing = 5; // Espacio entre las barras

        $image = imagecreatetruecolor($width, $height);
        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $barColor = imagecolorallocate($image, 0, 0, 255);
        $fontColor = imagecolorallocate($image, 0, 0, 0);
        $axisColor = imagecolorallocate($image, 200, 200, 200);
        imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);

        $totalBars = count($data);
        $barWidth = ($width - 2 * $padding - ($totalBars - 1) * $barSpacing) / $totalBars;
        $maxValue = max(array_column($data, 'total'));

        // Dibujar ejes
        imageline($image, $padding, $height - $padding, $width - $padding, $height - $padding, $axisColor); // Eje horizontal
        imageline($image, $padding, $padding, $padding, $height - $padding, $axisColor); // Eje vertical

        foreach ($data as $index => $item) {
            $x1 = $padding + $index * ($barWidth + $barSpacing);
            $x2 = $x1 + $barWidth - 1;
            $y1 = $height - $padding;
            $y2 = $y1 - ($item['total'] / $maxValue) * ($height - 2 * $padding);
            imagefilledrectangle($image, $x1, $y2, $x2, $y1, $barColor);

            // Mostrar labels de "total" en cada barra
            $labelX = $x1 + ($barWidth - imagefontwidth(2) * strlen($item['total'])) / 2;
            $labelY = $y2 - 15;
            imagestring($image, 2, $labelX, $labelY, $item['total'], $fontColor);

            // Centrar el label debajo de la barra
            $labelWidth = imagefontwidth(3) * strlen($item['product']);
            $labelX = $x1 + ($barWidth - $labelWidth) / 2;
            $labelY = $y1 + 5;
            imagestring($image, 3, $labelX, $labelY, $item['product'], $fontColor);
        }

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();

        imagedestroy($image);

        $response = response($imageData)->header('Content-Type', 'image/png');
        return $response;
    }

    //ventas por ano semestre
    public function ventas_primer_semestre_linea($company_id, $ano)
    {

        $start = [$ano . '-01-01', $ano . '-02-01', $ano . '-03-01', $ano . '-04-01', $ano . '-05-01', $ano . '-06-01'];
        $end   = [$ano . '-01-31', $ano . '-02-28', $ano . '-03-31', $ano . '-04-30', $ano . '-05-31', $ano . '-06-30'];
        $mes   = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'];

        $data = array();
        for ($i = 0; $i < 6; $i++) {
            //total vendido en el primer sem
            $totalValue = DB::table('product_outflows')
                ->join('products', 'product_outflows.product_id', '=', 'products.id')
                ->where('product_outflows.company_id', $company_id)
                ->whereBetween('product_outflows.fecha', [$start[$i], $end[$i]])
                ->sum(DB::raw('product_outflows.quantity * products.sale_price'));
            array_push($data, ['mes' => $mes[$i], 'ventas' => $totalValue]);
        }

        // Configuración del gráfico
        $width = 600;
        $height = 400;
        $padding = 40;
        // Crear imagen en blanco
        $image = imagecreatetruecolor($width, $height);
        // Definir colores
        $backgroundColor = imagecolorallocate($image, 255, 255, 255); // Fondo blanco
        $lineColor = imagecolorallocate($image, 255, 165, 0); // Color de la línea
        $labelColor = imagecolorallocate($image, 0, 0, 0); // Color de los labels
        // Rellenar fondo de la imagen
        imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);
        // Calcular valores máximos y mínimos
        $maxValue = max(array_column($data, 'ventas'));
        $minValue = min(array_column($data, 'ventas'));
        // Calcular dimensiones del gráfico
        $graphWidth = $width - 2 * $padding;
        $graphHeight = $height - 2 * $padding;
        // Dibujar ejes
        imageline($image, $padding, $padding, $padding, $height - $padding, $lineColor); // Eje vertical
        imageline($image, $padding, $height - $padding, $width - $padding, $height - $padding, $lineColor); // Eje horizontal
        // Calcular la escala para los valores
        $scaleX = $graphWidth / (count($data) - 1);
        if ($maxValue - $minValue != 0)
            $scaleY = $graphHeight / ($maxValue - $minValue);
        else
            $scaleY = 0;
        $prevX = $padding;
        $prevY = $height - $padding - ($data[0]['ventas'] - $minValue) * $scaleY;

        for ($i = 0; $i < count($data); $i++) {
            $x = $padding + $i * $scaleX;
            $y = $height - $padding - ($data[$i]['ventas'] - $minValue) * $scaleY;
            // Dibujar línea de conexión
            imageline($image, $prevX, $prevY, $x, $y, $lineColor);
            // Dibujar punto
            imagefilledellipse($image, $x, $y, 6, 6, $lineColor);
            // Mostrar valor de ventas
            $valueLabelX = $x - strlen($data[$i]['ventas']) * 3;
            $valueLabelY = $y - 15;
            imagestring($image, 4, $valueLabelX, $valueLabelY, $data[$i]['ventas'], $labelColor);
            // Mostrar mes
            $monthLabelX = $x - strlen($data[$i]['mes']) * 3;
            $monthLabelY = $height - $padding + 15;
            imagestring($image, 4, $monthLabelX, $monthLabelY, $data[$i]['mes'], $labelColor);
            $prevX = $x;
            $prevY = $y;
        }

        // Mostrar labels en el eje horizontal (parte inferior)
        foreach ($data as $index => $item) {
            $x = $padding + $index * $scaleX;
            $labelX = $x - strlen($item['mes']) * 3;
            $labelY = $height - $padding + 15;
            imagestring($image, 4, $labelX, $labelY, $item['mes'], $labelColor);
        }

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        $response = response($imageData)->header('Content-Type', 'image/png');
        return $response;
    }


    //ventas por ano semestre
    public function ventas_segundo_semestre_linea($company_id, $ano)
    {

        $start = [$ano . '-07-01', $ano . '-08-01', $ano . '-09-01', $ano . '-10-01', $ano . '-11-01', $ano . '-12-01'];
        $end   = [$ano . '-07-31', $ano . '-08-31', $ano . '-09-30', $ano . '-10-31', $ano . '-11-30', $ano . '-12-31'];
        $mes   = ['Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        $data = array();
        for ($i = 0; $i < 6; $i++) {
            //total vendido en el primer sem
            $totalValue = DB::table('product_outflows')
                ->join('products', 'product_outflows.product_id', '=', 'products.id')
                ->where('product_outflows.company_id', $company_id)
                ->whereBetween('product_outflows.fecha', [$start[$i], $end[$i]])
                ->sum(DB::raw('product_outflows.quantity * products.sale_price'));
            array_push($data, ['mes' => $mes[$i], 'ventas' => $totalValue]);
        }

        // return response()->json(['data' => $data]);

        // Configuración del gráfico
        $width = 600;
        $height = 400;
        $padding = 40;
        // Crear imagen en blanco
        $image = imagecreatetruecolor($width, $height);
        // Definir colores
        $backgroundColor = imagecolorallocate($image, 255, 255, 255); // Fondo blanco
        $lineColor = imagecolorallocate($image, 0, 0, 255); // Color de la línea
        $labelColor = imagecolorallocate($image, 0, 0, 0); // Color de los labels
        // Rellenar fondo de la imagen
        imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);
        // Calcular valores máximos y mínimos
        $maxValue = max(array_column($data, 'ventas'));
        $minValue = min(array_column($data, 'ventas'));
        // Calcular dimensiones del gráfico
        $graphWidth = $width - 2 * $padding;
        $graphHeight = $height - 2 * $padding;
        // Dibujar ejes
        imageline($image, $padding, $padding, $padding, $height - $padding, $lineColor); // Eje vertical
        imageline($image, $padding, $height - $padding, $width - $padding, $height - $padding, $lineColor); // Eje horizontal
        // Calcular la escala para los valores
        $scaleX = $graphWidth / (count($data) - 1);
        if ($maxValue - $minValue != 0)
            $scaleY = $graphHeight / ($maxValue - $minValue);
        else
            $scaleY = 0;
        $prevX = $padding;
        $prevY = $height - $padding - ($data[0]['ventas'] - $minValue) * $scaleY;

        for ($i = 0; $i < count($data); $i++) {
            $x = $padding + $i * $scaleX;
            $y = $height - $padding - ($data[$i]['ventas'] - $minValue) * $scaleY;
            // Dibujar línea de conexión
            imageline($image, $prevX, $prevY, $x, $y, $lineColor);
            // Dibujar punto
            imagefilledellipse($image, $x, $y, 6, 6, $lineColor);
            // Mostrar valor de ventas
            $valueLabelX = $x - strlen($data[$i]['ventas']) * 3;
            $valueLabelY = $y - 15;
            imagestring($image, 4, $valueLabelX, $valueLabelY, $data[$i]['ventas'], $labelColor);
            // Mostrar mes
            $monthLabelX = $x - strlen($data[$i]['mes']) * 3;
            $monthLabelY = $height - $padding + 15;
            imagestring($image, 4, $monthLabelX, $monthLabelY, $data[$i]['mes'], $labelColor);
            $prevX = $x;
            $prevY = $y;
        }

        // Mostrar labels en el eje horizontal (parte inferior)
        foreach ($data as $index => $item) {
            $x = $padding + $index * $scaleX;
            $labelX = $x - strlen($item['mes']) * 3;
            $labelY = $height - $padding + 15;
            imagestring($image, 4, $labelX, $labelY, $item['mes'], $labelColor);
        }

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        $response = response($imageData)->header('Content-Type', 'image/png');
        return $response;
    }


    public function Rendimiento_trabajador_torta($company_id)
    {

        $trabajadores = CompanyWorker::where('company_id', $company_id)->get();
        $data = array();
        foreach ($trabajadores as $trabajador) {
            $productOutflows = DB::table('product_outflows')
                ->where('worker_id', $trabajador->worker_id)
                ->count();
            array_push($data, ['label' => $trabajador->worker->name, 'value' => $productOutflows]);
        }

        // Crear imagen en blanco
        $width = 600;
        $height = 500;
        $image = imagecreatetruecolor($width, $height);
        // Definir colores
        $backgroundColor = imagecolorallocate($image, 255, 255, 255); // Fondo blanco
        $pieColors = [
            imagecolorallocate($image, 255, 0, 0),     // Rojo
            imagecolorallocate($image, 0, 255, 0),     // Verde
            imagecolorallocate($image, 0, 0, 255),     // Azul
            imagecolorallocate($image, 255, 255, 0),   // Amarillo
            imagecolorallocate($image, 255, 0, 255),   // Magenta
            imagecolorallocate($image, 0, 255, 255),   // Cian
            imagecolorallocate($image, 128, 0, 128),   // Púrpura
            imagecolorallocate($image, 255, 165, 0),   // Naranja
        ];
        // Rellenar fondo de la imagen
        imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);
        // Calcular el total de valores
        $total = array_reduce($data, function ($carry, $item) {
            return $carry + $item['value'];
        }, 0);

        // Dibujar sectores de la torta y etiquetas
        $startAngle = 0;
        foreach ($data as $index => $item) {
            $endAngle = $startAngle + ($item['value'] / $total) * 360;
            imagefilledarc($image, $width / 2, $height / 2, $width, $height, $startAngle, $endAngle, $pieColors[$index], IMG_ARC_PIE);
            // Calcular la posición de la etiqueta
            $labelAngle = deg2rad(($startAngle + $endAngle) / 2);
            $labelRadius = $width / 2 * 0.75;
            $labelX = $width / 2 + cos($labelAngle) * $labelRadius;
            $labelY = $height / 2 + sin($labelAngle) * $labelRadius;
            // Dibujar etiqueta
            $labelColor = imagecolorallocate($image, 0, 0, 0); // Texto negro
            imagestring($image, 4, $labelX, $labelY, $item['label'], $labelColor);
            $startAngle = $endAngle;
        }


        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        $response = response($imageData)->header('Content-Type', 'image/png');
        return $response;
    }


    //ventas por ano semestre
    public function ganancias_primer_semestre_linea($company_id, $ano)
    {

        $start = [$ano . '-01-01', $ano . '-02-01', $ano . '-03-01', $ano . '-04-01', $ano . '-05-01', $ano . '-06-01'];
        $end   = [$ano . '-01-31', $ano . '-02-28', $ano . '-03-31', $ano . '-04-30', $ano . '-05-31', $ano . '-06-30'];
        $mes   = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'];

        $data = array();
        for ($i = 0; $i < 6; $i++) {
            //total vendido en el primer sem
            $precioVenta = DB::table('product_outflows')
                ->join('products', 'product_outflows.product_id', '=', 'products.id')
                ->where('product_outflows.company_id', $company_id)
                ->whereBetween('product_outflows.fecha', [$start[$i], $end[$i]])
                ->sum(DB::raw('product_outflows.quantity * products.sale_price'));

            $precioOriginal = DB::table('product_outflows')
                ->join('products', 'product_outflows.product_id', '=', 'products.id')
                ->where('product_outflows.company_id', $company_id)
                ->whereBetween('product_outflows.fecha', [$start[$i], $end[$i]])
                ->sum(DB::raw('product_outflows.quantity * products.price'));
            array_push($data, ['mes' => $mes[$i], 'ventas' => $precioVenta - $precioOriginal]);
        }

        // return response()->json(['data' => $data]);

        // Configuración del gráfico
        $width = 600;
        $height = 400;
        $padding = 40;
        // Crear imagen en blanco
        $image = imagecreatetruecolor($width, $height);
        // Definir colores
        $backgroundColor = imagecolorallocate($image, 255, 255, 255); // Fondo blanco
        $lineColor = imagecolorallocate($image, 0, 255, 255); // Color de la línea
        $labelColor = imagecolorallocate($image, 0, 0, 0); // Color de los labels
        // Rellenar fondo de la imagen
        imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);
        // Calcular valores máximos y mínimos
        $maxValue = max(array_column($data, 'ventas'));
        $minValue = min(array_column($data, 'ventas'));
        // Calcular dimensiones del gráfico
        $graphWidth = $width - 2 * $padding;
        $graphHeight = $height - 2 * $padding;
        // Dibujar ejes
        imageline($image, $padding, $padding, $padding, $height - $padding, $lineColor); // Eje vertical
        imageline($image, $padding, $height - $padding, $width - $padding, $height - $padding, $lineColor); // Eje horizontal
        // Calcular la escala para los valores
        $scaleX = $graphWidth / (count($data) - 1);
        if ($maxValue - $minValue != 0)
            $scaleY = $graphHeight / ($maxValue - $minValue);
        else
            $scaleY = 0;
        $prevX = $padding;
        $prevY = $height - $padding - ($data[0]['ventas'] - $minValue) * $scaleY;

        for ($i = 0; $i < count($data); $i++) {
            $x = $padding + $i * $scaleX;
            $y = $height - $padding - ($data[$i]['ventas'] - $minValue) * $scaleY;
            // Dibujar línea de conexión
            imageline($image, $prevX, $prevY, $x, $y, $lineColor);
            // Dibujar punto
            imagefilledellipse($image, $x, $y, 6, 6, $lineColor);
            // Mostrar valor de ventas
            $valueLabelX = $x - strlen($data[$i]['ventas']) * 3;
            $valueLabelY = $y - 15;
            imagestring($image, 4, $valueLabelX, $valueLabelY, $data[$i]['ventas'], $labelColor);
            // Mostrar mes
            $monthLabelX = $x - strlen($data[$i]['mes']) * 3;
            $monthLabelY = $height - $padding + 15;
            imagestring($image, 4, $monthLabelX, $monthLabelY, $data[$i]['mes'], $labelColor);
            $prevX = $x;
            $prevY = $y;
        }

        // Mostrar labels en el eje horizontal (parte inferior)
        foreach ($data as $index => $item) {
            $x = $padding + $index * $scaleX;
            $labelX = $x - strlen($item['mes']) * 3;
            $labelY = $height - $padding + 15;
            imagestring($image, 4, $labelX, $labelY, $item['mes'], $labelColor);
        }

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        $response = response($imageData)->header('Content-Type', 'image/png');
        return $response;
    }

    //ventas por ano semestre
    public function ganancias_segundo_semestre_linea($company_id, $ano)
    {

        $start = [$ano . '-07-01', $ano . '-08-01', $ano . '-09-01', $ano . '-10-01', $ano . '-11-01', $ano . '-12-01'];
        $end   = [$ano . '-07-31', $ano . '-08-31', $ano . '-09-30', $ano . '-10-31', $ano . '-11-30', $ano . '-12-31'];
        $mes   = ['Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        $data = array();
        for ($i = 0; $i < 6; $i++) {
            //total vendido en el primer sem
            $precioVenta = DB::table('product_outflows')
                ->join('products', 'product_outflows.product_id', '=', 'products.id')
                ->where('product_outflows.company_id', $company_id)
                ->whereBetween('product_outflows.fecha', [$start[$i], $end[$i]])
                ->sum(DB::raw('product_outflows.quantity * products.sale_price'));

            $precioOriginal = DB::table('product_outflows')
                ->join('products', 'product_outflows.product_id', '=', 'products.id')
                ->where('product_outflows.company_id', $company_id)
                ->whereBetween('product_outflows.fecha', [$start[$i], $end[$i]])
                ->sum(DB::raw('product_outflows.quantity * products.price'));
            array_push($data, ['mes' => $mes[$i], 'ventas' => $precioVenta - $precioOriginal]);
        }

        // return response()->json(['data' => $data]);

        // Configuración del gráfico
        $width = 600;
        $height = 400;
        $padding = 40;
        // Crear imagen en blanco
        $image = imagecreatetruecolor($width, $height);
        // Definir colores
        $backgroundColor = imagecolorallocate($image, 255, 255, 255); // Fondo blanco
        $lineColor = imagecolorallocate($image, 128, 0, 128); // Color de la línea
        $labelColor = imagecolorallocate($image, 0, 0, 0); // Color de los labels
        // Rellenar fondo de la imagen
        imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);
        // Calcular valores máximos y mínimos
        $maxValue = max(array_column($data, 'ventas'));
        $minValue = min(array_column($data, 'ventas'));
        // Calcular dimensiones del gráfico
        $graphWidth = $width - 2 * $padding;
        $graphHeight = $height - 2 * $padding;
        // Dibujar ejes
        imageline($image, $padding, $padding, $padding, $height - $padding, $lineColor); // Eje vertical
        imageline($image, $padding, $height - $padding, $width - $padding, $height - $padding, $lineColor); // Eje horizontal
        // Calcular la escala para los valores
        $scaleX = $graphWidth / (count($data) - 1);
        if ($maxValue - $minValue != 0)
            $scaleY = $graphHeight / ($maxValue - $minValue);
        else
            $scaleY = 0;
        $prevX = $padding;
        $prevY = $height - $padding - ($data[0]['ventas'] - $minValue) * $scaleY;

        for ($i = 0; $i < count($data); $i++) {
            $x = $padding + $i * $scaleX;
            $y = $height - $padding - ($data[$i]['ventas'] - $minValue) * $scaleY;
            // Dibujar línea de conexión
            imageline($image, $prevX, $prevY, $x, $y, $lineColor);
            // Dibujar punto
            imagefilledellipse($image, $x, $y, 6, 6, $lineColor);
            // Mostrar valor de ventas
            $valueLabelX = $x - strlen($data[$i]['ventas']) * 3;
            $valueLabelY = $y - 15;
            imagestring($image, 4, $valueLabelX, $valueLabelY, $data[$i]['ventas'], $labelColor);
            // Mostrar mes
            $monthLabelX = $x - strlen($data[$i]['mes']) * 3;
            $monthLabelY = $height - $padding + 15;
            imagestring($image, 4, $monthLabelX, $monthLabelY, $data[$i]['mes'], $labelColor);
            $prevX = $x;
            $prevY = $y;
        }

        // Mostrar labels en el eje horizontal (parte inferior)
        foreach ($data as $index => $item) {
            $x = $padding + $index * $scaleX;
            $labelX = $x - strlen($item['mes']) * 3;
            $labelY = $height - $padding + 15;
            imagestring($image, 4, $labelX, $labelY, $item['mes'], $labelColor);
        }

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        $response = response($imageData)->header('Content-Type', 'image/png');
        return $response;
    }


    public function valor_inventario_barras($company_id)
    {
        $productos = Product::where('company_id', $company_id)->get();
        // $totales = DB::table('products')
        //         ->where('company_id', $company_id)
        //         ->where('id', $company_id)
        //         ->sum(DB::raw('amount * price'));
        // return response()->json([ 'data' => $totales]);
        $n = 2; // hasta 8 barras en la imagen
        $data = array();
        foreach ($productos as $producto) {
            $totalInventory = DB::table('products')
                ->where('company_id', $company_id)
                ->where('id', $producto->id)
                ->sum(DB::raw('amount * price'));
            array_push($data, ['product' => $producto->name, 'total' => $totalInventory]);
        }

        // return response()->json(['data' => $data]);

        $width = 600;
        $height = 400;
        $padding = 40;
        $barSpacing = 5; // Espacio entre las barras

        $image = imagecreatetruecolor($width, $height);
        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $barColor = imagecolorallocate($image, 255, 0, 255);
        $fontColor = imagecolorallocate($image, 0, 0, 0);
        $axisColor = imagecolorallocate($image, 200, 200, 200);
        // $axisColor = imagecolorallocate($image, 255, 0, 255);   // Magenta
        imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);

        $totalBars = count($data);
        $barWidth = ($width - 2 * $padding - ($totalBars - 1) * $barSpacing) / $totalBars;
        $maxValue = max(array_column($data, 'total'));

        // Dibujar ejes
        imageline($image, $padding, $height - $padding, $width - $padding, $height - $padding, $axisColor); // Eje horizontal
        imageline($image, $padding, $padding, $padding, $height - $padding, $axisColor); // Eje vertical

        foreach ($data as $index => $item) {
            $x1 = $padding + $index * ($barWidth + $barSpacing);
            $x2 = $x1 + $barWidth - 1;
            $y1 = $height - $padding;
            $y2 = $y1 - ($item['total'] / $maxValue) * ($height - 2 * $padding);
            imagefilledrectangle($image, $x1, $y2, $x2, $y1, $barColor);

            // Mostrar labels de "total" en cada barra
            $labelX = $x1 + ($barWidth - imagefontwidth(2) * strlen($item['total'])) / 2;
            $labelY = $y2 - 15;
            imagestring($image, 2, $labelX, $labelY, $item['total'], $fontColor);

            // Centrar el label debajo de la barra
            $labelWidth = imagefontwidth(3) * strlen($item['product']);
            $labelX = $x1 + ($barWidth - $labelWidth) / 2;
            $labelY = $y1 + 5;
            imagestring($image, 3, $labelX, $labelY, $item['product'], $fontColor);
        }

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();

        imagedestroy($image);

        $response = response($imageData)->header('Content-Type', 'image/png');
        return $response;
    }

    
    public function area($company_id)
    {
        $trabajadores = CompanyWorker::where('company_id', $company_id)->get();
        $data = array();
        foreach ($trabajadores as $trabajador) {
            $productOutflows = DB::table('product_outflows')
                ->where('worker_id', $trabajador->worker_id)
                ->count();
            array_push($data, ['mes' => $trabajador->worker->name, 'ventas' => $productOutflows]);
        }

        // return response()->json(['data' => $data]);
        
        // Configuración del gráfico
        $width = 800;
        $height = 400;
        $padding = 40;

        // Crear imagen en blanco
        $image = imagecreatetruecolor($width, $height);
        
        // Definir colores
        $backgroundColor = imagecolorallocate($image, 255, 255, 255); // Fondo blanco
        $areaColor = imagecolorallocate($image, 255, 255, 0); // Color del área
        $axisColor = imagecolorallocate($image, 0, 0, 0); // Color de los ejes
        
        // Rellenar fondo de la imagen
        imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);

        // Calcular valores máximos y mínimos
        $maxValue = max(array_column($data, 'ventas'));
        
        $minValue = min(array_column($data, 'ventas'));

        // Calcular dimensiones del gráfico
        $graphWidth = $width - 2 * $padding;
        $graphHeight = $height - 2 * $padding;
        
        // Calcular la escala para los valores
        $scaleX = $graphWidth / (count($data) - 1);
        if(($maxValue - $minValue) != 0)
            $scaleY = $graphHeight / ($maxValue - $minValue);
        else
            $scaleY = 0;
        
        // Dibujar ejes
        imageline($image, $padding, $height - $padding, $width - $padding, $height - $padding, $axisColor); // Eje horizontal
        imageline($image, $padding, $padding, $padding, $height - $padding, $axisColor); // Eje vertical

        // Dibujar polígono de áreas
        $points = [];
        foreach ($data as $index => $item) {
            $x = $padding + $index * $scaleX;
            $y = $height - $padding - ($item['ventas'] - $minValue) * $scaleY;
            $points[] = $x;
            $points[] = $y;
        }


        imagefilledpolygon($image, $points, count($points) / 2, $areaColor);
    

        $axisColor2 = imagecolorallocate($image, 0, 0, 0); // Color de los ejes
        // Mostrar labels de ventas en su respectiva área
        foreach ($data as $index => $item) {
            $x = $padding + $index * $scaleX;
            $y = $height - $padding - ($item['ventas'] - $minValue) * $scaleY - 15;
            $label = $item['ventas'];
            $labelX = $x - strlen($label) * 3;
            imagestring($image, 3, $labelX, $y, $label, $axisColor2);
        }

        // Mostrar labels en el eje horizontal (parte inferior)
        foreach ($data as $index => $item) {
            $x = $padding + $index * $scaleX;
            $labelX = $x - strlen($item['mes']) * 3;
            $labelY = $height - $padding + 15;
            imagestring($image, 3, $labelX, $labelY, $item['mes'], $axisColor);
        }

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        $response = response($imageData)->header('Content-Type', 'image/png');
        return $response;
    }

        //Rotación de inventario por producto: Calcula la frecuencia con la que se venden los productos en el 
    //inventario en un período determinado. Puedes obtenerlo dividiendo la cantidad total de productos vendidos 
    //en un período por la cantidad promedio de unidades en inventario para ese producto.
    // Grafico de Tortas
    public function Rotacion_torta($id)
    {

        $productos = Product::where('company_id', $id)->get();
        // return response()->json(['data' => $productos]);
        $data = array();
        foreach ($productos as $producto) {

            $soldQuantity = DB::table('product_outflows')
                ->where('product_id', $producto->id)
                ->whereBetween('created_at', ['2023-01-01', '2023-12-31']) //anual
                ->sum('quantity');

            //return response()->json(['data' => $soldQuantity]);

            $averageInventory = DB::table('products')
                ->where('id', $producto->id)
                ->avg('amount');

            //return response()->json(['data' => $averageInventory]);

            $inventoryTurnover = $soldQuantity / $averageInventory;
            array_push($data, ['label' => $producto->name, 'value' => $inventoryTurnover]);
        }
        // Crear imagen en blanco
        $width = 600;
        $height = 500;
        $image = imagecreatetruecolor($width, $height);

        // Definir colores
        $backgroundColor = imagecolorallocate($image, 255, 255, 255); // Fondo blanco
        $pieColors = [
            imagecolorallocate($image, 255, 0, 0),     // Rojo
            imagecolorallocate($image, 0, 255, 0),     // Verde
            imagecolorallocate($image, 0, 0, 255),     // Azul
            imagecolorallocate($image, 255, 255, 0),   // Amarillo
            imagecolorallocate($image, 255, 0, 255),   // Magenta
            imagecolorallocate($image, 0, 255, 255),   // Cian
            imagecolorallocate($image, 128, 0, 128),   // Púrpura
            imagecolorallocate($image, 255, 165, 0),   // Naranja
        ];


        // Rellenar fondo de la imagen
        imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);

        // Calcular el total de valores
        $total = array_reduce($data, function ($carry, $item) {
            return $carry + $item['value'];
        }, 0);

        // Dibujar sectores de la torta y etiquetas
        $startAngle = 0;
        foreach ($data as $index => $item) {
            $endAngle = $startAngle + ($item['value'] / $total) * 360;
            imagefilledarc($image, $width / 2, $height / 2, $width, $height, $startAngle, $endAngle, $pieColors[$index], IMG_ARC_PIE);

            // Calcular la posición de la etiqueta
            $labelAngle = deg2rad(($startAngle + $endAngle) / 2);
            $labelRadius = $width / 2 * 0.75;
            $labelX = $width / 2 + cos($labelAngle) * $labelRadius;
            $labelY = $height / 2 + sin($labelAngle) * $labelRadius;

            // Dibujar etiqueta
            $labelColor = imagecolorallocate($image, 0, 0, 0); // Texto negro
            imagestring($image, 4, $labelX, $labelY, $item['label'], $labelColor);

            $startAngle = $endAngle;
        }


        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        $response = response($imageData)->header('Content-Type', 'image/png');
        return $response;
    }

}
