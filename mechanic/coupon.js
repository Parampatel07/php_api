var connection = require('./connection').con;
function insertCoupon(request, response) {
     // ** URL:** `http://localhost:5000/insertCoupon`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "title": "SUMMER20",
     //      "code": "SUM20",
     //      "percentage": 20
     // }
     console.log(request.body);
     let { title, code, percentage } = request.body;

     // Checking if all fields are provided
     if (title === undefined || code === undefined || percentage === undefined) {
          response.json({ 'error': 'Invalid Input' });
     }
     else {
          let sql = `INSERT INTO coupon (title, code, percentage) VALUES ('${title}', '${code}', ${percentage})`;
          console.log(sql);
          let result = [];

          // Inserting the new coupon into the database
          connection.query(sql, function (error, values) {
               if (error) {
                    result.push({ 'error': error.message });
               }
               else {
                    result.push({ 'error': 'no' });
                    result.push({ 'success': 'yes' });
                    result.push({ 'message': 'Coupon Inserted Successfully' });
               }
               response.json(result);
          });
     }
};

function updateCoupon(request, response) {
     // ** URL:** `http://localhost:5000/updateCoupon`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "title": "SUMMER20",
     //      "code": "SUM20",
     //      "percentage": 20,
     //      "id": 1
     // }
     let { title, code, percentage, id } = request.body;
     let sql = `UPDATE coupon SET title='${title}', code='${code}', percentage='${percentage}' WHERE id='${id}'`;
     console.log(sql);
     connection.query(sql, function (error, result) {
          if (error)
               response.json([{ 'error': 'could not update coupon' }]);
          else {
               response.json([{ 'error': 'no' }, { 'success': 'yes' }, { 'message': 'coupon updated successfully' }]);
          }
     });
}

function deleteCoupon(request, response) {
     // ** URL:** `http://localhost:5000/deleteCart/:id`
     // ** Method:** `DELETE`
     var id = request.params.id;
     if (id === undefined) {
          response.json([{ 'error': "input is missing" }]);
     }
     else {
          var sql = `DELETE FROM coupon WHERE id = ${id}`;
          connection.query(sql, function (error, result) {
               if (error) {
                    response.json([{ 'error': 'Something Went Wrong ' }]);
               }
               else {
                    let data = [];
                    data[0] = { 'error': "no" };
                    data[1] = { 'success': "yes" };
                    data[2] = { 'message': "Coupon deleted Successfully" };
                    response.json(data);
               }
          });
     }
}

function getCoupon(request, response) {
     let { couponid } = request.body;
     if (couponid != undefined) {
          var sql = `SELECT * FROM coupon WHERE id = ${couponid}`;
     }
     else {
          var sql = `SELECT * FROM coupon`;
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

module.exports.insertCoupon = insertCoupon;
module.exports.updateCoupon = updateCoupon;
module.exports.deleteCoupon = deleteCoupon;
module.exports.getCoupon = getCoupon;