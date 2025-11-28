// PRODUK.JS — Fix membaca data-login per-card (tidak mengandalkan body)
const cartKey = "royalBakeryCart";
let cart = JSON.parse(localStorage.getItem(cartKey)) || [];
const cartCount = document.getElementById("cartCount");
const cartTotal = document.getElementById("cartTotal");
const menuCards = document.querySelectorAll(".menu-card");
const searchBar = document.getElementById("searchBar");
const cartIcon = document.getElementById("cartIcon");

// Cek apakah baru saja logout → tampilkan pesan
if (window.location.search.includes("logout=1")) {
    alert("Anda berhasil logout!");
    // Hapus flag returnAfterLogin kalau ada
    localStorage.removeItem("returnAfterLogin");
}
// helper: dapatkan status login untuk sebuah card/button
// prioritas: 1) atribut data-login pada elemen itu sendiri, 2) atribut data-login pada tombol plus dalam card, 3) atribut pada cartIcon, 4) body (fallback)
function isElementLoggedIn(el) {
  try {
    if (!el) return false;
    // 1. Jika elemen memiliki data-login
    if (typeof el.dataset !== 'undefined' && typeof el.dataset.login !== 'undefined') {
      return el.dataset.login === '1';
    }
    // 2. Jika ini adalah a card, cek tombol plus di dalamnya
    if (el.classList && el.classList.contains('menu-card')) {
      const plus = el.querySelector('.plus');
      if (plus && typeof plus.dataset.login !== 'undefined') {
        return plus.dataset.login === '1';
      }
    }
    // 3. cek cartIcon jika tersedia
    if (cartIcon && typeof cartIcon.dataset.login !== 'undefined') {
      return cartIcon.dataset.login === '1';
    }
    // 4. fallback ke body dataset (jika ada)
    if (document.body && document.body.dataset && typeof document.body.dataset.login !== 'undefined') {
      return document.body.dataset.login === '1';
    }
  } catch (e) {
    // fallback false on error
  }
  return false;
}

function saveCart() {
  localStorage.setItem(cartKey, JSON.stringify(cart));
}

function updateCartDisplay() {
  let totalItems = 0;
  let totalPrice = 0;

  cart.forEach(item => {
    totalItems += item.qty;
    totalPrice += item.harga * item.qty;
  });

  if (cartCount) cartCount.textContent = totalItems;
  if (cartTotal) cartTotal.textContent = totalPrice.toLocaleString("id-ID");

  saveCart();
}

menuCards.forEach(card => {
  const name = card.dataset.name;
  const price = parseInt(card.dataset.price, 10) || 0;
  const qtyDisplay = card.querySelector(".qty");
  const plusBtn = card.querySelector(".plus");
  const minusBtn = card.querySelector(".minus");

  const existing = cart.find(item => item.nama === name);
  if (qtyDisplay) qtyDisplay.textContent = existing ? existing.qty : 0;

  // Gunakan pengecekan per-card (baca dari plusBtn data-login atau fallback)
  plusBtn && plusBtn.addEventListener("click", () => {
    const logged = isElementLoggedIn(plusBtn) || isElementLoggedIn(card);
    if (!logged) {
      // simpan tempat kembali dan paksa login
      localStorage.setItem("returnAfterLogin", window.location.pathname + window.location.search);
      window.location.href = "../../DashboardUser/Login/login.php?redirect=" + encodeURIComponent(window.location.pathname + window.location.search);
      return;
    }

    let item = cart.find(i => i.nama === name);
    if (item) item.qty++;
    else cart.push({ nama: name, harga: price, qty: 1 });

    if (qtyDisplay) qtyDisplay.textContent = cart.find(i => i.nama === name).qty;
    updateCartDisplay();
  });

  minusBtn && minusBtn.addEventListener("click", () => {
    // untuk minus juga cek login dengan cara yang sama
    const logged = isElementLoggedIn(minusBtn) || isElementLoggedIn(card) || isElementLoggedIn(plusBtn);
    if (!logged) {
      localStorage.setItem("returnAfterLogin", window.location.pathname + window.location.search);
      window.location.href = "../../DashboardUser/Login/login.php?redirect=" + encodeURIComponent(window.location.pathname + window.location.search);
      return;
    }

    let item = cart.find(i => i.nama === name);
    if (!item) return;

    item.qty--;
    if (item.qty <= 0) {
      cart = cart.filter(i => i.nama !== name);
      if (qtyDisplay) qtyDisplay.textContent = 0;
    } else {
      if (qtyDisplay) qtyDisplay.textContent = item.qty;
    }

    updateCartDisplay();
  });
});

// Cart icon click
if (cartIcon) {
  cartIcon.addEventListener("click", () => {
    const logged = isElementLoggedIn(cartIcon) || isElementLoggedIn(document.body);
    if (!logged) {
      localStorage.setItem("returnAfterLogin", window.location.pathname + window.location.search);
      window.location.href = "../../DashboardUser/Login/login.php?redirect=" + encodeURIComponent(window.location.pathname + window.location.search);
      return;
    }

    if (cart.length === 0) {
      alert("Keranjang Anda kosong 😢");
      return;
    }

    window.location.href = "../../DashboardUser/order/order.php";
  });
}

if (searchBar) {
  searchBar.addEventListener("input", e => {
    const searchTerm = e.target.value.toLowerCase();
    menuCards.forEach(card => {
      const menuName = (card.dataset.name || '').toLowerCase();
      card.style.display = menuName.includes(searchTerm) ? "block" : "none";
    });
  });
}

updateCartDisplay();