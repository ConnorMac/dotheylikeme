# Do They Like Me

Sentiment Analysis library [PHPInsight](https://github.com/JWHennessey/phpInsight)

## Installation

Setup should not require a database but if Cake complains setup a default one called: dotheylikeme

My home setup is using PHP 7.0.0 but it should work fine on earlier versions.

## Disclaimer

The Reddit API calls that run to get the comments for the threads it finds can take a while so be patient. I have yet to find a way to
optimize it.

Currently it uses the Reddit search API call to get the 10 most relevant posts within the month and then all the comments from
those threads. It then filters out the ones that just contain the search keyword and rates those.

## Key Files

/src/Controller/AnalysisController.php (Main logic)  
/src/Template/Layout/default.ctp (default wrapper)  
/src/Template/Analysis/index.ctp (index view)  
/src/Template/Analysis/search.ctp (ajax view)  

/webroot/js/app.js (custom js)  
/webroot/css/app.css (custom styling)  

## Missing Functionality

Currently there is no way to sort comments by date


