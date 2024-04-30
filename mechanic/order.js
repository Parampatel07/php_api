var connection = require('./connection').con;
function insertOrder(request, response) {
     // ** URL:** `http://localhost:5000/insertOrder`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "address": "123 Street, Sydney",
     //      "paymentstatus": "Paid",
     //      "transactioncode": "ABC123",
     //      "utrno": "XYZ456"
     // }
     console.log(request.body);
     let { address, paymentstatus, transactioncode, utrno } = request.body;

     // Checking if all fields are provided
     if (address === undefined || paymentstatus === undefined || transactioncode === undefined || utrno === undefined) {
          response.json({ 'error': 'Invalid Input' });
     }
     else {
          let sql = `INSERT INTO corder (address, paymentstatus, transactioncode, utrno) VALUES ('${address}', '${paymentstatus}', '${transactioncode}', '${utrno}')`;
          console.log(sql);
          let result = [];

          // Inserting the new order into the database
          connection.query(sql, function (error, values) {
               if (error) {
                    result.push({ 'error': error.message });
               }
               else {
                    result.push({ 'error': 'no' });
                    result.push({ 'success': 'yes' });
                    result.push({ 'message': 'Order Inserted Successfully' });
               }
               response.json(result);
          });
     }
};

function updateOrder(request, response) {
     // ** URL:** `http://localhost:5000/updateOrder`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "address": "123 Main St",
     //      "paymentstatus": "Paid",
     //      "transactioncode": "ABC123",
     //      "utrno": "XYZ456",
     //      "id": 1
     // }
     let { address, paymentstatus, transactioncode, utrno, id } = request.body;
     let sql = `UPDATE corder SET address='${address}', paymentstatus='${paymentstatus}', transactioncode='${transactioncode}', utrno='${utrno}' WHERE id='${id}'`;
     console.log(sql);
     connection.query(sql, function (error, result) {
          if (error)
               response.json([{ 'error': error.message }]);
          else {
               response.json([{ 'error': 'no' }, { 'success': 'yes' }, { 'message': 'order updated successfully' }]);
          }
     });
}

function deleteOrder(request, response) {
     // ** URL:** `http://localhost:5000/deleteOrder/:id`
     // ** Method:** `DELETE`
     var id = request.params.id;
     if (id === undefined) {
          response.json([{ 'error': "input is missing" }]);
     }
     else {
          var sql = `DELETE FROM order WHERE id = ${id}`;
          connection.query(sql, function (error, result) {
               if (error) {
                    response.json([{ 'error': 'Something Went Wrong ' }]);
               }
               else {
                    let data = [];
                    data[0] = { 'error': "no" };
                    data[1] = { 'success': "yes" };
                    data[2] = { 'message': "Order deleted Successfully" };
                    response.json(data);
               }
          });
     }
}

function getOrder(request, response) {
     let { orderid } = request.body;
     if (orderid != undefined) {
          var sql = `SELECT * FROM order WHERE id = ${orderid}`;
     }
     else {
          var sql = `SELECT * FROM order`;
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
module.exports.getOrder = getOrder;
module.exports.insertOrder = insertOrder
module.exports.updateOrder = updateOrder;
module.exports.OrdeleteOrder = deleteOrder;