// Sepet sayfasındaki ürün miktarını güncelleyen bir örnek fonksiyon
function updateCartItem(itemId, quantity) {
  fetch(`/cart/update/${itemId}`, {
    method: "POST",
    body: JSON.stringify({ quantity: quantity }),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      alert("Sepet güncellendi!");
      location.reload(); // Sayfayı yeniden yükleyerek güncellenmiş verileri gösterir
    });
}
