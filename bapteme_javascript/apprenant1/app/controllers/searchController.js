const dataMapper = require("../dataMapper");

const searchController = {
  searchPage: (req, res) => {
    res.render('search/search');
  },
  searchByElement: async (req, res) => {
    const searchedElement = req.query.element;
    // console.log("searchedElement",searchedElement);
    // let searchedResults;
    // if(searchedElement != ''){
    //   searchedResults = await dataMapper.searchByElement(searchedElement);
    // } else {
    //   searchedResults = await dataMapper.searchByElementNull();
    // }
    try {
      searchedResults = await dataMapper.searchByElement(searchedElement);
      // console.log("searchedResults",searchedResults);
  
      res.render('main/cardList', {
        cards: searchedResults,
        title: 'Résultat de la recherche : ' + (searchedElement === 'null' ? ' sans élément' : + searchedElement),
      });
    } catch (error) {
      console.error(error);
      res.status(500).send(`An error occured`);
    }
  },
  searchByLevel: async (req, res) => {
    const searchedLevel = Number(req.query.level);

    try {
      // console.log("searchedLevel",searchedLevel);
      const searchedResults = await dataMapper.searchByLevel(searchedLevel);
      res.render('main/cardList', {
        cards: searchedResults,
        title: `Résultat de la recherche : level ${ searchedLevel }`
      });
    } catch (error) {
      console.error(error);
      res.status(500).send(`An error occured`);
    }

  },
  searchByValues: async (req, res) => {
    const searchedDirection = req.query.direction;
    const searchedValue = Number(req.query.value);
    // console.log("searchedDirection",searchedDirection);
    // console.log("searchedValue",searchedValue);

    try {
      let searchedResults = [];
      if(searchedDirection != '' && searchedValue != '') {
        searchedResults = await dataMapper.searchByValues(searchedDirection,searchedValue);
      }
      // console.log(searchedResults);
      res.render('main/cardList', {
        cards: searchedResults,
        title: `Résultat de la recherche : direction ${ searchedDirection } valeur ${ searchedValue }`
      });
    } catch (error) {
      console.error(error);
      res.status(500).send(`An error occured`);
    }

  },
  searchByName: async (req, res) => {
    const name = req.query.name;
    
    try {
      searchedResults = await dataMapper.searchByName(name);
      res.render('main/cardList', {
        cards: searchedResults,
        title: `Résultat de la recherche : name ${ name }`
      }); 
    } catch (error) {
      console.error(error);
      res.status(500).send(`An error occured`);
    }
  },
};

module.exports = searchController;
