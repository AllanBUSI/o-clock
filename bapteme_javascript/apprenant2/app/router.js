const express = require('express');
const router = express.Router();

const mainController = require('./controllers/mainController');
const searchController = require('./controllers/searchController');
const cardsController = require('./controllers/cardsController');
const deckController = require('./controllers/deckController');



router.get('/', mainController.homePage);
router.get('/search', searchController.searchPage);
router.get('/searchResults', searchController.getSearchResults);
router.get('/card/:id' , cardsController.item);
router.get("/deck" , deckController.deckPage);
router.get("/deck/add/:id" , deckController.addDeck);



module.exports = router;