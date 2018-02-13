FB = module.exports = require('fb');
var express = require('express');
var request = require('request');
var job = require('node-schedule');
var app = express();
var CronJob = require('cron').CronJob;
var fs = require('fs');
var mysql = require('mysql');
const mongod = require('mongodb').ObjectID;
var bodyParser = require('body-parser');

var db = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database : 'social_share'
});

db.connect();

app.use(bodyParser.urlencoded({ extended: false }));
// parse application/json
app.use(bodyParser.json());

var httpsOptions = {key: fs.readFileSync('certificates/certificate.key'), cert: fs.readFileSync('certificates/certificate.crt')};
var secureServer = require('https').createServer(httpsOptions, app);

app.listen(3000, function(){
	console.log("listen at 3000");
});

app.get('/p', (req, res)=>{
    res.send(200);
})

function jobs(date, arr){
  console.log("fire ::::::",date);
	var j = job.scheduleJob(date, function(y){
    
    var data = {
      title: arr.name,
      description: arr.description,
      imageurl: arr.imageurl,
      videourl: arr.videourl,
      keyword: arr.keyword,
      hashtag: arr.hashtag
    };
    
    if(typeof arr.campaignID != 'undefined'){
      console.log("fire ::::::");
      request.post({  url: 'http://localhost/SocialPoster/fire.php',
                        form: {action: 'nxs_snap_aj', nxsact: 'tst',nt: 'FB', nid: 0, message: data, id: arr.campaignID}}, function (error, response, body) {
          console.log('error:', error); // Print the error if one occurred
          console.log('statusCode:', response && response.statusCode); // Print the response status code if a response was received
          console.log('body: typeof ', typeof body);
          // body = JSON.parse(body);
          console.log('body:', body); // Print the HTML for the Google homepage.
        });
      j.cancel();

    }else{
      console.log("not fire ::::::",typeof arr.campaignID);
    }

	}.bind(null,j));
}

app.get('/saveMessage', (req, res)=>{
    res.setHeader("Access-Control-Allow-Origin", "*");
    res.send(200);
    console.log(":comes");
    req.query.id = mongod();
    var d = new Date(req.query.datetime);
    var timeStamp = d.getTime();
    var query = db.query('INSERT INTO messages SET ?', req.query, function (error, results, fields) {
      if (error) throw error;
      // Neat!
    });
    console.log("timestamp :::::: ", timeStamp);
    var date = new Date(parseInt(timeStamp));
    // console.log("data :::::: ", date);
    // console.log("current datw :::::: ", new Date());
    jobs(date, req.query);
    // console.log(query.sql);
})

app.get('/saveCampaign', (req, res)=>{
    res.setHeader("Access-Control-Allow-Origin", "*");
    req.query.id = mongod();
    var query = db.query('INSERT INTO campaigns SET ?', req.query, function (error, results, fields) {
      if (error) throw error;
      // Neat!
    });

    request.post({  url: 'http://localhost/SocialPoster/copy.php',
                    form: {id: req.query.id.toString()}}, function (error, response, body) {
      console.log('error:', error); // Print the error if one occurred
      console.log('statusCode:', response && response.statusCode); // Print the response status code if a response was received
      console.log('body:', body); // Print the HTML for the Google homepage.
    });

    res.send(200);
})

app.post('/deleteCampaign', (req, res)=>{
    res.setHeader("Access-Control-Allow-Origin", "*");
    var id = req.body.id; 
    console.log("req.body :::: ", req.body);
    if(req.body.id){

        var query = db.query('DELETE FROM campaigns WHERE id="'+id+'"', function (error, results, fields) {
          if (error) throw error;
          // Neat!
        });

        var query = db.query('DELETE FROM messages WHERE campaignID="'+id+'"', function (error, results, fields) {
          if (error){
            console.log("error ::::::::: ", error);
            console.log("results ::::::::: ", results);
          }
          // Neat!
        });

        request.post({  url: 'http://localhost/SocialPoster/delete.php',
                        form: {id: id.toString()}}, function (error, response, body) {
          console.log('error:', error); // Print the error if one occurred
          console.log('statusCode:', response && response.statusCode); // Print the response status code if a response was received
          console.log('body:', body); // Print the HTML for the Google homepage.
        });
    }
    res.send(200);
})






