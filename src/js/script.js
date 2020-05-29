import 'babel-polyfill';
import Swup from 'swup';
import SwupScrollPlugin from '@swup/scroll-plugin';
import LazyLoad from './LazyLoad.js';
(() => {

// Initializes Swup Js (for transition between pages)
const swup = new Swup({
  plugins: [new SwupScrollPlugin()]
});

let controller, lazy;

// Initiates listeners and functions
const mount = () => {

  /***********************
  Variables & DOM elements
  ************************/

  // mountializes ScrollMagic
  controller = new ScrollMagic.Controller();

  /***********************
        Components
  ************************/
  // LazyLoads cards images for home page
  lazy = new LazyLoad({
    swup: swup,
    controller: controller,
    cards : '.g__card__image'
  });

  /***********************
          Handlers
  ************************/


}

// Destroys listeners and functions
const unmount = () => {
  controller.destroy;
  lazy.destroy;
}

mount();

/***********************
      SWUP Events
************************/

swup.on('contentReplaced', () => mount());
swup.on('willReplaceContent', () => unmount());


})();