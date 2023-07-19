(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.MyModuleBehavior = {
    attach: function (context, settings) {
      //$('main', context).once('ip_views').each(function () {

        var views = drupalSettings.ip_views;

        if (views['region_code_check'] == 'undefined') {
          views['region_code_check'] = '';
        }
        if(views['region_code_form'] == views['region_code_check']){

          function Visibility() {
            head = document.head || document.getElementsByTagName('head')[0],
              style = document.createElement('style');

            head.appendChild(style);

            style.innerHTML = '.block-views-blockvarbase-heroslider-media-varbase-heroslider-media{display:none;}';
          }
          Visibility();
        }
        else {
          function Visibility() {
            head = document.head || document.getElementsByTagName('head')[0],
              style = document.createElement('style');

            head.appendChild(style);

            style.innerHTML = '.block-views-blockslider-media-hero-canarias-final-block-1{display:none;}';
          }
          Visibility();
          }
      //  });
      }
    };
})(jQuery, Drupal, drupalSettings);
