const express = require('express');
const session = require('express-session');
const router = express.Router();

const mainController = require('./controllers/mainController');
const searchController = require('./controllers/searchController');


router.get('/', mainController.homePage);
router.get('/search', searchController.searchPage);


// ETAPE-1 page qui affiche les détails d'une carte
// on prévoit un paramètre que l'on nomme id dans le path de la route
router.get('/card/:id', mainController.cardPage);

//ETAPE-2 route par element
router.get('/search/element', searchController.searchElement);


module.exports = router;