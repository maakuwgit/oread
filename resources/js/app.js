/**
* LL JS
* -----------------------------------------------------------------------------
*
* This is the core of the LLJS system. It's a combination of a couple things,
* DOM-based routing, module-export pattern, and component-driven development.
*
* The goal is to allow component JS to exist within the component's folder
* and only firing if that component is being used on the page.
*/
(function($) {


  var arrayUnique = function(a) {
    return a.reduce(function(p, c) {
      if (p.indexOf(c) < 0) { p.push(c); }
      return p;
    }, []);
  };

  /**
   * The main app.
   *
   * @type {Object}
   */
  var app = {

    components: {},

    registerComponent: function( componentName, component ) {
      this.components[ componentName ] = component;
    }
  };

  window.app = app;

  //Use body's after content to easily check if we're in a mobile
  //or desktop state
  var screenSize = window.getComputedStyle(document.body,':after').getPropertyValue('content');
  window.isMobile = true;
  if ( screenSize === '"desktop"' ) {
    window.isMobile = false;
  }


  // The routing fires all common scripts, followed by the component-specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = app.components;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      var components = [];

      $('[data-component]').each(function(index, el) {
        components.push( $( this ).attr( 'data-component' ) );
      });

      components = arrayUnique( components );

      // Fire component-specific init JS, and then finalize JS
      $.each(components, function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);
})(jQuery);
