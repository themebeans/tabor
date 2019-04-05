'use strict';

var gulp = require('gulp');
var HubRegistry = require('gulp-hub');

/* Load tasks into the registry */
var hub = new HubRegistry(['inc/admin/gulp/*.js']);

/* Tell gulp to use the tasks just loaded */
gulp.registry(hub);
