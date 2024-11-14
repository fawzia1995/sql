document.addEventListener('DOMContentLoaded', () => {
    fetchProducts();

    // Fetch products from the server
    function fetchProducts() {
        fetch('products.php')
            .then(response => response.json())
            .then(products => {
                const productList = document.getElementById('product-list');
                products.forEach(product => {
                    const productCard = `
                        <div class="col-md-4">
                            <div class="card">
                                <img src="${product.image_url}" class="card-img-top" alt="${product.product_name}">
                                <div class="card-body">
                                    <h5 class="card-title">${product.product_name}</h5>
                                    <p class="card-text">${product.product_description}</p>
                                    <p class="card-text"><strong>$${product.price}</strong></p>
                                    <button class="btn btn-primary add-to-cart" data-id="${product.product_id}">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    `;
                    productList.innerHTML += productCard;
                });

                // Add event listeners to "Add to Cart" buttons
                const addToCartButtons = document.querySelectorAll('.add-to-cart');
                addToCartButtons.forEach(button => {
                    button.addEventListener('click', addToCart);
                });
            });
    }

    // Add product to cart
    function addToCart(event) {
        const productId = event.target.getAttribute('data-id');
        // Store the productId in the local storage for the cart
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.push(productId);
        localStorage.setItem('cart', JSON.stringify(cart));
        alert('Product added to cart');
    }
});
