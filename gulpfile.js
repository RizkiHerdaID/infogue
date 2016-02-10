var gulp = require('gulp'),
	gutil = require('gulp-util'),
	gcoffee = require('gulp-coffee'),
	gbrowserify = require('gulp-browserify'),
	gcompass = require('gulp-compass'),
	gconnect = require('gulp-connect'),
	gif = require('gulp-if'),
	guglify = require('gulp-uglify'),
	gminifyHTML = require('gulp-minify-html'),
	gminifyjson = require('gulp-jsonminify'),
	gimagemin = require('gulp-imagemin'),
	grename = require('gulp-rename'),
	gconcat = require('gulp-concat');

var env,
	coffeeSources,
	jsSources,
	jsAdminSources,
	sassAdminSources,
	sassSources,
	sassAllSources,
	htmlSources,
	jsonSources,
	fontSources,
	fileSources,
	imageSources,
	outputDir,
	sassStyle;

env = process.env.NODE_ENV || 'development';

outputDir = 'builds/development/';

if(env === 'development'){
	outputDir = 'builds/development/';
	sassStyle = 'expanded';
}
else{
	outputDir = 'builds/production/';
	sassStyle = 'compressed';
}

coffeeSources = [
	'components/coffee/tagline.coffee'
];
jsSources = [
	'components/scripts/tagline.js',
	'components/scripts/main.js',
	'components/scripts/infinite.js',
	'components/scripts/template.js'
];
jsAdminSources = [
	'components/scripts/admin.js'
]
fileSources = [
	'builds/development/.htaccess',
	'builds/development/favicon.ico',
	'builds/development/*.png',
	'builds/development/*.xml',
	'builds/development/*.txt',
];
sassSources = ['components/sass/style.scss'];
sassAdminSources = ['components/sass/admin.scss'];
sassAllSources = ['components/sass/*.scss'];
htmlSources = ['builds/development/*.html'];
jsonSources = ['builds/development/js/*.json'];
fontSources = ['builds/development/fonts/*.ttf'];
imageSources = ['builds/development/images/**/*.*'];

gulp.task('default', ['file', 'html', 'json', 'font', 'coffee', 'js', 'compass', 'images', 'connect', 'watch'], function() {
	gutil.log('InfoGue.id is awesome');
});

gulp.task('admin', ['html', 'jsAdmin', 'compassAdmin', 'watchAdmin', 'connect'], function(){
	gutil.log('InfoGue.id Admin workflow is awesome')
});

gulp.task('coffee', function() {  
	gulp.src(coffeeSources)
		.pipe(gcoffee({bare:true}))
		.on('error', gutil.log)
		.pipe(gulp.dest('components/scripts'));
});

gulp.task('js', function(){
	gulp.src(jsSources)
		.pipe(gconcat('script.js'))
		.pipe(gbrowserify())
		.pipe(gif(env === 'production', guglify()))
		.pipe(gif(env === 'production', grename({ suffix: '.min' })))
		.pipe(gulp.dest(outputDir + 'js'))		
		.pipe(gconnect.reload());
});

gulp.task('compass', function(){
	gulp.src(sassSources)
		.pipe(gcompass({
			sass: 'components/sass',
			image: outputDir + 'images',
			style: sassStyle
		}))
		.on('error', gutil.log)
		.pipe(gif(env === 'production', grename({ suffix: '.min' })))
		.pipe(gulp.dest(outputDir + 'css'))
		.pipe(gconnect.reload());
});

gulp.task('watch', function() {
	gulp.watch(htmlSources, ['html']);
	gulp.watch(jsonSources, ['json']);
	gulp.watch(imageSources, ['images']);
	gulp.watch(coffeeSources, ['coffee']);
	gulp.watch(jsSources, ['js']);
	gulp.watch(sassAllSources, ['compass']);
});

gulp.task('connect', function() {
  gconnect.server({
    root: '',
    livereload: true
  });
});

gulp.task('html', function(){
	gulp.src(htmlSources)
		.pipe(gif(env === 'production', gminifyHTML()))
		.pipe(gif(env === 'production', gulp.dest(outputDir)))
		.pipe(gconnect.reload());
});

gulp.task('images', function(){
	gulp.src(imageSources)
		.pipe(gif(env === 'production', gimagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}]
		})))
		.pipe(gif(env === 'production', gulp.dest(outputDir + 'images')))
		.pipe(gconnect.reload());
});

gulp.task('json', function(){
	gulp.src(jsonSources)
		.pipe(gif(env === 'production', gminifyjson()))
		.pipe(gif(env === 'production', gulp.dest(outputDir + 'js')))
		.pipe(gconnect.reload());
});

gulp.task('font', function(){
	gulp.src(fontSources)
		.pipe(gif(env === 'production', gulp.dest(outputDir + 'fonts')))
		.pipe(gconnect.reload());
});

gulp.task('file', function(){
	gulp.src(fileSources)
		.pipe(gif(env === 'production', gulp.dest(outputDir)))
		.pipe(gconnect.reload());
});

gulp.task('jsAdmin', function(){
	gulp.src(jsAdminSources)
		.pipe(gif(env === 'production', guglify()))
		.pipe(gif(env === 'production', grename({ suffix: '.min' })))
		.pipe(gulp.dest(outputDir + 'js'))
		.pipe(gconnect.reload());
});

gulp.task('compassAdmin', function(){
	gulp.src(sassAdminSources)
		.pipe(gcompass({
			sass: 'components/sass',
			image: outputDir + 'images',
			style: sassStyle
		}))
		.on('error', gutil.log)
		.pipe(gif(env === 'production', grename({ suffix: '.min' })))
		.pipe(gulp.dest(outputDir + 'css'))
		.pipe(gconnect.reload());
});

gulp.task('watchAdmin', function() {
	gulp.watch(htmlSources, ['html']);
	gulp.watch(jsSources, ['jsAdmin']);
	gulp.watch(sassAllSources, ['compassAdmin']);
});