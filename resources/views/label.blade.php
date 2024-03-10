{{-- https://codesandbox.io/p/sandbox/inline-css-invoice-template-z5bur --}}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Inline CSS Invoice Template</title>
  </head>
  <body style="background-image: url('data:image/jpeg;base64,{{$label}}'); background-size: cover">
    <div style="padding: 10px;">
      <table style="width: 100%;">
        <tr style="width: 100%;">
          <td style="width: 50%;">
            <label style="font-size: 40px; font-weight: bold;">INV-001</label>
          </td>
          <td style="width: 50%; text-align: right;">
          </td>
        </tr>
      </table>
      <table style="width: 100%; margin: 10px 0px;">
        <tr style="width: 100%;">
          <td style="width: 33%; line-height: 25px;">
            <label>Billing Address</label><br />
            <label style="font-weight: bold; font-size: 20px;"
              >{{$order['billing_address']['name']}}</label
            >
            <br />
            {{$order['billing_address']['street'] . ' ' . $order['billing_address']['housenumber']}} <br />
            {{$order['billing_address']['zipcode'] . ', ' . $order['billing_address']['city']}}<br />
            {{$order['billing_address']['country']}}<br />
          </td>
          <td style="width: 33%; line-height: 25px;">
            <label>Shipping Address</label><br />
            <label style="font-weight: bold; font-size: 20px;"
              >{{$order['delivery_address']['name']}}</label
            ><br />
            {{$order['delivery_address']['street'] . ' ' . $order['delivery_address']['housenumber']}} <br />
            {{$order['delivery_address']['zipcode'] . ', ' . $order['delivery_address']['city']}}<br />
            {{$order['delivery_address']['country']}}<br />
          </td>
          <td style="width: 33%; margin: auto;">
            <span
              style="
                background: #e1e1e1;
                font-size: 30px;
                font-weight: bold;
                padding: 10px;
                color: #343a40;
              "
            >
              DUE/PAID</span
            >
          </td>
        </tr>
      </table>
      <table style="width: 100%;">
        <tr style="background: #343a40; color: white;">
          <th style="padding: 10px;">
            Description
          </th>
          <th>
            Amount
          </th>
          <th>
            SKU
          </th>
          <th>
            Total
          </th>
        </tr>
        @foreach($order['order_lines'] as $line)
        <tr>
          <td>
            {{$line['name']}} ({{$line['ean']}})
          </td>
          <td>
            {{$line['amount_ordered']}}
          </td>
          <td>
            {{$line['sku']}}
          </td>
          <td>
            -
          </td>
        </tr>
        @endforeach
      </table>
      <table style="width: 100%; position: fixed; bottom: 0;">
        <tr style="width: 100%;">
          <td style="width: 50%;">
            
          </td>
          <td
            style="
              width: 50%;
              background-color: whitesmoke;
              text-align: center;
              padding: 10px;
            "
          >
          
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>
