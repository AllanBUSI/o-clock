const dataMapper = require("../dataMapper");

const searchController = {
  searchPage: (req, res) => {
    res.render('search');
  },
  getSearchResults : async (req, res) => {
    const cardElement = req.query.element;
    const cards = await dataMapper.getElements();
  
    const results = cards.filter(cards => cards.element.includes(cardElement))
    console.log(results),
    
    res.render("searchResults" , {results})
  }


};

module.exports = searchController;