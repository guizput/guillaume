export default class {
  constructor(opts){
    this.controller = opts.controller;
    this.cards = document.querySelectorAll(opts.cards);

    this.lazyLoad();
  }

  lazyLoad() {
    if(this.cards.length > 0){
      this.cards.forEach((card, index) => {
        const style = card.getAttribute('data-style');
        let cardScene = new ScrollMagic.Scene({
          triggerElement: card,
          triggerHook: 1,
          offset: 1
        })
        .on('start', e => {
          card.setAttribute('style', style);
        })
        .addTo(this.controller);
      });
    }
  }

}