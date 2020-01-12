const gulp = require("gulp");
const sass = require("gulp-sass");
const autoprefixer = require("gulp-autoprefixer");
const cleanCSS = require("gulp-clean-css");
const rename = require("gulp-rename");

gulp.task("public-sass", function() {
  return gulp
    .src("public/scss/*.scss")
    .pipe(sass({ outputStyle: "expanded" })) // Converts Sass to CSS with gulp-sass
    .pipe(autoprefixer())
    .pipe(cleanCSS())
    .pipe(rename("small-form-public.min.css"))
    .pipe(gulp.dest("public/css/"));
});

gulp.task("watch", function() {
  gulp.watch("public/scss/*.scss", gulp.series("public-sass"));
});
