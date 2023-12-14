// Function to remove an item from the cart
function removeFromCart( product_id) {
  var base_url = window.location.protocol + '//' + window.location.hostname + '/';
  
    user_id = 1;
    fetch(`${base_url}/api/removecart.php?user_id=${user_id}&product_id=${product_id}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json', // Adjust content type if needed
      },
    })
      .then((response) => {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error('Failed to remove item from cart');
        }
      })
      .then((data) => {
        // Handle success response
        console.log(data.status + ': ' + data.message);
        alert("Item removed from cart")
        window.location.reload();
        // You can perform additional actions here based on the response
      })
      .catch((error) => {
        // Handle error
        console.error('Error removing item from cart:', error);
      });
  }
  
  // Example usage: Call the function to remove an item from the cart
//   removeFromCart('user123', 'product456'); // Replace 'user123', 'product456' with actual values
  