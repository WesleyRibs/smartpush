# SmartPush
Api of test for push notification Android &amp; IOS

Send push notification to APNS and Google

# Usage example:
Make a request POST with fields:

<h2>IOS</h2>
  * type => 'ios'
  * deviceToken
  * badge => int optional
  * msg

<h2>ANDROID</h2>
  * type => 'android'
  * deviceToken
  * title
  * subtitle
  * msg
  * tickerText (optional)
