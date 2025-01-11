<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <style type="text/css">
        *{
            font-family: Verdana, Arial, sans-serif;
        };

        table{
            font-size: x-small;
        };

        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        };

        .gray{
            background-color: lightgray;
        };

        .font{
            font-size: 15px;
        };

        .thanks p{
            color: blue;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        };

        .authority{
            margin-top: -10px;
            color: blue;
            margin-left: 35px;
        };


    </style>
</head>
<body>

    <table width="100%" style="background: #F7F7F7; padding: 0 20px 0 20px">
        <tr>
            <td valign="top">
                <h2 style="color: blue; font-size: 26px;"><strong>iKansea</strong></h2>
            </td>
            <td align="right">
                <pre>
                    iKansea Head Office
                    Email : ikansea@gmail.com <br>
                    Phone : 08637347427 <br>
                </pre>
            </td>
        </tr>
    </table>

    <table width="100%" style="background: #F7F7F7; padding: 0 5 0px">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>Name : </strong> {{ $order->name}} <br>
                    <strong>Email : </strong> {{ $order->email}} <br>
                    <strong>Phone : </strong> {{ $order->phone }} <br>
                    <strong>Address : </strong> {{ $order->village->name }} 
                    {{ $order->district->name }} {{ $order->regency->name }} {{ $order->province->name }}<br>
                    <strong>Post Code : </strong> {{ $order->post_code}}<br>
                </p>
            </td>
            <td>
                <p class="font">
                    <h3><span style="color: blue;"> #{{ $order->invoice_no}}</h3>
                    Order Date : {{ $order->order_date}}<br>
                    Delivery Date : {{ $order->delivered_date }}<br>
                    Payment Type : {{ $order->payment_type }}</span>
                </p>
            </td>
        </tr>
    </table>
    <br>
    <h3>Products</h3>

    <table width="100%">
        <thead style="background-color: blue; color: #FFFFFF;">
            <tr class="font">
                <th>Image</th>
                <th>Product Name</th>
                <th>Size</th>
                <th>Color</th>
                <th>Code</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItem as $item)
            <tr class="font">
                <td align="center">
                    <img src="{{ public_path($item->product->product_thumbnail) }}" height="60px;" width="60px;">
                </td>
                <td align="center">{{ $item->product->product_name_en}}</td>
                <td align="center">{{ $item->size }}</td>
                <td align="center">{{ $item->color }}</td>
                <td align="center">{{ $item->qty}} </td>
                <td align="center">Rp. {{ $item->price}} </td>
                <td align="center">Rp. {{ $item->price * $item->qty }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <table width="100%" style="padding: 0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: blue;"> Subtotal : Rp. {{ $order->amout}} </span></h2>
                <h2><span style="color: blue;"> Total : Rp. {{ $order->amout}}</span></h2>
                <h3><span style="color: green;">Payment Status : {{ $order->status }}</span></h3>
            </td>
        </tr>
    </table>

    <div class="thanks mt-3">
        <p>Thanks For Buying !</p>
    </div>

    <div class="authority float-right mt-5">
        <p>--------------------------------</p>
        <h5>Authority Signature : </h5>
    </div>


</body>
</html>