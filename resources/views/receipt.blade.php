<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Invoice</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #fff;
            background-image: none;
            font-size: 12px;
        }
        address{
            margin-top:15px;
        }
        h2 {
            font-size:28px;
            color:#cccccc;
        }
        .container {
            padding-top:30px;
        }
        .invoice-head td {
            padding: 0 8px;
        }
        .invoice-body{
            background-color:transparent;
        }
        .logo {
            padding-bottom: 10px;
        }
        .table th {
            vertical-align: bottom;
            font-weight: bold;
            padding: 8px;
            line-height: 20px;
            text-align: left;
        }
        .table td {
            padding: 8px;
            line-height: 20px;
            text-align: left;
            vertical-align: top;
            border-top: 1px solid #dddddd;
        }
        .well {
            margin-top: 15px;
        }
    </style>
</head>

<body>
<div class="container">
    <table style="margin-left: auto; margin-right: auto" width="550">
        <tr>
            <td width="160">
                &nbsp;
            </td>

            <!-- Organization Name / Image -->
            <td align="right">
                <strong>{{ $header or $vendor }}</strong>
            </td>
        </tr>
        <tr valign="top">
            <td style="font-size:28px;color:#cccccc;">
                Factura
            </td>

            <!-- Organization Name / Date -->
            <td>
                <br><br>
                <strong>De:</strong> {{ $name ?: $email }}
                <br>
                <strong>Data:</strong> 05/05/2016
            </td>
        </tr>
        <tr valign="top">
            <!-- Organization Details -->
            <td style="font-size:9px;">
                {{ $vendor }}<br>
                @if (isset($street))
                    {{ $street }}<br>
                @endif
                @if (isset($location))
                    {{ $location }}<br>
                @endif
                @if (isset($phone))
                    {{ $phone }}<br>
                @endif
                @if (isset($url))
                    <a href="{{ $url }}">{{ $url }}</a>
                @endif
            </td>
            <td>
                <!-- Invoice Info -->
                <p>
                    <strong>Producte:</strong> {{ $product }}<br>
                    <strong>Num. Factura:</strong> 05/2016 <br>
                </p>

                <br><br>

                <!-- Invoice Table -->
                <table width="100%" class="table" border="0">
                    <tr>
                        <th align="left">Descripció</th>
                        <th align="right">Data</th>
                        <th align="right">Total</th>
                    </tr>

                    <!-- Existing Balance -->
                    <tr>
                        <td>Starting Balance Template PDF</td>
                        <td>14/02/2016</td>
                        <td>1.200€</td>
                    </tr>

                    <!-- Display The Tax Amount -->
                    @if ($tax_percent)
                    <tr>
                        <td>IVA({{ $tax_percent }}%)</td>
                        <td>&nbsp;</td>
                        <td>{{ $tax }}</td>
                    </tr>
                    @endif

                    <!-- Display The Final Total -->
                    <tr style="border-top:2px solid #000;">
                        <td>&nbsp;</td>
                        <td style="text-align: right;"><strong>Total</strong></td>
                        <td><strong>{{ $total }}</strong></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>