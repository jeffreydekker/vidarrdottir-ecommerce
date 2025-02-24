document.addEventListener('DOMContentLoaded', () => {
const cartCount = document.querySelector('.cart-count');
const addToCartButtons = document.querySelectorAll('.btn-add-cart');

addToCartButtons.forEach(button => {
    button.addEventListener('click', () => {
    let count = parseInt(cartCount.textContent);
    cartCount.textContent = count + 1;
    alert('Item added to cart!');
    });
});
});