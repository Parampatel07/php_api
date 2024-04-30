var connection = require('./connection').con;

function insertCart(request, response) {
     // ** URL:** `http://localhost:5000/insertCart`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "userid": 1,
     //      "serviceid": 1,
     //      "cityid": 1,
     //      "price": 100,
     //      "orderid": 1
     // }
     console.log(request.body);
     let { userid, serviceid, cityid, price, orderid } = request.body;

     // Checking if all fields are provided
     if (userid === undefined || serviceid === undefined || cityid === undefined || price === undefined || orderid === undefined) {
          response.json({ 'error': 'Invalid Input' });
     }
     else {
          let sql = `INSERT INTO cart (userid, serviceid, cityid, price, orderid) VALUES (${userid}, ${serviceid}, ${cityid}, ${price}, ${orderid})`;
          console.log(sql);
          let result = [];

          // Inserting the new cart into the database
          connection.query(sql, function (error, values) {
               if (error) {
                    result.push({ 'error': error.message });
               }
               else {
                    result.push({ 'error': 'no' });
                    result.push({ 'success': 'yes' });
                    result.push({ 'message': 'Cart Inserted Successfully' });
               }
               response.json(result);
          });
     }
};

function updateCart(request, response) {
     // ** URL:** `http://localhost:5000/updateCart`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "userid": 1,
     //      "serviceid": 1,
     //      "cityid": 1,
     //      "price": 100,
     //      "orderid": 1,
     //      "id": 1
     // }
     let { userid, serviceid, cityid, price, orderid, id } = request.body;
     let sql = `UPDATE cart SET userid='${userid}', serviceid='${serviceid}', cityid='${cityid}', price='${price}', orderid='${orderid}' WHERE id='${id}'`;
     console.log(sql);
     connection.query(sql, function (error, result) {
          if (error)
               response.json([{ 'error': 'could not update cart' }]);
          else {
               response.json([{ 'error': 'no' }, { 'success': 'yes' }, { 'message': 'cart updated successfully' }]);
          }
     });
}

function deleteCart(request, response) {
     // ** URL:** `http://localhost:5000/deleteCart/:id`
     // ** Method:** `DELETE`
     var id = request.params.id;
     if (id === undefined) {
          response.json([{ 'error': "input is missing" }]);
     }
     else {
          var sql = `DELETE FROM cart WHERE id = ${id}`;
          connection.query(sql, function (error, result) {
               if (error) {
                    response.json([{ 'error': 'Something Went Wrong ' }]);
               }
               else {
                    let data = [];
                    data[0] = { 'error': "no" };
                    data[1] = { 'success': "yes" };
                    data[2] = { 'message': "Cart deleted Successfully" };
                    response.json(data);
               }
          });
     }
}

function getCart(request, response) {
     // # getCart API

     // **URL:** `http://localhost:5000/getCart`

     // **Method:** `POST`

     // **Body Parameters:**

     // - `userid`: User ID (optional)
     // - `serviceid`: Service ID (optional)
     // - `cityid`: City ID (optional)
     // - `orderid`: Order ID (optional)
     // - `cartid`: Cart ID (optional)
     console.log(request.body);
     let { userid, serviceid, cityid, orderid, cartid } = request.body;
     if (userid != undefined) {
          var sql = `SELECT c.* , cus.fullname as customer_name , s.title as service_name , citys.name as city_name from cart c , customer cus , service s , city citys where c.userid = ${userid} and c.userid = cus.id and s.id = c.serviceid and c.cityid = citys.id  `;
     }
     else if (serviceid != undefined) {
          var sql = `SELECT c.* , cus.fullname as customer_name , s.title as service_name , citys.name as city_name from cart c , customer cus , service s , city citys where c.serviceid = ${serviceid} and c.userid = cus.id and s.id = c.serviceid and c.cityid = citys.id `;
     }
     else if (cityid != undefined) {
          var sql = `SELECT c.* , cus.fullname as customer_name , s.title as service_name , citys.name as city_name from cart c , customer cus , service s , city citys where c.cityid = ${cityid} and c.userid = cus.id and s.id = c.serviceid and c.cityid = citys.id `;
     }
     else if (orderid != undefined) {
          var sql = `SELECT c.* , cus.fullname as customer_name , s.title as service_name , citys.name as city_name from cart c , customer cus , service s , city citys where c.orderid = ${orderid} and c.userid = cus.id and s.id = c.serviceid and c.cityid = citys.id `;
     }
     else if (cartid != undefined) {
          var sql = `SELECT c.* , cus.fullname as customer_name , s.title as service_name , citys.name as city_name from cart c , customer cus , service s , city citys where c.id = ${cartid} and c.userid = cus.id and s.id = c.serviceid and c.cityid = citys.id `;
     }
     connection.query(sql, function (error, result) {
          if (error != null) {
               console.log(error)
               response.json([{ 'error': "Something went wrong " }]);
          }
          else {
               result.unshift({ error: 'no' }, { total: result.length })
               response.send(JSON.parse(JSON.stringify(result)));
          }
     });
}

module.exports.insertCart = insertCart;
module.exports.updateCart = updateCart;
module.exports.deleteCart = deleteCart;
module.exports.getCart = getCart;