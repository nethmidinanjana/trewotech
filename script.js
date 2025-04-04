function changeView() {
    var signUpBox = document.getElementById("signupbox");
    var signInBox = document.getElementById("signinbox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");
}

function signUp() {
    var f = document.getElementById("f");
    var l = document.getElementById("l");
    var e = document.getElementById("e");
    var p = document.getElementById("p");
    var m = document.getElementById("m");
    var g = document.getElementById("g");

    var form = new FormData;
    form.append("f", f.value);
    form.append("l", l.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("m", m.value);
    form.append("g", g.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var t = request.responseText;
            if (t == "success") {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msg").className = "bi bi-check2-circle fs-5";
                document.getElementById("alertdiv").className = "alert alert-success";
                document.getElementById("msg_div").className = "d-block";
            } else {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msg_div").className = "d-block";
            }
        }
    }

    request.open("POST", "signUpProcess.php", true);
    request.send(form);

}

function signIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
                document.getElementById("alertdiv2").className = "alert alert-danger";
                document.getElementById("msg_div2").className = "d-block";
            }
        }
    }

    r.open("POST", "signInProcess.php", true);
    r.send(f);

}

var bm;
function forgotPassword() {

    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {resetpw
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {

                alert("Verification code has sent to your email. Please check your inbox.");
                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

function showPassword1() {

    var i = document.getElementById("npi");
    var icon1 = document.getElementById("icon1");

    if (i.type == "password") {
        i.type = "text";
        icon1.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        icon1.className = "bi bi-eye-slash-fill";
    }
}

function showPassword2() {

    var i = document.getElementById("rnp");
    var icon2 = document.getElementById("icon2");

    if (i.type == "password") {
        i.type = "text";
        icon2.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        icon2.className = "bi bi-eye-slash-fill";
    }
}

function resetpw() {
    var email = document.getElementById("email2");
    var np = document.getElementById("npi");
    var rnp = document.getElementById("rnp");
    var vcode = document.getElementById("vc");

    var f = new FormData();
    f.append("e", email.value);
    f.append("n", np.value);
    f.append("r", rnp.value);
    f.append("v", vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Your Password Updated");
                bm.hide();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "resetPassword.php", true);
    r.send(f);
}

function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            }
        }
    }

    r.open("GET", "signoutProcess.php", true);
    r.send();

}

function changeProductImage() {

    var image = document.getElementById("imageuploader");

    image.onchange = function () {

        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {

                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;

            }

        } else {
            alert(file_count + "files. You can upload only 3 or less than 3 images. ")
        }

    }
}

function loadBrands() {

    var category = document.getElementById("category").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("brand").innerHTML = t;
        }
    }

    r.open("GET", "loadbrands.php?c=" + category, true);
    r.send();
}

function loadModels() {

    var brand = document.getElementById("brand").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("model").innerHTML = t;
        }
    }

    r.open("GET", "loadModals.php?b=" + brand, true);
    r.send();
}

function addclr() {

    var clr = document.getElementById("clr_input").value;

    var f = new FormData();
    f.append("clr", clr);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "addClrProcess.php", true);
    r.send(f);
}

function addProduct() {

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");
    var clr = document.getElementById("clr");
    var clr_input = document.getElementById("clr_input");
    var condition = document.getElementById("condition");
    var qty = document.getElementById("qty");
    var price = document.getElementById("price");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("ca", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("clr", clr.value);
    f.append("clr_input", clr_input.value);
    f.append("con", condition.value);
    f.append("qty", qty.value);
    f.append("price", price.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("desc", desc.value);

    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {

        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Product Added Successfully.") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);

}

function clearsort() {
    window.location.reload();
}

function sort1(x) {

    var search = document.getElementById("s");
    var time = "0";

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }

    var qty = "0";

    if (document.getElementById("h").checked) {
        qty = "1";
    } else if (document.getElementById("l").checked) {
        qty = "2";
    }

    var condition = "0";

    if (document.getElementById("b").checked) {
        condition = "1";
    } else if (document.getElementById("u").checked) {
        condition = "2";
    }

    var f = new FormData();
    f.append("s", search.value);
    f.append("t", time);
    f.append("q", qty);
    f.append("c", condition);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sort").innerHTML = t;
        }
    }

    r.open("POST", "sortProcess.php", true);
    r.send(f);

}

function changeStatus(id) {

    var product_id = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "deactivated") {

                alert("Product Deactivated.");
                window.location.reload();

            } else if (t == "activated") {

                alert("Product Activated.");
                window.location.reload();

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "changeStatusProcess.php?p=" + product_id, true);
    r.send();

}

function sendId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "updateProduct.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "sendProductIdProcess.php?id=" + id, true);
    r.send();

}

function updateProduct() {

    var title = document.getElementById("title");
    var qty = document.getElementById("qty");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var description = document.getElementById("desc");
    var images = document.getElementById("imageuploader");

    var f = new FormData();

    f.append("t", title.value);
    f.append("q", qty.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("desc", description.value);

    var img_count = images.files.length;

    for (var x = 0; x < img_count; x++) {
        f.append("i" + x, images.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("POST", "updateProcess.php", true);
    r.send(f);


}

function changeImg() {

    var view = document.getElementById("viewImg");
    var file = document.getElementById("profileimg");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }

}

function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var image = document.getElementById("profileimg");

    var f = new FormData();
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("m", mobile.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pcode", pcode.value);

    if (image.files.length == 0) {

        var confirmation = confirm("Are you sure you don't want to update profile image?");

        if (confirmation) {
            alert("you havenot selected any image.");
        }

    } else {
        f.append("image", image.files[0]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);


}

function basicSearch(x) {

    var txt = document.getElementById("basic_search_txt");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);
}

function advancedSearch(x) {

    var txt = document.getElementById("t");
    var category = document.getElementById("c1");
    var brand = document.getElementById("b");
    var model = document.getElementById("m");
    var condition = document.getElementById("c2");
    var color = document.getElementById("c3");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("s");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("con", condition.value);
    f.append("col", color.value);
    f.append("pf", from.value);
    f.append("to", to.value);
    f.append("s", sort.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);

}

function loadMainImg(id) {
    var img = document.getElementById("productImg" + id).src;
    var main = document.getElementById("main_img");
    main.style.backgroundImage = "url(" + img + ")";
}

function checkValue(qty) {
    var input = document.getElementById("qty_input");

    if (input.value <= 0) {
        alert("Quantity must be 1 or more");
        input.value = 1;
    } else if (input.value > qty) {
        alert("Maximum quantity achived");
        input.value = qty;
    }
}

function qty_inc(qty) {
    var input = document.getElementById("qty_input");

    if (input.value < qty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue.toString();
    } else {
        alert("Maximum quantity has achived");
        input.value = qty;
    }
}

function qty_dec() {
    var input = document.getElementById("qty_input");

    if (input.value > 1) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue.toString();
    } else {
        alert("Quantity must be one or more");
        input.value = 1;
    }
}

function addToWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "removed") {
                document.getElementById("heart" + id).style.className = "text-warning";
                window.location.reload();
            } else if (t == "added") {
                document.getElementById("heart" + id).style.className = "text-danger";
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addToWishlistProcess.php?id=" + id, true);
    r.send();
}

function removeFromWatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeFromWishlistProcess.php?id=" + id, true);
    r.send();
}

function addToCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();

}

function deleteFromCart(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t = "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "deleteFromCartProcess.php?id=" + id, true);
    r.send();
}

function payNow(id) {

    var qty = document.getElementById("qty_input").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["mail"];
            var amount = obj["amount"];

            if (t == "1") {
                alert("Please log in or sign up");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please update your profile first");
                window.location = "userProfile.php";
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {

                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId, id, mail, amount, qty);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221812",    // Replace your Merchant ID
                    "return_url": "http://localhost/trewotech/singleProductView.php?id" + id,     // Important
                    "cancel_url": "http://localhost/trewotech/singleProductView.php?id" + id,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }

        }
    }

    r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true)
    r.send();

}

function saveInvoice(orderId, id, mail, amount, qty) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);
    f.append("q", qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveInvoice.php", true);
    r.send(f);

}

function viewMessages(email) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("chat_box").innerHTML = t;
        }
    }

    r.open("GET", "viewMsgProcess.php?e=" + email, true);
    r.send();
}

function send_msg() {
    var email = document.getElementById("rmail");
    var txt = document.getElementById("msg_txt");

    var f = new FormData();
    f.append("e", email.innerHTML);
    f.append("t", txt.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "sendMsgProcess.php", true);
    r.send(f);
}

var cam;
function contactAdmin(email) {
    var m = document.getElementById("contactAdmin");
    cam = new bootstrap.Modal(m);
    cam.show();
}

var av;
function adminVerification() {

    document.getElementById("btn_txt").innerHTML = "";
    document.getElementById("btn_txt").classList = "spinner-border spinner-border-sm mt-2";

    var email = document.getElementById("e");

    var f = new FormData();
    f.append("e", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var adminVerificationModal = document.getElementById("verificationModal");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminVarificationProcess.php", true);
    r.send(f);
}

function verify() {
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                av.hide();
                window.location = "adminPanel.php";
            }
        }
    }

    r.open("GET", "verificationProcess.php?v=" + verification.value, true);
    r.send();
}

function searchUser() {

    var txt = document.getElementById("searchusertxt");

    var f = new FormData();
    f.append("txt", txt.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("searchUserResult").innerHTML = t;
        }
    }

    r.open("POST", "searchUserProcess.php", true);
    r.send(f);
}

var um;
function viewUserModal(email) {
    var m = document.getElementById("viewUserModal" + email);
    um = new bootstrap.Modal(m);
    um.show();
}

var mm;
function viewMsgModal(email) {
    var m = document.getElementById("userMsgModal" + email);
    mm = new bootstrap.Modal(m);
    mm.show();
}

function blockUser(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "blocked") {
                document.getElementById("ub" + email).innerHTML = "Unblock";
                document.getElementById("ub" + email).classList = "btn btn-success";
            } else if (t == "unblocked") {
                document.getElementById("ub" + email).innerHTML = "Block";
                document.getElementById("ub" + email).classList = "btn btn-danger";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "userBlockProcess.php?e=" + email, true);
    r.send();
}

function searchProduct() {

    var txt = document.getElementById("searchUsertxt");

    var f = new FormData();
    f.append("txt", txt.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("productSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "searchProductProcess.php", true);
    r.send(f);
}

var pm;
function viewProductModal(id) {
    var m = document.getElementById("viewProductModal" + id);
    pm = new bootstrap.Modal(m);
    pm.show();
}

var ou;
function viewModalOFS() {
    var m = document.getElementById("outOfStockModal");
    ou = new bootstrap.Modal(m);
    ou.show();
}

function blockProduct(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "blocked") {
                document.getElementById("pb" + id).innerHTML = "Unblock";
                document.getElementById("pb" + id).classList = "btn btn-success";
            } else if (txt == "unblocked") {
                document.getElementById("pb" + id).innerHTML = "Block";
                document.getElementById("pb" + id).classList = "btn btn-danger";
            } else {
                alert(txt);
            }
        }
    }

    r.open("GET", "productBlockProcess.php?id=" + id, true);
    r.send();

}

function searchBrand() {

    var txt = document.getElementById("singleProductViewSrchTxt");

    var f = new FormData();
    f.append("txt", txt.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("serchresult").innerHTML = t;

        }
    }

    r.open("POST", "singleProductViewSerchProcess.php", true);
    r.send(f);
}

function cartSearch() {

    var txt = document.getElementById("cartSearchTxt");

    var f = new FormData();
    f.append("txt", txt.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        var t = r.responseText;
        document.getElementById("cartSearchResult").innerHTML = t;
    }

    r.open("POST", "cartSearchProcess.php", true);
    r.send(f);
}

function printInvoice() {
    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = body;
}

var m;
function addFeedback(id) {

    var feedbackModal = document.getElementById("feedbackModal" + id);
    m = new bootstrap.Modal(feedbackModal);
    m.show();

}

function saveFeedback(id) {
    var type;
    if (document.getElementById("type1").checked) {
        type = 1;
    } else if (document.getElementById("type2").checked) {
        type = 2;
    } else if (document.getElementById("type3").checked) {
        type = 3;
    }

    var feedback = document.getElementById("feed");

    var f = new FormData();
    f.append("t", type);
    f.append("p", id);
    f.append("f", feedback.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                m.hide();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);
}

function sendAdminMsg(email) {
    var txt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("txt", txt);
    f.append("email", email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "sendAdminMsgProcess.php", true);
    r.send(f);
}

function sendAdminMsg2(email) {

    var txt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("txt", txt);
    f.append("rmail", email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success2") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "SendMsgUserProcess.php", true);
    r.send(f);
}

var vm;
function viewDetails(id) {

    var viewModal = document.getElementById("viewDetailsModal" + id);
    vm = new bootstrap.Modal(viewModal);
    vm.show();

}

function searchInvoiceId() {
    var id = document.getElementById("searchTxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("viewArea").innerHTML = t;

        }
    }

    r.open("GET", "searchInvoiceIdProcess.php?id=" + id, true);
    r.send();
}

function findSelling() {

    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("viewArea").innerHTML = t;
        }
    }

    r.open("GET", "findSellingProcess.php?f=" + from + "&t=" + to, true);
    r.send();

}

var cs;
function contactSeller(email) {
    var modal = document.getElementById("contactSeller" + email);
    cs = new bootstrap.Modal(modal);
    cs.show();

}

function sendHelpTxt() {
    var txt = document.getElementById("text");
    var email = document.getElementById("email");

    var f = new FormData();
    f.append("txt", txt.value);
    f.append("email", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Your message has been sent successfully.");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "sendHelpTxt.php", true);
    r.send(f);
}

function msg() {
    alert("Sign In to use this feature.");
}

function searchWishlist() {
    var txt = document.getElementById("txt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("searchResults").innerHTML = t;
        }
    }


    r.open("GET", "searchWishlist.php?txt=" + txt, true);
    r.send();
}

var tv;
function deleteProductModal(id) {
    var l = document.getElementById("deleteProductModal" + id);
    tv = new bootstrap.Modal(l);
    tv.show();
}

function deleteProduct(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Product successfully deleted.");
                window.location.reload();
            }
        }
    }

    r.open("GET", "deleteProduct.php?id=" + id, true);
    r.send();
}

function changeInvoiceStatus(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == 1) {
                document.getElementById("btn" + id).innerHTML = "Packing";
                document.getElementById("btn" + id).classList = "btn btn-warning fw-bold mt-3";
            } else if (t == 2) {
                document.getElementById("btn" + id).innerHTML = "Dispatch";
                document.getElementById("btn" + id).classList = "btn btn-info fw-bold mt-3";
            } else if (t == 3) {
                document.getElementById("btn" + id).innerHTML = "Shipping";
                document.getElementById("btn" + id).classList = "btn btn-primary fw-bold mt-3";
            } else if (t == 4) {
                document.getElementById("btn" + id).innerHTML = "Delivered";
                document.getElementById("btn" + id).classList = "btn btn-danger fw-bold mt-3 disabled";
            }
        }
    }

    r.open("GET", "changeInvoiceStatusProcess.php?id=" + id, true);
    r.send();
}

function checkout() {
    var qty = document.getElementById("qty").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["mail"];
            var amount = obj["amount"];

            if (t == "1") {
                alert("Please log in or sign up");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please update your profile first");
                window.location = "userProfile.php";
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {

                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId, id, mail, amount, qty);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221812",    // Replace your Merchant ID
                    "return_url": "http://localhost/trewotech/singleProductView.php?id" + id,     // Important
                    "cancel_url": "http://localhost/trewotech/singleProductView.php?id" + id,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }

        }
    }

    r.open("GET", "checkoutProcess.php?qty=" + qty, true)
    r.send();
}

var modal;
function loadMsgModal(email) {
    var sellerm = document.getElementById("cusMsgModal" + email);
    modal = new bootstrap.Modal(sellerm);
    modal.show();
}

function sendCusMg(email) {

    var txt = document.getElementById("msgtxt");

    var f = new FormData();
    f.append("e", email);
    f.append("t", txt.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "sendCusMsgProcess.php", true);
    r.send(f);
}

var rm;
function openModal(id) {
    var jk = document.getElementById("openModal" + id);
    rm = new bootstrap.Modal(jk);
    rm.show();
}

function removeOrder(id){

    var r = new XMLHttpRequest();
    r.open("GET","removeOrder.php?id="+id, false);
    r.send();
    alert(r.responseText);

    window.location.reload();
}