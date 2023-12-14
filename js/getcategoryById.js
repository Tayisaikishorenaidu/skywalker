
    // Function to fetch products by category ID from the server
    function fetchProductsByCategory(categoryId) {
var base_url = window.location.protocol + '//' + window.location.hostname + '/';
      
      // Replace 'getproductsbycategory.php' with the actual URL of your PHP endpoint
      const apiUrl = `${base_url}api/getcategoryById.php?category_id=${categoryId}`;
  
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
        <div class="col-lg-3 col-md-4 col-6">
                                        <div class="product-box product-style-5">
                                        <a onclick="redirectToProductDetails('${product.id}')">
                                                <h6>${product.productName}</h6>
                                            </a>
                                           
                                            <h4>$${product.price}</h4>
                                            <div class="addtocart_btn">
                                                <button class="add-button add_cart" title="Add to cart">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty open">
                                                    <div class="input-group">
                                                        <button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input type="text" name="quantity" class="form-control input-number qty-input" value="1">
                                                        <button type="button" class="btn quantity-right-plus" onclick="addToCart('${product.id}')" data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="img-wrapper">
                                                <div class="front">
                                                    <a href="product-page.html" class="bg-size blur-up lazyloaded" style="background-image: url('.../api/${product.imagePath}'); background-size: cover; background-position: center center; display: block;"><img alt="" src="../api/${product.imagePath}" class="img-fluid blur-up lazyload bg-img" style="display: none;"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
      });
  
      // Set the HTML content in the productListDiv
      productListDiv.innerHTML = productListHTML;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Function to fetch and display products
        function fetchProducts() {
          // Replace 'get_products.php' with the actual URL of your API endpoint
          const apiUrl = 'http://localhost/public/ideation/FashionEcom/api/getproductApi.php';
      
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
            <div class="col-lg-3 col-md-4 col-6">
                                        <div class="product-box product-style-5">
                                        <a onclick="redirectToProductDetails('${product.id}')">
                                                <h6>${product.productName}</h6>
                                            </a>
                                           
                                            <h4>$${product.price}</h4>
                                            <div class="addtocart_btn">
                                                <button class="add-button add_cart" title="Add to cart">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty open">
                                                    <div class="input-group">
                                                        <button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input type="text" name="quantity" class="form-control input-number qty-input" value="1">
                                                        <button type="button" class="btn quantity-right-plus" onclick="addToCart('${product.id}')" data-type="plus" data-field="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="img-wrapper">
                                                <div class="front">
                                                    <a href="product-page.html" class="bg-size blur-up lazyloaded" style="background-image: url('.../api/${product.imagePath}'); background-size: cover; background-position: center center; display: block;"><img alt="" src="../api/${product.imagePath}" class="img-fluid blur-up lazyload bg-img" style="display: none;"></a>
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
      
  
    // Example usage:
    // Replace '1' with the actual category ID you want to fetch products for

    
        
    
  
  