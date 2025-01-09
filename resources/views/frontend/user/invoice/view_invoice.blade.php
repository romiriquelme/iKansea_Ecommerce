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
                <p class="font">
                    <strong>Name : </strong> <br>
                    <strong>Email : </strong> <br>
                    <strong>Phone : </strong> <br>
                    <strong>Address : </strong> <br>
                    <strong>Post Code : </strong> <br>
                </p>
            </td>
            <td>
                <p class="font">
                    <h3><span style="color: blue;"> #Invoice</h3>
                    Order Date : <br>
                    Delivery Date : <br>
                    Payment Type : </span>
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
            <tr class="font">
                <td align="center">
                    <img src="" height="60px;" width="60px;">
                </td>
                <td align="center">Product_name_en</td>
                <td align="center">Product_size</td>
                <td align="center">Product_color</td>
                <td align="center">Product_code</td>
                <td align="center">Product_qty</td>
                <td align="center">Product_unit_price</td>
                <td align="center">Product_total</td>
            </tr>
        </tbody>
    </table>

    <br>

    <table width="100%" style="padding: 0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: blue;"> Subtotal : </span></h2>
                <h2><span style="color: blue;"> Total : </span></h2>
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