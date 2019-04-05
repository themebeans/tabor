// General.
var pkg				= require('../../../package.json');
var project 			= pkg.name;
var project 			= project.replace(/_/g, " ");
var slug			= pkg.slug;
var prefix			= pkg.prefix;
var prefixUppercase		= prefix.toUpperCase();
var projectURL			= 'http://demo.dev/' + slug;
var css_suffix			= pkg.css_min_suffix;

// Translation.
var text_domain			= pkg.textdomain;
var destFile			= slug+'.pot';
var packageName			= project;
var bugReport			= pkg.author_uri;
var lastTranslator		= pkg.author;
var team			= pkg.author_shop;
var translatePath		= './languages';

// Styles.
var styleSRC			= './scss/style.scss'; // Path to main .scss file.
var styleDestination		= './';
var cssFiles			= './**/*.css';
var scssDistFolder		= './_dist/'+slug+'/scss/';
var scssDistFiles		= './_dist/'+slug+'/scss/**/*.scss';
var scssDistFolderPackageDest	= './_dist/'+slug+'/assets/scss/';
var scssDemoFolder		= './_demo/assets/scss/';

// Visual Editor.
var editorStyles		= './scss/editor.scss'; // Path to main .scss file.
var editorDestination		= './assets/css/';
var distEditorStyleSheet	= './_dist/'+slug+'/assets/css/editor.css';

// Gutenberg Editor.
var gutenbergStyles		= './scss/gutenberg.scss'; // Path to main .scss file.
var gutenbergDestination	= './assets/css/';
var distGutenbergStyleSheet	= './_dist/'+slug+'/assets/css/gutenberg.css';

// Style Editor.
var styleEditorStyles		= './scss/style-editor.scss';
var distStyleEditorSheet	= './_dist/'+slug+'/assets/css/style-editor.css';

// Style Editor Frame.
var styleEditorFrameStyles	= './scss/style-editor-frame.scss';
var distStyleEditorFrameSheet	= './_dist/'+slug+'/assets/css/style-editor-frame.css';

// Huh.
var huhStyles		        = './inc/admin/guide/assets/guide.scss'; // Path to main .scss file.
var huhDestination	        = './inc/admin/guide/assets/css/';
var distHuhStyleSheet	        = './_dist/'+slug+'/inc/admin/guide/huh.css';
var distHuhSCSS	                = './_dist/'+slug+'/inc/admin/guide/huh.scss';
var huhSRCtoRemove		= './_dist/'+slug+'/inc/admin/guide/assets/huh.scss'; // Path to JS vendor folder.

// Huh Javascript.
var huhSRC			= './inc/admin/guide/assets/js/src/*.js'; // Path to JS folder.
var huhVendorDestination	= './inc/admin/guide/assets/js/dist/'; // Path to place the compiled JS vendors file.
var huhVendorFile		= 'guide'; // Compiled JS vendors file name.

// Controls SCSS.
var rangeControlSCSS		= './inc/admin/controls/assets/scss/range.scss';
var titleControlSCSS		= './inc/admin/controls/assets/scss/title.scss';
var toggleControlSCSS		= './inc/admin/controls/assets/scss/toggle.scss';
var licenseControlSCSS		= './inc/admin/controls/assets/scss/license.scss';
var layoutControlSCSS		= './inc/admin/controls/assets/scss/layout.scss';
var controlsSCSStoRemove	= './_dist/'+slug+'/inc/admin/controls/assets/scss';
var controlsSRCtoRemove		= './_dist/'+slug+'/inc/admin/controls/assets/css/src';
var controlsDistDestination	= './inc/admin/controls/assets/css/dist';
var controlsSRCDestination	= './inc/admin/controls/assets/css/src';

// Controls Scripts.
var rangeControlJS		= './inc/admin/controls/assets/js/src/range.js';
var toggleControlJS		= './inc/admin/controls/assets/js/src/toggle.js';
var licenseControlJS		= './inc/admin/controls/assets/js/src/license.js';
var layoutControlJS		= './inc/admin/controls/assets/js/src/layout.js';
var controlsJSDistDestination	= './inc/admin/controls/assets/js/dist';

// Customize Controls.
var customizeControlsStyles	= './scss/customize-controls.scss';
var customizeControlsDestination = './assets/css/';

// Metaboxes.
var metaboxesStyles		= './inc/admin/metaboxes/scss/style-metaboxes.scss';
var metaboxesStylesDestination = './inc/admin/metaboxes/css/';
var metaboxesWatchFiles	  	= ['./inc/admin/metaboxes/scss/*.scss' ];

// Vendor Javascript.
var jsVendorSRC			= './assets/js/vendors/*.js'; // Path to JS vendor folder.
var jsVendorDestination	 	= './assets/js/'; // Path to place the compiled JS vendors file.
var jsVendorFile		= 'vendors'; // Compiled JS vendors file name.

// Custom Javascript.
var jsCustomSRC			= './assets/js/custom/*.js'; // Path to JS custom scripts folder.
var jsCustomDestination	 	= './assets/js/'; // Path to place the compiled JS custom scripts file.
var jsCustomFile		= 'custom'; // Compiled JS custom file name.

// Customizer Javascript.
var jsCustomizePreviewSRC	= './assets/js/admin/customize-preview.js';
var jsCustomizePreviewFileName	= 'customize-preview';

var jsCustomizeControlsSRC	= './assets/js/admin/customize-controls.js';
var jsCustomizeControlsFileName	= 'customize-controls';

var jsCustomizeEventsSRC	= './assets/js/admin/customize-events.js';
var jsCustomizeEventsFileName	= 'customize-events';

var jsCustomizeLiveSRC		= './assets/js/admin/customize-live.js';
var jsCustomizeLiveFileName	= 'customize-live';

var jsCustomizeScriptsDest      = './assets/js/admin/';
var jsCustomizeWatchFiles  	= [ './assets/js/admin/customize-controls.js', './assets/js/admin/customize-preview.js' ];

// WooCommerce Javascript.
var jsWooCommerceSRC		= './assets/js/custom/woocommerce/*.js';
var jsWooCommerceDestination	= './assets/js/';
var jsWooCommerceFile		= 'woocommerce';

// PhotoSwipe Javascript.
var jsPhotoSwipeSRC             = "./assets/js/photoswipe/*.js";
var jsPhotoSwipeFile            = "photoswipe";
var jsPhotoSwipeDestination	= './assets/js/';

// PhotoSwipe Classic Javascript.
var jsPhotoSwipeClassicSRC         = "./assets/js/photoswipe-classic/*.js";
var jsPhotoSwipeClassicFile        = "photoswipe-classic";
var jsPhotoSwipeClassicDestination = './assets/js/';

// Images.
var imagesSRC			= './assets/images/src/**/*.{png,jpg,gif,svg}';
var imagesDestination	  	= './assets/images/';

// BrowserSync.
var styleWatchFiles	  	= ['./scss/**/*.scss', '!/scss/_gutenberg.scss' ];
var controlStylesWatchFiles	= ['./inc/admin/controls/assets/scss/**/*.scss' ];
var vendorJSWatchFiles	  	= './assets/js/vendors/**/*.js';
var customJSWatchFiles	  	= ['./assets/js/custom/**/*.js', '!_dist/assets/js/custom/**/*.js', '!_demo/assets/js/custom/**/*.js' ];
var projectPHPWatchFiles	= ['./**/*.php', '!_dist', '!_dist/**', '!_dist/**/*.php', '!_demo', '!_demo/**','!_demo/**/*.php'];
var jsPhotoSwipeWatchFiles	= ['./assets/js/photoswipe/*.js', './assets/js/photoswipe-classic/*.js'];

// Build.
var distBuildFiles		= ['./**', '!_dist', '!_dist/**', '!_demo', '!_demo/**', '!inc/admin/gulp', '!inc/admin/gulp/**', '!node_modules/**', '!*.json', '!*.map', '!*.xml', '!gulpfile.js', '!*.sublime-project', '!*.sublime-workspace', '!*.sublime-gulp.cache', '!*.log', '!*.DS_Store', '!*.gitignore', '!TODO', '!*.git', '!*.ftppass', '!*.DS_Store', '!yarn.lock', '!package.lock'];
var distDestination		= './_dist/';
var distCleanFiles		= ['./_dist/'+slug+'/', './_dist/'+slug+'-package/', './_dist/'+slug+'.zip', './_dist/'+slug+'-package.zip' ];
var demoCleanFiles		= ['./_demo/'];

var distCMB2			= './_dist/'+slug+'/inc/admin/cmb2';

// Build /slug/ contents within the _dist folder
var themeDestination		= './_dist/'+slug+'/';
var themeBuildFiles		= './_dist/'+slug+'/**/*';

// Build _demo contents.
var demoDestination		= './_demo/';
var sftpDemoFilesToUpload	= [ './_demo/**/*' ] ;
var merlinDemoFolder		= './_demo/inc/demo/';

// Browsers you care about for autoprefixing. https://github.com/ai/browserslist
const AUTOPREFIXER_BROWSERS = [
	'last 2 version',
	'> 1%',
	'ie >= 9',
	'ie_mob >= 10',
	'ff >= 30',
	'chrome >= 34',
	'safari >= 7',
	'opera >= 23',
	'ios >= 7',
	'android >= 4',
	'bb >= 10'
];

/**
 * Load Plugins.
 */
var gulp		= require('gulp');
var sass		= require('gulp-sass');
var minifycss		= require('gulp-uglifycss');
var autoprefixer 	= require('gulp-autoprefixer');
var concat	   	= require('gulp-concat');
var uglify	   	= require('gulp-uglify');
var del                 = require('del');
var imagemin	 	= require('gulp-imagemin');
var rename	   	= require('gulp-rename');
var lineec	   	= require('gulp-line-ending-corrector');
var filter	   	= require('gulp-filter');
var sourcemaps   	= require('gulp-sourcemaps');
var notify	   	= require('gulp-notify');
var browserSync  	= require('browser-sync').create();
var reload	   	= browserSync.reload;
var wpPot		= require('gulp-wp-pot');
var sort		= require('gulp-sort');
var replace	  	= require('gulp-replace-task');
var zip		  	= require('gulp-zip');
var copy		= require('gulp-copy');
var sftp	  	= require('gulp-sftp');
var open	  	= require('gulp-open');
var gulpif              = require('gulp-if');
var cache               = require('gulp-cache');

function clearCache(done) {
	cache.clearAll();
	done();
}
gulp.task(clearCache);

gulp.task('clean', function(done) {
	return del( distCleanFiles );
	done();
});

gulp.task('clean_demo', function (done) {
	return del( demoCleanFiles );
	done();
});

gulp.task('clean_dist_scss', function (done) {
	return del( scssDistFolder );
	done();
});

gulp.task('clean_demo_scss', function (done) {
	return del( scssDemoFolder );
	done();
});

gulp.task('clean_demo_folder', function (done) {
	return del( merlinDemoFolder );
	done();
});

gulp.task('clean_dist_huh_scss', function (done) {
	return del( distHuhSCSS );
	done();
});

gulp.task('clean_dist_huh_css', function (done) {
	return del( distHuhStyleSheet );
	done();
});

gulp.task('clean_dist_huh_src_js', function (done) {
	return del( huhSRCtoRemove );
	done();
});

gulp.task('clean_dist_controls_scss', function (done) {
	return del( huhSRCtoRemove );
	done();
});

gulp.task('clean-dist', function (done) {
	return del( './_dist/' + slug + '/' );
	done();
});

gulp.task('clean_distCMB2', function (done) {
	if ( false == pkg.cmb2 ) {
		return del( distCMB2 );
	}
	done();
});

/**
 * Tasks.
 */
gulp.task( 'browser-sync', function(done) {

	try {
		var environmentFile	= require('../../../environment.json');
	} catch (error) {
		done();
	}

	if ( environmentFile ) {
		browserSync.init( {
			proxy: environmentFile.devURL,
			open: true,
			injectChanges: true,
		} );
		done();
	}
});

// Open the download on themebeans.com, so I can update the version number.
gulp.task( 'edit-download-on-themebeans.com', function(done){

	var sftpFile;

	try {
		var sftpFile = require('./sftp.json');
	} catch (error) {
		done();
	}

	if ( sftpFile ) {
		gulp.src(__filename)
		.pipe( open( { uri: 'https://themebeans.com/wp-admin/post.php?post=' + pkg.downloadid + '&action=edit&version=' + pkg.version + '' } ) );
		done();
	}
	done();
});

// Open the demo and so I may clear the cache and verify that the demo looks right.
gulp.task( 'view-demo-and-clear-cache', function(done){

	if ( 'tabor' == slug ) {
		done();
		return;
	}

	var sftpFile;

	try {
		var sftpFile = require('./sftp.json');
	} catch (error) {
		done();
	}

	if ( sftpFile ) {
		gulp.src(__filename)
		.pipe( open( { uri: 'https://demo.themebeans.com/' + slug + '/wp-admin/admin.php?page=wp_pagely' } ) );
		done();
	}
	done();
});

// Moves the development top-level scss folder within the /assets/ folder
gulp.task( 'move_dist_scss', function(done){
	return gulp.src( scssDistFiles, { allowEmpty: true } )
	.pipe( gulp.dest( scssDistFolderPackageDest ) );
	done();
});

gulp.task( 'huhJs', function(done) {
	gulp.src( huhSRC, { allowEmpty: true } )
	.pipe( concat( huhVendorFile + '.min.js' ) )
	.pipe( lineec() )
	.pipe( gulp.dest( huhVendorDestination ) )
	.pipe( rename( {
		basename: huhVendorFile,
		suffix: '.min'
	} ) )
	.pipe( lineec() )
	.pipe( gulp.dest( huhVendorDestination ) )
	done();
});

// Ensures that debug mode is turned on during development.
gulp.task( 'debug_mode_on', function(done) {
	return gulp.src( ['./functions.php', '!_demo/functions.php', '!_dist/functions.php'] )

	.pipe( replace( {
		patterns: [
		{
			match: '_DEBUG\', false );',
			replacement: '_DEBUG\', true );'
		}
		],
		usePrefix: false
	} ) )
	.pipe(gulp.dest( './' ));
	done();
});

// Ensures SLUG_DEBUG is set to false for all build and demo files.
gulp.task( 'debug_mode_off', function(done) {
	return gulp.src( themeBuildFiles )

	.pipe( replace( {
		patterns: [
		{
			match: '_DEBUG\', true );',
			replacement: '_DEBUG\', false );'
		}
		],
		usePrefix: false
	} ) )
	.pipe(gulp.dest( themeDestination ));
	done();
});

// Assign the proper definition prefixes.
gulp.task( 'definition_prefix', function(done) {
	return gulp.src( themeBuildFiles )

	.pipe( replace( {
		patterns: [
		{
			match: '__PREFIX',
			replacement: prefixUppercase,
		}
		],
		usePrefix: false
	} ) )
	.pipe( gulp.dest( themeDestination ) );
	done();
});


gulp.task( 'styles', function(done) {
	gulp.src( styleSRC )

	.pipe( sourcemaps.init() )

	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )

	.on('error', console.error.bind(console))

	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

	.pipe( sourcemaps.write( { includeContent: false } ) )
	.pipe( sourcemaps.init( { loadMaps: true } ) )
	.pipe( sourcemaps.write( styleDestination ) )

	.pipe( lineec() )

	.pipe( gulp.dest( styleDestination ) )

	.pipe( filter( '**/*.css' ) )

	.pipe( browserSync.stream() )

	.pipe(replace({
	patterns: [
		{
		  match: 'pkg.name',
		  replacement: project
		},
		{
		  match: 'pkg.author_shop',
		  replacement: pkg.author_shop
		},
		{
		  match: 'pkg.author_uri',
		  replacement: pkg.author_uri
		},
		{
		  match: 'pkg.version',
		  replacement: pkg.version
		},
		{
		  match: 'pkg.theme_uri',
		  replacement: pkg.theme_uri
		},
		{
		  match: 'pkg.description',
		  replacement: pkg.description
		},
		{
		  match: 'pkg.downloadid',
		  replacement: pkg.downloadid
		},
		{
		  match: 'pkg.textdomain',
		  replacement: pkg.textdomain
		},
	]
	}))
	.pipe( gulp.dest( './' ) )

	// Minify.
	.pipe( rename( { suffix: css_suffix } ) )
	.pipe( minifycss() )
	.pipe( lineec() )
	.pipe( gulp.dest( styleDestination ) )

	.pipe( filter( '**/*.css' ) )
	.pipe( browserSync.stream() )
	done();
});

gulp.task( 'gutenberg-styles', function(done) {

	gulp.src( gutenbergStyles, { allowEmpty: true } )

	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )

	.on('error', console.error.bind(console))

	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

	.pipe( lineec() )

	.pipe( gulp.dest( gutenbergDestination ) )

	.pipe( browserSync.stream() )

	.pipe( rename( { suffix: css_suffix } ) )
	.pipe( minifycss() )
	.pipe( lineec() )
	.pipe( gulp.dest( gutenbergDestination ) )

	.pipe( browserSync.stream() )
	done();

});

gulp.task( 'style-editor-styles', function(done) {

	gulp.src( styleEditorStyles, { allowEmpty: true } )

	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )

	.on('error', console.error.bind(console))

	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

	.pipe( lineec() )

	.pipe( gulp.dest( gutenbergDestination ) )

	.pipe( browserSync.stream() )

	.pipe( rename( { suffix: css_suffix } ) )
	.pipe( minifycss() )
	.pipe( lineec() )
	.pipe( gulp.dest( gutenbergDestination ) )

	.pipe( browserSync.stream() )
	done();

});

gulp.task( 'style-editor-frame-styles', function(done) {

	gulp.src( styleEditorFrameStyles, { allowEmpty: true } )

	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )

	.on('error', console.error.bind(console))

	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

	.pipe( lineec() )

	.pipe( gulp.dest( gutenbergDestination ) )

	.pipe( browserSync.stream() )

	.pipe( rename( { suffix: css_suffix } ) )
	.pipe( minifycss() )
	.pipe( lineec() )
	.pipe( gulp.dest( gutenbergDestination ) )

	.pipe( browserSync.stream() )
	done();

});

gulp.task( 'editor-styles', function(done) {

	gulp.src( editorStyles, { allowEmpty: true } )

	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )

	.on('error', console.error.bind(console))

	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

	.pipe( lineec() )

	.pipe( gulp.dest( editorDestination ) )

	.pipe( browserSync.stream() )

	.pipe( rename( { suffix: css_suffix } ) )
	.pipe( minifycss() )
	.pipe( lineec() )
	.pipe( gulp.dest( editorDestination ) )

	.pipe( browserSync.stream() )
	done();

});

gulp.task( 'huh-styles', function(done) {

	gulp.src( huhStyles, { allowEmpty: true } )

	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )

	.on('error', console.error.bind(console))

	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

	.pipe( lineec() )

	.pipe( gulp.dest( huhDestination ) )

	.pipe( browserSync.stream() )

	.pipe( rename( { suffix: css_suffix } ) )
	.pipe( minifycss() )
	.pipe( lineec() )
	.pipe( gulp.dest( huhDestination ) )

	.pipe( browserSync.stream() )
	done();

});

gulp.task( 'customize-controls-styles', function(done) {

	gulp.src( customizeControlsStyles, { allowEmpty: true } )

	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )

	.on('error', console.error.bind(console))

	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

	.pipe( lineec() )

	.pipe( gulp.dest( customizeControlsDestination ) )

	.pipe( browserSync.stream() )

	.pipe( rename( { suffix: css_suffix } ) )
	.pipe( minifycss() )
	.pipe( lineec() )
	.pipe( gulp.dest( customizeControlsDestination ) )

	.pipe( browserSync.stream() )
	done();
});

gulp.task( 'metaboxes-styles', function(done) {

	gulp.src( metaboxesStyles, { allowEmpty: true } )

	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )

	.on('error', console.error.bind(console))

	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

	.pipe( lineec() )

	.pipe( gulp.dest( metaboxesStylesDestination ) )

	.pipe( browserSync.stream() )

	.pipe( rename( { suffix: css_suffix } ) )
	.pipe( minifycss() )
	.pipe( lineec() )
	.pipe( gulp.dest( metaboxesStylesDestination ) )

	.pipe( browserSync.stream() )
	done();
});

gulp.task( 'controls-scss', function(done) {

	gulp.src( [ rangeControlSCSS, titleControlSCSS, toggleControlSCSS, licenseControlSCSS, layoutControlSCSS ] )

	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )

	.on('error', console.error.bind(console))

	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

	.pipe( lineec() )

	.pipe( gulp.dest( controlsSRCDestination ) )

	.pipe( browserSync.stream() )

	.pipe( rename( { suffix: css_suffix } ) )
	.pipe( minifycss() )
	.pipe( lineec() )
	.pipe( gulp.dest( controlsDistDestination ) )

	.pipe( browserSync.stream() )
	done();

});

gulp.task( 'controls-scripts', function(done) {
	gulp.src( [ rangeControlJS, toggleControlJS, licenseControlJS, layoutControlJS ] )
	.pipe( rename( {
		suffix: '.min'
	}))
	.pipe( uglify() )
	.pipe( lineec() )
	.pipe( gulp.dest( controlsJSDistDestination ) )
	done();
});

gulp.task( 'vendorsJs', function(done) {
	gulp.src( jsVendorSRC )
	.pipe( concat( jsVendorFile + '.min.js' ) )
	.pipe( lineec() )
	.pipe( gulp.dest( jsVendorDestination ) )
	.pipe( rename( {
		basename: jsVendorFile,
		suffix: '.min'
	} ) )
	.pipe( uglify() )
	.pipe( lineec() )
	.pipe( gulp.dest( jsVendorDestination ) )
	done();
});

gulp.task( 'customJS', function(done) {
	gulp.src( jsCustomSRC )
	.pipe( concat( jsCustomFile + '.min.js' ) )
	.pipe( lineec() )
	.pipe( gulp.dest( jsCustomDestination ) )
	.pipe( rename( {
		basename: jsCustomFile,
		suffix: '.min'
	} ) )
	.pipe( uglify() )
	.pipe( lineec() )
	.pipe( gulp.dest( jsCustomDestination ) )
	done();
});

gulp.task( 'woocommerceJS', function(done) {
	gulp.src( jsWooCommerceSRC, { allowEmpty: true } )
		.pipe( concat( jsWooCommerceFile + '.min.js' ) )
		.pipe( lineec() )
		.pipe( gulp.dest( jsWooCommerceDestination ) )
		.pipe( rename( {
			basename: jsWooCommerceFile,
			suffix: '.min'
		}))
		.pipe( uglify() )
		.pipe( lineec() )
		.pipe( gulp.dest( jsWooCommerceDestination ) )
		done();
});

gulp.task( 'photoswipeJs', function(done) {

	// Gallery Block PhotoSwipe
	gulp.src( jsPhotoSwipeSRC, { allowEmpty: true } )
	.pipe( concat( jsPhotoSwipeFile + '.min.js' ) )
	.pipe( lineec() )
	.pipe( gulp.dest( jsPhotoSwipeDestination ) )
	.pipe(
		rename( {
			basename: jsPhotoSwipeFile,
			suffix: ".min"
		} )
	)
	.pipe( lineec() )
	.pipe( gulp.dest( jsPhotoSwipeDestination ) )

	// Gallery Block PhotoSwipe
	gulp.src( jsPhotoSwipeClassicSRC, { allowEmpty: true } )
	.pipe( concat( jsPhotoSwipeClassicFile + '.min.js' ) )
	.pipe( lineec() )
	.pipe( gulp.dest( jsPhotoSwipeClassicDestination ) )
	.pipe(
		rename( {
			basename: jsPhotoSwipeClassicFile,
			suffix: ".min"
		} )
	)
	.pipe( lineec() )
	.pipe( gulp.dest( jsPhotoSwipeClassicDestination ) );

	done();
});

gulp.task( 'customize-scripts', function(done) {
	// customize-preview.js
	gulp.src( jsCustomizePreviewSRC, { allowEmpty: true } )
	.pipe( rename( {
		basename: jsCustomizePreviewFileName,
		suffix: '.min'
	}))
	.pipe( uglify() )
	.pipe( lineec() )
	.pipe( gulp.dest( jsCustomizeScriptsDest ) )

	// customize-controls.js
	gulp.src( jsCustomizeControlsSRC, { allowEmpty: true } )
	.pipe( rename( {
		basename: jsCustomizeControlsFileName,
		suffix: '.min'
	}))
	.pipe( uglify() )
	.pipe( lineec() )
	.pipe( gulp.dest( jsCustomizeScriptsDest ) )

	// customize-events.js
	gulp.src( jsCustomizeEventsSRC, { allowEmpty: true } )
	.pipe( rename( {
		basename: jsCustomizeEventsFileName,
		suffix: '.min'
	}))
	.pipe( uglify() )
	.pipe( lineec() )
	.pipe( gulp.dest( jsCustomizeScriptsDest ) )

	// customize-live.js
	gulp.src( jsCustomizeLiveSRC, { allowEmpty: true } )
	.pipe( rename( {
		basename: jsCustomizeLiveFileName,
		suffix: '.min'
	}))
	.pipe( uglify() )
	.pipe( lineec() )
	.pipe( gulp.dest( jsCustomizeScriptsDest ) )
	done();
});

gulp.task( 'images', function(done) {
	gulp.src( imagesSRC, { allowEmpty: true } )
	.pipe( imagemin( {
		progressive: true,
		optimizationLevel: 3,
		interlaced: true,
		svgoPlugins: [{removeViewBox: false}]
	} ) )
	.pipe(gulp.dest( imagesDestination ))
	done();
});

gulp.task('copy', function(done) {
	return gulp.src( distBuildFiles )
	.pipe( copy( themeDestination ) );
	done();
});

gulp.task('variables', function(done) {
	return gulp.src( themeBuildFiles )
	.pipe(replace({
		patterns: [
		{
			match: 'pkg.name',
			replacement: project
		},
		{
			match: 'pkg.version',
			replacement: pkg.version
		},
		{
			match: 'pkg.author',
			replacement: pkg.author
		},
		{
			match: 'pkg.author_shop',
			replacement: pkg.author_shop
		},
		{
			match: 'pkg.license',
			replacement: pkg.license
		},
		{
			match: 'pkg.slug',
			replacement: pkg.slug
		},
		{
			match: 'pkg.copyright',
			replacement: pkg.copyright
		},
		{
			match: 'pkg.theme_uri',
			replacement: pkg.theme_uri
		},
		{
			match: 'textdomain',
			replacement: pkg.textdomain
		},
		{
			match: 'pkg.downloadid',
			replacement: pkg.downloadid
		},
		{
			match: 'pkg.description',
			replacement: pkg.description
		}
		]
	}))
	.pipe(gulp.dest( themeDestination ));
	done();
});

gulp.task('move-to-demo', function(done){
	return gulp.src('./_dist/'+slug+'/**')
	.pipe( gulp.dest( demoDestination ) );
	done();
});

gulp.task( 'translate', function(done) {

	gulp.src( projectPHPWatchFiles )

	.pipe(sort())
	.pipe(wpPot( {
		 domain		: text_domain,
		 destFile	: destFile,
		 package	: project,
		 bugReport	: bugReport,
		 lastTranslator : lastTranslator,
		 team		: team
	} ))
	.pipe( gulp.dest( translatePath ) )
	done();
});

gulp.task('css_variables', function(done) {
  gulp.src( cssFiles )
	.pipe(replace({
	  patterns: [
		{
		  match: 'pkg.name',
		  replacement: project
		},
	  ]
	}))
	.pipe(gulp.dest( './' ));
	done();
});

gulp.task('zip-theme', function(done) {
	return gulp.src( themeDestination + '/**', { base: '_dist' } )
	.pipe( zip( slug + '.zip' ) )
	.pipe( gulp.dest( distDestination ) );
	done();
});

gulp.task('zip-package', function(done) {
	return gulp.src( './_dist/**' , { base: '_dist' } )
	.pipe( zip( slug + '-package.zip' ) )
	.pipe( gulp.dest( distDestination ) );
	done();
});

gulp.task( 'sftp-upload-theme-zip', function(done) {

	var sftpFile;

	try {
		var sftpFile = require('./sftp.json');
	} catch (error) {
		done();
	}

	if ( sftpFile ) {
		return gulp.src( './_dist/' + slug + '.zip' )
		.pipe( sftp( {
			host: sftpFile.host,
			authFile: sftpFile.authFile,
			auth: sftpFile.authDemo,
			remotePath: sftpFile.remotePathDemo,
		}))
		.pipe( notify( { message: 'The ' + packageName + ' theme zip files have been uploaded.', onLast: true } ) );
	}
	done();
});

gulp.task( 'sftp-upload-theme-package', function(done) {

	var sftpFile;

	try {
		var sftpFile = require('./sftp.json');
	} catch (error) {
		done();
	}

	if ( sftpFile ) {
		return gulp.src( './_dist/' + slug + '-package.zip' )
		.pipe( sftp( {
			host: sftpFile.host,
			authFile: sftpFile.authFile,
			auth: sftpFile.authDemo,
			remotePath: sftpFile.remotePathDemo,
		}))
		.pipe( notify( { message: 'The ' + packageName + ' package has been uploaded.', onLast: false } ) );
	}
	done();
});

gulp.task( 'sftp-upload-to-theme-demo', function(done) {

	var sftpFile;

	try {
		var sftpFile = require('./sftp.json');
	} catch (error) {
		done();
	}

	if ( sftpFile ) {
		return gulp.src( sftpDemoFilesToUpload )
		.pipe( sftp( {
			host: sftpFile.host,
			authFile: sftpFile.authFile,
			auth: sftpFile.auth,
			remotePath: '/wp-content/themes/' + slug
		}))
	}
	done();
});

gulp.task( 'build_notice', function( done) {
	return gulp.src( './' )
	.pipe( notify( { message: 'Your build of ' + packageName + ' is complete.', onLast: true } ) )
	done();
});

gulp.task( 'release_notice', function(done) {
	return gulp.src( './' )
	.pipe( notify( { message: 'The v' + pkg.version + ' release of ' + packageName + ' has been uploaded.', onLast: false } ) )
	done();
});

gulp.task( 'default', gulp.series( 'clearCache', 'debug_mode_on', 'styles', 'gutenberg-styles', 'style-editor-styles', 'style-editor-frame-styles', 'huh-styles', 'editor-styles', 'customize-controls-styles', 'metaboxes-styles', 'controls-scss', 'controls-scripts', 'vendorsJs', 'customJS', 'huhJs', 'customize-scripts', 'woocommerceJS', 'photoswipeJs', 'images', 'browser-sync', function(done) {

	gulp.watch( projectPHPWatchFiles, gulp.parallel(reload));
	gulp.watch( styleWatchFiles, gulp.parallel('styles'));
	gulp.watch( controlStylesWatchFiles, gulp.parallel('controls-scss'));
	gulp.watch( metaboxesWatchFiles, gulp.parallel('metaboxes-styles'));
	gulp.watch( gutenbergStyles, gulp.parallel('gutenberg-styles'));
	gulp.watch( styleEditorStyles, gulp.parallel('style-editor-styles'));
	gulp.watch( styleEditorFrameStyles, gulp.parallel('style-editor-frame-styles'));
	gulp.watch( huhStyles, gulp.parallel('huh-styles'));
	gulp.watch( editorStyles, gulp.parallel('styles'));
	gulp.watch( customizeControlsStyles, gulp.parallel('customize-controls-styles'));
	gulp.watch( vendorJSWatchFiles, gulp.parallel('vendorsJs'));
	gulp.watch( customJSWatchFiles, gulp.parallel('customJS'));
	gulp.watch( jsCustomizeWatchFiles, gulp.parallel('customize-scripts'));
	gulp.watch( jsPhotoSwipeWatchFiles, gulp.parallel('photoswipeJs'));
	done();
} ) );

gulp.task( 'build-process', gulp.series( 'clearCache', 'clean', 'clean_demo', 'styles', 'css_variables', 'vendorsJs', 'customJS', 'customize-scripts', 'woocommerceJS', 'photoswipeJs', 'translate', 'images', 'gutenberg-styles', 'style-editor-styles', 'style-editor-frame-styles', 'huh-styles', 'huhJs', 'editor-styles', 'customize-controls-styles', 'metaboxes-styles', 'controls-scss', 'controls-scripts', 'copy', 'variables', 'debug_mode_off', 'definition_prefix', 'clean_distCMB2', 'clean_dist_huh_scss', 'clean_dist_huh_css', 'clean_dist_huh_src_js', 'clean_dist_controls_scss', 'move_dist_scss', 'clean_dist_scss', 'zip-theme', 'move-to-demo', 'clean_demo_scss', 'clean_demo_folder', 'clean-dist', 'zip-package', function(done) {
	done();
} ) );

gulp.task( 'build', gulp.series( 'build-process', 'build_notice', function(done) {
	done();
} ) );

gulp.task( 'release', gulp.series( 'build-process', 'sftp-upload-to-theme-demo', 'view-demo-and-clear-cache', 'sftp-upload-theme-zip', 'sftp-upload-theme-package', 'edit-download-on-themebeans.com', 'release_notice', function(done) {
	done();
} ) );
