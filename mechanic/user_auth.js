var connection = require('./connection').con;

function userRegister(request, response) {
     // **URL:** `http://localhost:5000/registerUser`
     // **Method:** `POST`
     // **Headers:** `Content-Type: application/json`
     // **Body:**
     // ```json
     // {
     //   "email": "user@example.com",
     //   "password": "user123",
     //   "fullname": "John Doe"
     // }
     // ```
     console.log(request.body);
     let { email, mobile, password, fullname, gender, orderid } = request.body;
     // Checking if all fields are provided
     if (email === undefined || mobile === undefined || password === undefined || fullname === undefined || gender === undefined || orderid === undefined) {
          response.json({ 'error': 'Invalid Input' });
     }
     else {
          let sql = `INSERT INTO customer (email, mobile, password, fullname, gender, orderid) VALUES ('${email}', '${mobile}', '${password}', '${fullname}', ${gender}, ${orderid})`;
          console.log(sql);
          let result = [];

          // Inserting the new user into the database
          connection.query(sql, function (error, values) {
               if (error) {
                    result.push({ 'error': error.message });
               }
               else {
                    result.push({ 'error': 'no' });
                    result.push({ 'success': 'yes' });
                    result.push({ 'message': 'User Registered Successfully' });
               }
               response.json(result);
          });
     }
};

// Login API for the user
function userLogin(request, response) {
     // ** URL:** `http://localhost:5000/userLogin`
     // ** Method:** `POST`
     // ** Headers:** `Content-Type: application/json`
     // ** Body:**
     // json
     // {
     //      "email": "user@example.com",
     //           "password": "user123"
     // }
     console.log(request.body);
     let { email, password } = request.body;

     // Checking if email and password are provided
     if (email === undefined || password === undefined) {
          response.json({ 'error': 'Invalid Input' });
     }
     else {
          let sql = `SELECT * FROM customer WHERE email = '${email}' AND password = '${password}'`;
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
                         result.push({ 'userid': values[0]['id'] });
                         result.push({ 'message': 'Login Successfully' });
                    }
               }
               response.json(result);
          });
     }
}

// Change password API for the user
function userChangePassword(request, response) {
     //      **URL:** `http://localhost:5000/userChangePassword`
     // **Method:** `POST`
     // **Headers:** `Content-Type: application/json`
     // **Body:**
     // ```json
     // {
     //   "email": "user@example.com",
     //   "oldPassword": "user456",
     //   "newPassword": "user457"
     // }
     console.log(request.body);
     let { email, oldPassword, newPassword } = request.body;

     // Checking if email, old password and new password are provided
     if (email === undefined || oldPassword === undefined || newPassword === undefined) {
          response.json({ 'error': 'Invalid Input' });
     }
     else {
          let sql = `SELECT * FROM customer WHERE email = '${email}' AND password = '${oldPassword}'`;
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
                         let updateSql = `UPDATE customer SET password = '${newPassword}' WHERE email = '${email}'`;
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

function getUser(request, response) {
     let { customerid } = request.body;
     if (customerid != undefined) {
          var sql = `SELECT * FROM customer WHERE id = ${customerid}`;
     }
     else {
          var sql = `SELECT * FROM customer`;
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

module.exports.userRegister = userRegister;
module.exports.userChangePassword = userChangePassword;
module.exports.userLogin = userLogin;
module.exports.getUser = getUser;