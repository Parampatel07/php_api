var express = require("express");
const multer = require("multer");
const path = require("path");
var cors = require("cors"); // Add this line
var app = express();
var connection = require('./connection').con;
var adminAuth = require("./admin_auth");
var userAuth = require("./user_auth");
var city = require('./city');
var coupon = require('./coupon');
var order = require('./order');
var model = require('./model');
var category = require('./category');
var service = require('./service');
var company = require('./company');
var cart = require("./cart");
app.use('/images', express.static(path.join(__dirname, 'images/')));
app.use(cors({
     origin: 'http://localhost:5000',
     // Update with your React.js app's origin
     optionsSuccessStatus: 200,
}));
app.use(express.json());
app.use(express.urlencoded({ extended: false })); // Move this line after initializing app
var storage = multer.diskStorage({
     destination: function (req, file, cb) {
          cb(null, "images");
     },
     filename: function (req, file, cb) {
          cb(null, file.fieldname + "-" + Date.now() + ".jpg");
     },
});
const maxSize = 3 * 1000 * 1000;
var upload = multer({
     storage: storage,
     limits: { fileSize: maxSize },
     fileFilter: function (req, file, cb) {
          var filetypes = /jpeg|jpg|png/;
          var mimetype = filetypes.test(file.mimetype);
          var extname = filetypes.test(path.extname(file.originalname).toLowerCase());

          if (mimetype && extname) {
               return cb(null, true);
          }

          cb("Error: File upload only supports the " + "following filetypes - " + filetypes);
     },
});
// app.get("/Staff", (request, response) => staff.getCategories(request, response));
// app.get("/staff/:id", (request, response) => staff.getCategory(request, response));
// app.delete("/Staff", (request, response) => staff.deleteCategory(request, response));
// app.post("/Staff", upload.single("photo"), (request, response) => staff.insertCategory(request, response));
// app.put("/Staff", upload.single("photo"), (request, response) => staff.updateCategory(request, response));


// =============================================admin ================================================
app.post('/adminLogin', (request, response) => adminAuth.adminLogin(request, response));
app.post('/adminChangePassword', (request, response) => adminAuth.adminChangePassowrd(request, response));
// =============================================admin ================================================


// =============================================Customer  ================================================

app.post("/userRegister", (request, response) => userAuth.userRegister(request, response));
app.post("/userLogin", (request, response) => userAuth.userLogin(request, response));
app.post("/userChangePassword", (request, response) => userAuth.userChangePassword(request, response));
app.post("/getUser", (request, response) => userAuth.getUser(request, response));
// =============================================Customer  ================================================


// =============================================Cart  ================================================
app.post("/insertCart", (request, response) => cart.insertCart(request, response));
app.put("/updateCart", (request, response) => cart.updateCart(request, response));
app.delete("/deleteCart/:id", (request, response) => cart.deleteCart(request, response));
app.post('/getCart', (request, response) => cart.getCart(request, response));
// =============================================Cart  ================================================

// =============================================City  ================================================
app.post("/insertCity", (request, response) => city.insertCity(request, response));
app.put("/updateCity", (request, response) => city.updateCity(request, response));
app.delete("/deleteCity/:id", (request, response) => city.deleteCity(request, response));
app.post("/getCity", (request, response) => city.getCity(request, response));
// =============================================City  ================================================


// =============================================Coupon  ================================================
app.post("/insertCoupon", (request, response) => coupon.insertCoupon(request, response));
app.put("/updateCoupon", (request, response) => coupon.updateCoupon(request, response));
app.delete("/deleteCoupon/:id", (request, response) => coupon.deleteCoupon(request, response));
app.post("/getCoupon", (request, response) => city.getCoupon(request, response));
// =============================================Coupon  ================================================


// =============================================Model  ================================================
app.post("/insertModel", (request, response) => model.insertModel(request, response));
app.put("/updateModel", (request, response) => model.updateModel(request, response));
app.delete("/deleteModal/:id", (request, response) => model.deleteModal(request, response));
app.post("/getModal", (request, response) => model.getModel(request, response));
// =============================================Model  ================================================


// =============================================Order  ================================================
app.post("/insertOrder", (request, response) => order.insertOrder(request, response));
app.put("/updateOrder", (request, response) => order.updateOrder(request, response));
app.delete("/deleteOrder/:id", (request, response) => order.deleteOrder(request, response));
app.post("/getOrder", (request, response) => order.getOrder(request, response));
// =============================================Order  ================================================


// =============================================Category  ================================================
app.post("/insertCategory", upload.single("photo"), (request, response) => category.insertCategory(request, response));
app.put("/updateCategory", upload.single("photo"), (request, response) => category.updateCategory(request, response));
app.delete("/deleteCategory/:id", (request, response) => category.deleteCategory(request, response));
app.post('/getCategory', (request, response) => category.getCategory(request, response));
// =============================================Category  ================================================


// =============================================Company  ================================================
app.post("/insertCompany", upload.single("photo"), (request, response) => company.insertCompany(request, response));
app.put("/updateCompany", upload.single("photo"), (request, response) => company.updateCompany(request, response));
app.delete("/deleteCompany/:id", (request, response) => company.deleteCompany(request, response));
app.post("/getCompany", (request, response) => company.getCompany(request, response));
// =============================================Company  ================================================

// =============================================Service  ================================================
app.post("/insertService", upload.single("photo"), (request, response) => service.insertService(request, response));
app.put("/updateService", upload.single("photo"), (request, response) => service.updateService(request, response));
app.delete("/deleteService/:id", (request, response) => service.deleteService(request, response));
app.post('/getService', (request, response) => service.getService(request, response));
// =============================================Service  ================================================

app.listen(5000);
console.log("server ready ");