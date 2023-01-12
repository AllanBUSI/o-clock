
const searchController = {
  searchPage: (req, res) => {
    res.render('main/search');
  },

  searchElement :async (request, response, next) => {

    try {
      const element = request.params.element

      const result = await dataMapper.cardElement(element);

      if (result){
        response.render('main/element/', {element});
      }else{
        next();
      }
      
    } catch (error) {
      console.log(error);
      response.status(500).send('Oups, nous rencontrons un problème technique');
    }    
  },

};

module.exports = searchController;