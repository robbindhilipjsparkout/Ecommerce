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
        }
        .product {
    display: flex; /* Use flexbox to align items */
    align-items: center; /* Center align items vertically */
    max-width: 600px; /* Adjust the maximum width as needed */
    margin: 0 auto; /* Center the content horizontally */
}

.product-title {
    flex: 1; /* Allow the text to expand as needed */
    margin-right: 20px; /* Add some space between text and image */
}

.product-image {
    max-width: 100%; /* Ensure the image stays within its container */
    height: auto;
}
page-title {
  position: relative;
  padding: 100px 0;
  background-size: cover;
  background-image: url('');
  background-position: center center;
  background-repeat: no-repeat;
opacity: 0.88;
}
.page-title h1 {
  position: relative;
  float: left;
  font-size: 40px;
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


    </style>
</head>

<body>

    <div class="container">
                      
    <section class="page-title">
  <div class='auto-container'>
    <div class='inner-container'><h1 >PRODUCT LIST</h1></div>
    </div>
</section>

    <img src="shirtbg.jpeg" alt="Product Image" class="product-image">
</div>
@if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Actual Price</th>
                    <th>Product Offer Price</th>
                    <th>QTY</th>
                    <th>Total Price</th>
                    <th></th>
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
                <tr>
    <td colspan="3">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Customer Information</h3>
            </div>
            <div class="card-body">
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
                    <button type="submit" class="btn btn-primary">Place Order</button>
                </form>
            </div>
        </div>
    </td>
</tr>
<tr>
    <td colspan="4"></td>
    <td class="text-right"><strong>Total Amount:</strong></td>
    <td id="total-amount" colspan="2"><strong>Rs. 0</strong></td>
</tr>

            
            </tbody>

            
        </table>
      

    </div>

    <!-- Include Bootstrap JS and any other necessary scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const qtyInputs = document.querySelectorAll('.qty-input');
        const totalPrices = document.querySelectorAll('.total-price');

        qtyInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                const offerPrice = +input.dataset.offer;
                const quantity = +input.value;
                totalPrices[index].textContent = `Rs. ${offerPrice * quantity}`;
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const qtyInputs = document.querySelectorAll('.qty-input');
        const totalAmountElement = document.getElementById('total-amount');

        qtyInputs.forEach(input => input.addEventListener('input', updateTotalAmount));

        function updateTotalAmount() {
            const totalAmount = [...qtyInputs].reduce((sum, input) => {
                const offerPrice = parseFloat(input.dataset.offer);
                const quantity = parseInt(input.value);
                return sum + offerPrice * quantity;
            }, 0);
            totalAmountElement.textContent = `Rs. ${totalAmount.toFixed(2)}`;
        }

        updateTotalAmount();
    });
</script>


<script>
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
