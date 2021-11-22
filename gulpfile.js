
 //Trae dependencia---import---dest es para decir donde almacenar el archivo css
 const { series, src, dest, watch, parallel } = require("gulp"); 
 //src para identificar una fuente
 
 const sass = require('gulp-sass')(require('sass'));
 const imagemin = require('gulp-imagemin');
 const gulp = require('gulp');
 const webp = require('gulp-webp');
 const concat = require('gulp-concat');
 const sourcemaps = require('gulp-sourcemaps');
 const plumber = require('gulp-plumber');
 const terser = require('gulp-terser-js');


 //utilities css
 
 const autoprefixer = require('autoprefixer');
 const postcss = require('gulp-postcss');
 const cssnano = require('cssnano');
 
 
 sass.compiler = require("dart-sass");
 
 const paths = {
     imagenes: "src/img/**/*",
     js: 'src/js/**/*.js',
     scss: 'src/scss/**/*.scss',
 }
 
 
 
 function imagenes () {
    const options = {
        optimizationLevel: 3
    }
     return src(paths.imagenes)
         .pipe( imagemin(options) )
         .pipe( dest('./build/img') );
 }
 
 function versionWebp() {
    const options = {
        quality: 50
    };
     return src(paths.imagenes)
         .pipe( webp(options) )
         .pipe( dest('./build/img') );
 }
 

 function javascript( done ) {
    src('src/js/**/*.js')
        .pipe(sourcemaps.init())
        .pipe( terser() )
        .pipe(sourcemaps.write('.'))
        .pipe(dest('build/js'));

    done();
}
 

 function compilarSASS( done ) {
    src('src/scss/**/*.scss') // Identificar el archivo .SCSS a compilar
        .pipe(sourcemaps.init())
        .pipe( plumber())
        .pipe( sass() ) // Compilarlo
        .pipe( postcss([ autoprefixer(), cssnano() ]) )
        .pipe(sourcemaps.write('.'))
        .pipe( dest('build/css') ) // Almacenarla en el disco duro
    done();
}
 
 
 
 function watchData() {
     watch("./src/scss/*.scss", compilarSASS); //archivo y tarea a ejecutar
     watch(paths.js, javascript);
 }
  
 
 //Saber si existe
 //nombre tarea, nombre funcion
 exports.css = compilarSASS ;
 exports.compressed_img = imagenes;
 exports.watchData = watchData;
 exports.default = series( compilarSASS, javascript ,imagenes, versionWebp, watchData)