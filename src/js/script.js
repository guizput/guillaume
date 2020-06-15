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
          Gestures
  ************************/
  const swipeContainer = document.querySelector('#js__post');
  if(swipeContainer){
    var hammertime = new Hammer(swipeContainer);
    hammertime.on('swipeleft', function(ev) {
      const prevPost = document.querySelector('#js__prevPost');
      if(prevPost) prevPost.click();
    });
    hammertime.on('swiperight', function(ev) {
      const nextPost = document.querySelector('#js__nextPost');
      if(nextPost) nextPost.click();
    });
  }
  

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