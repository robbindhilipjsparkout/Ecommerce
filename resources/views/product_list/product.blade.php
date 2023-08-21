<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom styles here */
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .table th,
        .table td {
            vertical-align: middle;
            padding:10px;
            text-align:center;
            text-transform:uppercase;
            font-size: 15px;
        }
    

.product-title {
    flex: 1; /* Allow the text to expand as needed */
    margin-right: 20px; /* Add some space between text and image */
}

.page-title {
        position: relative;
        padding: 115px 0;
        margin-left:-95px;
        margin-right:-95px;
        margin-bottom: 20px;
        background-size: cover;
        background-image: url('images/shirtbg2.jpeg'); 
        background-position: center center;
        background-repeat: no-repeat;
        opacity: 0.95;
        
    }

.page-title h1 {
  position: relative;
  float: left;
  font-size: 30px;
  color: #ffffff;
  line-height: 0px;
  text-align: center;
  font-weight: 700;
  text-shadow: 0 5px 10px #222222;
}
.auto-container {
  position: static;
  max-width: 1200px;
  padding: 0px 15px;
  margin: 0 auto;
}

.page-title .inner-container {
  position: relative;
}
.card-header {
        background-color: lightblue;
        border-radius: 10px;
    }
    .thead{
        background-color: lightblue;
    }
 .logo{


    margin:-20px;
 }
</style>
</head>

<body>

    <div class="container">
        
                    <!-- <div class="logo-box">
                        <div class="logo"><a href=""><img src="images/vipershirt.png" width=20% hight=20% alt=""></a></div>
                    </div> -->

    <section class="page-title">
    <div class='auto-container'>
    <div class='inner-container'><h1 >SHIRTS LIST</h1></div>
    </div>
    </section>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

          <table class="table table-bordered table-hover">
            <thead class="thead">
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Actual Price</th>
                    <th>Product Offer Price</th>
                    <th>QTY</th>
                    <th>Total Price</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><img src="{{ asset($product->product_image) }}" alt="Product Image" style="max-height: 100px;"></td>
                        <td>{{ $product->product_name }}</td>
                        <td>Rs. {{ $product->product_actual_price }}</td>
                        <td>Rs. {{ $product->product_offer_price }}</td>
                        <td>
                        <input type="number" class="form-control qty-input" data-offer="{{ $product->product_offer_price }}" min="0" max="999" value="0" oninput="validateQuantity(this)">
                        </td>
                        <td class="total-price">Rs. 0</td>
                    </tr>
                @endforeach
            </tbody>
          </table>


         
          <div class="card-header col-md-3 offset-md-9"> 
    <strong class="mb-0">Total Amount:</strong>
    <span id="total-amount">
        <strong>Rs. 0</strong>
    </span>
</div>


<div class="card col-md-7" style="margin-top:-50px">
    <div>
        <h3 class="mb-0">Customer Information</h3>
    </div>
    <div class="card-body c">
        <form action="{{ route('placeOrder') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="customer_name" placeholder="Customer Name" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="mobile_number" placeholder="Mobile Number" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email ID">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Address" required>
            </div>
            <div class="form-group">
                    <input type="text" class="form-control" name="city" placeholder="City" required>
            </div>
             <div class="form-group">
                        <input type="text" class="form-control" name="state" placeholder="State" required>        
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="pincode" placeholder="Pincode" required>
            </div>
            <br>
            <input type="hidden" id="total" name="total">

            <button type="submit" class="btn btn-primary mb-4  col-md-3 offset-md-5" >Submit</button>
        </form>
    </div>
</div>

</div>   
   <br>

<!-- JavaScript scripts and libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<<script>
    document.addEventListener('DOMContentLoaded', () => {
        const qtyInputs = document.querySelectorAll('.qty-input');
        const totalPrices = document.querySelectorAll('.total-price');
        const totalAmountElement = document.getElementById('total-amount');

        qtyInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                const offerPrice = +input.dataset.offer;
                const quantity = +input.value;
                totalPrices[index].textContent = `Rs. ${offerPrice * quantity}`;
                updateTotalAmount();
            });
        });

        function updateTotalAmount() {
            const totalAmount = [...qtyInputs].reduce((sum, input) =>
                sum + parseFloat(input.dataset.offer) * parseInt(input.value), 0);
            totalAmountElement.textContent = `Rs. ${totalAmount.toFixed(2)}`;
            $("#total").val(totalAmount);
        // alert(totalAmount);
        }

    });

    function validateQuantity(input) {
        const enteredQty = parseInt(input.value);
        if (enteredQty > 999) {
            alert("Qty only accepts values up to 999.");
            input.value = ""; // Clear the input field
        }
    }
</script>




</body>
</html>
