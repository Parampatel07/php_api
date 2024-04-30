var connection = require('./connection').con;

function insertCompany(request, response) {
     let result = [];
     let { title } = request.body;
     let photo = request.file.filename;
     if (title === undefined) {
          result.push({ 'error': 'Invalid Input ' });
          response.json(result);
     }
     else {
          let sql = `INSERT into company (title,logo) VALUES ('${title}','${photo}')`;
          connection.query(sql, function (error, data) {
               if (error) {
                    result.push({ 'error': 'Oops something went wrong ' });
               }
               else {
                    result.push({ 'error': 'no' });
                    result.push({ 'success': 'yes' });
                    result.push({ 'message': 'Company added successfully ' });
                    response.json(result);
               }
          })
     }
}

function updateCompany(request, response) {
     // ** URL:** `http://localhost:5000/updateCompany`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "title": "Apple Inc.",
     //      "logo": "apple_logo.jpg",
     //      "id": 1
     // }
     console.log(request.file);
     let { title, id } = request.body;
     let logo = request.file.filename;

     let sql = `UPDATE company SET title='${title}', logo='${logo}' WHERE id='${id}'`;
     console.log(sql);
     connection.query(sql, function (error, result) {
          if (error)
               response.json([{ 'error': error.message }]);
          else
               response.json([{ 'error': 'no' }, { 'success': 'yes' }, { 'message': 'Company Updated Successfully' }]);
     });
}

function deleteCompany(request, response) {
     // ** URL:** `http://localhost:5000/deleteCompany/:id`
     // ** Method:** `DELETE`
     var id = request.params.id;
     if (id === undefined) {
          response.json([{ 'error': "input is missing" }]);
     }
     else {
          var sql = `DELETE FROM company WHERE id = ${id}`;
          connection.query(sql, function (error, result) {
               if (error) {
                    response.json([{ 'error': 'Something Went Wrong ' }]);
               }
               else {
                    let data = [];
                    data[0] = { 'error': "no" };
                    data[1] = { 'success': "yes" };
                    data[2] = { 'message': "Company deleted Successfully" };
                    response.json(data);
               }
          });
     }
}

function getCompany(request, response) {
     let { companyid } = request.body;
     if (companyid != undefined) {
          var sql = `SELECT * FROM company WHERE id = ${companyid}`;
     }
     else {
          var sql = `SELECT * FROM company`;
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


module.exports.deleteCompany = deleteCompany;
module.exports.insertCompany = insertCompany;
module.exports.updateCompany = updateCompany;
module.exports.getCompany = getCompany;