const express = require('express');
const router = express.Router();

const mainController = require('./controllers/mainController');
const searchController = require('./controllers/searchController');


router.get('/', mainController.homePage);
router.get('/search', searchController.searchPage);
router.get('/card', mainController.cardPage);

module.exports = router;