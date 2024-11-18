document.addEventListener('DOMContentLoaded', function() {
  const cartCountElement = document.getElementById('cart-count');
  const cartButtons = document.querySelectorAll('.cart-btn');

  // Load cart count from localStorage
  const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
  updateCartCount(cartItems);

  // Add event listeners to cart buttons
  cartButtons.forEach(function(button) {
      button.addEventListener('click', function() {
          const productId = button.getAttribute('data-id');
          const productName = button.getAttribute('data-name');
          const productPrice = parseFloat(button.getAttribute('data-price'));
          const productImage = button.getAttribute('data-image');

          const product = {
              id: productId,
              name: productName,
              price: productPrice,
              image: productImage,
              quantity: 1
          };

          addToCart(product);
          alert('Item added to cart!');
      });
  });

  function addToCart(product) {
      let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
      const existingProductIndex = cartItems.findIndex(item => item.id === product.id);

      if (existingProductIndex !== -1) {
          cartItems[existingProductIndex].quantity++;
      } else {
          cartItems.push(product);
      }

      localStorage.setItem('cartItems', JSON.stringify(cartItems));
      updateCartCount(cartItems);
  }

  function updateCartCount(cartItems) {
      const totalItems = cartItems.reduce((total, item) => total + item.quantity, 0);
      cartCountElement.textContent = totalItems;
  }
});

document.addEventListener('DOMContentLoaded', function() {
  const cartProductsElement = document.getElementById('cart-products');
  const totalPriceElement = document.getElementById('totalPrice');
  const totalItemsElement = document.getElementById('totalItems');
  const discountElement = document.getElementById('discount');
  const reducedAmountElement = document.getElementById('reducedAmount');
  const discountPercentage = 40; // Discount percentage

  let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
  updateCartDisplay();

  function updateCartDisplay() {
      cartProductsElement.innerHTML = '';
      let totalPrice = 0;
      let totalItems = 0;

      cartItems.forEach(item => {
          const productElement = document.createElement('div');
          productElement.classList.add('product');
          productElement.innerHTML = `
              <img src="${item.image}" />
              <div class="product-info">
                  <h3 class="product-name">${item.name}</h3>
                  <h4 class="product-price">Rs. ${item.price}</h4>
                  <p>Quantity: <span id="quantity_${item.id}">${item.quantity}</span></p>
                  <button class="btn1" onclick="decreaseQuantity(${item.id}, ${item.price})"><ion-icon name="remove-circle"></ion-icon></button>
                  <button class="btn1" onclick="increaseQuantity(${item.id}, ${item.price})"><ion-icon name="add-circle"></ion-icon></button>
                  <button class="btn2 remove" onclick="removeItem(${item.id})">Remove</button>
              </div>
          `;
          cartProductsElement.appendChild(productElement);

          totalPrice += item.price * item.quantity;
          totalItems += item.quantity;
      });

      totalPriceElement.textContent = `Rs. ${totalPrice}`;
      totalItemsElement.textContent = totalItems;

      const discountAmount = totalPrice * (discountPercentage / 100);
      const reducedAmount = totalPrice - discountAmount;

      discountElement.textContent = `Rs. ${discountAmount} (${discountPercentage}% off)`;
      reducedAmountElement.textContent = `Rs. ${reducedAmount}`;
  }

  window.increaseQuantity = function(itemId, price) {
      const item = cartItems.find(item => item.id === itemId.toString());
      if (item
