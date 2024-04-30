var connection = require("./connection").con;
function insertService(request, response) {
     // ** URL:** `http://localhost:5000/insertService`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "categoryid": 1,
     //      "title": "iPhone Repair",
     //      "photo": "iphone_repair.jpg",
     //      "price": 100,
     //      "actualprice": 120,
     //      "serviceduraion": "30 minutes",
     //      "point1": "Point 1",
     //      "point2": "Point 2",
     //      "point3": "Point 3",
     //      "point4": "Point 4",
     //      "point5": "Point 5",
     //      "point6": "Point 6",
     //      "islive": true,
     //      "isdeleted": false
     // }
     console.log(request.file);
     let { categoryid, title, price, actualprice, serviceduraion, point1, point2, point3, point4, point5, point6, islive, isdeleted } = request.body;
     let photo = request.file.filename;

     let sql = `INSERT INTO service (categoryid, title, photo, price, actualprice, serviceduraion, point1, point2, point3, point4, point5, point6, islive, isdeleted) VALUES (${categoryid}, '${title}', '${photo}', ${price}, ${actualprice}, '${serviceduraion}', '${point1}', '${point2}', '${point3}', '${point4}', '${point5}', '${point6}', ${islive}, ${isdeleted})`;
     console.log(sql);
     let result = [];

     // Inserting the new service into the database
     connection.query(sql, function (error, values) {
          if (error) {
               result.push({ 'error': error.message });
          }
          else {
               result.push({ 'error': 'no' });
               result.push({ 'success': 'yes' });
               result.push({ 'message': 'Service Inserted Successfully' });
          }
          response.json(result);
     });
}

function updateService(request, response) {
     // ** URL:** `http://localhost:5000/updateService`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "categoryid": 1,
     //      "title": "iPhone Repair",
     //      "photo": "iphone_repair.jpg",
     //      "price": 100,
     //      "actualprice": 120,
     //      "serviceduraion": "30 minutes",
     //      "point1": "Point 1",
     //      "point2": "Point 2",
     //      "point3": "Point 3",
     //      "point4": "Point 4",
     //      "point5": "Point 5",
     //      "point6": "Point 6",
     //      "islive": true,
     //      "isdeleted": false,
     //      "id": 1
     // }
     console.log(request.file);
     let { categoryid, title, price, actualprice, serviceduraion, point1, point2, point3, point4, point5, point6, islive, isdeleted, id } = request.body;
     let photo = request.file.filename;

     let sql = `UPDATE service SET categoryid='${categoryid}', title='${title}', photo='${photo}', price='${price}', actualprice='${actualprice}', serviceduraion='${serviceduraion}', point1='${point1}', point2='${point2}', point3='${point3}', point4='${point4}', point5='${point5}', point6='${point6}', islive='${islive}', isdeleted='${isdeleted}' WHERE id='${id}'`;
     console.log(sql);
     connection.query(sql, function (error, result) {
          if (error)
               response.json([{ 'error': error.message }]);
          else
               response.json([{ 'error': 'no' }, { 'success': 'yes' }, { 'message': 'Service Updated Successfully' }]);
     });
}

function deleteService(request, response) {
     // ** URL:** `http://localhost:5000/deleteCart/:id`
     // ** Method:** `DELETE`
     var id = request.params.id;
     if (id === undefined) {
          response.json([{ 'error': "input is missing" }]);
     }
     else {
          var sql = `UPDATE service set isdeleted = 1  WHERE id = ${id}`;
          connection.query(sql, function (error, result) {
               if (error) {
                    response.json([{ 'error': 'Something Went Wrong ' }]);
               }
               else {
                    let data = [];
                    data[0] = { 'error': "no" };
                    data[1] = { 'success': "yes" };
                    data[2] = { 'message': "Service deleted Successfully" };
                    response.json(data);
               }
          });
     }
}

function getService(request, response) {
     let { serviceid, categoryid } = request.body;
     if (serviceid != undefined) {
          // Fetch specific service
          var sql = `SELECT s.*, c.name as category_name FROM service s, category c WHERE s.id = ${serviceid} AND s.categoryid = c.id`;
     }
     else if (categoryid != undefined) {
          // Fetch services with specific categoryid
          var sql = `SELECT s.*, c.name as category_name FROM service s, category c WHERE s.categoryid = ${categoryid} AND s.categoryid = c.id`;
     }
     else {
          // Fetch all services
          var sql = `SELECT s.*, c.name as category_name FROM service s, category c WHERE s.categoryid = c.id`;
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
module.exports.insertService = insertService;
module.exports.updateService = updateService;
module.exports.deleteService = deleteService;
module.exports.getService = getService;