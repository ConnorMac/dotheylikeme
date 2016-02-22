# Do They Like Me

Sentiment Analysis library [PHPInsight](https://github.com/JWHennessey/phpInsight)

## Installation

Setup should not require a database but if Cake complains setup a default one called: dotheylikeme

My home setup is using PHP 7.0.0 but it should work fine on earlier versions.

## Disclaimer

The Reddit API calls that run to get the comments for the threads it finds can take a while so be patient. I have yet to find a way to
optimize it.

## Key Files

/src/Controller/AnalysisController.php (Main logic)
/src/Template/Layout/default.ctp (default wrapper)
/src/Template/Analysis/index.ctp (index view)
/src/Template/Analysis/search.ctp (ajax view)

/webroot/js/app.js (custom js)
/webroot/css/app.css (custom styling)



