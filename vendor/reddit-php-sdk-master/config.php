<?php
namespace Reddit;
class redditConfig{
    //standard, oauth token fetch, and api request endpoints
    static $ENDPOINT_STANDARD = 'http://www.reddit.com';
    static $ENDPOINT_OAUTH = 'https://oauth.reddit.com';
    static $ENDPOINT_OAUTH_AUTHORIZE = 'https://www.reddit.com/api/v1/authorize';
    static $ENDPOINT_OAUTH_TOKEN = 'https://www.reddit.com/api/v1/access_token';
    static $ENDPOINT_OAUTH_REDIRECT = 'http://dev.dotheylikeme.com/search';
    static $REQUIRES_OAUTH = FALSE;
    
    //access token configuration from https://ssl.reddit.com/prefs/apps
    static $CLIENT_ID = 'cnP7JcG-ctLsJw';
    static $CLIENT_SECRET = 'BNOi7AMuzWKvClFRRExesQaG0uc';
    
    //access token request scopes
    //full list at http://www.reddit.com/dev/api/oauth
    static $SCOPES = '';
}
?>
