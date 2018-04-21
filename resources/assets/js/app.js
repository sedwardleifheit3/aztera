
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('jquery');
require('./vendors/bootstrap');
require('./vendors/nifty');
var _ = require('lodash');


//import plugins
window.moment = require('moment');
window.select2 = require('./vendors/select2');
window.Dropzone = require('./vendors/dropzone');
window.bootbox = require('bootbox');
window.axios = require('axios');

//bootstrap plugins
window.bootstrapValidator = require('./vendors/bootstrap-validator');
window.typeahead = require('./vendors/bootstrap3-typeahead');
window.mask = require('./vendors/jquery.mask');
window.countdown = require('./vendors/jquery.countdown');
window.bootstrapTable = require('bootstrap-table');
window.datepicker = require('bootstrap-datepicker');

require('./vendors/flot-charts/jquery.flot');
require('./vendors/flot-charts/jquery.flot.time');
require('./vendors/flot-charts/jquery.flot.fillbetween');
require('./vendors/flot-charts/jquery.flot.canvas');
require('./vendors/flot-charts/jquery.flot.axislabels');

require('./vendors/gauge-js/gauge');

//charts/graphs
require('./charts/dosing-point.chart');
require('./charts/dosed-amount.chart');
require('./charts/temperature.chart');
require('./charts/inlet-pressure.chart');
require('./charts/outlet-pressure.chart');


require('./components/common');
require('./components/users');
require('./components/batches');

//app components
require('./api-core');
