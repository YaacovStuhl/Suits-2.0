
const express = require('express');

const server = express();

server.set('view engine', 'ejs');

server.get('/',(req,res) => { res.render('suits');});

server.listen(4242, () => {console.log('we are up and running');});

server.use(express.static( "pics" ));