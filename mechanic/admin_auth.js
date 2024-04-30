var connection = require('./connection').con;
function adminLogin(request, response) {
     // ** URL:** `http://localhost:5000/adminLogin`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "email": "admin@example.com",
     //           "password": "admin123"
     // }
     console.log(request.body);
     let { email, password } = request.body;

     // Checking if email and password are provided
     if (email === undefined || password === undefined) {
          response.json({ 'error': 'Invalid Input' });
     }
     else {
          let sql = `SELECT * FROM administrator WHERE email = '${email}' AND password = '${password}'`;
          console.log(sql);
          let result = [];

          // Querying the database
          connection.query(sql, function (error, values) {
               if (error) {
                    result.push({ 'error': error.message });
               }
               else {
                    result.push({ 'error': 'no' });

                    // Checking if any user exists with the provided email and password
                    if (values.length <= 0) {
                         result.push({ 'success': 'no' });
                         result.push({ 'message': 'Invalid Login Attempt' });
                    }
                    else {
                         result.push({ 'success': 'yes' });
                         result.push({ 'adminid': values[0]['id'] });
                         result.push({ 'message': 'Login Successfully' });
                    }
               }
               response.json(result);
          });
     }
}

function adminChangePassowrd(request, response) {
     //      **URL:** `http://localhost:5000/changePassword`
     // **Method:** `POST`
     // **Headers:** `Content-Type: application/json`
     // **Body:**
     // ```json
     // {
     //   "email": "admin@example.com",
     //   "oldPassword": "admin123",
     //   "newPassword": "admin456"
     // }
     console.log(request.body);
     let { email, oldPassword, newPassword } = request.body;

     // Checking if email, old password and new password are provided
     if (email === undefined || oldPassword === undefined || newPassword === undefined) {
          response.json({ 'error': 'Invalid Input' });
     }
     else {
          let sql = `SELECT * FROM administrator WHERE email = '${email}' AND password = '${oldPassword}'`;
          console.log(sql);
          let result = [];

          // Querying the database
          connection.query(sql, function (error, values) {
               if (error) {
                    result.push({ 'error': error.message });
                    response.json(result);
               }
               else {
                    result.push({ 'error': 'no' });
                    // Checking if any user exists with the provided email and old password
                    if (values.length <= 0) {
                         result.push({ 'success': 'no' });
                         result.push({ 'message': 'Invalid Email or Old Password' });
                         response.json(result);
                    }
                    else {
                         // If user exists, update the password
                         let updateSql = `UPDATE administrator SET password = '${newPassword}' WHERE email = '${email}'`;
                         connection.query(updateSql, function (updateError, updateValues) {
                              if (updateError) {
                                   result.push({ 'error': updateError.message });
                                   response.json(result);
                              }
                              else {
                                   result.push({ 'success': 'yes' });
                                   result.push({ 'message': 'Password Changed Successfully' });
                                   console.log(result);
                                   response.json(result);
                              }
                         });
                    }
               }
          });
     }
}

module.exports.adminLogin = adminLogin;
module.exports.adminChangePassowrd = adminChangePassowrd;