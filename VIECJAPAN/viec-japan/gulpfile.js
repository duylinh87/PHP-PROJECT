/**
 * CSS/JSファイルのコンパイル・監視・圧縮・ブラウザのオートリロードを行う
 *
 * "gulp --hostname ホスト名" を実行します。ホスト名は、site.ymlのhostnameの値。
 * defaultでは下記の処理が走ります。
 *
 * ・sassファイルのコンパイル
 * ・cssの圧縮
 * ・sassファイルが変更されたらコンパイルする
 * ・cssファイルが変更されたら圧縮する
 * ・cssファイルが圧縮されたらbrowserSyncでブラウザをオートリロード
 * ・jsファイルが変更されたら圧縮する
 * ・jsファイルが圧縮されたらbrowserSyncでブラウザをオートリロード
 */

/* モジュールの読み込み
--------------------------------------------------------- */
var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var browserSync = require("browser-sync").create();
var cssmin = require('gulp-cssmin');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');


/* コマンドライン引数
--------------------------------------------------------- */
// コマンドライン引数でホスト名を必須とする
if ( "--hostname" == process.argv[2] ){
	var hostname = process.argv[3];
} else {
	console.log("ERROR: hostname is not specified.");
	console.log("Run command like: gulp --hostname example.com");
	return;
}


/* デフォルトタスクの定義
--------------------------------------------------------- */
// 'gulp'コマンドで実行されるタスク
// gulp.task('default', ['compileSass', 'watchSass', 'watchCSS', 'browserSyncTask']);
gulp.task('default', ['compileSass', 'watchSass', 'browserSyncTask']);
// gulp.task('default', ['compileSass', 'watchSass', 'watchCSS', 'watchJs', 'minifyJs', 'browserSyncTask']);


/* コンパイル
--------------------------------------------------------- */
// scssファイルをコンパイル
gulp.task('compileSass', function () {

	// // /sass -> /css
	// gulp.src(['./sass/**/*.scss', '!./sass/style.scss'])
	// 	.pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
	// 	.pipe(autoprefixer())
	// 	.pipe(gulp.dest('./css'));

	// /sass/style.scss -> style.css
	gulp.src(['./css/admin/editor-style.scss'])
		.pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
		.pipe(autoprefixer())
		.pipe(gulp.dest('/css/admin/',{ sourcemaps: '.' }))
		.pipe(browserSync.stream());

	// /sass/style.scss -> style.css
	gulp.src(['./css/sass/style.scss'])
		.pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
		.pipe(autoprefixer())
		.pipe(gulp.dest('css/',{ sourcemaps: '.' }))
		.pipe(browserSync.stream());

});


/* 監視
--------------------------------------------------------- */
// sassファイルの変更を監視
gulp.task('watchSass', function () {

	// sassファイルに変更があったらcompileSassタスクを実行する
	gulp.watch(['./css/sass/**/*.scss', './css/admin/*.scss'], ['compileSass']);
});


/* browerSync
--------------------------------------------------------- */
// browserSync: ローカルサーバーを立ち上げ
gulp.task("browserSyncTask", function () {
	browserSync.init({
		proxy: hostname
	});
});