(function (factory) {
  /* global define */
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['jquery'], factory);
  } else {
    // Browser globals: jQuery
    factory(window.jQuery);
  }
}(function ($) {
  // template
  var tmpl = $.summernote.renderer.getTemplate();

  /**
   * @class plugin.photo 
   * 
   * Hello Plugin  
   */
  $.summernote.addPlugin({
    /** @property {String} name name of plugin */
    name: 'photo',
    /** 
     * @property {Object} buttons 
     * @property {Function} buttons.photo   function to make button
     * @property {Function} buttons.photoDropdown   function to make button
     * @property {Function} buttons.photoImage   function to make button
     */
    buttons: { // buttons
      photo : function () {
        return tmpl.iconButton('fa fa-file-image-o', {
          event : 'photo',
          title: 'photo',
          _id:'_photo-upload',
          hide: true
        });
      },
      send : function () {
        return tmpl.iconButton('fa fa-send-o', {
          event : 'send',
          title: 'send',
          _id:'_send-tracking',
          _text:'Send Message',
          className:'bg-success tool-large',
          hide: true
        });
      }
    },
    /*
    events: { // events

      photo : function (event, editor, layoutInfo) {
        var $editable = layoutInfo.editable();
      }
    }
    */
  });
}));
