<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura de Pago</title>
    <style>
        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }        
        a {
        color: #5D6975;
        text-decoration: underline;
        }        
        body {
        position: relative;
        margin: 0 auto; 
        color: #001028;
        background: #FFFFFF; 
        font-family: Arial, sans-serif; 
        font-size: 12px; 
        font-family: Arial;
        }        
        header {
        padding: 10px 0;
        margin-bottom: 30px;
        }        
        #logo {
        text-align: center;
        margin-bottom: 10px;
        }        
        #logo img {
        width: 90px;
        }        
        h1 {
        border-top: 1px solid  #5D6975;
        border-bottom: 1px solid  #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
        background-image: url('/img/pdf/dimension.png');
        }        
        #project {
        float: left;
        }        
        #project span {
        color: #5D6975;
        text-align: right;
        width: 52px;
        margin-right: 10px;
        display: inline-block;
        font-size: 0.8em;
        }        
        #company {
        float: right;
        text-align: left;
        }        
        #project div,
        #company div {
        white-space: nowrap;        
        }        
        table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        }        
        table tr:nth-child(2n-1) td {
        background: #F5F5F5;
        }        
        table th,
        table td {
        text-align: center;
        }        
        table th {
        padding: 5px 20px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;        
        font-weight: normal;
        }        
        table .service,
        table .desc {
        text-align: left;
        }        
        table td {
        padding: 20px;
        text-align: right;
        }        
        table td.service,
        table td.desc {
        vertical-align: top;
        }        
        table td.unit,
        table td.qty,
        table td.total {
        font-size: 1.2em;
        }        
        table td.grand {
        border-top: 1px solid #5D6975;;
        }        
        #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
        }        
        footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
        }
    </style>
</head>
<body>
    <header class="clearfix">
        <div id="logo">
            <img src="img/pdf/logo.png">
        </div>
        <h1>FE Y ALEGRIA</h1>
        <div id="company" class="clearfix">
            <div>Unidad Educativa</div>
            <div>007 Santa Cruz,<br/> Bolivia, JJ</div>
            <div>(591) 731-193-61</div>
            <div><a href="mailto:altamar@rundevs.com">altamar@rundevs.com</a></div>
        </div>
        <div id="project">
            <div><span>Documento</span> Pago de Mensualidades</div>
            <div><span>Alumno</span> {{$alumno}}</div>
            <div><span>DIRECCION</span> Santa Cruz, SC</div>
            <div><span>FECHA</span> {{$fecha_actual}}</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Mensualidad</th>
                    <th>Plazo Maximo</th>
                    <th>Monto</th>
                    <th>Fecha Pago</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mensualidad as $item)
                    <tr>
                        <td class="service">{{ $item->mes }}</td>
                        <td class="unit">{{ $item->plazo_fecha }}</td> 
                        <td class="unit">{{ $item->monto }}</td> 
                        <td class="qty">{{ $item->fecha_pago }}</td> 
                        <td class="total">
                            @if ($item->estado==1)
                            {{'Pagado'}}
                            @else
                            {{'Sin pagar'}}
                            @endif
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="notices">
            <div>NOTA:</div>
            <div class="notice">Extracto de los pagos  respecto a las mensualidades Escolares.</div>
        </div>
    </main>
    <footer>
        Documento valido y confidencial, avalado por el Colegio Fe y Alegria.
    </footer>
</body>
</html>