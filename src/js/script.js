import 'babel-polyfill';
import Swup from 'swup';
import LazyLoad from './LazyLoad.js';
(() => {

// Initializes Swup Js (for transition between pages)
const swup = new Swup();

const init = () => {

  /***********************
  Variables & DOM elements
  ************************/

  // Initializes ScrollMagic
  let controller = new ScrollMagic.Controller();

  /***********************
        Components
  ************************/
  // LazyLoads cards images for home page
  const lazy = new LazyLoad({
    swup: swup,
    controller: controller,
    cards : '.g__card__image'
  });

  /***********************
          Handlers
  ************************/


}

init();

/***********************
      SWUP Events
************************/

swup.on('contentReplaced', () => init());

})();