var gulp       = require('gulp'),
    gutil      = require('gulp-util'),
    less       = require('gulp-less'),
    sass       = require('gulp-sass'),
    concat     = require('gulp-concat'),
    minifyCSS  = require('gulp-minify-css'),
    cleanCSS   = require('gulp-clean-css'),
    uglify     = require('gulp-uglify'),
    watch      = require('gulp-watch'),
    livereload = require('gulp-livereload'),
    rename     = require('gulp-rename'),
    prefix     = require('gulp-autoprefixer'),
    ngAnnotate = require('gulp-ng-annotate'),
    del        = require('del'),
    rev        = require('gulp-rev'),
    vinylPaths = require('vinyl-paths'),
    sourcemaps = require('gulp-sourcemaps'),
    stripDebug = require('gulp-strip-debug');

var fileMode = 436;

function swallowError (error) {
    console.log(error.toString());
    this.emit('end');
}

// Set env production ( useful var for optimizing purposes )
// can be executed as follows >gulp all OR >gulp task-name --prod=true
gulp.task('set-env-prod', function() {
    gutil.env.prod = true;
});

// Compile Sass and save to css directory
gulp.task('sass-public', function () {
    return gulp.src('resources/assets/sass/master.scss')
        .pipe(!gutil.env.prod ? sourcemaps.init() : gutil.noop())
        .pipe(sass({
            includePaths: ['node_modules']
        }))
        .on('error', swallowError)
        .pipe(gutil.env.prod
            ? prefix({ browsers: ['ie >= 11', 'iOS > 7', 'Firefox ESR', 'Opera 12.1', 'last 2 versions'] })
            : gutil.noop())
        .pipe(gutil.env.prod ? cleanCSS() : gutil.noop())
        .pipe(!gutil.env.prod ? sourcemaps.write() : gutil.noop())
        .pipe(rename('public.css'))
        .pipe(gulp.dest('public/css'));

});

// Compile Less and save to css directory
gulp.task('less-admin', function () {

    return gulp.src('resources/assets/less/admin/master.less')
        .pipe(less())
        .on('error', swallowError)
        .pipe(prefix('last 2 versions', '> 1%', 'ie >= 9', 'Android 2'))
        .pipe(cleanCSS())
        .pipe(rename('admin.css'))
        .pipe(gulp.dest('public/css', {mode: fileMode}));

});

// version
gulp.task('version', ['sass-public', 'js-public', 'less-admin', 'js-admin'], function() {

    var publicDir = 'public',
        buildDir = publicDir + '/build',
        files = vinylPaths();

    del.sync(buildDir + '/*', { force: true });

    return gulp.src([
            publicDir + '/css/*',
            publicDir + '/js/admin/*',
            publicDir + '/js/public/*'
        ], { base: './' + publicDir })
        .pipe(gulp.dest(buildDir, {mode: fileMode}))
        .pipe(files)
        .pipe(rev())
        .pipe(gulp.dest(buildDir, {mode: fileMode}))
        .pipe(rev.manifest())
        .pipe(gulp.dest(buildDir, {mode: fileMode}))
        .on('end', function() {
            del(files.paths);
        });
});

// Publish fonts
gulp.task('fonts', function () {

    var destDir = 'public/fonts';

    return gulp.src([
            'node_modules/font-awesome/fonts/*'
        ])
        .pipe(gulp.dest(destDir, {mode: fileMode}));

});

// Publish angular locales
gulp.task('angular-locales', function () {

    var destDir = 'public/js/angular-locales';

    return gulp.src([
            'node_modules/angular-i18n/angular-locale_fr-fr.js',
            'node_modules/angular-i18n/angular-locale_nl-nl.js'
        ])
        .pipe(gulp.dest(destDir, {mode: fileMode}));

});

// Publish Fancybox images
gulp.task('fancybox-img', function () {

    var destDir = 'public/components/fancybox/source';

    return gulp.src('node_modules/fancybox/dist/img/*')
        .pipe(gulp.dest(destDir, {mode: fileMode}));

});

// Publish ElFinder images
gulp.task('elfinder-img', function () {

    var destDir = 'public/components/elfinder/source';

    return gulp.src('node_modules/jquery-colorbox/example1/images/*')
        .pipe(gulp.dest(destDir, {mode: fileMode}));

});

// Publish CKEditor
gulp.task('ckeditor', function () {

    // Base files
    gulp.src([
        'node_modules/ckeditor/ckeditor.js',
        'node_modules/ckeditor/styles.js',
        'node_modules/ckeditor/contents.css'
    ])
    .pipe(gulp.dest('public/components/ckeditor', {mode: fileMode}));

    // Lang files
    gulp.src([
            'node_modules/ckeditor/lang/fr.js',
            'node_modules/ckeditor/lang/es.js',
            'node_modules/ckeditor/lang/pt.js',
            'node_modules/ckeditor/lang/de.js',
            'node_modules/ckeditor/lang/en.js',
            'node_modules/ckeditor/lang/nl.js'
        ])
        .pipe(gulp.dest('public/components/ckeditor/lang', {mode: fileMode}));

    // Plugins
    var plugins = [
        'clipboard',
        'image',
        'image2',
        'justify',
        'lineutils',
        'link',
        'magicline',
        'panelbutton',
        'pastefromword',
        'showblocks',
        'specialchar',
        'table',
        'widget',
        'uploadwidget',
        'filetools',
        'notification',
        'notificationaggregator',
        'uploadimage'
    ];
    for (var i = 0; i < plugins.length; i++) {
        gulp.src(['node_modules/ckeditor/plugins/' + plugins[i] + '/**/*'])
            .pipe(gulp.dest('public/components/ckeditor/plugins/' + plugins[i], {mode: fileMode}));
    }

});

gulp.task('js-admin', function () {

    var destDir = 'public/js/admin',
        destFile = 'components.min.js',
        files = [
            'node_modules/jquery/dist/jquery.js',
            'node_modules/angular/angular.js',
            'node_modules/angular-resource/angular-resource.js',
            'node_modules/angular-smart-table/dist/smart-table.js',
            'node_modules/angular-ui-tree/dist/angular-ui-tree.js',
            'node_modules/angularjs-datepicker/dist/angular-datepicker.min.js',
            // 'node_modules/vue/vue.js',
            // 'node_modules/vue-tables/lib/dist/v-client-table.js',
            'node_modules/bootstrap/js/dropdown.js',
            'node_modules/bootstrap/js/collapse.js',
            'node_modules/bootstrap/js/alert.js',
            'node_modules/bootstrap/js/tab.js',
            'node_modules/bootstrap/js/transition.js',
            'node_modules/alertify.js/dist/js/alertify.js',
            'node_modules/dropzone/dist/dropzone.js',
            'node_modules/selectize/dist/js/standalone/selectize.js',
            'node_modules/fancybox/dist/js/jquery.fancybox.js',
            'node_modules/jquery-colorbox/jquery.colorbox-min.js',
            'public/packages/barryvdh/elfinder/js/standalonepopup.js',
            'resources/assets/js/admin/*',
            'resources/assets/typicms/app.js',
            'resources/assets/typicms/**/!(app)*.js'
        ];

    return gulp.src(files)
        .pipe(concat('components.js'))
        .pipe(ngAnnotate())
//        .pipe(uglify())
        .on('error', swallowError)
        .pipe(rename(destFile))
        .pipe(gulp.dest(destDir, {mode: fileMode}));

});

gulp.task('js-public', function () {

    var destDir = 'public/js/public',
        destFile = 'components.min.js',
        files = [
            'node_modules/jquery/dist/jquery.js',
            'node_modules/bootstrap/js/dropdown.js',
            'node_modules/bootstrap/js/collapse.js',
            'node_modules/bootstrap/js/alert.js',
            'node_modules/bootstrap/js/tab.js',
            'node_modules/bootstrap/js/transition.js',
            'node_modules/fancybox/dist/js/jquery.fancybox.js',
            'node_modules/swiper/dist/js/swiper.jquery.js',
            'resources/assets/js/public/**/*.js'
        ];

    return gulp.src(files)
        .pipe(gutil.env.prod ? stripDebug() : gutil.noop())
        .pipe(concat('components.js'))
        .pipe(gutil.env.prod ? uglify() : gutil.noop())
        .on('error', swallowError)
        .pipe(rename(destFile))
        .pipe(gulp.dest(destDir, {mode: fileMode}));

});

// Keep an eye on SASS and JS files* for changes…
// uncomment to watch LESS/JS admin if needed
gulp.task('watch', ['sass-public', 'js-public'], function () {
    gulp.watch('resources/assets/sass/**/*.scss', ['sass-public']);
    gulp.watch('resources/assets/js/public/**/*.js', ['js-public']);
    // gulp.watch('resources/assets/less/admin/**/*.less', ['less-admin']);
    // gulp.watch('resources/assets/less/*.less', ['less-admin']);
    // gulp.watch('resources/assets/js/admin/**/*.js', ['js-admin']);
    // gulp.watch('resources/assets/typicms/**/*.js', ['js-admin']);

});

// What tasks does running gulp trigger?
gulp.task('all', [
    'set-env-prod',
    'sass-public',
    'less-admin',
    'js-public',
    'js-admin',
    'fonts',
    'angular-locales',
    'fancybox-img',
    'elfinder-img',
    'ckeditor',
    'version'
]);

gulp.task('admin', [
    'less-admin',
    'js-admin',
    'angular-locales',
    'ckeditor'
]);

gulp.task('default', [
    'sass-public',
    'js-public',
    'watch'
]);
