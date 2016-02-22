<?php

namespace App\Controller;

use Reddit\reddit;
use PHPInsight\Sentiment;

//Modified base php wrapper for the reddit api
require_once(ROOT . DS . "Vendor" . DS . "reddit-php-sdk-master" . DS . "reddit.php");
//Sentiment analysis php library
require_once(ROOT . DS . "Vendor" . DS . "PHPInsight" . DS . "Sentiment.php");

class AnalysisController extends AppController 
{

    public function initialize()
    {
        parent::initialize();

    	$this->Reddit = new Reddit;
    	$this->Sentiment = new Sentiment;
    }

    /**
    *
    * Site index
    *
    */
    public function index()
    {
    	$this->set('title', 'Do they like me?');
    }

    /**
    *
    * Ajax function to gather and sort reddit posts
    *
    */
	public function search()
	{
		$this->viewBuilder()->layout("ajax");

		$searchString = $this->request->data('search');

		//Get search results from all using our search term and in the last week
		//Uses reddit search which isn't the best but should give us relevant data
		$searchWithString = $this->Reddit->search($searchString, 'all', 20, 'month');
		//We can append any more listing data we want from other redit api calls
		if($searchWithString)
		{
			$listings = $searchWithString->data->children;
			$comments = array();

			//Get the comments for each returned listing
			foreach($listings as $key => $listing)
			{
				$subreddit = $listing->data->subreddit;
				$commentCode = explode('_', $listing->data->name)[1];

				if($subreddit && $commentCode)
				{
					//Get the comment data for each listing returned
					$rawCommentData = $this->Reddit->getComments($commentCode, $subreddit, 20);
					if(!empty($rawCommentData[1]))
					{
						//Extract the raw comment data out of the returned objects
						$commentData = $this->extractCommentData($rawCommentData[1]->data->children, "body" , $searchString);
						$comments = array_merge($comments, $commentData);
					}
				}
			}

			if($comments)
			{
				//Run all comments through sentimant analysis
				$proccessedData = $this->analysComments($comments);

				//Set view variables
				$this->set([
					'totalNeg' => $proccessedData['totalNeg'], 
					'totalPos' => $proccessedData['totalPos'], 
					'totalNeu' => $proccessedData['totalNeu'], 
					'commentsWithScore' => $proccessedData['commentsWithScore'], 
					'searchString' => $searchString
				]);
			}
			else
			{
				//just using a simple variable for error display
				$error = "No comments were found, please try again";
				$this->set(compact('error'));
			}
		}
		else
		{
			//just using a simple variable for error display
			$error = "No threads were found using the search term";
			$this->set(compact('error'));
		}
	}

	/**
	*
	* Runs each comment through Sentiment Analysis saves comments and calculates totals
	*
	* @param Array $comments
	* @return Array $data
	*
	*/
	private function analysComments($comments)
	{
		$data['commentsWithScore'] = array();
		$data['totalNeg'] = 0;
		$data['totalPos'] = 0;
		$data['totalNeu'] = 0;
		
		//Build array of scores as well as total sentiment ratings
		foreach($comments as $key => $comment)
		{
			$score = $this->Sentiment->score($comment);
			$data['totalNeg'] += $score['neg'];
			$data['totalPos'] += $score['pos'];
			$data['totalNeu'] += $score['neu'];

			//Lets set if a comment is Pos/Neg/Neu for easy filtering
			if($score['neg'] > $score['pos'] && $score['neg'] > $score['neu'])
			{
				$overallRating = 'neg';
			}
			elseif($score['pos'] > $score['neg'] && $score['pos'] > $score['neu'])
			{
				$overallRating = 'pos';
			}
			else {
				$overallRating = 'neu';
			}
			$temp['score'] = $score;
			$temp['comment'] = $comment;
			$temp['overalRating'] = $overallRating;

			array_push($data['commentsWithScore'], $temp);
		}

		$data['totalNeg'] = round($data['totalNeg']/count($comments), 2);
		$data['totalPos'] = round($data['totalPos']/count($comments), 2);
		$data['totalNeu'] = round($data['totalNeu']/count($comments), 2);

		$data['commentsWithScore'] = json_encode($data['commentsWithScore']);

		return $data;
	}

	/**
	*
	* Recursive function to extract values with the property/search term defined
	*
	* @param Object Array $data
	* @param String $propery 
	* @param String $search
	* @param Array $commentArray 
	* @return Array $commentArray
	*
	*/
	private function extractCommentData($data, $property, $search = NULL, &$commentArray = array())
	{
		foreach ($data as $key => $value)
		{
			if ($key === (String) $property) 
			{
				if($search)
				{
					$pos = strpos($value, $search);
					if($pos !== FALSE)
					{
						array_push($commentArray, $value);
					}
				}
			}
			if(is_object($value) || is_array($value))
			{
				$this->extractCommentData($value, $property, $search, $commentArray);
			}
		}

		return $commentArray;
	}

}