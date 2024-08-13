/**
* Digit Software Solutions.
*
* NOTICE OF LICENSE
*
* This source file is subject to the EULA
* that is bundled with this package in the file LICENSE.txt.
*
* @category  Dss
* @package   Dss_LazyImageLoader
* @author    Extension Team
* @copyright Copyright (c) 2024 Digit Software Solutions. ( https://digitsoftsol.com )
*/
define([
  'jquery'
], function ($) {
  'use strict';

  return function(config) {
      (function(c, l, a, r, i, t, y) {
          c[a] = c[a] || function() {
              (c[a].q = c[a].q || []).push(arguments);
          };
          t = l.createElement(r);
          t.async = 1;
          t.src = "https://www.clarity.ms/tag/" + i + "?ref=dss";
          y = l.getElementsByTagName(r)[0];
          y.parentNode.insertBefore(t, y);

          if (config.isCustomerGroupTagEnabled) {
              c.clarity("set", "customer_group", config.customerGroup);
          }
      })(window, document, "clarity", "script", config.clarityCode);
  };
});
