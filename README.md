# SmartPush
Api of test for push notification Android &amp; IOS

Send push notification to APNS and Google

# Usage example:
Make a request POST with fields:

<h3>IOS</h3>
  * type => 'ios'
  * deviceToken
  * badge => int optional
  * msg

<h3>ANDROID</h3>
  * type => 'android'
  * deviceToken => array
  * title
  * subtitle
  * msg
  * tickerText (optional)
