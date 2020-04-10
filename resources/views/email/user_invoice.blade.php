
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 3</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
       @font-face {
  font-family: Junge;
  src: url(Junge-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #001028;
  text-decoration: none;
}

body {
  font-family: Junge;
  position: relative;
  width: fit-content;  
  height: auto; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-size: 14px; 
}

.arrow {
  margin-bottom: 4px;
}

.arrow.back {
  text-align: right;
}

.inner-arrow {
  padding-right: 10px;
  height: 30px;
  display: inline-block;
  background-color: rgb(233, 125, 49);
  text-align: center;

  line-height: 30px;
  vertical-align: middle;
}

.arrow.back .inner-arrow {
  background-color: rgb(233, 217, 49);
  padding-right: 0;
  padding-left: 10px;
}

.arrow:before,
.arrow:after {
  content:'';
  display: inline-block;
  width: 0; height: 0;
  border: 15px solid transparent;
  vertical-align: middle;
}

.arrow:before {
  border-top-color: rgb(233, 125, 49);
  border-bottom-color: rgb(233, 125, 49);
  border-right-color: rgb(233, 125, 49);
}

.arrow.back:before {
  border-top-color: transparent;
  border-bottom-color: transparent;
  border-right-color: rgb(233, 217, 49);
  border-left-color: transparent;
}

.arrow:after {
  border-left-color: rgb(233, 125, 49);
}

.arrow.back:after {
  border-left-color: rgb(233, 217, 49);
  border-top-color: rgb(233, 217, 49);
  border-bottom-color: rgb(233, 217, 49);
  border-right-color: transparent;
}

.arrow span { 
  display: inline-block;
  width: 80px; 
  margin-right: 20px;
  text-align: right; 
}

.arrow.back span { 
  margin-right: 0;
  margin-left: 20px;
  text-align: left; 
}

h1 {
  color: #5D6975;
  font-family: Junge;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  border-top: 1px solid #5D6975;
  border-bottom: 1px solid #5D6975;
  margin: 0 0 2em 0;
}

h1 small { 
  font-size: 0.45em;
  line-height: 1.5em;
  float: left;
} 

h1 small:last-child { 
  float: right;
} 

#project { 
  float: left; 
}

#company { 
  float: right; 
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 30px;
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

table td.sub {
  border-top: 1px solid #C1CED9;
}

table td.grand {
  border-top: 1px solid #5D6975;
}

table tr:nth-child(2n-1) td {
  background: #EEEEEE;
}

table tr:last-child td {
  background: #DDDDDD;
}

#details {
  margin-bottom: 30px;
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
    <main>
       <img style="width: 200px; height: auto; text-align: center;" src="http://admin.nextbuy.ae/public/adminasset/192.png"/>
      <h1  class="clearfix">
         <small><span>Order DATE</span><br />{{ date('M d,y',strtotime($order->created_at))}}</small> Receipt No {{ $order->receipt_no}}
      </h1>
      <div id="details" class="clearfix">
        <div id="project">
          <div><div><span>Company Name :</span> NextBuy </div></div>
          <div><div><span>ADDRESS  : </span> Al Wasl building 9275, OFFICE 201,<br> P.O Box: 124963. karama, Dubai.</div></div>
          <div><div><span>Phone No : </span> 0557858137</div></div>
          <div><div><span>EMAIL    : </span> <a href="info@nextbuy.ae">info@nextbuy.ae</a></div></div>
        </div>
            <div id="company">
              <div><div>Customer Name  : <span>{{ $order->address->first_name }} ,{{ $order->address->last_name }}</span></div></div>
              <div><div><span>ADDRESS  : </span> {{ $order->address->address1 }} ,{{ $order->address->postcode }} {{ $order->address->city}},{{ $order->address->state}}</div></div>
              <div><div><span>Phone No : </span> {{ $order->address->phone}}</div></div>
              <div><div><span>EMAIL    : </span> <a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a></div></div>
            </div>
          </div>
      <table style="width: 100%">
        <thead>
          <tr>
            <th class="service">Name</th>
            <th class="desc">Price </th>
            <th>QTy</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($order->order_product as $item)
          <tr>
            <td class="service">{{ $item->product->name}}</td>
            <td class="desc">{{ number_format($item->price,2) }} aed</td>
            <td class="unit">{{ $item->qty }}</td>
            <td class="qty">{{ $item->total_amount }} aed</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="3" class="sub">SUBTOTAL</td>
            <td class="sub total">{{ $order->total_amount}} aed</td>
          </tr>
          <tr>
            <td colspan="3">Discount </td>
            <td class="total">{{ ($order->discounted_amount) ? $order->discounted_amount ."aed" : "No Discount"  }} </td>
          </tr>
          <tr>
            <td colspan="3" class="grand total">GRAND TOTAL</td>
            <td class="grand total">{{ ($order->discounted_amount != NULL) ?  $order->total_amount - $order->discounted_amount ."aed" : $order->total_amount }}aed</td>
          </tr>
        </tbody>
      </table>
      
      <div id="notices">
        <div>Delivery Date: {{ $order->sent_date }}</div>
        <div>Deliver Time: {{ $order->sent_time }}</div>
        <div>Payment Type: {{ $order->payment_type }}</div>
        <div class="notice">.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>