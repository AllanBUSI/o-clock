const dotenv = require('dotenv');
dotenv.config();
const express = require('express');

const router = require('./app/router');

const app = express();

app.set('view engine', 'ejs');
app.set('views', './app/views');

const session = require('express-session')
app.use(express.static('./public'));

app.use(session({
  secret: process.env.SESSION_SECRET,
  resave: false,
  saveUninitialized: true,
  cookie: { }
}))

app.use(router);

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Listening at http://localhost:${PORT}`);
});
