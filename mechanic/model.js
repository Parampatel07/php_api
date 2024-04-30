var connection = require('./connection').con;
function insertModel(request, response) {
     // ** URL:** `http://localhost:5000/insertModel`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "companyid": 1,
     //      "title": "Model S",
     //      "enginetype": "Electric"
     // }
     console.log(request.body);
     let { companyid, title, enginetype } = request.body;

     // Checking if all fields are provided
     if (companyid === undefined || title === undefined || enginetype === undefined) {
          response.json({ 'error': 'Invalid Input' });
     }
     else {
          let sql = `INSERT INTO model (companyid, title, enginetype) VALUES (${companyid}, '${title}', '${enginetype}')`;
          console.log(sql);
          let result = [];

          // Inserting the new model into the database
          connection.query(sql, function (error, values) {
               if (error) {
                    result.push({ 'error': error.message });
               }
               else {
                    result.push({ 'error': 'no' });
                    result.push({ 'success': 'yes' });
                    result.push({ 'message': 'Model Inserted Successfully' });
               }
               response.json(result);
          });
     }
};

function updateModel(request, response) {
     // ** URL:** `http://localhost:5000/updateModel`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "companyid": 1,
     //      "title": "Model S",
     //      "enginetype": "Electric",
     //      "islive": "0",
     //      "id": 1,
     // }
     let { companyid, title, enginetype, id, islive } = request.body;
     let sql = `UPDATE model SET companyid='${companyid}', title='${title}', enginetype='${enginetype}' , islive = ${islive} WHERE id='${id}'`;
     console.log(sql);
     connection.query(sql, function (error, result) {
          if (error)
               response.json([{ 'error': 'could not update model' }]);
          else {
               response.json([{ 'error': 'no' }, { 'success': 'yes' }, { 'message': 'model updated successfully' }]);
          }
     });
}

function deleteModel(request, response) {
     // ** URL:** `http://localhost:5000/deleteModel/:id`
     // ** Method:** `DELETE`
     var id = request.params.id;
     if (id === undefined) {
          response.json([{ 'error': "input is missing" }]);
     }
     else {
          var sql = `Update model set isdeleted = 1  WHERE id = ${id}`;
          connection.query(sql, function (error, result) {
               if (error) {
                    response.json([{ 'error': 'Something Went Wrong ' }]);
               }
               else {
                    let data = [];
                    data[0] = { 'error': "no" };
                    data[1] = { 'success': "yes" };
                    data[2] = { 'message': "Model deleted Successfully" };
                    response.json(data);
               }
          });
     }
}

function getModel(request, response) {
     let { modelid, companyid } = request.body;
     if (modelid != undefined) {
          // Fetch specific model
          var sql = `SELECT m.*, c.title as company_title FROM model m, company c WHERE m.id = ${modelid} AND m.companyid = c.id`;
     }
     else if (companyid != undefined) {
          // Fetch models with specific companyid
          var sql = `SELECT m.*, c.title as company_title FROM model m, company c WHERE m.companyid = ${companyid} AND m.companyid = c.id`;
     }
     else {
          // Fetch all models
          var sql = `SELECT m.*, c.title as company_title FROM model m, company c WHERE m.companyid = c.id`;
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
module.exports.insertModel = insertModel
module.exports.updateModel = updateModel;
module.exports.deleteModel = deleteModel;