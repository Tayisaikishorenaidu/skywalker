// Function to fetch cart items for a user

document.addEventListener('DOMContentLoaded', function() {
let totalCost = 0;
var base_url = window.location.protocol + '//' + window.location.hostname + '/';

function getCartItems(user_id ) {
    const tableBody = document.getElementById('cartItems');
    fetch(`${base_url}api/getcartApi.php?user_id=${user_id}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json', // Adjust content type if needed
      },
    })
      .then((response) => {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error('Failed to fetch cart items');
        }
      })
      .then((data) => {
        // Handle received cart items data
        if (data.status === 'success') {
          const cartItems = data.cart_items;
          // Process cart items - display, manipulate, etc.
          cartItems.forEach((item) => {
            const newRow = `
              <tr>
                <td>
                  <a href="#"><img src="../api/${item.image}" alt=""></a>
                </td>
                <td>
                  <a href="#">${item.product_name}</a>
                  <!-- Other content for item details -->
                </td>
                <td>
                  <!-- Item price -->
                  <h2>${item.price}</h2>
                </td>
                <td>
                  <!-- Quantity input -->
                  <div class="qty-box">
                    <div class="input-group">
                      <input type="number" name="quantity" class="form-control input-number" value="${item.quantity}">
                    </div>
                  </div>
                </td>
                <td>
                  <!-- Remove item icon/link -->
                  <a  onclick="removeFromCart('${item.product_id}')" class="icon"><i class="ti-close"></i></a>
                </td>
                <td>
                  <!-- Total price -->
                  <h2 class="td-color">${item.price * item.quantity}</h2>
                </td>
              </tr>`;
            // Append the newly created row to the table
            tableBody.insertAdjacentHTML('beforeend', newRow);
            totalCost += item.price * item.quantity;

            document.getElementById('totalCost').innerHTML = '$'+totalCost;
             
          });
          // You can perform further operations with the received cart data
        } else {
          console.error('Error:', data.message);
        }
      })
      .catch((error) => {
        // Handle error
        console.error('Error fetching cart items:', error);
      });
  }
  getCartItems(1)
});
  
  // Example usage: Call the function to get cart items for a specific user
 // Replace 'user123' with the actual user ID
  