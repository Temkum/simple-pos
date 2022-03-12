let PRODUCTS = [];
let ITEMS = [];

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
      if (ajax.status == 200) {
        handleResult(ajax.responseText);
      } else {
        console.log(
          "An error occurred with Err Code: " +
            ajax.status +
            " Err msg:" +
            ajax.statusText
        );
        console.log(ajax);
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
      myDiv.innerHTML = "";
      PRODUCTS = [];

      // verify if data exist
      if (obj.data != "") {
        // update prods table
        PRODUCTS = obj.data;

        // loop through db data
        for (let i = 0; i < obj.data.length; i++) {
          myDiv.innerHTML += productMarkup(obj.data[i], i);
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

function itemMarkup(data) {
  return `<tr>
            <td><img src="assets/images/fast-food.jpg" class="cart-img" alt="...">
            </td>
            <td class="text-muted">Burger King
              <div class="input-group my-3 numba-input">
                <span class="input-group-text"><i class="bi bi-dash-lg"></i></span>
                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="1">
                <span class="input-group-text">
                  <i class="bi bi-plus-lg"></i>
                </span>
              </div>
            </td>
            <td><b>$5</b></td>
          </tr>`;
}

function addItem(e) {
  if (e.target.tagName == "IMG") {
    let index = e.target.getAttribute("index");

    ITEMS.push(PRODUCTS[index]);

    console.log(ITEMS);
  }
}

sendData({
  dataType: "search",
  text: "",
});
