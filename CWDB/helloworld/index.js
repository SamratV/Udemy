var express = require('express')
var app = express()

app.get('/', function (req, res) {
  res.send('Hello Samrat!')
})

app.listen(1234, function () {
  console.log('Example app listening on port 1234!')
})
