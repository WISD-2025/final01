function increase(btn) {
    let input = btn.previousElementSibling;
    let val = parseInt(input.value);
    

    let max = parseInt(input.getAttribute('data-max'));

    if (val < max) {
        input.value = val + 1;
    } else {
        alert("已達到庫存上限！");
    }
}

function decrease(btn) {
    let input = btn.nextElementSibling;
    let val = parseInt(input.value);
    if (val > 1) {
        input.value = val - 1;
    }
}


function addToCart(id, name, price, btn, maxStock) { 
    let card = btn.closest('.group');
    let qtyInput = card.querySelector('.qty');
    
    if (!qtyInput) return;

    let qty = parseInt(qtyInput.value);
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    let existingItem = cart.find(item => item.id === id);

    let currentQtyInCart = existingItem ? existingItem.qty : 0;

    if (currentQtyInCart + qty > maxStock) {
        alert(`庫存不足！\n目前庫存：${maxStock}\n購物車內已有：${currentQtyInCart}\n您想再加：${qty}\n(總共 ${currentQtyInCart + qty} 超過上限)`);
        return;
    }

    if (existingItem) {
        existingItem.qty += qty;
        existingItem.maxStock = maxStock;
    } else {
        cart.push({ 
            id: id,           
            name: name, 
            price: price, 
            qty: qty, 
            maxStock: maxStock 
        });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    
    qtyInput.value = 1;
    alert(`成功！已將 ${qty} 份「${name}」加入購物車`);
}



function renderCart() {
    let tbody = document.getElementById('cart-body');
    if (!tbody) return;

    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let totalSpan = document.getElementById('total');
    let total = 0;

    tbody.innerHTML = '';

    if (cart.length === 0) {
        tbody.innerHTML = `<tr><td colspan="5" class="p-8 text-center text-gray-500">購物車目前是空的</td></tr>`;
        if (totalSpan) totalSpan.innerText = 0;
        return;
    }

    cart.forEach((item, index) => {
        let subtotal = item.price * item.qty;
        total += subtotal;

        let maxStock = item.maxStock || 999; 

        tbody.innerHTML += `
            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition border-b border-gray-100 dark:border-zinc-700">
                <td class="p-3 text-gray-800 dark:text-gray-200">
                    ${item.name}
                    <div class="text-xs text-gray-400">庫存上限: ${maxStock}</div>
                </td>
                <td class="p-3 text-gray-600 dark:text-gray-400">$${item.price}</td>
                <td class="p-3">
                    <div class="flex items-center gap-2">
                        <button onclick="changeQty(${index}, -1)" class="w-6 h-6 rounded bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold">-</button>
                        <span class="w-8 text-center text-gray-800 dark:text-white font-medium">${item.qty}</span>
                        <button onclick="changeQty(${index}, 1)" class="w-6 h-6 rounded bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold" ${item.qty >= maxStock ? 'disabled style="opacity:0.5"' : ''}>+</button>
                    </div>
                </td>
                <td class="p-3 text-blue-600 dark:text-blue-400 font-bold">$${subtotal}</td>
                <td class="p-3">
                    <button onclick="changeQty(${index}, -9999)" class="text-red-500 hover:text-red-700 font-bold text-sm">刪除</button>
                </td>
            </tr>
        `;
    });

    if (totalSpan) totalSpan.innerText = total;
}

function changeQty(index, delta) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let item = cart[index];
    let maxStock = item.maxStock || 999;

    if (delta > 0 && item.qty >= maxStock) {
        alert("已達到庫存上限，無法再增加！");
        return;
    }
    
    if (delta === -9999) {
        cart.splice(index, 1);
    } else {
        item.qty += delta;
        if (item.qty < 1) {
            cart.splice(index, 1);
        }
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();
}


function submitOrder() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (cart.length === 0) {
        alert('購物車是空的！');
        return;
    }
    if (confirm('確定要送出訂單嗎？')) {
        localStorage.removeItem('cart');
        alert('訂單已送出！');
        location.reload();
    }
}

function clearCart() {
    if (confirm('確定要清空購物車嗎？')) {
        localStorage.removeItem('cart');
        location.reload();
    }
}

document.addEventListener("DOMContentLoaded", function() {
    renderCart();
});
