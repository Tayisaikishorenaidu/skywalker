document.addEventListener('DOMContentLoaded', function() {
    // Function to fetch and display products
    function fetchProducts() {
var base_url = window.location.protocol + '//' + window.location.hostname + '/';
      
      // Replace 'get_products.php' with the actual URL of your API endpoint
      const apiUrl = base_url+'api/getproductApi.php';
  
      // Make a GET request using fetch
      fetch(apiUrl)
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json(); // Parse the JSON response
        })
        .then(products => {
          // Handle the products received
          displayProducts(products);
        })
        .catch(error => {
          // Handle any errors that occurred during the fetch operation
          console.error('There was a problem fetching the products:', error);
        });
    }
  
    // Function to display products on the page
    function displayProducts(products) {
      const productListDiv = document.getElementById('productList');
      let productListHTML = '';
      
      // Create HTML for each product
      products.forEach(product => {
        productListHTML += `
        
          <div class="col-3">
        <div class="ratio_square">
          <div class="product-box product-wrap product-style-3">
            <div class="img-wrapper">
              <div class="front">
              <a onclick="getProductDetails('${product.id}')">
                  <img alt="" src="../api/${product.imagePath}" alt="${product.productName}" class="img-fluid blur-up lazyload bg-img">
                </a>
              </div>
              <div class="cart-detail">
                <a href="javascript:void(0)" title="Add to Wishlist">
                  <i class="ti-heart" aria-hidden="true"></i>
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View">
                  <i class="ti-search" aria-hidden="true"></i>
                </a>
                <a href="compare.html" title="Compare">
                  <i class="ti-reload" aria-hidden="true"></i>
                </a>
              </div>
            </div>
            <div class="product-info">
              <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
              <a onclick="redirectToProductDetails('${product.id}')">
                <h6>${product.productName}</h6>
              </a>
              <h4>$${product.price}</h4>
              <div class="add-btn">
                <a href="javascript:void(0)" class="" onclick="addToCart('${product.id}')">
                  <i class="ti-shopping-cart"></i> add to cart </a>
              </div>
            </div>
          </div>
        </div>
      </div>
        `;
      });
  
      // Set the HTML content in the productListDiv
      productListDiv.innerHTML = productListHTML;
    }
  
    // Load products when the page loads
    fetchProducts();
  });
  