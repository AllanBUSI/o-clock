const express = require('express');
const router = express.Router();

// Controllers
const mainController = require('./controllers/mainController');
const searchController = require('./controllers/searchController');
const cardController = require('./controllers/cardController');

// Middlewares
const middleware = require('./middlewares/middleware');

// Middleware // Initialiser le tableau si inexistant
router.use(middleware.cardSession);

// Homepage
router.get('/', mainController.homePage);

// Card
router.get('/card/:id', cardController.renderOneCard);

// Search
router.get('/search', searchController.searchPage);
router.get('/search/element', searchController.searchByElement);
router.get('/search/level', searchController.searchByLevel);
router.get('/search/values', searchController.searchByValues);
router.get('/search/name', searchController.searchByName);

// Deck
router.get('/deck', cardController.deckPage);
router.get("/deck/add/:id", cardController.addCard);
router.get("/deck/remove/:id", cardController.removeCard);

// 404
router.use(mainController.notFound);

module.exports = router;