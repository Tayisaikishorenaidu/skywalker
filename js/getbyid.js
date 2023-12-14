// const { document } = require("postcss");

// Function to fetch product details by ID
document.addEventListener('DOMContentLoaded', function() {
  var base_url = window.location.protocol + '//' + window.location.hostname + '/';

function getProductDetails(productId) {
    fetch(`${base_url}/api/getbyidApi.php?product_id=${productId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json', // Adjust content type if needed
      },
    })
      .then((response) => {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error('Failed to fetch product details');
        }
      })
      .then((data) => {
        // Handle received product details data
        if (data.status === 'success') {
          const productDetails = data.product_details;
          document.getElementById('productName').innerHTML = productDetails.product_name;
          document.getElementById('productPrice').innerHTML = productDetails.price;
          var cartbtn = `<div class="product-buttons"><a href="javascript:void(0)" onclick="addToCart('${productDetails.product_id}')"
          class="btn btn-solid hover-solid btn-animation"><i
              class="fa fa-shopping-cart me-1" aria-hidden="true"></i> add to
          cart</a> <a href="#" class="btn btn-solid"><i
              class="fa fa-bookmark fz-16 me-2"
              aria-hidden="true"></i>wishlist</a>
              </div>`;
            document.getElementById('cart-btn').innerHTML = cartbtn;
          // Process product details - display, manipulate, etc.
          console.log('Product Details:', productDetails);
          // You can perform further operations with the received product data
        } else {
          console.error('Error:', data.message);
        }
      })
      .catch((error) => {
        // Handle error
        console.error('Error fetching product details:', error);
      });
}

// Get the product ID from the URL
const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('product_id');

// Call the function to get product details by ID
getProductDetails(productId);

});
  // Example usage: Call the function to get product details by ID
//   getProductDetails('your_product_id'); // Replace 'your_product_id' with the actual product ID
  