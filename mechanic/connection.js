var mysql = require("mysql");
var conObject = {
     host: "localhost",
     port: 3306,
     user: "root",
     password: "",
     database: "mechanic"
}
var con = mysql.createConnection(conObject);
con.connect(
     function (error) {
          if (error) {
               console.log("error in making connection")
          }
          else
               console.log("connection established successfully")
     }
);
module.exports.con = con;