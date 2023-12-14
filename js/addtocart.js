// Function to add an item to the cart
function addToCart( product_id) {
    user_id = 1;
    var base_url = window.location.protocol + '//' + window.location.hostname + '/';
    // API endpoint for adding an item to the cart
    fetch(base_url+'api/addcartApi.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded', // Adjust content type if needed
      },
      body: new URLSearchParams({
        user_id: user_id,
        product_id: product_id,
        quantity: 1,
      }),
    })
      .then((response) => {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error('Failed to add item to cart');
        }
      })
      .then((data) => {
        // Handle success response
        alert("Item added to cart")
        console.log(data.status + ': ' + data.message);
        // You can perform additional actions here based on the response
      })
      .catch((error) => {
        // Handle error
        console.error('Error adding item to cart:', error);
      });
}

function redirectToProductDetails(productId) {
    // Redirect to the product details page with the product ID in the URL
    window.location.href = "product-page.html?product_id=" + productId;
}

// Example usage: Call the function to redirect to product details page
redirectToProductDetails(productId); // Replace 'your_product_id' with the actual product ID

// Example usage: Call the function to add an item to the cart
