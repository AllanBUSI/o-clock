
const middleware = {
  cardSession: (req, res, next) => {
    if (!req.session.cards) {
      req.session.cards = [];
      console.log("init deck Middleware");
    }
    next();
  },
}

module.exports = middleware;