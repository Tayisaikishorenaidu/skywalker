document.addEventListener('DOMContentLoaded', function() {
var base_url = window.location.protocol + '//' + window.location.hostname + '/';
// Function to fetch products by category
    // Function to fetch categories from the server
    function fetchCategories() {
      // Replace 'getcategoryapi.php' with the actual URL of your PHP endpoint to fetch categories
      const apiUrl = base_url+'api/getcategoryApi.php';
  
      // Make a GET request using fetch
      fetch(apiUrl)
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json(); // Parse the JSON response
        })
        .then(categories => {
          // Handle the categories received
          displayCategories(categories);
        })
        .catch(error => {
          // Handle any errors that occurred during the fetch operation
          console.error('There was a problem fetching the categories:', error);
        });
    }
  
    // Function to display categories on the page
    function displayCategories(categories) {
      const categoryListDiv = document.getElementById('categoryList');
      let categoryListHTML = '';
      
      // Create HTML for each category
      categories.forEach(category => {
        categoryListHTML += `
          <a class="nav-link" data-bs-toggle="pill" data-bs-target="#${category.categoryName}" role="tab" onclick="fetchProductsByCategory('${category.id}');" >${category.categoryName}</a>
        `;
      });
  
      // Set the HTML content in the categoryListDiv
      categoryListDiv.innerHTML = categoryListHTML;
    }
  
    // Load categories when the page loads
    fetchCategories();
  });
  