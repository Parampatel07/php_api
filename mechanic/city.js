var connection = require('./connection').con;

function insertCity(request, response) {
     // ** URL:** `http://localhost:5000/insertCity`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "name": "Sydney",
     //      "pincode": "2000"
     // }
     console.log(request.body);
     let { name, pincode } = request.body;

     // Checking if all fields are provided
     if (name === undefined || pincode === undefined) {
          response.json({ 'error': 'Invalid Input' });
     }
     else {
          let sql = `INSERT INTO city (name, pincode) VALUES ('${name}', '${pincode}')`;
          console.log(sql);
          let result = [];

          // Inserting the new city into the database
          connection.query(sql, function (error, values) {
               if (error) {
                    result.push({ 'error': error.message });
               }
               else {
                    result.push({ 'error': 'no' });
                    result.push({ 'success': 'yes' });
                    result.push({ 'message': 'City Inserted Successfully' });
               }
               response.json(result);
          });
     }
};

function updateCity(request, response) {
     // ** URL:** `http://localhost:5000/updateCity`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "name": "Sydney",
     //      "pincode": "2000",
     //      "id": 1
     // }
     let { name, pincode, id } = request.body;
     let sql = `UPDATE city SET name='${name}', pincode='${pincode}' WHERE id='${id}'`;
     console.log(sql);
     connection.query(sql, function (error, result) {
          if (error)
               response.json([{ 'error': 'could not update city' }]);
          else {
               response.json([{ 'error': 'no' }, { 'success': 'yes' }, { 'message': 'city updated successfully' }]);
          }
     });

}

function deleteCity(request, response) {
     // ** URL:** `http://localhost:5000/deleteCity/:id`
     // ** Method:** `DELETE`
     var id = request.params.id;
     if (id === undefined) {
          response.json([{ 'error': "input is missing" }]);
     }
     else {
          var sql = `DELETE FROM city WHERE id = ${id}`;
          connection.query(sql, function (error, result) {
               if (error) {
                    response.json([{ 'error': 'Something Went Wrong ' }]);
               }
               else {
                    let data = [];
                    data[0] = { 'error': "no" };
                    data[1] = { 'success': "yes" };
                    data[2] = { 'message': "City deleted Successfully" };
                    response.json(data);
               }
          });
     }
}

function getCity(request, response) {
     let { cityid } = request.body;
     if (cityid != undefined) {
          var sql = `SELECT * FROM city WHERE id = ${cityid}`;
     }
     else {
          var sql = `SELECT * FROM city`;
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

module.exports.insertCity = insertCity;
module.exports.updateCity = updateCity;
module.exports.deleteCity = deleteCity;
module.exports.getCity = getCity;