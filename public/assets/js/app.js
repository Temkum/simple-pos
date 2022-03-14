let PRODUCTS = [];
let ITEMS = [];
let BARCODE = false;

let main_input = document.querySelector(".js-search");

// search feature
function searchItem(e) {
  const text = e.target.value.trim();

  const data = {};
  data.dataType = "search";
  data.text = text;

  sendData(data);
}

function sendData(data) {
  let ajax = new XMLHttpRequest();

  // get a response
  ajax.addEventListener("readystatechange", function (e) {
    if (ajax.readyState == 4) {
      // empty the div
      let myDiv = document.querySelector(".js-products");
      myDiv.innerHTML = "";
      PRODUCTS = [];

      if (ajax.status == 200) {
        // check for empty string
        if (ajax.responseText.trim() != "") {
          handleResult(ajax.responseText);
        } else {
          if (BARCODE) {
            alert("Item not found!");
          }
        }
      } else {
        console.log(
          "An error occurred with Err Code: " +
            ajax.status +
            " Err msg:" +
            ajax.statusText
        );
        // console.log(ajax);
      }
      // set barcode to false after prod is added to cart
      // and clear input if enter is pressed
      if (BARCODE) {
        BARCODE = false;
        main_input.value = "";
        main_input.focus;
      }
    }
  });

  //true so it runs in the background
  ajax.open("post", "index.php?page_name=ajax", true);
  // convert obj to string & send
  ajax.send(JSON.stringify(data));
}

function handleResult(result) {
  let obj = JSON.parse(result);

  if (typeof obj != "undefined") {
    // get valid json
    if (obj.dataType == "search") {
      let myDiv = document.querySelector(".js-products");

      // verify if data exist
      if (obj.data != "") {
        // update prods table
        PRODUCTS = obj.data;

        // loop through db data
        for (let i = 0; i < obj.data.length; i++) {
          myDiv.innerHTML += productMarkup(obj.data[i], i);
        }
        if (BARCODE && PRODUCTS.length == 1) {
          addItemFromIndex(0);
        }
      }
    }
  }
}

function productMarkup(data, index) {
  return `<div class="card mx-auto mb-2" style="width: 12rem;">
           <a href="#" class=""><img src="${data.image}" index="${index}" class="card-img-top" alt="...">
           </a>
           <div class="card-body">
             <p class="card-title text-muted">${data.description}</p>
             <p class="card-text bold"><b>$${data.amount}</b></p>
           </div>
         </div>`;
}

function itemMarkup(data, index) {
  return `<tr>
            <td><img src="${data.image}" class="cart-img" alt="...">
            </td>
            <td class="text-muted">${data.description}
              <div class="input-group my-3 numba-input">
                <span index="${index}" onclick="changeQty('decrease', event)" class="input-group-text"><i class="bi bi-dash-lg"></i></span>
                <input index="${index}" onblur="changeQty('input', event)" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="${data.qty}">
                <span index="${index}" onclick="changeQty('increase', event)" class="input-group-text">
                  <i class="bi bi-plus-lg"></i>
                </span>
              </div>
            </td>
            <td><b>$${data.amount}</b>
                <button onclick="clearCartItem(${index})" class="btn btn-danger float-end"><i class="bi bi-trash"></i></button>
            </td>
          </tr>`;
}

function addItem(e) {
  if (e.target.tagName == "IMG") {
    let index = e.target.getAttribute("index");

    addItemFromIndex(index);
  }
}

function addItemFromIndex(index) {
  // check if item exists in cart
  for (let i = ITEMS.length - 1; i >= 0; i--) {
    // add qty and refresh table
    if (ITEMS[i].id == PRODUCTS[index].id) {
      ITEMS[i].qty += 1;
      refreshItems();
      return;
    }
  }

  let tempData = PRODUCTS[index];
  tempData.qty = 1;

  ITEMS.push(PRODUCTS[index]);
  refreshItems();
}

function refreshItems() {
  let itemCount = document.querySelector(".js-item-count");
  itemCount.innerHTML = ITEMS.length;

  let itemsDiv = document.querySelector(".js-items");
  itemsDiv.innerHTML = "";

  // get total
  let grand_total = 0;

  for (let i = ITEMS.length - 1; i >= 0; i--) {
    itemsDiv.innerHTML += itemMarkup(ITEMS[i], i);
    grand_total += ITEMS[i].qty * ITEMS[i].amount;
  }

  let grandtotal_Div = document.querySelector(".js-total");
  grandtotal_Div.innerHTML = "Total: $" + grand_total;
}

function clearCart() {
  if (!confirm("Are you sure you want to clear cart items!")) {
    return;
  } else {
    ITEMS = [];
    refreshItems();
  }
}

/* function clearCartItem(index) {
  if (!confirm("Sure you want to remove this item?!")) {
    return;
  } else {
    // remove item from array
    ITEMS.splice(index, 1);
    refreshItems();
  }
} */

function clearCartItem(index) {
  // remove item from array
  ITEMS.splice(index, 1);
  refreshItems();
}

function changeQty(direction, e) {
  let index = e.currentTarget.getAttribute("index");

  if (direction == "increase") {
    ITEMS[index].qty += 1;
  } else if (direction == "decrease") {
    ITEMS[index].qty -= 1;
  } else {
    // use parseInt to prevent decimals
    ITEMS[index].qty = parseInt(e.currentTarget.value);
  }

  // prevent negative amt in qty
  if (ITEMS[index].qty < 1) {
    ITEMS[index].qty = 1;
  }

  refreshItems();
}

function checkForEnterKey(e) {
  if (e.keyCode == 13) {
    BARCODE = true;
    searchItem(e);
  }
}

sendData({
  dataType: "search",
  text: "",
});
