<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ModulAr SRL - Solicitud de presupuestación</title>
</head>
<body>
    <h4>Buenos días, <b>{{ $objEnviarMail ['nombreProveedor'] }}</b></h4>

    <p>Mediante la presente quien suscribe, ALVARO ERNESTO CARABAJAL. En carácter de Encargado de Compras de la Firma ModulAr SRL CUIT 30711555575 se dirige a usted y por su intermedio a la firma que representa; a los fines de solicitarle tenga bien participar de proceso de cotización de los siguientes materiales:</p>

    {{-- {{ $objEnviarMail ['productos'] }} --}}

    <table>
        <tr>
            <td><strong>Producto</strong></td>
            <td>-</td>
            <td><strong>Cantidad</strong></td>
        </tr>

        @foreach ($objEnviarMail ['productos'] as $producto)
            <tr>
                <td>{{ $producto['nombre'] }}</td>
                <td>-</td>
                <td>{{ $producto['cantidad'] }}</td>
            </tr> 
        @endforeach
        
    </table>


    <p>Se solicita que dicha cotización indique:</p>
    <ul>
        <li>Precio</li>
        <li>Precio Pagado con Valores y plazo de los mismos.</li>
        <li>Precio pagado mediante transferencia bancaria.</li>
        <li>Disponibilidad de los productos.</li>
        <li>% de IVA del producto</li>
        <li>Descuentos o bonificaciones</li>
        <li>Especificar si los descuentos o bonificaciones son por compra total o si se hacen parciales se mantiene el descuento / Bonificación.</li>
        <li>Lugar de Entrega de los materiales (Si es puesto en obra o retirado de su depósito)</li>
        <li>Mantenimiento de la Cotización.</li>
        <li> En caso de tener algún producto alternativo al solicitado por favor expresarlo haciendo referencia al mismo</li>
    </ul>

    Atte.

    <img src="{{ URL::asset('public/img/logomodular.jpg') }}" alt="logo">
    {{-- <img src="../assets/logomodular.jpg" alt="Vue"> --}}

    <h3>ALVARO ERNESTO CARABAJAL</h3>`
    <h4>Oficina Compras</h4>

    <h3><b>Güemes Nº70 | (4200) Santiago del Estero, Argentina</b></h3>
    <h3><b>Cel. 385-5953463</b></h3>
    <h3><b>Sitio web: modularsrl.com.ar/ </b></h3>
    <p>Esta empresa cuenta con servicio de auditoría de compras. Ante cualquier inquietud o insatisfacción, por favor comuníquese con Nicolás Bernardi al 011-53231155.</p>

</body>
</html>

{{-- Hola {{ $data }}, los correos con Gmail funcionan --}}