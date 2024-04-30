var connection = require('./connection').con;
function insertCategory(request, response) {
     let result = [];
     let { name } = request.body;
     let photo = request.file.filename;
     if (name === undefined || photo === undefined) {
          result.push({ 'error': 'Invalid Input ' });
          response.json(result);
     }
     else {
          let sql = `INSERT INTO category (name ,photo) VALUES ('${name}','${photo}')`;
          connection.query(sql, function (error, data) {
               if (error) {
                    result.push({ 'error': 'Oops something went wrong ' });
               }
               else {
                    result.push({ 'error': 'no' });
                    result.push({ 'success': 'yes' });
                    result.push({ 'message': 'Category added successfully ' });
                    response.json(result);
               }
          })
     }
}

function updateCategory(request, response) {
     // ** URL:** `http://localhost:5000/updateCategory`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "name": "Electronics",
     //      "photo": "electronics.jpg",
     //      "id": 1
     // }
     console.log(request.file);
     let { name, id } = request.body;
     let photo = request.file.filename;

     let sql = `UPDATE category SET name='${name}', photo='${photo}' WHERE id='${id}'`;
     console.log(sql);
     connection.query(sql, function (error, result) {
          if (error)
               response.json([{ 'error': error.message }]);
          else
               response.json([{ 'error': 'no' }, { 'success': 'yes' }, { 'message': 'Category Updated Successfully' }]);
     });
}

function deleteCategory(request, response) {
     // ** URL:** `http://localhost:5000/deleteCategory/:id`
     // ** Method:** `DELETE`
     var id = request.params.id;
     if (id === undefined) {
          response.json([{ 'error': "input is missing" }]);
     }
     else {
          var sql = `DELETE FROM category WHERE id = ${id}`;
          connection.query(sql, function (error, result) {
               if (error) {
                    response.json([{ 'error': 'Something Went Wrong ' }]);
               }
               else {
                    let data = [];
                    data[0] = { 'error': "no" };
                    data[1] = { 'success': "yes" };
                    data[2] = { 'message': "Category deleted Successfully" };
                    response.json(data);
               }
          });
     }
}

function getCategory(request, response) {
     let { categoryid } = request.body;
     if (categoryid != undefined) {
          // Fetch specific category
          var sql = `SELECT * FROM category WHERE id = ${categoryid}`;
     }
     else {
          // Fetch all categories
          var sql = `SELECT * FROM category`;
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

module.exports.insertCategory = insertCategory;
module.exports.updateCategory = updateCategory;
module.exports.deleteCategory = deleteCategory;
module.exports.getCategory = getCategory;