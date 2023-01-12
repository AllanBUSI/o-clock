const dotenv = require('dotenv');
const express = require('express');
dotenv.config();

const router = require('./app/router');
const mainController = require ('./app/controllers/mainController');


// ETAPE 3-on importe le middleware de session
const sessionMiddleware = require('express-session');

const app = express();

app.set('view engine', 'ejs');
app.set('views', 'app/views');

app.use(express.static('public'));

// ETAPE 3: on branche le middleware de session
app.use(sessionMiddleware({
  secret: 'shqhshjsqh suiuui siofioq',
  resave: false,
  saveUninitialized: true,
  cookie: { secure: false }
}));

app.use(router);
app.use(mainController.cardPage);
app.use(mainController.notFound);

const PORT = process.env.PORT || 1234;
app.listen(PORT, () => {
  console.log(`Listening at http://localhost:${PORT}`);
});
